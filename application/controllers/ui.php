<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UI extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @since 1.0
	 * @access public
	 */
	public function _remap(){
		$this->load->library("Computer");
		$Computer = new Computer();
		$Computer->load(1);
		echo "<pre>";
		print_r($Computer->Export(false,true));
		echo "</pre>";
	}
}