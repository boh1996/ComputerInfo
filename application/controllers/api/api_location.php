<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create locations
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Location extends CI_API_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->library("location");
	}

	/**
	 * Loads up a Location
	 *
	 * @since 1.0
	 * @param  integer $id The location to load
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Location = new Location();

		$db_fields = $this->fields();

		if ( ! in_array("organization", $db_fields) ) {
			$db_fields[] = "organization";
		}

		if ( ! $Location->Load($id, false, $db_fields) ) {
			self::error(404);
		}

		if ( ! $this->has_access("organizations", $this->user, $Location->organization) ) {
			self::error(403);
		}

		$this->response($Location->Export($this->fields()));
	}

	public function index_delete ( $id = null ) {

	}

	public function index_put ( $id = null ) {

	}

	public function index_patch ( $id = null ) {

	}

	/**
	 * Creates a Location, with the posted data
	 *
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}
		
		$Location = new Location();

		if ( ! $Location->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! isset($Location->organization->id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organization", $this->user, $Location->organization) ) {
			self::error(403);
		}

		if ( ! $Location->Save() ) {
			self::error(403);
		}

		$this->response($Location->Export($this->fields()),201);
	}

	/**
	 * Called on HEAD requests, used to check for access and existence of an object
	 *  
	 * @since 1.0
	 * @param  integer $id The location to load
	 * @return array
	 */
	public function index_head ( $id = null ) {
		$this->fields = array("id");
		$this->index_head();
	}
}
?>