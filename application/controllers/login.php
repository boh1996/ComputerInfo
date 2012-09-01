<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function index(){
		$Data = array(
			"base_url" => base_url()
		);
		$this->load->view("login_view",$Data);
	}

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
						redirect($this->config->item("front_page"));
					} else {
						redirect($this->config->item("login_page"));
					}
				} else { 
					redirect($this->config->item("login_page"));
				}
			}
		} else {
			redirect($this->config->item("front_page"));
		}
	}

	public function Enter () {
		if (!isset($_SESSION["user_id"])) {

		} else {
			redirect($this->config->item("login_page"));
		}
	}
}
?>