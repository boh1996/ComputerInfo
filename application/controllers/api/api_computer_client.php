<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to reate single computers,
 * this endpoint is used when the Windows application submits data
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Computer_Client extends CI_API_Controller {

	/**
	 * Class Contructor
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("Computer");
	}

	/**
	 * Creates a new computer with the requested data, and assign some needed data
	 * 
	 * @return array
	 */
	public function index_post () {
		if ( ! $this->post() ) {
			self::error(400);
		}

		$Computer = new Computer();

		$post = $this->post();

		if ( isset($post["printers"]) ) {
			foreach ( $post["printers"] as $key => $printer ) {
				$post[$key]["organization"] = $post["organization"];
			}
		}

		if ( ! $Computer->Import($post) ) {
			self::error(400);
		}

		if ( is_null($Computer->organization) ) {
			self::error(400);
		}

		if ( ! is_null($Computer->organization) && ! $this->has_access("organizations",$this->user,$Computer->organization) ) {
			self::error(403);
		}

		if ( ! $Computer->Save() ) {
			self::error(409);
		}

		$this->response($Computer->Export($this->fields()),201);
	}

}