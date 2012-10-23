<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/recaptchalib.php');
class User_Management extends CI_Controller {

	/**
	 * The recaptcha config
	 * @var array
	 */
	private $_recaptcha = array();

	public function __construct () {
		parent::__construct();
		$this->user_control->batch_load_lang_files(array(
			"register",
			"reset_password"
		));
		$this->load->config("recaptcha");
		$this->_recaptcha = array(
			"recaptcha_url" => $this->computerinfo_security->CheckHTTPS("http://www.google.com/recaptcha/api/challenge?k=".$this->config->item("recaptcha_public_key")),
			"recaptcha_noscript_url" => $this->computerinfo_security->CheckHTTPS("http://www.google.com/recaptcha/api/noscript?k=".$this->config->item("recaptcha_public_key"))
		);
	}

	public function index () {}

	/**
	 * This function is called when the register view is reguested
	 * @since 1.0
	 * @access public
	 */
	public function Register () {
		$data = array();
		$data = array_merge($data,$this->_recaptcha);
		$this->load->view("user_register_view",$this->computerinfo_security->ControllerInfo($data));
	}	

	/**
	 * This function is called when data is posted from the register view
	 * @since 1.0
	 * @access public
	 */
	public function Check () {
		if (isset($_POST["username"]) && !empty($_POST["username"])) {
			self::_Register();
		} else {
			redirect($this->computerinfo_security->CheckHTTPS(base_url()."users/sign_up"));
		}
	}

	/**
	 * This function collects all the user input
	 * @since 1.0
	 */
	private function _Register () {
		$this->load->library("input");
		if (self::_Input_Check(array("username","email","password","name","recaptcha_challenge_field","re-password","recaptcha_response_field"),$missing)) {
			if ($this->input->post("re-password") != $this->input->post("password")) {
				$data = array(
					"errors" => json_encode(array($this->lang->line("error_password_not_macthing"))),
					"username" => $this->input->post("username"),
					"email" => $this->input->post("email"),
					"name" => $this->input->post("name")
				);
				self::_Show_View($data);
				return FALSE;
			}
			$captcha = recaptcha_check_answer($this->config->item("recaptcha_private_key"), $_SERVER["REMOTE_ADDR"],$this->input->post("recaptcha_challenge_field"),$this->input->post("recaptcha_response_field"));
			if (!$captcha->is_valid){
				self::_Show_View(array(
					"errors" => json_encode(array($captcha->error)),
					"username" => $this->input->post("username"),
					"email" => $this->input->post("email"),
					"name" => $this->input->post("name")
				));
				return;
			} else {
				if (self::_Check_User_Input($this->input->post("username"),$this->input->post("password"),$this->input->post("email"),$this->input->post("name"),$errors) !== true) {
					$data = array(
						"errors" => json_encode($errors),
						"username" => $this->input->post("username"),
						"email" => $this->input->post("email"),
						"name" => $this->input->post("name")
					);
					self::_Show_View($data);
				}
				return;
			}
		} else {
			//Needs translations
			$data = array(
				"errors" => json_encode(array("Missing fields" . implode(",",$missing)))
			);
			self::_Show_View($data);
		}
	}

	/**
	 * This function shos the register view
	 * @param array $data The custom input data
	 * @param string $view The view to show
	 * @since 1.0
	 * @access private
	 */
	private function _Show_View ($data = array(), $view = "user_register_view") {
		$data = array_unique(array_merge($data,$this->_recaptcha));
		$this->load->view($view,$this->computerinfo_security->ControllerInfo($data));
	}

	/**
	 * This function ensures that the input data has the correct pattern
	 * @since 1.0
	 * @access private
	 * @return boolean
	 * @param string $username The users reguested userame
	 * @param string $password The users dessired password
	 * @param string $email    The users email
	 * @param string $name     The users name
	 * @param array $errors   A variable to store possibly errors in
	 */
	private function _Check_User_Input ($username, $password, $email, $name, &$errors) {
		$errors = array();
		if (!self::_Username_Correct($username)) {
			$errors[] = $this->lang->line("register_username_requirement");
		}
		if (!self::_Password_Correct($password)) {
			$errors[] = $this->lang->line("register_password_requirement");
		}
		if (!self::_Email_Check($email)) {
			$errors[] = $this->lang->line("register_not_valid_email");
		}
		if (count($errors) > 0) {
			return false;
		}
		$errors[] = $this->lang->line("register_username_or_email_exists");
		return self::_Register_User($username,$password,$email,$name);

	}

