<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create a device
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Computer extends CI_API_Controller {

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

		$db_fields = $this->fields();

		if ( ! in_array("organization", $db_fields) ) {
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

	public function index_post () {

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

	public function index_patch ( $id = null ) {

	}

	public function index_put ( $id = null ) {

	}
}