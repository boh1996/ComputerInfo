<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	/**
	 * This function is called as standard when the login page is requested
	 * @since 1.0
	 * @access public
	 */
	public function index(){
		redirect("home/login");
	}

	public function Redirect () {
		redirect("home/login");
	}

	/**
	 * Is everything set properly
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _Is_Set () {
		$this->load->helper("cookie");
		return (isset($_SESSION[$this->config->item("user_id_session")]) && get_cookie("token") != null && get_cookie("token") != false && get_cookie("token") != "");
	}

	/**
	 * This function redirects the user, to the login with username view
	 * @since 1.0
	 * @access public
	 */
	public function Username () {
		redirect("home/login");
	}

	/**
	 * This function lets the user login with Google
	 * @param string $page The current operation "auth" or "callback"
	 * @param string $platform The platform the user is authenticating from
	 * @since 1.0
	 * @access public
	 */
	public function Google($page = "auth",$platform = "web"){
		if(!self::_Is_Set()){
			$this->load->library("auth/google");
			$this->load->library("token");
			$this->load->library("User");
			$this->load->config("api");
			$this->load->model("login_model");
			$Google = new Google();
			$Google->client();
			$Google->redirect_uri($this->computerinfo_security->CheckHTTPS(base_url()."login/google/callback"));
			$Google->scopes(array("userinfo.profile","userinfo.email"));
			$Google->state($platform);
			$Google->access_type("offline");
			if($page == "auth"){
				self::Logout(false);
				$Google->auth();
			} else if($page == "callback"){
				$Google->callback();
				if ($Google->state() != "web") {
					if (!$Google->access_token()) {
						self::_redirect(base_url() . "login/windows");
						return;
					}
					if ($Google->state() == "windows") {
						header("Location: ".$this->computerinfo_security->CheckHTTPS(base_url() . "login/windows?access_token=".$Google->access_token()));
						return;
					}
				}
				$Account = $Google->account_data();
				if($Account !== false && $Account != NULL){
					$this->login_model->Google($Account->id,$Account->name,$Account->email,$UserId);
					if(!is_null($UserId)){
						$User = new User();
						if (!$User->Load($UserId)) { 
							self::_redirect($this->config->item("login_page"));
						}
						$_SESSION[$this->config->item("user_id_session")] = $User->id;
						$Token = new Token();
						$Token->Create($User->id);
						$this->load->helper("cookie");
						set_cookie("token",$Token->token,$Token->time_to_live);
						self::_redirect($this->config->item("front_page"));
					} else {
						self::_redirect($this->config->item("login_page"));
					}
				} else { 
					self::_redirect($this->config->item("login_page"));
				}
			}
		} else {
			self::_redirect($this->config->item("front_page"));
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
		redirect($this->computerinfo_security->CheckHTTPS(site_url($url)));
	}

	public function Reset () {
		self::Logout(false);
		self::_redirect("home/login");
	}

	/**
	 * This function checks if the entered password and username is corrected and matches
	 * @param  object &$user_object This will contain the current user, if succes
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _check_user_login ( &$user_object ) {
		$this->load->library("User");
		$this->load->library("auth/login_security");

		//If the user already is logged in
		if (isset($_SESSION[$this->config->item("user_id_session")]) && $this->computerinfo_security->User_Exists($_SESSION[$this->config->item("user_id_session")])) {
			$User = new User();
			$User->Load($_SESSION[$this->config->item("user_id_session")]);
			$user_object = $User;
			return TRUE;

		//Else destroy the old session
		} else if (isset($_SESSION[$this->config->item("user_id_session")])) {
			$this->load->helper("cookie");
			unset($_SESSION[$this->config->item("user_id_session")]);
			delete_cookie("PHPSESSID");
			delete_cookie("token");
		}
		//If no password or usernmae is posted
		if ($this->input->post('username') == false || $this->input->post('password') == false) {
			return FALSE;
		}
		//Get the password and username
		$User = new User();
		$username = $this->login_security->check_security($this->input->post('username'));
		$password = $this->login_security->check_security($this->input->post('password'));

		//If any of the input variables is empty
		if (is_null($username) || is_null($password) || $password === false || $username === false) {
			return FALSE;
		}

		//The user is as standard set as not authenticated
		$authenticated = false;

		//If the 
		if (filter_var($username, FILTER_VALIDATE_EMAIL) && $User->Load(array("email" => $username)) && !is_null($User->password)) {
			$authenticated = true;
		} else if ($User->Load(array("username" => $username)) && !is_null($User->username) && !is_null($User->password)) {
			$authenticated = true;
		}

		//If the user is authenticated check the password and set the username to $user_object
		if ($authenticated === true) {
			if ($this->login_security->check($password, $User->password, $User->login_token,$User->hashing_iterations)) {
				$user_object = $User;
				return true;
			} else {
				return false;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This view/function is called when the form is submitted
	 * @since 1.0
	 * @access public
	 */
	public function Enter () {
		if (self::_check_user_login($User) && !is_null($User->id)) {
			$_SESSION[$this->config->item("user_id_session")] = $User->id;
			$this->load->library("token");
			$this->load->config("api");
			$Token = new Token();
			$Token->Create($User->id);
			$this->load->helper("cookie");
			set_cookie("token",$Token->token,$Token->time_to_live);
			self::_redirect($this->config->item("front_page"));
		} else {
			self::_redirect($this->config->item("login_page"));
		}
	}

	/**
	 * This function is called if it's a device that is using the login form
	 * @param string $type The authentication type
	 * @since 1.0
	 * @access public
	 */
	public function Device ($type = "username") {
		$authenticated = false;
		$this->load->library("user");
		switch ($type) {
			case 'google':
				if (!isset($_GET["access_token"])) {
					break;
				}
				$access_token = $_GET["access_token"];
				if (self::_Google_Auth_Access_Token($access_token,$User)) {
					$authenticated = true;
				}
			break;
				
			default:
				if (self::_check_user_login($User)) {
					$authenticated = true;
				}
			break;
		}
			if ($authenticated && isset($User)) {
				$this->load->library("token");
				$this->load->config("api");
				$Token = new Token();
				$Token->offline = 1;
				$Token->Create($User->id);
				$_SESSION[$this->config->item("user_id_session")] = $User->id;
				echo json_encode(array("User" => $User->Export(),"status" => "OK","token" => $Token->Export(null, false, array("user","created"))));
			} else {
				echo json_encode(array("User" => null,"status" => "FAIL"));
			}
	}

	/**
	 * This function gets user data by access token from googles servers
	 * @since 1.0
	 * @access private
	 * @param string $access_token The access token to use as auth
	 * @param object &$User         A variable to store the user object
	 */
	private function _Google_Auth_Access_Token ($access_token, &$User) {
		$this->load->library("auth/google");
		$this->load->config("api");
		$this->load->model("login_model");
		$Google = new Google();
		$Google->client();
		$Google->access_token($access_token);
		$account_data = $Google->account_data();
		if (!isset($account_data->email)) {
			return FALSE;
		}
		if($account_data !== false && $account_data != NULL){
			$this->login_model->Google($account_data->id,$account_data->name,$account_data->email,$user_id);
			if(!is_null($user_id)){
				$User = new User();
				$User->Load($user_id);
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * This function is used to log a user in using the windows client
	 * @param string $platform The current platform
	 * @since 1.0
	 * @access public
	 */
	public function Desktop ($platform = "windows") {
		$this->load->library("token");
		$Token = new Token();
		$authenticated = false;
		if (self::_check_user_login($User) && !is_null($User->id)) {
			$authenticated = true;
		} else if (isset($_GET["access_token"])) {
			if (self::_Google_Auth_Access_Token($_GET["access_token"],$User)) {
				$authenticated = true;
			}
		}	
		if ($authenticated) {
			$this->load->config("api");
			$Token->Create($User->id);
			$this->load->helper("cookie");
			$Token->offline = true;
			echo '<div style="display:none;" id="token">'.$Token->token.'</div>';
		} else {
			if (isset($_COOKIE["token"]) && $Token->Load(array("token" => $_COOKIE["token"]))) {
				echo '<div style="display:none;" id="token">'.$Token->token.'</div>';
			}
		}
	}

	/**
	 * This function logs the user out
	 * @since 1.0
	 * @access public
	 */
	public function Logout ( $redirect = true) {
		$this->computerinfo_security->Logout();
		if ($redirect) {
			self::_redirect($this->config->item("not_logged_in_page"));
		}
	}
}
?>