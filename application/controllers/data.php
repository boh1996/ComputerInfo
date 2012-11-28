<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		/*$array = json_decode(file_get_contents("assets/testDump.json"),true);
		$this->load->library("Computer");
		$Computer = new Computer();
		$Computer->Import($array["computer"]);
		$Computer->Save();
		/*$Computer->Load(10);
		$Computer->Debug($Computer->Export(false,null));*/
		
	}
 }
?>