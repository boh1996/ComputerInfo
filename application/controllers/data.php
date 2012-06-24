<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("screen");
		$Screen = new Screen();
		$Screen->Set_Current_User(2);
		$Screen->Import(array(
			"identifier" => "Lal3",
			"organization" => 1,
			"location" => 3
		));
		$Screen->Save();
	}
}
?>