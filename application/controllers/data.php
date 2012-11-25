<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$Computer = new Computer();
		$array = json_decode(file_get_contents("assets/testDump.json"),true);
		$Computer->Import($array["computer"]);
		$Computer->Debug($Computer->Export());
	}
 }
?>