<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$Computer = new Computer();
		$Computer->Load(1,false,array("identifier","wifi_mac","ram_size","lan_mac","serial","created_time"));
		print_r($Computer->Export());
	}
}
?>