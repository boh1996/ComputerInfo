<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$Computer = new Computer();
		$Computer->Load(1,false);
		echo "<pre>";
		print_r($Computer->Export());
		echo "</pre>";
		echo "Done";
		/*$Screen->Set_Current_User(2);
		$Screen->Import(array(
			"identifier" => "Lal3",
			"organization" => 1,
			"location" => 3
		));
		$Screen->Save();*/
	}
}
?>