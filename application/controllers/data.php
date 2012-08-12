<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		/*$data = array(
			"base_url" => base_url(),
			"asset_url" => base_url().$this->config->item("asset_url"),
			"jquery_url" => $this->config->item("jquery_url"),
			"jqueryui_version" => $this->config->item("jqueryui_version")
		);
		$this->load->view("test_view",$data);*/
		$this->load->library("Computer");
		$Computer = new Computer();
		$Computer->Load(1);
		$Computer->Debug($Computer);
		$Computer->Import(array("memory" => array("total_physical_memory" => "300", "slots" => array(array("capacity" => "1000","empty" => "false"),array("capacity" => "2000","empty" => "false")))));
		//$Computer->Save();
	}
 }
?>