<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update and create a screen
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Screen extends CI_API_Controller {

	/**
	 * Class constructor, used to load needed ressources
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("screen");
	}

	/**
	 * Retrieves a screen,
	 * use &fields to select fields to load and show
	 *
	 * @since 1.0
	 * @param  integer $id The screen to retrive
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Screen = new Screen();

		$db_fields = ( $this->fields() !== null ) ? $this->fields() : null;

		if ( ! is_null($db_fields) ) {
			if ( ! in_array("organization", $db_fields) ) {
				$db_fields[] = "organization";
			}

			$db_fields[] = "last_updated";

			array_unique($db_fields);
		}

		if ( ! $Screen->Load($id, false, $db_fields) ) {
			$this->response(array(), 404);
		}

		if ( ! $this->has_access("organizations",$this->user,$Screen->organization) ) {
			self::error(401);
		}

		$this->headers["Last-Modified"] = gmdate('D, d M Y H:i:s \G\M\T', $Screen->last_updated);

		$this->response($Screen->Export($this->fields()));
	}

	/**
	 * Creates a screen with the suplied data
	 * 
	 * @since 1.0
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Screen = new Screen();

		if ( ! $Screen->Import($this->post()) ) {
			self::error(400);
		}

		if ( ! isset($Screen->organization->id) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $Screen->organization) ) {
			self::error(403);
		}

		if ( ! $Screen->Save() ) {
			self::error(409);
		}

		$this->response($Computer->Export($this->fields()),201);
	}

	/**
	 * Removes a screen from the database
	 *
	 * @since 1.0
	 * @param  integer $id The screen to remove
	 * @return array
	 */
	public function index_delete ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$Screen = new Screen();

		if ( ! $Screen->Load($id) ) {
			$this->response(array(), 404);
		}

		if ( ! $this->has_access("organizations", $this->user, $Screen->organization) ) {
			self::error(403);
		}

		$Computer->Delete(true);

		$this->response(array(), 202);
	}

	/**
	 * Used to perform overwrite update operations
	 *
	 * @since 1.0
	 * @param  integer $id The screen to update
	 * @return array
	 */
	public function index_put ( $id = null ) {
		if ( ! $this->put() || is_null($id) ) {
			self::error(400);
		}

		$Screen = new Screen();
		
		if ( ! $Screen->Load($id) ) {
			$this->response(array(), 404);
		}

		if ( ! $Screen->Import($this->put(), true, false, array(
			"organization"
		)) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $Screen->organization) ) {
			self::error(401);
		}

		if ( ! $Screen->Save() ) {
			self::error(409);
		}

		$this->response($Screen->Export($this->fields()),202);
	}

	/**
	 * Performs a merge update operation
	 *
	 * @since 1.0
	 * @param  integer $id The screen to update
	 * @return array
	 */
	public function index_patch ( $id = null ) {
		if ( ! $this->patch() || is_null($id) ) {
			self::error(400);
		}

		$Screen = new Screen();

		if ( ! $Screen->Load($id) ) {
			$this->response(array(), 404);
		}

		if ( ! $Screen->Import($this->patch(), false, false, array(
			"organization"
		)) ) {
			self::error(400);
		}

		if ( ! $this->has_access("organizations", $this->user, $Screen->organization) ) {
			self::error(401);
		}

		if ( ! $Screen->Save() ) {
			self::error(409);
		}

		$this->response($Screen->Export($this->fields()), 202);
	}

	/**
	 * Checks if a object exists
	 * 
	 * @since 1.0
	 * @param  integer $id The screen to check
	 * @return array
	 */
	public function index_head ( $id = null ) {
		$this->fields = array("id");
		self::index_get($id);
	} 
}