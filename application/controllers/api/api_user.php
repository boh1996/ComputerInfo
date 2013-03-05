<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve, update a user
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_User extends CI_API_Controller {

	/**
	 * Loads up a user
	 *
	 * @since 1.0
	 * @param  integer $id The user to load
	 * @return array
	 */
	public function index_get ( $id = null ) {
		if ( is_null($id) ) {
			self::error(400);
		}

		$User = new User();

		if ( ! $User->Load($id, $this->fields()) ) {
			self::error(404);
		}

		if ( ! self::share_organization($User) ) {
			self::error(403);
		}

		$this->response($User->Export($this->fields()));
	} 

	/**
	 * Outputs the user object, associated with the current token
	 *
	 * @since 1.0
	 * @return array
	 */
	public function me_get () {
		$this->response($this->user->Export($this->fields()));
	}
}
?>