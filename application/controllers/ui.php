<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UI extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL,$params = array()){
		$data = array(
			"method" => $method,
			"params" => json_encode($params),
			"base_url" => base_url(),
			"asset_url" => $this->computerinfo_security->CheckHTTPS(base_url().$this->config->item("asset_url")),
			"jquery_url" => $this->config->item("jquery_url"),
			"jqueryui_version" => $this->config->item("jqueryui_version")
		);
		$this->load->view("front_view",$data);
	}
}