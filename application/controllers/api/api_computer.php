<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create single computers
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Computer extends CI_API_Controller {

	/**
	 * Class Contructor
	 */
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

		$db_fields = ( $this->fields() !== null ) ? $this->fields() : array();

		if ( ! in_array("organization", $db_fields) ) {
			$db_fields[] = "organization";
		}

		if ( ! $Computer->Load($id, false, $db_fields) ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(401);
		}

		$this->response($Computer->Export($this->fields()));
	}

	/**
	 * Deletes a Computer from the database
	 *
	 * @since 1.0
	 * @param  integer $id The database id of the Computer to delete
	 */
	public function index_delete ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Computer = new Computer();

		if ( ! $Computer->Load($id) ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(403);
		}

		$Computer->Delete(true);		

		$this->response(array(),200);
	}

	/**
	 * Outputs the same as index_get
	 *
	 * @see index_get
	 * @param  integer $id The computer db id to load
	 */
	public function index_head ( $id = null ) {
		$this->fields = array("id");
		self::index_get($id);
	}

	/**
	 * This endpoint overwrites every property that is being updated,
	 * use PATCH for a merge update
	 *
	 * @since 1.0
	 * @param  integer $id The id of the computer to update
	 * @return array
	 */
	public function index_put ( $id = null ) {
		if ( ! $this->put() || is_null($id) ) {
			self::error(400);
		}

		$Computer = new Computer();

		if ( ! $Computer->Load($id) ) {
			self::error(404);
		}

		if ( ! $Computer->Import($this->put(),true,false,array(
			"organization"
		)) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(401);
		}

		if ( ! $Computer->Save() ) {
			self::error(409);
		}

		$this->response($Computer->Export($this->fields()),202);

	}

	/**
	 * Responds to PATCH requests, it performs partial merge operations,
	 * use PUT for overwriting arrays
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_patch ( $id = null ) {
		if ( ! $this->patch() || is_null($id) ) {
			self::error(400);
		}

		$Computer = new Computer();

		if ( ! $Computer->Load($id) ) {
			self::error(404);
		}

		if ( ! $Computer->Import($this->patch(),false,false, array(
			"organization"
		))) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(401);
		}

		if ( ! $Computer->Save() ) {
			self::error(409);
		}

		$this->response($Computer->Export($this->fields()),202);
	}

	/**
	 * Saves a Computer
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Computer = new Computer ();

		if ( ! $Computer->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! isset($Computer->organization->id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(403);
		}

		if ( ! $Computer->Save() ) {
			self::error(409);
		}

		$this->response($Computer->Export($this->fields()),201);
	}
}