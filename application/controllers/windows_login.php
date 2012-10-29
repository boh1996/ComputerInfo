<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Windows_Login extends CI_Controller {

	public function index (){
		if (isset($_SESSION[$this->config->item("user_id_session")])) {
			redirect("login/windows");
		} else {
			$this->load->view("windows_login_view",$this->computerinfo_security->ControllerInfo());
		}
	}
}
