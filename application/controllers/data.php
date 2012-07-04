<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("User");
		$User = new User();
		$User->Load(1);
		print_r($User->Export());
	}
}
?>