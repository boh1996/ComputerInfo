<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function index(){
		$Data = array(
			"base_url" => base_url()
		);
		$this->load->view("login_view",$Data);
	}

	/**
	 * This function redirects the user, to the login with username view
	 * @since 1.0
	 * @access public
	 */
	public function Username () {
		$this->load->view("login_form_view");
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
	 * This view/function is called when the form is submitted
	 * @since 1.0
	 * @access public
	 */
	public function Enter () {
		$this->load->library("User");
		$this->load->library("auth/login_security");
		if (!isset($_SESSION["user_id"]) && $this->input->post('username') != false && $this->input->post('password') != false) {
			$User = new User();
			$username = $this->login_security->check_security($this->input->post('username'));
			$password = $this->login_security->check_security($this->input->post('password'));
			if ($User->Find(array("username" => $username)) && !is_null($User->username)) {
				if ($this->login_security->check($password, $User->password, $User->login_token,$User->hashing_iterations)) {
					$_SESSION["user_id"] = $User->id;
				} else {
					self::_redirect($this->config->item("login_page"));
				}
			} else {
				self::_redirect($this->config->item("login_page"));
			}
		} else {
			self::_redirect($this->config->item("login_page"));
		}
	}
}
?>