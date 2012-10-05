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
		return (isset($_SESSION["user_id"]) && get_cookie("token") != null && get_cookie("token") != false && get_cookie("token") != "");
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
	 * @since 1.0
	 * @access public
	 */
	public function Google($page = "auth"){
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
			$Google->access_type("offline");
			if($page == "auth"){
				self::Logout(false);
				$Google->auth();
			} else if($page == "callback"){
				$Google->callback();
				$Account = $Google->account_data();
				if($Account !== false && $Account != NULL){
					$this->login_model->Google($Account->id,$Account->name,$Account->email,$UserId);
					if(!is_null($UserId)){
						$User = new User();
						if (!$User->Load($UserId)) { 
							self::_redirect($this->config->item("login_page"));
						}
						$_SESSION["user_id"] = $User->id;
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
		redirect((strpos(site_url($url),'http') !== false) ? site_url($url) : $this->Computerinfo_Security->CheckHTTPS(site_url($url)));
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
		if (isset($_SESSION["user_id"]) && $this->computerinfo_security->User_Exists($_SESSION["user_id"])) {
			$User = new User();
			$User->Load($_SESSION["user_id"]);
			$user_object = $User;
			return TRUE;

		//Else destroy the old session
		} else if (isset($_SESSION["user_id"])) {
			$this->load->helper("cookie");
			unset($_SESSION["user_id"]);
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
			$_SESSION["user_id"] = $User->id;
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
				$this->load->library("auth/google");
				$this->load->config("api");
				$this->load->model("login_model");
				$Google = new Google();
				$Google->client();
				$Google->access_token($access_token);
				$account_data = $Google->account_data();
				if (!isset($account_data->email)) {
					break;
				}
				if($account_data !== false && $account_data != NULL){
					$this->login_model->Google($account_data->id,$account_data->name,$account_data->email,$user_id);
					if(!is_null($user_id)){
						$User = new User();
						$User->Load($user_id);
						$authenticated = true;
					}
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
				$_SESSION["user_id"] = $User->id;
				echo json_encode(array("User" => $User->Export(),"status" => "OK","token" => $Token->Export(null, false, array("user","created"))));
			} else {
				echo json_encode(array("User" => null,"status" => "FAIL"));
			}
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
		if (self::_check_user_login($User) && !is_null($User->id)) {
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
		$this->load->helper("cookie");
		if (isset($_SESSION["user_id"])) {
			unset($_SESSION["user_id"]);
		}
		session_destroy();
		delete_cookie("PHPSESSID");
		delete_cookie("token");
		if ($redirect) {
			self::_redirect($this->config->item("not_logged_in_page"));
		}
	}
}
?>