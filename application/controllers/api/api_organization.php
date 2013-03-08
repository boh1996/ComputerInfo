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

		$parameters = array("identifier");

		$result = $Loader->Load("computers", "Computer", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

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

		$parameters = array("identifier","description");

		$result = $Loader->Load("devices", "Device", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Receives all the printers associated with an organization
	 *
	 * @since 1.0
	 * @param  integer $organization_id The organization to recieve printers for
	 * @return array
	 */
	public function printers_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$printers = ( $this->get("printers") !== false ) ? explode(",", $this->get("printers")) : null;

		if ( is_array($printers) ) {
			$this->db->where_in("id", $printers);
		}

		$Loader = new Batch_Loader();

		$parameters = array("identifier","name");

		$result = $Loader->Load("printers", "Printer", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Retrieves all the screens owned by an organization
	 *
	 * @since 1.0
	 * @param  integer $organization_id The organization to load screens for
	 * @return array
	 */
	public function screens_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$screens = ( $this->get("screens") !== false ) ? explode(",", $this->get("screens")) : null;

		if ( is_array($screens) ) {
			$this->db->where_in("id", $screens);
		}

		$Loader = new Batch_Loader();

		$parameters = array("identifier");

		$result = $Loader->Load("screens", "Screen", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);

	}

	/**
	 * Outputs all locations for an organization
	 *
	 * @since 1.0 
	 * @param  integer $organization_id The organization to recieve locations for
	 * @return array
	 */
	public function locations_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$locations = ( $this->get("locations") !== false ) ? explode(",", $this->get("locations")) : null;
	
		if ( is_array($locations) ) {
			$this->db->where_in("id", $locations);
		}

		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("locations", "Location", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs a list of floors that an organization has,
	 * use &fields to select fields,
	 * &limit and &offset to paginate,
	 * and &floors to select which floors to output,
	 * and use data member names to search for content
	 *
	 * @since 1.0
	 * @param  intger $organization_id The organization to look for
	 * @return array
	 */
	public function floors_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$floors = ( $this->get("floors") !== false ) ? explode(",", $this->get("floors")) : null;

		if ( is_array($floors) ) {
			$this->db->where_in("id", $floors);
		}

		$Loader = new Batch_Loader();

		$parameters = array("floor", "building", "name");

		$result = $Loader->Load("floors", "Floor", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( ! $Loader->success ) {
			$this->response(array(), 404);
		}

		$this->response($result);
	}

	/**
	 * Outputs all the buildings for an organization,
	 * use buildings to select buildings and see floors for other parameters
	 *
	 * @see Floors
	 * @since 1.0
	 * @param  integer $organization_id The organization to look for
	 * @return array
	 */
	public function buildings_get ( $organization_id = null ) {
		if ( is_null($organization_id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $organization_id) ) {
			self::error(401);
		}

		$buildings = ( $this->get("buildings") !== false ) ? explode(",", $this->get("buildings")) : null;

		if ( is_array($buildings) ) {
			$this->where_in("id", $buildings);
		}

		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("buildings", "Building", array("organization_id" => $organization_id), $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( ! $result->success ) {
			self::error(404);
		}

		$this->response($result);
	}
}