	/**
	 * This endpoint is called when a user is trying to resend the activation email
	 * @since 1.0
	 * @access public
	 * @param integer $identifier The register token string identifier
	 */
	public function Resend ($identifier = null) {
		$this->load->library("register_token");
		$Register_Token = new Register_Token();
		if ($Register_Token->Load(array("identifier" => $identifier)) && !is_null($Register_Token->id)) {
			self::_Send_Activation_Email($Register_Token,$Register_Token->name,$Register_Token->email);	
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array("message" => $this->lang->line("register_resend_no_user_found"))));
		}
	}

	/**
	 * This endpoint is called when an activation link is pressed
	 * @since 1.0
	 * @access public
	 * @param string $token The token that links to the user to activate
	 */
	public function Activate ($token = null) {
		if (is_null($token)) {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array("message" => $this->lang->line("register_no_token_found"))));
			return;
		}
		$this->load->library("register_token");
		$Register_Token = new Register_Token();
		if ($Register_Token->Load(array("token" => $token))) {
			$User = self::_Activate($Register_Token);
			if (is_object($User)) {
				self::_Login($User->id);
				$Register_Token->Delete();
				self::_redirect($this->config->item("front_page"));
			} else {
				$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array("message" => $this->lang->line("register_we_couldnt_activate"))));
			}
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array("message" => $this->lang->line("register_resend_no_user_found"))));
		}
	}

	/**
	 * This function redirects the user
	 * @since 1.0
	 * @access private
	 * @param  stirng $url The url to redirect too;
	 * @return 
	 */
	private function _redirect ( $url ) {
		redirect((strpos(site_url($url),'http') !== false) ? site_url($url) : $this->Computerinfo_Security->CheckHTTPS(site_url($url)));
	}

	/**
	 * This function logs the newly created user in
	 * @since 1.0
	 * @access private
	 * @param integer $user_id The id of the user to login
	 */
	private function _Login ($user_id) {
		$_SESSION["user_id"] = $user_id;
		$this->load->library("token");
		$this->load->config("api");
		$Token = new Token();
		$Token->Create($user_id);
		$this->load->helper("cookie");
		set_cookie("token",$Token->token,$Token->time_to_live);
	}

	/**
	 * This function activates a user using a register token object
	 * @since 1.0
	 * @access private
	 * @param object $register_token The register token object to load the data from
	 */
	private function _Activate ($register_token) {
		$this->load->library("user");
		$User = new User();
		$User->username = $register_token->username;
		$User->password = $register_token->password;
		$User->email = $register_token->email;
		$User->name = $register_token->name;
		$User->hashing_iterations = $register_token->hashing_iterations;
		$User->login_token = $register_token->user_salt;
		if ($User->Save()) {
			return $User;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function saves the user to the register tokens database and send an email to the user
	 * @since 1.0
	 * @access private
	 * @param string $username The users username
	 * @param string $password The users password
	 * @param string $email    The users email
	 * @param string $name     The name of the user
	 * @return boolean
	 */
	private function _Register_User ($username, $password, $email, $name) {
		$this->load->library("user");
		$this->load->library("register_token");
		$this->load->library("auth/login_security");
		$User = new User();
		$Register_Token = new Register_Token();
		if ($User->Load(array("username" => $username)) || $User->Load(array("email" => $email)) || $Register_Token->Load(array("username" => $username)) || $Register_Token->Load(array("email" => $email))) {
			return FALSE;
		}
		$password = $this->login_security->createUser($password,$this->config->item("hashing_iterations"),$this->config->item("user_salt_length"),$user_salt);
		$user_data = array(
			"name" => $name,
			"username" => $username,
			"email" => $email,
			"password" => $password,
			"user_salt" => $user_salt,
			"hashing_iterations" => $this->config->item("hashing_iterations")
		);
		$Register_Token->Import($user_data);
		if ($Register_Token->Create()){
			return self::_Send_Activation_Email($Register_Token,$name,$email);
		} else {
			return FALSE;
		}
	}	

	/**
	 * This function deletes a users registration
	 * @since 1.0
	 * @access public
	 * @param string $identifier The register token string identifier
	 */
	public function Delete ($identifier = null) {
		$this->load->library("register_token");
		$Register_Token = new Register_Token();
		if ($Register_Token->Load(array("identifier" => $identifier))) {
			$Register_Token->Delete();
			$template_constants = array(
				"{signup_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."users/sign_up")
			);
			$template = $this->lang->line("registration_removed");
			$template_data = self::_Template_Mix($template_constants);
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
				"message" => self::_Template($template_data,$template)
			)));
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array("message" => $this->lang->line("register_resend_no_user_found"))));
		}
	}

	/**
	 * This function returns the standard constants mixed with the custom
	 * @param array $constants The custom constrants
	 * @since 1.1
	 * @access private
	 * @return array
	 */
	private function _Template_Mix ($constants = null) {
		$template_constants = array(
			"{base_url}" => $this->computerinfo_security->CheckHTTPS(base_url()),
			"{asset_url}" => $this->computerinfo_security->CheckHTTPS(base_url().$this->config->item("asset_url")),
			"{webmaster_email}" => $this->config->item("webmaster_email"),
			"{organization_name}" => $this->config->item("email_sender_name"),
			"{app_name}" => $this->config->item("app_name")
		);
		if (!is_null($constants) && is_array($constants)) {
			$template_data = array_unique(array_merge($template_constants,$constants));
		} else {
			$template_data = $template_constants;
		}
		return $template_data;
	}

	/**
	 * This function ensures that the email is sent to the user
	 * @since 1.0
	 * @access private
	 * @param object $register_token The register token object
	 * @param string $name The name of the reciever
	 * @param string $email The recievers email
	 * @return boolean
	 */
	private function _Send_Activation_Email ($register_token, $name, $email) {
		$template_variables = array(
			"{activation_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/activate/".$register_token->token),
			"{token}" => $register_token->token,
			"{email}" => $email,
			"{name}" => $name,
			"{resend_activation_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/activate/resend/".$register_token->identifier),
			"{remove_email_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/register/delete/".$register_token->identifier),
		);
		$template = $this->lang->line("register_activation_mail_send");
		$template_data = self::_Template_Mix($template_variables);
		$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
			"message" => self::_Template($template_data,$template)
		)));
		return self::_Send_Email($name, $email, $this->lang->line("register_mail_subject"),$this->lang->line("register_mail_template"),$template_variables);
	}

	/**
	 * This function sends the reset message to the user
	 * @since 1.0
	 * @access private
	 * @param object $reset_token The reset token object
	 * @param string $name        The name of the reciever
	 * @param string $email       The users email, to send the email to
	 * @return boolean
	 */
	private function _Send_Password_Reset_Email ($reset_token, $name, $email) {
		$template_variables = array(
			"{token}" => $reset_token->token,
			"{reset_time}" => date("H:i:s"),
			"{reset_day}" => date("d-m-Y"),
			"{resend_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/reset/password/resend/".$reset_token->identifier),
			"{reset_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/reset/password/new/".$reset_token->token),
			"{remove_url}" => $this->computerinfo_security->CheckHTTPS(base_url()."user/remove/new/password/".$reset_token->identifier),
			"{email}" => $email,
			"{name}" => $name,
		);
		$template = $this->lang->line("password_reset_email_send");
		$template_data = self::_Template_Mix($template_variables);
		$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
			"message" => self::_Template($template_data,$template),
			"title" => $this->lang->line("ui_reset_password")
		)));
		return self::_Send_Email($name, $email, $this->lang->line("reset_password_mail_subject"),$this->lang->line("reset_password_mail_template"),$template_variables);
	}

	/**
	 * This function sends an email to a user
	 * @since 1.0
	 * @access private
	 * @param string $name    The name of the user that this email is sent to
	 * @param string $email   The email of the user to send the email too
	 * @param string $subject The subject of the email
	 * @param string $template The mail template
	 * @param array $template_variables Replacements to be used when using templates
	 */
	private function _Send_Email ($name, $email,$subject,$template, $template_variables = null) {
		$this->load->helper("custom_email");
		$headers = array(
			"X-Mailer" => 'PHP/' . phpversion(),
			"Reply-To" => $this->config->item("webmaster_email"),
			"From" => $this->config->item("email_sender_name")." " . "<".$this->config->item("webmaster_email").">",
			"MIME-Version" => "1.0",
			"Content-type" => "text/html; charset=iso-8859-1"
		);
		$template_constants = array(
			"{base_url}" => $this->computerinfo_security->CheckHTTPS(base_url()),
			"{email}" => $email,
			"{asset_url}" => $this->computerinfo_security->CheckHTTPS(base_url().$this->config->item("asset_url")),
			"{name}" => $name,
			"{webmaster_email}" => $this->config->item("webmaster_email"),
			"{organization_name}" => $this->config->item("email_sender_name"),
			"{app_name}" => $this->config->item("app_name")
		);
		if (!is_null($template_variables) && is_array($template_variables)) {
			$template_data = array_unique(array_merge($template_constants,$template_variables));
		} else {
			$template_data = $template_constants;
		}
		$email_content = self::_Template($template_data,$template);
		$subject = self::_Template($template_data,$subject);
		send_email($email,$subject,$email_content,$headers);
		return TRUE;
	}

	/**
	 * This function replaces all the template variables with the desired value
	 * @param array $variables An array of the keys to replace and the values to replace them with
	 * @param string $template  The template as string
	 * @return string
	 * @since 1.0
	 * @access private
	 */
	private function _Template ( $variables, $template ) {
		$content = $template;
		foreach ($variables as $variable => $value) {
			$content = str_replace($variable, $value, $content);
		}
		return $content;
	}

	/**
	 * This function checks if the password matches length and characters
	 * @param string $password The password to test
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _Password_Correct ($password) {
		if ($this->config->item("password_length")) {
			if (strlen($password) >= $this->config->item("password_length")) {
				if ($this->config->item("password_pattern") != "") {
					return (preg_match($this->config->item("password_pattern"),$password) > 0);
				} else {
					return TRUE;
				}
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}

	/**
	 * This function checks if an email matches the correct pattern
	 * @since 1.0
	 * @access private
	 * @return boolean
	 * @param string $email The email to match
	 */
	private function _Email_Check($email) {
		return (filter_var($email, FILTER_VALIDATE_EMAIL));
	}

	/**
	 * This function checks the length of the username
	 * @param string $username The desired username
	 * @since 1.0
	 * @access private
	 */
	private function _Username_Correct ($username) {
		if ($this->config->item("username_length") > 0) {
			return (strlen($username) >= $this->config->item("username_length"));
		} else {
			return TRUE;
		}
	}

	/**
	 * This function checks POST fields
	 * @since 1.0
	 * @access private
	 * @param array $fields The post fields to check
	 * @return boolean
	 */
	private function _Input_Check ($fields, &$missing) {
		$missing = array();
		foreach ($fields as $field) {
			$missing[] = $field;
			if (!isset($_POST[$field]) || empty($_POST[$field])) {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * This function shows the reset password view
	 * @since 1.0
	 * @access public
	 */
	public function Forgot_Password () {
		self::_Show_View(array(),"reset_password_view");
	}

	/**
	 * This function is called when a user posts from the reset password form
	 * @since 1.0
	 * @access public
	 */
	public function Reset_Password () {
		$this->load->library("user");
		$User = new User();
		if (self::_Input_Check(array("email","recaptcha_challenge_field","recaptcha_response_field"),$missing)) {
			$captcha = recaptcha_check_answer($this->config->item("recaptcha_private_key"), $_SERVER["REMOTE_ADDR"],$this->input->post("recaptcha_challenge_field"),$this->input->post("recaptcha_response_field"));
			if (!$captcha->is_valid){
				self::_Show_View(array(
					"errors" => json_encode(array($captcha->error)),
					"email" => $this->input->post("email")
				),"reset_password_view");
				return;
			} else {
				if(!self::_Email_Check($this->input->post("email"))) {
					self::_Show_View(array(
						"errors" => json_encode(array($this->lang->line("not_a_valid_email")))
					),"reset_password_view");
				}
				$email = $this->input->post("email");
				if ($User->Load(array("email" => $email))) {
					if (self::_Reset_Password($email,$User) === false) {
						$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
							"message" => $this->lang->line("password_reset_has_been_requested"),
							"title" => $this->lang->line("ui_reset_password")
						)));
					}
				} else {
					$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
						"message" => $this->lang->line("reset_password_no_user_found"),
						"title" => $this->lang->line("ui_reset_password")
					)));
				}
			}
		} else {	
			self::_Show_View(array("error" => json_encode($missing)),"reset_password_view");
		}
	}

	/**
	 * This function is the backend of the send reset email form
	 * @since 1.0
	 * @access private
	 * @param string $email The users email
	 * @param object $user  The user object
	 * @since 1.0
	 * @access private
	 */
	private function _Reset_Password ($email, $user) {
		$this->load->library("reset_password_token");
		$Reset_Token = new Reset_Password_Token();
		if ($Reset_Token->Load(array("email" => $email))) {
			return FALSE;
		}
		$Reset_Token->user = $user->id;
		$Reset_Token->email = $email;
		$Reset_Token->Create();
		return self::_Send_Password_Reset_Email($Reset_Token,$user->name, $user->email);
	}

	/**
	 * This function resends the password reset email
	 * @param string $identifier The token identifier
	 * @since 1.0
	 * @access public
	 */
	public function Password_Resend ($identifier = null) {
		$this->load->library("reset_password_token");
		$Reset_Token = new Reset_Password_Token();
		if ($Reset_Token->Load(array("identifier" => $identifier))) {
			self::_Send_Password_Reset_Email($Reset_Token,$Reset_Token->user->name,$Reset_Token->email);
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
				"message" => $this->lang->line("reset_password_no_request_found"),
				"title" => $this->lang->line("ui_reset_password")
			)));
		}
	}

	/**
	 * This function checks if the token is correct and then shows the change password view
	 * @since 1.0
	 * @access public
	 * @param string $token The reset password token
	 */
	public function Create_New_Password ($token = null) {
		$this->load->library("reset_password_token");
		$Reset_Token = new Reset_Password_Token();
		if (!is_null($token) && $Reset_Token->Load(array("token" => $token))) {
			$this->load->view("reset_create_new_password_view",$this->computerinfo_security->ControllerInfo(array(
				"token" => $Reset_Token->token,
				"title" => $this->lang->line("ui_reset_password")
			)));
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
				"message" => $this->lang->line("reset_password_no_request_found"),
				"title" => $this->lang->line("ui_reset_password")
			)));
		}
	}

	/**
	 * This function is the post endpoint for the change password form
	 * @since 1.0
	 * @access public
	 */
	public function Reset_Password_Check () {
		if (self::_Input_Check(array("password","re-password","token"),$missing)) {
			if ($this->input->post("password") != $this->input->post("re-password")) {
				self::_Show_View(array("error" => json_encode(array($this->lang->line("error_password_not_macthing")))),"reset_create_new_password_view");
				return;
			}
			if (!self::_Password_Correct($this->input->post("password"))) {
				self::_Show_View(array("error" => json_encode(array($this->lang->line("password_pattern_description")))),"reset_create_new_password_view");
				return;
			}
			$this->load->library("reset_password_token");
			$this->load->library("user");
			$this->load->library("auth/login_security");
			$Reset_Token = new Reset_Password_Token();
			$User = new User();
			if ($Reset_Token->Load(array("token" => $this->input->post("token")))) {
				$User->Load($Reset_Token->user->id);
				$User->hashing_iterations = $this->config->item("hashing_iterations");
				$User->password = $this->login_security->createUser($this->input->post("password"),$this->config->item("hashing_iterations"),$this->config->item("user_salt_length"),$user_salt);
				$User->login_token = $user_salt;
				if ($User->Save()) {
					$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
						"message" => $this->lang->line("successfully_changed_password"),
						"title" => $this->lang->line("ui_reset_password")
					)));
					$Reset_Token->Delete();
				} else {
					self::_Show_View(array("error" => json_encode(array($this->lang->line("error_no_token_found"))),"token" => $this->input->post("token")),"reset_create_new_password_view");
				}
			} else {
				self::_Show_View(array("error" => json_encode(array($this->lang->line("error_no_token_found")))),"reset_create_new_password_view");
			}
		} else {
			self::_Show_View(array("error" => json_encode(array($this->lang->line("error_missing_input")))),"reset_create_new_password_view");
		}
	}

	/**
	 * This function removes the password reset request
	 * @param string $identifier The string identifier of the token
	 * @since 1.0
	 * @access public
	 */
	public function Remove_New_Password ($identifier = null) {
		$this->load->library("reset_password_token");
		$Reset_Token = new Reset_Password_Token();
		if ($Reset_Token->Load(array("identifier" => $identifier))) {
			$Reset_Token->Delete();
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
				"message" => $this->lang->line("password_reset_removed"),
				"title" => $this->lang->line("ui_reset_password")
			)));
		} else {
			$this->load->view("register_status_view",$this->computerinfo_security->ControllerInfo(array(
				"message" => $this->lang->line("reset_password_no_request_found"),
				"title" => $this->lang->line("ui_reset_password")
			)));
		}
	}
}