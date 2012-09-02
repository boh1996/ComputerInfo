<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	/**
	 * This function is called as standard when the login page is requested
	 * @since 1.0
	 * @access public
	 */
	public function index(){
		$data = array(
			"method" => "login",
			"base_url" => base_url(),
			"asset_url" => base_url().$this->config->item("asset_url"),
			"jquery_url" => $this->config->item("jquery_url"),
			"jqueryui_version" => $this->config->item("jqueryui_version")
		);
		$this->load->view("login_view",$data);
	}

	/**
	 * This function redirects the user, to the login with username view
	 * @since 1.0
	 * @access public
	 */
	public function Username () {
		$data = array(
			"method" => "username",
			"base_url" => base_url(),
			"asset_url" => base_url().$this->config->item("asset_url"),
			"jquery_url" => $this->config->item("jquery_url"),
			"jqueryui_version" => $this->config->item("jqueryui_version"),
			"back" => (strpos(site_url("login"),'http') !== false) ? site_url("login") : 'http://'.site_url("login")
		);
		$this->load->view("login_form_view",$data);
	}

	/**
	 * This function lets the user login with Google
	 * @param string $page The current operation "auth" or "callback"
	 * @since 1.0
	 * @access public
	 */
	public function Google($page = "auth"){
		if(!isset($_SESSION["user_id"])){
			$this->load->library("auth/google");
			$this->load->model("login_model");
			$Google = new Google();
			$Google->client();
			$Google->redirect_uri(base_url()."login/google/callback");
			$Google->scopes(array("userinfo.profile","userinfo.email"));
			$Google->access_type("offline");
			if($page == "auth"){
				$Google->auth();
			} else if($page == "callback"){
				$Google->callback();
				$Account = $Google->account_data();
				if($Account !== false){
					$this->login_model->Google($Account->id,$Account->name,$Account->email,$UserId);
					if(!is_null($UserId)){
						$_SESSION["user_id"] = $UserId;
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
		redirect((strpos(site_url($url),'http') !== false) ? site_url($url) : 'http://'.site_url($url));
		die();
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
	 * This function logs the user out
	 * @since 1.0
	 * @access public
	 */
	public function Logout () {
		session_destroy();
		self::_redirect($this->config->item("login_page"));
		die();	
	}
}
?>