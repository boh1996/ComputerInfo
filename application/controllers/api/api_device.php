<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create a device
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Device extends CI_API_Controller {

	/**
	 * Class Contructor
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("Device");
	}

	/**
	 * Outputs a device
	 *
	 * @since 1.0
	 * @param  integer $id The id of the device to output
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Device = new Device();

		$db_fields = ( $this->fields() !== null ) ? $this->fields() : null;

		if ( ! is_null($db_fields) && ! in_array("organization", $db_fields) ) {
			$db_fields[] = "organization";
		}

		if ( ! $Device->Load($id, false, $db_fields) ) {
			self::error(404);
		}

		if ( ! $this->has_access("organizations",$this->user,$Device->organization) ) {
			self::error(401);
		}

		$this->response($Device->Export($this->fields()));
	}

	/**
	 * Responds with headers for HEAD requests
	 * 
	 * @see index_get
	 * @param  integer $id The device to load
	 */
	public function index_head ( $id = null ) {
		$this->fields = array("id");
		self::index_get($id);
	}

	/**
	 * Creates a device, with the specified data
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Device = new Device();

		if ( ! $Device->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! isset($Device->organization->id) ) {
			self::error();
		}

		if ( ! $this->has_access("organizations",$this->user,$Device->organization) ) {
			self::error(401);
		}

		if ( ! $Device->Save() ) {
			self::error(409);
		}

		$this->response($Device->Export($this->fields()),201);
	}
		
	/**
	 * Deletes a device
	 * 
	 * @since 1.0
	 * @param  integer $id The device to delete
	 * @return array
	 */
	public function index_delete ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Device = new Device();

		if ( ! $Device->Load() ) {
			$this->response(array());
		}

		if ( ! $this->has_access("organizations",$this->user,$Device->organization) ) {
			self::error(401);
		}

		$Device->Delete(true);

		$this->response(array(),200);
	}

	/**
	 * Performs a merge update operation
	 *
	 * @since 1.0
	 * @param  integer $id The device to update
	 * @return array
	 */
	public function index_patch ( $id = null ) {
		if ( is_null($id) || ! $this->patch() ) {
			self::error(400);
		}

		$Device = new Device();

		if ( ! $Device->Load($id) ) {
			self::error(404);
		}

		if ( ! $Device->Import( $this->patch(), false, false, array(
			"organization"
		))) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Device->organization) ) {
			self::error(401);
		}

		if ( ! $Device->Save() ) {
			self::error(409);
		}

		$this->response($Device->Export($this->fields()),202);
	}

	/**
	 * Performs a overwrite update operation
	 *
	 * @since 1.0
	 * @param  integer $id The device to update
	 * @return array
	 */
	public function index_put ( $id = null ) {
		if ( is_null($id) || ! $this->put()) {
			self::error(400);
		}

		$Device = new Device();

		if ( ! $Device->Load($id) ) {
			self::error(404);
		}

		if ( ! $Device->Import( $this->patch(), true, false, array(
			"organization"
		))) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations",$this->user,$Device->organization) ) {
			self::error(401);
		}

		if ( ! $Device->Save() ) {
			self::error(409);
		}

		$this->response($Device->Export($this->fields()),202);
	}
}