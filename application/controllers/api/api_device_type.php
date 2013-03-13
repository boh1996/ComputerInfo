<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve and create a device type
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Device_Type extends CI_API_Controller {

	public function __construct( ) {
		parent::__construct();
		$this->load->library("Device_Type");
	}

	/**
	 * Creates a device type
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Device_Type = new Device_Type();

		if ( ! $Device_Type->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! $Device_Type->Save() ) {
			self::error(409);
		}

		$this->response($Device_Type->Export($this->fields()), 201);
	}
}