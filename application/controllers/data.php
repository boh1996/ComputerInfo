<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		$this->load->library("Computer");
		$Computer = new Computer();

		$computers = json_decode(file_get_contents("computersOldDump.json"));
		$Computer = new Computer();
		foreach ($computers->computers as $object) {
			$Computer->Load((int)$object->id);
			$Computer->Import(array("memory" => array("total_physical_memory" => $object->ram_size)));;
			$Computer->Save();
		}
	}
 }
?>