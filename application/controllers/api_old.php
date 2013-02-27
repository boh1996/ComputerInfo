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
	 * This function loads a specific computer using the specified id
	 * @param integer $Id The id of the computer to load
	 * @since 1.0
	 * @access private
	 */
	private function _Computer($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Computer");
			$this->api_response->ResponseKey = "Computer";
			$Computer = new Computer();
			if($Computer->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Computer->organization)){
					$this->api_response->Code = 200;
					$this->api_response->Count = 1;
					$this->api_response->Response = $Computer->Export(null,false);
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This endpoint responds to POST request,
	 * and outputs the request "computers" with the requested "fields"
	 * @since 1.2
	 * @access private
	 */
	private function _Computers_Select_Create () {
		$post = $this->api_request->Request_Data();
		$this->api_response->ResponseKey = "Computers";

		$this->load->library("batch_loader");
		$Loader = new Batch_Loader();

		if ( ! isset($post["computers"]) || ! is_array(explode(",", $post["computers"])) ) {
			$this->api_response->Code = 400;
			return;
		}

		$fields = null;

		if ( isset($post["fields"]) ) {
			$fields = explode(",", $post["fields"]);
		} else if ( isset($_GET["fields"]) ) {
			$fields = explode(",", $_GET["fields"]);
		}

		$this->db->where_in("id", explode(",", $post["computers"]));

		$result = $Loader->Load("computers", "Computer",null,null,null,$fields);

		if ( $result !== false ) {
			$this->api_response->Response = $result;
			$Query_Data = $Loader->Last();
			$this->api_response->Count = $Query_Data["num_rows"];
			$this->api_response->Code = 200;
		} else {
			$this->api_response->Code = 404;
		}
	}

	/**
	 * This function outputs an organizations computers with ids and last_updated
	 * @since 1.1
	 * @access private
	 * @param integer $organization_id The organization to search for
	 */
	private function _Computers_Timestamps ( $organization_id ) {
		$this->load->library("batch_loader");
		$Loader = new Batch_Loader();

		if( ! is_null($organization_id) ){
			if(!self::_Has_Access("organizations",$this->_User,$organization_id)){
				$this->api_response->Code = 401;
				return;
			}

			$result = $Loader->Load("computers", "Computer", array("organization" => $organization_id), null, null, array("id","last_updated"));
			if ( $result !== false ) {
				$this->api_response->Response = $result;
				$Query_Data = $Loader->Last();
				$this->api_response->Count = $Query_Data["num_rows"];
				$this->api_response->ResponseKey = "Computers";
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 404;
				return;
			}
		} else  {
			$this->api_response->Code = 400;
			return;
		}
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
	 * This function deletes a computer, found by it's database id
	 * @param integer $Id The id of the computer to delete
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Delete($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Computer");
			$this->api_response->ResponseKey = "Computer";
			$Computer = new Computer();
			if($Computer->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Computer->organization)){
					$this->api_response->Code = 200;
					$Computer->Delete(true);
					$this->api_response->Response = array();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function get's the available options for a class
	 * @since 1.3
	 * @access private
	 * @param string $option_type The class to get the options for
	 */
	private function _Options ( $option_type = null ) {
		if (is_null($option_type)) {
			$this->api_response->Code = 400;
			return;
		}
		$this->api_response->Code = 200;
		$option_type = strtolower($option_type);
		switch ($option_type) {
			case "device_type":
				$this->api_response->Code = 200;
				$category = null;
				if (isset($_GET["category"])) {
					$category = $_GET["category"];
				}
				self::_Find_Device_Types($category);
				break;
			
			case "computer_model" :
				$manufacturer = null;
				if (isset($_GET["manufacturer"])) {
					$manufacturer = $_GET["manufacturer"];
				}
				$device_type = null;
				$category = null;
				if (isset($_GET["type"])) {
					$device_type = $_GET["type"];
				}
				$name = null;
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
				}
				self::_Find_Computer_Models($manufacturer,$device_type,$name);
				break;

			case "screen_size" :
				self::_Simple_Search("Screen_Size", null, false, true);
				break;

			case "printer_model" :
				$manufacturer = null;
				if (isset($_GET["manufacturer"])) {
					$manufacturer = $_GET["manufacturer"];
				}
				$name = null;
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
				}
				self::_Find_Printer_Models($manufacturer,$name);
				break;

			case "device_model" : 
				$manufacturer = null;
				if (isset($_GET["manufacturer"])) {
					$manufacturer = $_GET["manufacturer"];
				}
				$device_type = null;
				$category = null;
				if (isset($_GET["type"])) {
					$device_type = $_GET["type"];
				}
				$name = null;
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
				}
				self::_Find_Device_Models($manufacturer,$device_type,$name);
				break;

			case "location" :
				if (isset($_GET["organization"]) && in_array($_GET["organization"], self::_Get_User_Organizations())) {
					self::_Get_Locations($_GET["organization"]);
				} else {
					$this->api_response->Code = 400;
				}
				break;

			case "floor" :
				if (isset($_GET["organization"]) && !empty($_GET["organization"])) {
					$name = null;
					$building = null;
					if (!empty($_GET["building"])) {
						$building = $_GET["building"];
					}
					if (!empty($_GET["name"])) {
						$name = $_GET["name"];
					}
					self::_Get_Floors($_GET["organization"],$name,$building);
				} else {
					$this->api_response->Code = 400;
				}
				break;

			case "building":
				if (isset($_GET["organization"]) && !empty($_GET["organization"])) {
					self::_Get_Buildings($_GET["organization"]);
				} else {
					$this->api_response->Code = 400;
				}
				break;

			case "manufacturer" :
				$manufacturer = null;
				if (!empty($_GET["name"])) {
					$manufacturer = $_GET["name"];
				}
				self::_Find_Manufacturers($manufacturer);
				break;

			default:
				$this->api_response->Code = 400;
				break;
		}
	}

	/**
	 * This function finds either all manufacturers or the one(s)
	 * that fits the specified name
	 * @param string $name The name or the beginning of it to search for
	 * @since 1.0
	 * @access private
	 */
	private function _Find_Manufacturers ( $name = null ) {
		$data = array("q" => "","fields" => "name");
		if (!is_null($name)) {
			$data["q"] = $name;
			$data["fields"] = "name";
		}
		if (count($data) > 0) {
			$this->api_request->Request_Data($data);
		}
		self::_Simple_Search("Manufacturer", null, false, true);
	}

	/**
	 * This function finds all the device models
	 * @since 1.0
	 * @access private
	 * @param string $manufacturer The manufacturer to search for, this is optional
	 * @param string $device_type  An optional device type to search for
	 */
	private function _Find_Device_Models ( $manufacturer = null, $device_type = null, $name = null ) {
		$data = array();
		if (!is_null($manufacturer)) {
			$this->load->library("Manufacturer");
			$Manufacturer = new Manufacturer();
			$Category->Find(array("name" => $manufacturer));
			$data = array(
				"q" => $Manufacturer->id,
				"fields" => "manufacturer"
			);
			$this->api_request->Request_Data($data);
		}
		if (!is_null($name)) {
			if (!isset($data["q"])) {
				$data["q"] = $name;
			}
			if (isset($data["fields"])) {
				$data["fields"] = $data["fields"].",name";
			} else {
				$data["fields"] = "name";
			}
			$data["name"] = $name;
		}
		if (!is_null($device_type)) {
			$this->load->library("Device_Type");
			$Type = new Device_Type();
			if (strlen((int)$device_type) > 0) {
				$Type->Load($device_type);
			} else {
				$Type->Find(array("name" => $device_type));
			}
			if (!isset($data["q"])) {
				$data["q"] = $Type->id;
			}
			if (!isset($data["fields"])) {
				$data["fields"] = "type";
			} else {
				$data["fields"] = $data["fields"].",type";
			}
			$data["type"] = $Type->id;
		}
		if (count($data) > 0) {
			$this->api_request->Request_Data($data);
		}
		self::_Simple_Search("Device_Model", null, false, true);
	}

	/**
	 * This function is used to get all the options for the printer models select
	 * @since 1.0
	 * @access private
	 * @param string $manufacturer The name of the manufacturer
	 * @param string $name         The name of the printer model
	 */
	private function _Find_Printer_Models ( $manufacturer = null, $name = null) {
		$data = array();
		if (!is_null($manufacturer)) {
			$this->load->library("Manufacturer");
			$Manufacturer = new Manufacturer();
			$Category->Find(array("name" => $manufacturer));
			$data = array(
				"q" => $Manufacturer->id,
				"fields" => "manufacturer"
			);
			$this->api_request->Request_Data($data);
		}
		if (!is_null($name)) {
			if (!isset($data["q"])) {
				$data["q"] = $name;
			}
			if (isset($data["fields"])) {
				$data["fields"] = $data["fields"].",name";
			} else {
				$data["fields"] = "name";
			}
			$data["name"] = $name;
		}
		if (count($data) > 0) {
			$this->api_request->Request_Data($data);
		}
		self::_Simple_Search("Printer_Model", null, false, true);
	}

	/**
	 * This function finds all the computer models
	 * @since 1.0
	 * @access private
	 * @param string $manufacturer The manufacturer to search for, this is optional
	 * @param string $device_type  An optional device type to search for
	 */
	private function _Find_Computer_Models ( $manufacturer = null, $device_type = null, $name = null) {
		$data = array();
		if (!is_null($manufacturer)) {
			$this->load->library("Manufacturer");
			$Manufacturer = new Manufacturer();
			$Category->Find(array("name" => $manufacturer));
			$data = array(
				"q" => $Manufacturer->id,
				"fields" => "manufacturer"
			);
			$this->api_request->Request_Data($data);
		}
		if (!is_null($name)) {
			if (!isset($data["q"])) {
				$data["q"] = $name;
			}
			if (isset($data["fields"])) {
				$data["fields"] = $data["fields"].",name";
			} else {
				$data["fields"] = "name";
			}
			$data["name"] = $name;
		}
		if (!is_null($device_type)) {
			$this->load->library("Device_Type");
			$Type = new Device_Type();
			if (strlen((int)$device_type) > 0) {
				$Type->Load($device_type);
			} else {
				$Type->Find(array("name" => $device_type));
			}
			if (!isset($data["q"])) {
				$data["q"] = $Type->id;
			}
			if (!isset($data["fields"])) {
				$data["fields"] = "type";
			} else {
				$data["fields"] = $data["fields"].",type";
			}
			$data["type"] = $Type->id;
		}
		if (count($data) > 0) {
			$this->api_request->Request_Data($data);
		}
		self::_Simple_Search("Computer_Model", null, false, true);
	}

	/**
	 * This function loads uo an array of all device types allocated with a specific category
	 * @since 1.0
	 * @access private
	 */
	private function _Find_Device_Types ( $category = "Computer") {
		if (is_null($category)) {
			$category = "Computer";
		}
		$this->load->library("Device_Category");
		$Category = new Device_Category();
		$Category->Find(array("name" => $category));
		$data = array("q" => $Category->id,"fields" => "category");
		$this->api_request->Request_Data($data);
		self::_Simple_Search("Device_Type", null, false, true);
	}

	/**
	 * This function gets the computers for a specific organization
	 * @param integer $Id The organization id
	 * @since 1.0
	 * @access private
	 */
	private function _Get_Computers($Id = NULL){
		if (self::_Get_User_Organizations() != null) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}

			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();

			if(in_array($Id, self::_Get_User_Organizations())){
				$result = $Loader->Load("computers", "Computer", array("organization" => $Id),$fields);
				if ( $result !== false ) {
					$this->api_response->Response = $result;
					$Query_Data = $Loader->Last();
					$this->api_response->Count = $Query_Data["num_rows"];
					$this->api_response->ResponseKey = "Computers";
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 401;
			}
		}
	}

	/**
	 * This function is used to get all devices of an organizations
	 * @param integer $Id The organization id
	 * @since 1.0
	 * @access private
	 */
	private function _Get_Devices($Id = NULL){
		if (self::_Get_User_Organizations() !== null) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}

			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();

			if(in_array($Id, self::_Get_User_Organizations())){
				$result = $Loader->Load("devices", "Device", array("organization" => $Id),$fields);
				if ( $result !== false ) {
					$this->api_response->Response = $result;
					$Query_Data = $Loader->Last();
					$this->api_response->Count = $Query_Data["num_rows"];
					$this->api_response->ResponseKey = "Devices";
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 401;
			}
		}
	}

	/**
	 * This function finds the floors specified by thw query
	 * @since 1.0
	 * @access private
	 * @param integer $organization   The organization to search for
	 * @param string $name           An optional floor name
	 * @param integer $building_seach An optional building name or id
	 */
	private function _Get_Floors ( $organization = null, $name = null, $building_seach = null ) {
		if (self::_Get_User_Organizations() != null && in_array($organization, self::_Get_User_Organizations())) {
			$Building = null;
			$this->load->library("building");
			if (is_null($building_seach)) {
				$data = array(
					"organization" => $organization
				);
				$this->api_request->Request_Data($data);
				$building_objects = self::_Simple_Search("Building",null,true);
				$buildings = array();
				if (!is_null($buildings) && is_array($buildings)) {
					foreach ($building_objects as $key => $value) {
						$buildings[] = $value["id"];
					}
				} else {
					$this->api_response->Code = 401;
					return;
				}
			} else if (strlen((int)$building_seach) > 0) {
				$Building = new Building();
				if (!$Building->Load($building_seach)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$Building = new Building();
				if(!$Building->Find(array("name" => $building_seach,"organization" => $organization))){
					$this->api_response->Code = 401;
					return;
				}
			}
			if (!is_null($Building)) {
				$buildings = $Building->id; 
			}
			$data = array(
				"building" => $buildings
			);
			if (!is_null($name)){
				$data["name"] = $name;
			}
			if (!is_null($name)) {
				$data["name"] = $name;
			}
			$this->api_request->Request_Data($data);
			self::_Simple_Search("Floor");
		} else {
			$this->api_response->Code = 401;
		}
	}

	/**
	 * This function searches for buildings by organization or name
	 * @param integer $organization The organization id
	 * @since 1.0
	 * @access private
	 * @param string $name         An optional name of the building
	 */
	private function _Get_Buildings ( $organization = null, $name = null ) {
		if (self::_Get_User_Organizations() != null && in_array($organization, self::_Get_User_Organizations())) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}

			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();
			$data = array(
				"organization" => $organization
			);
			if (!is_null($name)){
				$data["name"] = $name;
			}
			$result = $Loader->Load("buildings", "Building", $data,$fields);
			if ( $result !== false ) {
				$this->api_response->Response = $result;
				$Query_Data = $Loader->Last();
				$this->api_response->Count = $Query_Data["num_rows"];
				$this->api_response->ResponseKey = "Buildings";
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 401;
		}
	}

	/**
	 * This function is used to get all the printers of an organization
	 * @since 1.0
	 * @access private
	 * @param integer $Id The organization id
	 */
	private function _Get_Printers($Id = NULL){
		if (self::_Get_User_Organizations() !== null) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}
			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();

			if ( in_array($Id, self::_Get_User_Organizations())) {
				$result = $Loader->Load("printers", "Printer", array("organization" => $Id),$fields);
				if ( $result !== false ) {
					$this->api_response->Response = $result;
					$Query_Data = $Loader->Last();
					$this->api_response->Count = $Query_Data["num_rows"];
					$this->api_response->ResponseKey = "Printers";
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 401;
			}
		}
	}

	/**
	 * This function is used to get all the screens of an organization
	 * @since 1.0
	 * @access private
	 * @param integer $Id The organization id
	 */
	private function _Get_Screens($Id = NULL){
		if (self::_Get_User_Organizations() !== null) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}
			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();

			if(in_array($Id, self::_Get_User_Organizations())){
				$result = $Loader->Load("screens", "Screen", array("organization" => $Id),$fields);
				if ( $result !== false ) {
					$this->api_response->Response = $result;
					$Query_Data = $Loader->Last();
					$this->api_response->Count = $Query_Data["num_rows"];
					$this->api_response->ResponseKey = "Screens";
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 401;
			}
		}
	}

	/**
	 * This function is used tog et all the locations of a organization
	 * @since 1.0
	 * @access private
	 * @param integer $Id The organization id
	 */
	private function _Get_Locations($Id = NULL){
		if (self::_Get_User_Organizations() !== null) {
			$fields = null;
			if ( $this->input->get("fields") ) {
				$fields = explode(",", $this->input->get("fields"));
			}
			$this->load->library("batch_loader");
			$Loader = new Batch_Loader();

			if(in_array($Id, self::_Get_User_Organizations())){
				$result = $Loader->Load("locations", "Location", array("organization" => $Id),null,null,$fields);
				if ( $result !== false ) {
					$this->api_response->Response = $result;
					$Query_Data = $Loader->Last();
					$this->api_response->Count = $Query_Data["num_rows"];
					$this->api_response->ResponseKey = "Locations";
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 401;
			}
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
	 * This endpoint provides information on a specific user
	 * or if the [:id:] is set to "me" then the current user is shown
	 * @param string|integer $id The user id or "me"
	 * @since 1.0
	 * @access private
	 */
	private function _User ( $id = null ) {
		if (self::_Get_User_Organizations() !== null) {
			$this->load->library("User");
			$this->api_response->ResponseKey = "User";
			$User = new User();
			$me = false;
			if (!is_null($id)) {	
				$fields = array(
					"id",
					"organizations",
					"email",
					"name"
				);
				if ( $id == "me" ) {
					$id = (int)$this->_User->id;
					$me = true;
				}
				if (!$User->Load($id)) {
					$this->api_response->Code = 500;
					return;
				}
				if ( $me == false ) {
					if (self::_Share_Organization($User) === false) {
						$this->api_response->Code = 403;
						return;
					}
				}
				$this->api_response->Response = $User->Export($fields,false);
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 400;
			}
		} else {
			$this->api_response->Code = 401;
		}
	}

	/**
	 * This function performs the PATCH and PUT request
	 * @param integer  $Id        The id of the computer to update
	 * @param boolean $Overwrite If the request is PATCH, "false" or PUT, "true"
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Update($Id = NULL,$Overwrite = true){
		if($this->api_request->Request_Data() != NULL and $this->api_request->Request_Data() != "" and count($this->api_request->Request_Data()) > 0){
			$this->api_response->ResponseKey = "Computer";
			$this->api_response->Debug = false;
			$Request_Data = $this->api_request->Request_Data();
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			if(isset($Request_Data["created_time"])){
				unset($Request_Data["created_time"]);
			}
			$this->load->library("Computer");
			$Computer = new Computer();
			$Computer->Set_Current_User($this->_User->id);
			if(!$Computer->Load($Id)){
				$this->api_request->Code = 404;
				return;
			}
			$Computer->Import($Request_Data,$Overwrite);
			if(!is_null($Computer->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Computer->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$this->api_response->Code = 400;
				return;
			}
			if($Computer->Save()){
				$this->api_response->Response = $Computer->Export(null,null,array("organization","groups"));
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function handles the Token info endpoint
	 * @since 1.0
	 * @access private
	 * @param string $token The token to get the info for
	 */
	private function _Token ( $token = null ) {
		if (!is_null($token)) {
			$this->load->library("token");
			$Token = new Token();
			if ($Token->Load(array("token" => $token))){
				$this->api_response->Code = 200;
				$this->api_response->Count = 4;
				if ($Token->offline == 0) {
					$Token->time_left = round(($Token->created + $Token->time_to_live) - time());
				}
				if (self::_Is_Application()) {
					die("true");
				} else {
					$this->api_response->Response = $Token->Export(null, false, array("user","created"));
				}
			} else {
				if (self::_Is_Application()) {
					die("false");
				} else {
					$this->api_response->Code = 404;
				}
			}
		} else {
			if (self::_Is_Application()) {
					die("false");
			} else {
				$this->api_response->Code = 400;
			}
		}
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
	 * This function builds the search query based on the request data
	 * and the request object
	 * @param object $Object The object that are being searched on
	 * @param boolean $Secure If a secure convert should be used
	 * @since 1.0
	 * @access private
	 * @return array
	 */
	private function _Search_Build_Query($Object = NULL, $Secure = true){
		if(!is_null($Object)){
			$Request_Data = $this->api_request->Request_Data();

			//Loop through the fields that the requester requests or use all fields
			if(isset($Request_Data["fields"])){
				$Fields = explode(",",$Request_Data["fields"]);
			} else {
				$Fields = array_keys($Object->Export(null,false));
			}

			//Build the query
			$InputQuery = array();
			$where_in = array();
			foreach ($Fields as $Field) {
				if (!empty($Request_Data)) {
					if (isset($Request_Data["q"])) {
						$InputQuery[$Field] = $Request_Data["q"];
					}
					if (isset($Request_Data[$Field])) {
						if (is_array($Request_Data[$Field])) {
							$where_in[$Field] = $Request_Data[$Field];
							unset($InputQuery[$Field]);
						} else if (is_string($Request_Data[$Field]) && strpos($Request_Data[$Field], ",") === false) {
							$InputQuery[$Field] = $Request_Data[$Field];
						} else {
							if (isset($Request_Data[$Field])) {
								unset($InputQuery[$Field]);
								$where_in[$Field] = explode(",", $Request_Data[$Field]);
							}
						}
					}
				}
			}
			

			$Organizations = self::_Get_User_Organizations();
			if(is_null($Organizations)){
				$this->api_response->Code = 401;
				return;
			}

			//If the object has an organization row use it
			$Organization_Id_Row = self::_Convert(array("organization" => "1"),$Object);
			if(count($Organization_Id_Row) > 0){
				$Organization_Id_Row = key($Organization_Id_Row);
			} else {
				$Organization_Id_Row = NULL;
			}

			//Build the query array
			if ($Secure) {
				$Secure = $Object->Export(null,false);
				$Query = self::_Convert($InputQuery,$Object,$Secure,$Fields);
			} else {
				$Query = $Object->Convert($InputQuery);
			}
			if (!is_null($where_in)) {
				if ($Secure) {
					$Secure = $Object->Export(null,false);
					$where_in = self::_Convert($where_in,$Object,$Secure,$Fields);
				} else {
					$where_in = $Object->Convert($where_in);
				}
				foreach ($where_in as $key => $value) {
					$this->db->where_in($key, $value);
				}
			}
			if(count($Query) > 0 || count($where_in) > 0){
				//Assemble thw query
				$this->db->like($Query,"after")->select("id")->group_by("id");

				//If the organization row isset use it
				if(!is_null($Organization_Id_Row)){
					$this->db->where_in($Organization_Id_Row,$Organizations);
				}

				//Get the database raw data
				$Raw = $this->db->get($Object->Database_Table);

				return $Raw;
			} else {
				if (is_null($Organization_Id_Row)) {
					$Raw = $this->db->get($Object->Database_Table);
					if (is_null($Raw)) {
						$this->api_response->Code = 400;
					} else {
						return $Raw;
					}
				} else if (!is_null($Organization_Id_Row)) {
					$this->db->where_in($Organization_Id_Row,$Organizations);
					$Raw = $this->db->get($Object->Database_Table);
					if (is_null($Raw)) {
						$this->api_response->Code = 400;
					} else {
						return $Raw;
					}
				} else {
					$this->api_response->Code = 400;
				}
			}
		}
	}

	/**
	 * This function performs a standadirized search
	 * @param string $Key     The name of the type we are using etc "Computer"
	 * @param string $Library An optional library overwrite
	 * @param boolan $Return If this flag is set to true, then the data us returned instead of send to the api_response
	 * @param boolean $Linked If this flag is true, then the linked properties can be searched in too
	 * @since 1.0
	 * @access private
	 */
	private function _Simple_Search($Key = NULL,$Library = NULL, $Return = false, $Linked = false){
		if(!is_null($Key)){
			if(is_null($Library)){
				$Library = $Key;
			}

			if(substr($Key, -1) !== "s"){
				$ResponseKey = $Key."s";
			} else {
				$ResponseKey = $Key;
			}
			$this->load->library($Library);
			$Class = new $Library();	
			$Request_Data = $this->api_request->Request_Data();
			if((isset($Request_Data["q"]) || $this->api_request->Request_Data()) && is_array($this->api_request->Request_Data()) && count($this->api_request->Request_Data()) > 0 && ($this->api_request->Request_Method() === "post" || "get")){				
				$this->api_response->ResponseKey = $ResponseKey;
				//Get the response
				$Raw = self::_Search_Build_Query($Class,!$Linked);
				if(is_null($Raw)){
					$this->api_response->Code = 400;
					return;
				}

				//Assemble the response
				$Response = array();
				if($Raw->num_rows() > 0){
					foreach ($Raw->result() as $Row) {
						$Object = new $Library();
						$Object->Load($Row->id);
						$Response[] = $Object->Export(null,false);
					}
					if (!$Return) {
						$this->api_response->Response = $Response;
						$this->api_response->Code = 200;
					} else {
						return $Response;
					}
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->ResponseKey = $ResponseKey;
				$Raw = $this->db->select("id")->get($Class->Database_Table);
				$Response = array();
				if($Raw->num_rows() > 0){
					foreach ($Raw->result() as $Row) {
						$Object = new $Library();
						$Object->Load($Row->id);
						$Response[] = $Object->Export(null,false);
					}
					if (!$Return) {
						$this->api_response->Response = $Response;
						$this->api_response->Code = 200;
					} else {
						return $Response;
					}
				} else {
					$this->api_response->Code = 404;
				}
			}
		} else {
			$this->api_response->Code = 500;
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
	 * This function performs the search query for the computers
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Search () {
		$Request_Data = $this->api_request->Request_Data();
		if(isset($Request_Data["q"]) && is_array($this->api_request->Request_Data()) && count($this->api_request->Request_Data()) > 0 && ($this->api_request->Request_Method() === "post" || "get")){		
			$this->load->library("Computer");
			$this->api_response->ResponseKey = "Computers";
			$Computer = new Computer();			

			//Get the response
			$Raw = self::_Search_Build_Query($Computer);
			if(is_null($Raw)){
				$this->api_response->Code = 400;
				return;
			}

			//Assemble the response
			$Response = array();
			if($Raw->num_rows() > 0){
				foreach ($Raw->result() as $Row) {
					$Object = new Computer();
					$Object->Load($Row->id);
					$Response[] = $Object->Export();
				}
				$this->api_response->Response = $Response;
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function ensures that the user has access to create a computer
	 * and then the new computer is created
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Create(){
		if(is_array($this->api_request->Request_Data())){		
			$this->api_response->Debug = false;
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Computer";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			$this->load->library("Computer");
			$Computer = new Computer();
			$Computer->Set_Current_User($this->_User->id);
			$Computer->Import($Request_Data);
			if(!is_null($Computer->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Computer->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$Computer->organization = $this->_User->organizations[0]->id;
			}
			//Ensure that all the parameters are right
			if($Computer->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Computer->Export();
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function is used to create computers from the desktop clients
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Client_Create () {
		if (is_array($this->api_request->Request_Data())) {
			if ( self::_Get_User_Organizations() != null ) {
				$Request_Data = $this->api_request->Request_Data();
				if (isset($Request_Data["computer"])) {
					$Request_Data = $Request_Data["computer"];
				} else {
					$this->api_response->Code = 400;
					return;
				}
				if ( ! is_null($Request_Data["printers"]) ) {
					foreach ($Request_Data["printers"] as $key => $value) {
						$Request_Data["printers"][$key] = $Request_Data["organization"];
					}
				}
				$this->api_response->ResponseKey = "Computer";
				if(isset($Request_Data["id"])){
					unset($Request_Data["id"]);
				}
				$this->load->library("Computer");
				$Computer = new Computer();
				$Computer->Set_Current_User($this->_User->id);
				$Computer->Import($Request_Data);
				if(!is_null($Computer->organization)){
					if(!self::_Has_Access("organizations",$this->_User,$Computer->organization)){
						$this->api_response->Code = 401;
						return;
					}
				} else {
					$Computer->organization = $this->_User->organizations[0]->id;
				}
				//Ensure that all the parameters are right
				if($Computer->Save()){
					$this->api_response->Code = 200;
					$this->api_response->Response = $Computer->Export(null, false);
				} else {
					$this->api_response->Code = 409;
				}
			} else {
				$this->api_response->Code = 401;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function creates a printer
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Create(){
		if(!is_null($this->api_request->Request_Data())){
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Printer";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			$this->load->library("Printer");
			$Printer = new Printer();
			$Printer->Set_Current_User($this->_User->id);
			$Printer->Import($Request_Data);
			if(!is_null($Printer->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Printer->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$Printer->organization = $this->_User->organizations[0]->id;
			}
			if($Printer->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = array("id" => $Printer->id);
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function is used to update a specific printer
	 * @param integer  $Id        The id of the printer to update
	 * @param boolean $Overwrite If the request is PATCH, false or PUT, true
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Update($Id = NULL,$Overwrite = false){
		if(!is_null($this->api_request->Request_Data())){
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Printer";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			if(isset($Request_Data["created_time"])){
				unset($Request_Data["created_time"]);
			}
			$this->load->library("Printer");
			$Printer = new Printer();
			$Printer->Set_Current_User($this->_User->id);
			if(!$Printer->Load($Id)){
				$this->api_request->Code = 404;
				return;
			}
			$Printer->Import($Request_Data);
			if(!is_null($Printer->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Printer->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$this->api_response->Code = 400;
				return;
			}
			if($Printer->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = array();
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This funcion is used when a post request is performed
	 * at the device endpoint
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Create(){
		if(!is_null($this->api_request->Request_Data())){
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Device";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			$this->load->library("Device");
			$Device = new Device();
			$Device->Set_Current_User($this->_User->id);
			$Device->Import($Request_Data);
			if(!is_null($Device->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Device->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$Device->organization = $this->_User->organizations[0]->id;
			}
			if($Device->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = array("id" => $Device->id);
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function performs update and overwrite request on a specific deviec
	 * if the user has access
	 * @param integer  $Id        The id of the device to update
	 * @param boolean $Overwrite If the request is PATCH, false or PUT, true
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Update($Id = NULL,$Overwrite = false){
		if(!is_null($this->api_request->Request_Data())){
			$Request_Data = $this->api_request->Request_Data();
			$this->api_response->ResponseKey = "Device";
			if(isset($Request_Data["id"])){
				unset($Request_Data["id"]);
			}
			if(isset($Request_Data["created_time"])){
				unset($Request_Data["created_time"]);
			}
			$this->load->library("Device");
			$Device = new Device();
			$Device->Set_Current_User($this->_User->id);
			if(!$Device->Load($Id)){
				$this->api_request->Code = 404;
				return;
			}
			$Device->Import($Request_Data);
			if(!is_null($Device->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Device->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$this->api_response->Code = 400;
				return;
			}
			if($Device->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Device->Export();
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
		}
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
			$this->api_response->ResponseKey = "Computer_Model";
			$ComputerModel = new Computer_Model();
			if($ComputerModel->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $ComputerModel->Export();
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
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

	/**
	 * This function loads up a device,
	 * defined by the database id of it
	 * @param integer $Id The database id of the device to load
	 * @since 1.0
	 * @access private
	 */
	private function _Device($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Device");
			$this->api_response->ResponseKey = "Device";
			$Device = new Device();
			if($Device->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Device->organization)){
					$this->api_response->Code = 200;
					$this->api_response->Response = $Device->Export();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {	
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This endpoint outputs specifik data about a screen
	 * @param integer $id The database id of the screen to load
	 * @since 1.0
	 * @access private
	 */
	private function _Screen ($id = null) {
		if(!is_null($id)){
			$this->load->library("Screen");
			$this->api_response->ResponseKey = "Screen";
			$Screen = new Screen();
			if($Screen->Load($id)){
				if(self::_Has_Access("organizations",$this->_User,$Screen->organization)){
					$this->api_response->Code = 200;
					$this->api_response->Response = $Screen->Export();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {	
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This endpoint output data about a specific location,
	 * found by id
	 * @since 1.0
	 * @access public
	 * @param integer $id The database id of the location
	 */
	public function _Location ($id = null) {
		if(!is_null($id)){
			$this->load->library("Location");
			$this->api_response->ResponseKey = "Location";
			$Location = new Location();
			if($Location->Load($id)){
				if(self::_Has_Access("organizations",$this->_User,$Location->organization)){
					$this->api_response->Code = 200;
					$this->api_response->Response = $Location->Export();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {	
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function deletes a specific device, if the user has access to it
	 * @param integer $Id The id of the device to delete
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Delete($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Device");
			$this->api_response->ResponseKey = "Device";
			$Device = new Device();
			$Device->Set_Current_User($this->_User->id);
			if($Device->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Device->organization)){
					$this->api_response->Code = 200;
					$Device->Delete(true);
					$this->api_response->Response = array();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {	
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function loads up a cpu specified by it's
	 * database id
	 * @param integer $Id The database id of the Cpu
	 * @since 1.0
	 * @access private
	 */
	private function _Cpu($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Cpu");
			$this->api_response->ResponseKey = "Cpu";
			$Cpu = new Cpu();
			if($Cpu->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Cpu->Export();
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function loads up
	 * a specific device model, specified by it's database id
	 * @param integer $Id The database row id of the Device Model
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Model($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Device_Model");
			$this->api_response->ResponseKey = "Device_Model";
			$DeviceModel = new Device_Model();
			if($DeviceModel->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $DeviceModel->Export();
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function loads up a specific manufacturer,
	 * specified by it's id
	 * @param integer $Id The database id if the Manufacturer
	 * @since 1.0
	 * @access private
	 */
	private function _Manufacturer($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Manufacturer");
			$this->api_response->ResponseKey = "Manufacturer";
			$Manufacturer = new Manufacturer();
			if($Manufacturer->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $Manufaturer->Export();
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
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
			$this->api_response->ResponseKey = "Printer";
			$Printer = new Printer();
			if($Printer->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Printer->organization)){
					$this->api_response->Code = 200;
					$this->api_response->Response = $Printer->Export();
				} else {
					$this->api_response->Code = 401;
				}
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function deletes the printer specified,
	 * if the user has access to it
	 * @param integer $Id The database row id of the printer to delete
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Delete($Id = NULL){
		if(!is_null($Id)){
			$this->load->library("Printer");
			$this->api_response->ResponseKey = "Printer";
			$Printer = new Printer();
			$Printer->Set_Current_User($this->_User->id);
			if($Printer->Load($Id)){
				if(self::_Has_Access("organizations",$this->_User,$Printer->organization)){
					$this->api_response->Code = 200;
					$Printer->Delete();
					$this->api_response->Response = array();
				} else {
					$this->api_response->Code = 401;
				}
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
			$this->api_response->ResponseKey = "Printer_Model";
			$PrinterModel = new Printer_Model();
			if($PrinterModel->Load($Id)){
				$this->api_response->Code = 200;
				$this->api_response->Response = $PrinterModel->Export();
			} else {
				$this->api_response->Code = 404;
			}
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function is used to search for printers using fields or all fields
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Search(){
		self::_Simple_Search("Printer");
	}

	/**
	 * This function is used to search for printer models
	 * @since 1.0
	 * @access private
	 */
	private function _Printer_Model_Search(){
		self::_Simple_Search("Printer_Model");
	}

	/**
	 * This function is used to search for manufacturers
	 * @since 1.0
	 * @access private
	 */
	private function _Manufacturer_Search(){
		self::_Simple_Search("Manufacturer");
	}

	/**
	 * This function is called when a requester searches for a device
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Search(){
		self::_Simple_Search("Device");
	}

	/**
	 * This function is called when a requester searches for 
	 * a device model
	 * @since 1.0
	 * @access private
	 */
	private function _Device_Model_Search(){
		self::_Simple_Search("Device_Model");
	}

	/**
	 * This function is used to search for computer models
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Model_Search(){
		self::_Simple_Search("Computer_Model");
	}

	/**
	 * This function just configurates the Simple search
	 * so it can search for Cpu's
	 * @since 1.0
	 * @access private
	 */
	private function _Cpu_Search(){
		self::_Simple_Search("Cpu");
	}

	/**
	 * This function saves the users settings
	 * @since 1.0
	 * @access private
	 */
	private function _User_Settings_Create () {
		$this->load->model("settings");
		$this->load->library("auth/login_security");
		$data = array();
		if ($this->input->post("save_selection") !== false && in_array($this->input->post("save_selection"), array("true","false"))) {
			$data["save_selection"] = $this->input->post("save_selection");
		}

		if ($this->input->post("language") && array_search($this->input->post("language"), $this->config->item("languages")) !== false) {
			$data["language"] = array_search($this->input->post("language"), $this->config->item("languages"));
		}

		//Only promt for password if the user has a password
		if ($this->user_control->user->password != "") {
			if ($this->input->post("user_password") !== false && $this->login_security->check($this->input->post("user_password"), $this->user_control->user->password, $this->user_control->user->login_token,$this->user_control->user->hashing_iterations,$userHash)) {
				if ($this->user_control->user->password != $userHash) {
					$this->user_control->user->password = $userHash;
					$this->user_control->user->hashing_iterations = $this->config->item("hashing_iterations");
				}
				if ($this->input->post("user_email") !== false && filter_var($this->input->post("user_email"), FILTER_VALIDATE_EMAIL)) {
					$User->email = $this->input->post("user_email");
				}
				$this->user_control->user->Save();
			}
		}

		if (count($data) > 0) {
			$this->settings->set($this->_User->id,$data);
			$this->api_response->Response = array("status" => "Success");
			$this->api_response->Code = 200; 
		} else {
			$this->api_response->Code = 400;
		}
	}

	/**
	 * This function outputs the current version of CodeIgniter
	 * @since 1.1
	 * @access private
	 */
	private function _Ci_Version () {
		echo CI_VERSION;
		die();
	}

	/**
	 * This function outputs if the installed version is the newest available version of CodeIgniter
	 * @since 1.1
	 * @access private
	 */
	private function _Codeigniter_Version_Check () {
		 $newestVersion = file_get_contents("http://versions.ellislab.com/codeigniter_version.txt");
		 $installedVersion = CI_VERSION;
		 echo ($newestVersion == $installedVersion)? "false" : "true";
		 die();
	}

	/**
	 * This function outputs the newest version of CodeIgniter
	 * @since 1.0
	 * @access private
	 */
	private function _Ci_Version_Remote () {
		echo file_get_contents("http://versions.ellislab.com/codeigniter_version.txt");
		die();
	}
}