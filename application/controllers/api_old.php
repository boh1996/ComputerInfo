<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_Old extends CI_Controller {

	/**
	 * The user that owns the access token
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_User = NULL;

	private $_no_auth = array("_Token","_Ci_Version","_Codeigniter_Version_Check","_Ci_Version_Remote");

	/**
	 * This function recives all the calls when a page is requested
	 * @param string $method The internal method to call to perform the response
	 * @param array $params Some extra parameters
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL, $params = NULL) {
		$method = explode("_", $method);
		foreach ($method as $key => $value) {
			$method[$key] = ucfirst($value);
		}
	   	$method = '_'.implode("_", $method);
	    if(isset($params[0]) and method_exists($this, $method."_".ucfirst($params[0]))){ 
	    	$method = $method."_".ucfirst($params[0]);
	    	unset($params[0]);
	    }
	   	if(isset($params[0]) && $params[0] == "search"){
		    	$method .= "_Search";
		    	unset($params[0]);
		} else if(isset($params[1]) && $params[1] == "search"){
		    	$method .= "_Search";
		    	unset($params[1]);
		} else if($this->api_request->Request_Method() != "get" && $this->api_request->Request_Method() != "head" && strpos($method, "_Search") === false){
			$methods_table = array(
				"post" => "create",
				"patch" => "update",
				"put" => "update",
				"options" => "options",
				"delete" => "delete"
			);
			if(array_key_exists($this->api_request->Request_Method(), $methods_table)){
				$method .= "_".ucfirst($methods_table[$this->api_request->Request_Method()]);
				if($this->api_request->Request_Method() === "put"){
					array_push($params, true);
				}
			} else {
				$this->api_response->Code = 405;
				return TRUE;
			}
		}

	    if (method_exists($this, $method)) {	
	    	$authenticated = false;
	    	if (self::_No_Auth($method) == true) {
	    		$authenticated = true;
	    	} else if (self::_Authenticate()) {
	    		$authenticated = true;
	    	}
	    	if($authenticated == true){
	    		return call_user_func_array(array($this, $method), $params);
	    	} else {
	    		$this->api_response->Code = 403;
	    		return FALSE;
	    	}
	    }
	    show_404();
	}

	/**
	 * This function checks if the current endpoint has auth turned off
	 * @param string $function The function that is called
	 * @since 1.0
	 * @access private
	 */
	private function _No_Auth ($function = "") {
		return (in_array($function, $this->_no_auth));
	}

	/**
	 * This function checks if the specified token exist and the user is valid
	 * @since 1.0
	 * @access private
	 */
	private function _Authenticate(){
		$this->load->library("User");
	    $this->_User = new User();
	    $this->load->library("Token");
	    $Token = new Token();
	    if (isset($_GET["token"]) && !empty($_GET["token"])) {
	    	$token_string = htmlentities(mysql_real_escape_string($_GET["token"]));
	    } else {
	    	return FALSE;
	    }
	    if (!$Token->Load(array("token" => $token_string))){
	    	return FALSE;
		}
		if (!$Token->IsValid()) {
			return FALSE;
		}
	  	if($this->_User->Load($Token->user->id)){
	  		return TRUE;
	  	} else {
	  		return FALSE;
	  	}
	}

	/**
	 * This function is used to force all api response through the API Response class
	 * @param  string $Output The CodeIgniter output sent
	 * @since 1.0
	 * @access public
	 */
	public function _output($Output)
	{	
		$this->api_response->Expires = date(time()+5);
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
		$this->benchmark->mark('code_start');
		$this->load->library("api/api_request");
		$this->load->library("api/api_response");
		$this->load->helper("http");
		$this->load->helper("array_xml");
		$this->api_request->Perform_Request();
		$this->api_response->Format = $this->api_request->Format();
		$this->api_response->Callback = $this->api_request->Callback;
	}

	/**
	 * This function get's the id for the has access function
	 * @since 1.0
	 * @access private
	 * @return boolean|integer
	 * @param object|array|integer|string $id The integer or object to check
	 */
	private function _Get_Id ($id) {
		if (is_array($id)) {
			if (isset($id[0]) && is_object($id[0]) && property_exists($id[0], "id")) {
				return $id[0]->id;
			} else {
				return false;
			}
		} else if (is_integer($id)) {
			return $id;
		} else {
			if (is_object($id) && property_exists($id, "id")) {
				return $id->id;
			} else {
				$id = (int)$id;
				if (!is_null($id)) {
					return $id;
				} else {
					return false;
				}
			}
		}
	}

	/**
	 * This function checks if the user has access to watch that content
	 * @param string $node   The node where to check for a "organization" id etc
	 * @param object $Object The object to check in
	 * @param integer $Id     The id to check for
	 * @return boolean
	 * @since 1.0
	 * @access private
	 */
	private function _Has_Access($node = NULL,$Object = NULL,$Id = NULL){
		$Id = self::_Get_Id($Id);
		if ($Id === false) return false;
		if (!is_null($node) && is_string($node) && !is_null($Object) && !is_null($Id) && is_integer($Id)) {
			if (is_array($Object)) {
				$return = false;
				foreach ($Object as $key => $element) {
					if (self::_Check_Access($element,$id,$node)) {
						$return = true;
					}
				}
				return $return;
			} else {
				return self::_Check_Access($Object, $Id, $node);
			}
		} else {
			return false;
		}
		
	}

	/**
	 * This function is used to repeat the check access progress
	 * @since 1.0
	 * @access private
	 * @param object $element The object to check in
	 * @param integer $id      The id to check for
	 * @param string $node    The node to check in
	 * @return boolean
	 */
	private function _Check_Access ($element = null, $id = null,$node = null) {
		if(!is_null($node) && is_string($node) && !is_null($element) && is_object($element) && !is_null($id) && is_integer($id) && property_exists($element, $node)){
			if(is_array($element->{$node})){
				$Return = FALSE;
				foreach ($element->{$node} as $Element) {
					if(is_object($Element)){
						if(property_exists($Element, "id") && $Element->id == $id){
							$Return = TRUE;
						}
					} else {
						if($Element == $id){
							$Return = TRUE;
						}
					}
				}
				return $Return;
			} else {
				if(is_object($element->{$node})){
					if(property_exists($element->{$node}, "id")){
						return ($element->{$node}->id == $id);
					} else {
						return FALSE;
					}
				} else {
					return ($element->{$node} == $id);
				}
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function checks if two users share minimum one organization
	 * @param object $user The user to check the current user agains
	 * @since 1.0
	 * @access private
	 */
	private function _Share_Organization ( $user) {
		$share = false;
		$user_organizations = self::_Get_User_Organizations($user);
		if (self::_Get_User_Organizations() != null && $user_organizations != null) {
			foreach (self::_Get_User_Organizations() as $key => $org) {
				if (in_array($org, $user_organizations) || array_key_exists($org, $user_organizations)) {
					$share = true;
				}
			}
		}
		return $share;
	}

	/**
	 * This function returns if the request is coming from a CI applicaton
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _Is_Application () {
		return ((isset($_SERVER["HTTP_USER_AGENT"]) && ($_SERVER["HTTP_USER_AGENT"] == "CI/Windows") || (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "CI/Android")));
	}

	/**
	 * This function converts property names to row names
	 * used in the search function
	 * @param array $Query  The query to convert
	 * @param object $Object The pbject to get the convert table from
	 * @param array $Secure An optional secure export ignore list
	 * @param array $Fields An optional array of the requested fields
	 * @since 1.0
	 * @access private
	 */
	private function _Convert($Query = NULL,$Object = NULL,$Secure = NULL,$Fields = NULL){
		if(!is_null($Object)){
			$Rows = $Object->Database_Names();
			$Allowed = $Object->Database_Rows();
			$Return = array();
			foreach ($Query as $Key => $Term) {
				if((!is_null($Secure) && array_key_exists($Key, $Secure)) || is_null($Secure)){
					if((!is_null($Fields) && is_array($Fields) && (array_key_exists($Key, $Fields) || in_array($Key, $Fields))) || is_null($Fields)){
						if(array_key_exists($Key, $Rows)){
							$Key = $Rows[$Key];
						}
						if(array_key_exists($Key, $Allowed)){
							$Return[$Key] = $Term;
						}
					}
				}
			}
			return $Return;
		} else {
			return $Query;
		}
	}

	/**
	 * This function creates a array containing all the users organizations
	 * @since 1.0
	 * @param object $user An optional user to get the organizations from
	 * @access private
	 * @return array
	 */
	private function _Get_User_Organizations( $user = null){
		$Organizations = array();	
		if (is_null($user)) {
			$user = $this->_User;
		}
		if(!is_null($user->organizations) && is_array($user->organizations)){
			foreach ($user->organizations as $Organization) {
				if(is_object($Organizations)){
					if(property_exists($Organization, "id")){
						$Organizations[] = (int)$Organization->id;
					}
				} else {
					if(is_object($Organization)){
						if(property_exists($Organization, "id")){
							$Organizations[] = (int)$Organization->id;
						}
					} else {
						$Organizations[] = (int)$Organization;
					}
				}
			}
		} else if(!is_null($user->organizations) && is_integer($user->organizations)){
			$Organizations[] = (int)$user->organizations;
		} else {
			$this->api_response->Code = 401;
			return;
		}
		return $Organizations;
	}

	/**
	 * This function is used to create Computer Models using the API
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Model_Create () {
		if(!is_null($this->api_request->Request_Data())){
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Computer_Model";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			$this->load->library("Computer_Model");
			$Computer_Model = new Computer_Model();
			$Computer_Model->Set_Current_User($this->_User->id);
			$Computer_Model->Import($Request_Data);
			if($Computer_Model->Save()){
				self::_Computer_Model($Computer_Model->id);
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}
}