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
		if (!isset($_SESSION["user_id"]) && $this->input->post('username') != false && $this->input->post('password') != false) {
			$User = new User();
			$username = $this->login_security->check_security($this->input->post('username'));
			$password = $this->login_security->check_security($this->input->post('password'));
			if ($User->Find(array("username" => $username)) && !is_null($User->username)) {
				if ($this->login_security->check($password, $User->password, $User->login_token,$User->hashing_iterations)) {
					$user_object = $User;
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
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
	 * @since 1.0
	 * @access public
	 */
	public function Device () {
		if (self::_check_user_login($User)) {
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
			session_destroy();
		}
		set_cookie("token","",time() - 9999);
		delete_cookie("PHPSESSID");
		delete_cookie("token");
		if ($redirect) {
			self::_redirect($this->config->item("not_logged_in_page"));
		}
	}
}
?>