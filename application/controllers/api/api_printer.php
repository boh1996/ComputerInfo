<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create a printer
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Printer extends CI_API_Controller {

	/**
	 * Class contructor
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("printer");
	}

	/**
	 * Outputs one printer found by it's db id
	 * 
	 * @since 1.0
	 * @param  integer $id The id of the printer to load
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Printer = new Printer();

		$db_fields = null;

			if ( ! is_null($this->fields()) ) {
			$db_fields = $this->fields();

			if ( ! in_array("organization", $db_fields) ) {
				$db_fields[] = "organization";
			}
		}

		if ( ! $Printer->Load($id,$db_fields) ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Printer->organization) ) {
			self::error(403);
		}

		$this->response($Printer->Export($this->fields()));
	}

	/**
	 * Called on HEAD requests, outputs headers, used for testing access and existing of an object
	 * 
	 * @since 1.0
	 * @param  integer $id The printer to check for
	 * @return headers
	 */
	public function index_head ( $id = null ) {
		$this->fields = array("id");
		$this->index_head($id);
	}

	/**
	 * Creates a printer with the posted data
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Printer = new Printer();

		if ( ! $Printer->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! isset($Printer->organization->id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Printer->organization) ) {
			self::error(403);
		}

		if ( ! $Printer->Save() ) {
			self::error(409);
		}

		$this->response($Printer->Export($this->fields()),201);
	}

	/**
	 * Performs and overwrite update on all changed filds
	 *
	 * @since 1.0
	 * @param  integer $id The printer to update
	 * @return array
	 */
	public function index_put ( $id = null ) {
		if ( ! $this->put() || is_null($id) ) {
			self::error(400);
		}

		$Printer = new Printer();

		if ( ! $Printer->Load($id) ) {
			self::error(404);
		}

		if ( ! $Printer->Import($this->put(),true,false,array(
			"organization"
		)) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Printer->organization) ) {
			self::error(403);
		}

		if ( ! $Printer->Save() ) {
			self::error(409);
		}

		$this->response($Printer->Export($this->fields()),202);
	}

	/**
	 * Performs a merge update operations,
	 * use PUT for overwrite update operations and this to add data to an array or so.
	 *
	 * @since 1.0
	 * @param  integer $id The printer to update
	 * @return array
	 */
	public function index_patch ( $id = null ) {
		if ( ! $this->patch() || is_null($id) ) {
			self::error(400);
		}

		$Printer = new Printer();

		if ( ! $Printer->Load($id) ) {
			self::error(404);
		}

		if ( ! $Printer->Import($this->patch(),false,false,array(
			"organization"
		)) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Printer->organization) ) {
			self::error(403);
		}

		if ( ! $Printer->Save() ) {
			self::error(409);
		}

		$this->response($Printer->Export($this->fields()),202);
	}

	/**
	 * Delets a printer from the db
	 *
	 * @since 1.0
	 * @param  integer $id The id of the printer to delete
	 * @return array
	 */
	public function index_delete ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Printer = new Printer();

		if ( ! $Printer->Load($id) ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Printer->organization) ) {
			self::error(403);
		}

		$Printer->Delete(true);

		$this->response(array(),200);
	}
}