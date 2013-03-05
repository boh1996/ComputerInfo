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
		if ( is_null($id) ) {
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

		$result = $Loader->Load("computers", "Computer", array("organization" => $organization_id), $this->limit(), $this->offset(), $this->fields());

		if ( $result === false ) {
			self::error(404);
		}

		$this->response($result);
	}
}