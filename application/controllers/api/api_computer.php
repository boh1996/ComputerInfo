<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

class API_Computer extends CI_API_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->library("Computer");
	}

	/**
	 * Outputs a computer
	 * 
	 * @param  integer $id The database id of the computer
	 * @since 1.0
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Computer = new Computer();

		$fields = ($this->get("fields") !== false) ? $this->get("fields") : null;

		$fields = explode(",", $fields);

		$db_fields = $fields;

		if ( ! in_array("organization", $db_fields) ) {
			$db_fields[] = "organization";
		}

		if ( ! $Computer->Load($id, false, $db_fields) ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(401);
		}

		$this->response($Computer->Export($fields));
	}

	public function index_delete ( $id = null ) {

	}

	public function index_put ( $id = null ) {

	}

	public function index_post () {

	}

	public function index_patch () {
		
	}
}