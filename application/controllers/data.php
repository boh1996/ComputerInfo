<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller {

	public function index(){
		/*$this->load->library("Computer");
		$Computer = new Computer();

		$computers = json_decode(file_get_contents("computersOldDump.json"));
		$Computer = new Computer();
		foreach ($computers->computers as $object) {
			$Computer->Load((int)$object->id);
			$Computer->Import(array("memory" => array("total_physical_memory" => $object->ram_size)));;
			$Computer->Save();
		}*/
		/*$this->load->library("Token");
		$Token = new Token();
		$Token->Load(array("token" => "yQ7jy0TJhikSNxtkjDNJyLAiogk5U5xircUhtLE0UiIJXiGuLoF9lypi0f7rLqfJ"));
		$Token->Debug($Token->Export());*/
	}
 }
?>