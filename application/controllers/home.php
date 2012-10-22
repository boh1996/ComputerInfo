<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	public function index (){
		$this->user_control->batch_load_lang_files(array(
			"home"
		));
		$this->load->view("home_view",$this->computerinfo_security->ControllerInfo());
	}
}
