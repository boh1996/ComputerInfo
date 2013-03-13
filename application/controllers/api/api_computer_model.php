<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve a computer model
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Computer_Model extends CI_API_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->library("computer_model");
		$this->headers["Allow"] = implode(",", array("GET","HEAD"));
	}

	/**
	 * Outputs a computer model object
	 * 
	 * @since 1.0
	 * @param  integer $id The computer model to output
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Computer_Model = new Computer_Model();

		if ( ! $Computer_Model->Load($id, false, $this->fields()) ) {
			self::error(404);
		}

		$this->response($Computer_Model->Export($this->fields()));
	}

	/**
	 * Checks if the resource exists
	 * 
	 * @since 1.0
	 * @param  integer $id The computer model, database id
	 * @return [typheaders
	 */
	public function index_head ( $id = null ) {
		$this->fields[] = "id";
		self::index_get($id);
	}
}