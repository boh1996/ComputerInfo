<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve all the different objects associated with an organization
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Organization extends CI_API_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->library("batch_loader");
		$this->headers["Allow"] = implode(",", array("GET","HEAD"));
		$this->headers["Expires"] = gmdate('D, d M Y H:i:s \G\M\T', time() + 86400);
	}

	/**
	 * Outputs all the computers for an organization,
	 * with the ability to select fields to load, limit, offset, and the computers to retrieve
	 * 
	 * @param  integer $organization_id The organization to load computers for
	 * @return array
	 * @since 1.0
	 */
	public function computers_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$computers = ( $this->get("computers") !== false ) ? explode(",", $this->get("computers")) : null;

		if ( is_array($computers) ) {
			$this->db->where_in("id", $computers);
		}

		$Loader = new Batch_Loader();

		$result = $Loader->Load("computers", "Computer", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields());

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Fetches all the available devices for an organization,
	 * select which fields to show, set limit and offset and select which devices to show
	 * 
	 * @param  integer $organization_id The organization to fetch data for
	 * @return array
	 * @since 1.0
	 */
	public function devices_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$devices = ( $this->get("devices") !== false ) ? explode(",", $this->get("devices")) : null;

		if ( is_array($devices) ) {
			$this->db->where_in("id", $devices);
		}

		$Loader = new Batch_Loader();

		$result = $Loader->Load("devices", "Device", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields());

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	public function printers_get ( $organization_id = null ) {

	}

	public function screens_get ( $organization_id = null ) {

	}

	public function locations_get ( $organization_id = null ) {
		
	}
} 