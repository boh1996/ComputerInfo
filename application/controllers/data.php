<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$data = array(
			"base_url" => base_url(),
			"asset_url" => base_url().$this->config->item("asset_url"),
			"jquery_url" => $this->config->item("jquery_url"),
			"jqueryui_version" => $this->config->item("jqueryui_version")
		);
		$this->load->view("test_view",$data);
	}
}
?>