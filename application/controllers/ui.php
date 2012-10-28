<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UI extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL,$params = array()) {
		$data = array(
			"method" => $method,
			"params" => json_encode($params),
		);
		$this->user_control->batch_load_lang_files(array(
			"modals",
			"user_settings"
		));
		$this->load->view("front_view",$this->computerinfo_security->ControllerInfo($data));
	}
}