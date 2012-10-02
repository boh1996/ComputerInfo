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
				$data = array("errors" => json_encode(array("Passwords not matching")));
				self::_Show_View($data);
			}
			$captcha = recaptcha_check_answer($this->config->item("recaptcha_private_key"), $_SERVER["REMOTE_ADDR"],$this->input->post("recaptcha_challenge_field"),$this->input->post("recaptcha_response_field"));
			if (!$captcha->is_valid){
				self::_Show_View(array("errors" => json_encode(array($captcha->error))));
			} else {
				if (self::_Check_User_Input($this->input->post("username"),$this->input->post("password"),$this->input->post("email"),$this->input->post("name"),$errors) !== true) {
					$data = array("errors" => json_encode($errors));
					self::_Show_View($data);
				}
			}
		} else {
			$data = array(
				"errors" => json_encode(array("Missing fields" . implode(",",$missing)))
			);
			self::_Show_View($data);
		}
	}

	/**
	 * This function shos the register view
	 * @param array $data The custom input data
	 * @since 1.0
	 * @access private
	 */
	private function _Show_View ($data = array()) {
		$data = array_unique(array_merge($data,$this->_recaptcha));
		$this->load->view("user_register_view",$this->computerinfo_security->ControllerInfo($data));
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
			$errors[] = "Username needs to be 5 characters or more";
		}
		if (!self::_Password_Correct($password)) {
			$errors[] = "Password needs to be 7 characters or more and include numbers";
		}
		if (!self::_Email_Check($email)) {
			$errors[] = "Not a matching email";
		}
		if (count($errors) > 0) {
			return false;
		}
		$errors[] = "Username or email already exists";
		return self::_Register_User($username,$password,$email,$name);

	}

	/**
	 * This endpoint is called when a user is trying to resend the activation email
	 * @since 1.0
	 * @access public
	 * @param integer $id The register token id
	 */
	public function Resend ($id = null) {
		$this->load->library("register_token");
		$Register_Token = new Register_Token();
		if ($Register_Token->Load($id)) {
			self::_Send_Activation_Email($Register_Token,$Register_Token->name,$Register_Token->email);	
		} else {
			echo "Sorry no user found";
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
			echo "A token is needed";
			return;
		}
		$this->load->library("register_token");
		$Register_Token = new Register_Token();
		if ($Register_Token->Load(array("token" => $token))) {
			if (self::_Activate($Register_Token,$User)) {
				self::_Login($User);
				$Register_Token->Delete();
				self::_redirect($this->config->item("front_page"));
			} else {
				echo "Sorry we couldn't activate that user!";
			}
		} else {
			echo "Sorry no user found";
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
	 * @param object $user The user to log in
	 */
	private function _Login ($user) {
		$_SESSION["user_id"] = $user->id;
		$this->load->library("token");
		$this->load->config("api");
		$Token = new Token();
		$Token->Create($user->id);
		$this->load->helper("cookie");
		set_cookie("token",$Token->token,$Token->time_to_live);
	}

	/**
	 * This function activates a user using a register token object
	 * @since 1.0
	 * @access private
	 * @param object $register_token The register token object to load the data from
	 * @param object &$User A variable to hold the created user
	 */
	private function _Activate ($register_token, &$User) {
		$this->load->library("user");
		$User = new User();
		$User->username = $register_token->username;
		$User->password = $register_token->password;
		$User->email = $register_token->email;
		$User->hashing_iterations = $register_token->hashing_iterations;
		$User->login_token = $register_token->user_salt;
		return ($User->Save());
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
			"{token}" => $register_token->token
		);
		echo '<a href="'.$this->computerinfo_security->CheckHTTPS(base_url()."user/activate/resend/".$register_token->id).'">Resend activation email!</a>';
		return self::_Send_Email($name, $email, $this->config->item("register_mail_subject"),$this->config->item("register_mail_template"),$template_variables);
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
}