<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Windows_Login extends CI_Controller {

	public function index (){
		$this->load->view("windows_login_view",$this->computerinfo_security->ControllerInfo());
	}
}
