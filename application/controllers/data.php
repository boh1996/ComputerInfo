<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("Operating_System");
		$os = new Operating_System();
		$os->Load(1);
		echo "<pre>";
		print_r($os->Export());
	}
}
?>