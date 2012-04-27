<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @param string $method The internal method to call to perform the response
	 * @param array $params Some extra parameters
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL, $params = NULL)
	{	
	   	$method = '_'.ucfirst($method);
	    if(isset($params[0]) and method_exists($this, $method."_".ucfirst($params[0]))){ 
	    	$method = $method."_".ucfirst($params[0]);
	    	unset($params[0]);
	    }
	    if($this->api_request->Request_Method() == "get" || $this->api_request->Request_Method() == "head"){
		    if(isset($params[0]) && $params[0] == "search"){
		    	$method .= "_Search";
		    	unset($params[0]);
		    } 
		    if(isset($params[1]) && $params[1] == "search"){
		    	$method .= "_Search";
		    	unset($params[1]);
		    }
		} else {
			$methods_table = array(
				"post" => "create",
				"patch" => "update",
				"put" => "overwrite",
				"options" => "options",
				"delete" => "delete"
			);
			if(array_key_exists($this->api_request->Request_Method(), $methods_table)){
				$method .= "_".ucfirst($methods_table[$this->api_request->Request_Method()]);
			} else {
				$this->api_response->Code = 400;
				return;
			}
		}
	    if (method_exists($this, $method))
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
	    show_404();
	}

	/**
	 * This function is used to force all api response through the API Response class
	 * @param  string $Output The CodeIgniter output sent
	 * @since 1.0
	 * @access public
	 */
	public function _output($Output)
	{	
		$Output = array($Output);
		$this->api_response->Add_Response($Output);
	    $this->api_response->Send_Response();
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

	/**
	 * This function loads a specific computer using the specified id
	 * @param integer $Id The id of the computer to load
	 * @since 1.0
	 * @access private
	 */
	private function _Computer($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Computer");
			$Computer = new Computer();
			if($Computer->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Computer->Export(false);
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	private function _Computer_Create(){
		
	}

	/**
	 * This function loads a specific Computer Model,
	 * defined by the database id of it
	 * @param integer $Id The id to load
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Model($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Computer_Model");
			$ComputerModel = new Computer_Model();
			if($ComputerModel->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $ComputerModel->Export(false);
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	private function _Device($Id = NULL){

	}

	private function _Cpu($Id = NULL){

	}

	private function _Device_Model($Id = NULL){

	}

	private function _Manufacturer($Id = NULL){

	}

	/**
	 * This function loads up a printer specified by an id
	 * @param integer $Id The id of the printer to find
	 * @since 1.0
	 * @access private
	 */
	private function _Printer($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Printer");
			$Printer = new Printer();
			if($Printer->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Printer->Export(false);
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function loads up a specific Printer Model
	 * @param integer $Id The id of the printer model to find
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Model($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Printer_Model");
			$PrinterModel = new Printer_Model();
			if($PrinterModel->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $PrinterModel->Export(false);
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	private function _Printer_Search(){

	}

	private function _Printer_Model_Search(){
		echo "Searching for printer model";
	}
}