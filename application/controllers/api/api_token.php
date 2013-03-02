<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

class API_Token extends CI_API_Controller {

	/**
	 * Methods settings
	 * 
	 * @var array
	 */
	protected $methods = array(
		"token_get" => array("key" => false)
	);

	/**
	 * The contructor method, it loads up the needed resources for this series of endpoints
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("token");
	}

	/**
	 * Outputs information about the requested token
	 * 
	 * @param string $token The token to get info about
	 * @since 1.0
	 */
	public function token_get ( $token = null ) {
		if ( is_null($token) ) {
			if ( $this->is_application() ) {
				die("false");
			} else {
				self::error(400);
			}
		}

		$Token = new Token();

		if ( ! $Token->Load(array(
			"token" => $token
		)) ) {
			if ( $this->is_application() ) {
				die("false");
			} else {
				self::error(404);
			}
		}

		if ( $Token->offline == 0 ) {
			$Token->time_left = round(($Token->created + $Token->time_to_live) - time());
		}

		if ( $this->is_application() ) {
			die("true");
		} else {
			$this->response($Token->Export(null, false, array(
				"user",
				"created"
			)));
		}
	}
}
?>