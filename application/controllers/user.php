<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	public function index () {}

	/**
	 * This function is called when the register view is reguested
	 * @since 1.0
	 * @access public
	 */
	public function Register () {
		$this->load->view("user_register_view",$this->computerinfo_security->ControllerInfo());
	}	

	/**
	 * This function is called when data is posted from the register view
	 * @since 1.0
	 * @access public
	 */
	public function Check () {
		if (isset($_POST["username"]) && !empty($_POST["username"])) {

		} else {
			redirect($this->computerinfo_security->CheckHTTPS(base_url()."users/sign_up"));
		}
	}

	private function _Register () {
		if (self::_Input_Check(array("username","password","name"),$missing)) {

		} else {
			$this->load->view("user_register_view",$this->computerinfo_security->ControllerInfo(array(array("errors" => array("Missing fields" . implode(",",$missing))))));
		}
	}

	/**
	 * This function checks POST fields
	 * @since 1.0
	 * @access private
	 * @param array $fields The post fields to check
	 * @return boolean
	 */
	private function _Input_Check ($fields, &$missing) {
		$missing = array();
		foreach ($fields as $fields) {
			$missing[] = $field;
			if (!isset($_POST[$field]) || empty($_POST[$field])) {
				return FALSE;
			}
		}
		return TRUE;
	}
}
