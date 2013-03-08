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
			$this->response(array((, 404);
		}

		if ( ! $this->has_access("organizations",$this->user,$Screen->organization) ) {
			self::error(401);
		}

		$this->headers["Last-Modified"] = gmdate('D, d M Y H:i:s \G\M\T', $Screen->last_updated);

		$this->response($Screen->Export($this->fields()));
	}

	public function index_post () {

	}

	public function index_put ( $id = null ) {

	}

	public function index_put ( $id = null ) {

	}

	public function index_patch ( $id = null ) {

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