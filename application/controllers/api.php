<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @param string $method The internal method to call to perform the response
	 * @param array $params Some extra parameters
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method, $params = array())
	{	
	    $method = '_'.ucfirst($method);
	    if(isset($params[0]) and method_exists($this, $method."_".ucfirst($params[0]))){ 
	    	$method = $method."_".ucfirst($params[0]);
	    	unset($params[0]);
	    }
	    if(isset($params[0]) && $params[0] == "search"){
	    	$method .= "_Search";
	    	unset($params[0]);
	    } 
	    if(isset($params[1]) && $params[1] == "search"){
	    	$method .= "_Search";
	    	unset($params[1]);
	    }
	    if (method_exists($this, $method))
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
	    show_404();
	}

	public function _output($Output)
	{
	    echo $Output;
	}

	/**
	 * This function is called when the controller is loaded,
	 * it loads up the configs and libraries that the api needs
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library("api/api_request");
		$this->load->library("api/api_response");
		$this->load->helper("http");
		$this->load->helper("array_xml");
		$this->api_request->Perform_Request();
		$this->api_response->Format = $this->api_request->Format();
	}

	private function _Printer($Id = NULL){
		if(!is_null($Id)){

		}
	}

	private function _Printer_Model_Search(){
		echo "Searching for printer model";
	}

	private function _Printer_Model(){
		echo "Printer Model";
	}
}