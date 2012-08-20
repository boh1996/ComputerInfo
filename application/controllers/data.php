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
		$Computer->Load(95);
		/*$Computer->Import(array("memory" => array("total_physical_memory" => 400,"slots" => array(array("empty" => "true","capacity" => 2000)))));
		$Computer->Save();
		//$Computer->Save();*/
		/*$this->load->library("User");
		$User = new User();
		$User->Load(1);
		$User->Import(array("organizations" => 1));
		$User->Debug($User);
		$User->Save();*/
	}
 }
?>