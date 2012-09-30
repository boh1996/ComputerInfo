<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Windows_Login extends CI_Controller {

	public function index (){
<<<<<<< HEAD
		if (isset($_SESSION["user_id"])) {
			redirect("login/windows");
		} else {
			$this->load->view("windows_login_view",$this->computerinfo_security->ControllerInfo());
		}
=======
		$this->load->view("windows_login_view",$this->computerinfo_security->ControllerInfo());
>>>>>>> 8df41feec26df4cf43c2a785aedae428fe3cde57
	}
}
