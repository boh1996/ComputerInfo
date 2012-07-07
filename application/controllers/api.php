<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller {

	/**
	 * The user that owns the access token
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_User = NULL;

	/**
	 * This function recives all the calls when a page is requested
	 * @param string $method The internal method to call to perform the response
	 * @param array $params Some extra parameters
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL, $params = NULL)
	{	
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
	    	if(self::_Authenticate()){
	    		return call_user_func_array(array($this, $method), $params);
	    	} else {
	    		$this->api_response->Code = 403;
	    		exit;
	    	}
	    }
	    //show_404();
	}

	/**
	 * This function checks if the specified token exist and the user is valid
	 * @since 1.0
	 * @access private
	 */
	private function _Authenticate(){
		$this->load->library("User");
	    $this->_User = new User();
	  	if($this->_User->Load(1)){
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
					$this->api_response->Response = $Computer->Export();
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

			case "location" :
				if (isset($_GET["organization"]) && in_array($_GET["organization"], self::_Get_User_Organizations())) {
					self::_Get_Locations($_GET["organization"]);
				} else {
					$this->api_response->Code = 400;
				}
				break;

			default:
				$this->api_response->Code = 400;
				break;
		}
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
			if (!isset($data["q"])) {
				$data["q"] = $Type->id;
			}
			if (is_string($device_type)) {
				$Type->Find(array("name" => $device_type));
			} else {
				$Type->Load($device_type);
			}
			if (isset($data["fields"])) {
				$data["fields"] = $data["fields"].",type";
			} else {
				$data["fields"] = "type";
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
			$this->load->library("Computer");
			$Computer = new Computer();
			if(in_array($Id, self::_Get_User_Organizations())){
				$Data = array("q" => $Id,"fields" => "organization");
				$this->api_request->Request_Data($Data);
				self::_Simple_Search("Computer");
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
			$this->load->library("Device");
			$Device = new Device();
			if(in_array($Id, self::_Get_User_Organizations())){
				$Data = array("q" => $Id,"fields" => "organization");
				$this->api_request->Request_Data($Data);
				self::_Simple_Search("Device");
			} else {
				$this->api_response->Code = 401;
			}
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
			$this->load->library("Printer");
			$Printer = new Printer();
			if(in_array($Id, self::_Get_User_Organizations())){
				$Data = array("q" => $Id,"fields" => "organization");
				$this->api_request->Request_Data($Data);
				self::_Simple_Search("Printer");
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
			$this->load->library("Screen");
			$Screen = new Screen();
			if(in_array($Id, self::_Get_User_Organizations())){
				$Data = array("q" => $Id,"fields" => "organization");
				$this->api_request->Request_Data($Data);
				self::_Simple_Search("Screen");
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
			$this->load->library("Location");
			$Location = new Location();
			if(in_array($Id, self::_Get_User_Organizations())){
				$Data = array("q" => $Id,"fields" => "organization");
				$this->api_request->Request_Data($Data);
				self::_Simple_Search("Location");
			} else {
				$this->api_response->Code = 401;
			}
		}
	}

	/**
	 * This function performs the PATCH and PUT request
	 * @param integer  $Id        The id of the computer to update
	 * @param boolean $Overwrite If the request is PATCH, "false" or PUT, "true"
	 * @since 1.0
	 * @access private
	 */
	private function _Computer_Update($Id = NULL,$Overwrite = false){
		if($this->api_request->Request_Data() != NULL and $this->api_request->Request_Data() != "" and count($this->api_request->Request_Data()) > 0){
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
			$Computer->Import($Request_Data,$Overwrite,true);
			if(!is_null($Computer->organization)){
				if(!self::_Has_Access("organizations",$this->_User,$Computer->organization)){
					$this->api_response->Code = 401;
					return;
				}
			} else {
				$this->api_response->Code = 400;
				return;
			}
			$Computer->last_updated = time();
			if($Computer->Save()){
				$this->api_response->Response = array();
				$this->api_response->Code = 200;
			} else {
				$this->api_response->Code = 409;
			}
		} else {
			$this->api_response->Code = 400;
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

			//Loop through the fields that the requester reqeusts or use all fields
			if(isset($Request_Data["fields"])){
				$Fields = explode(",",$Request_Data["fields"]);
			} else {
				$Fields = array_keys($Object->Export(null,false));
			}

			//Build the query
			$InputQuery = array();
			foreach ($Fields as $Field) {
				$InputQuery[$Field] = $Request_Data["q"];
				if (isset($Request_Data[$Field])) {
					$InputQuery[$Field] = $Request_Data[$Field];
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
			if(count($Query) > 0){
				//Assemble thw query
				$this->db->or_like($Query,"after")->select("id")->group_by("id");

				//If the organization row isset use it
				if(!is_null($Organization_Id_Row)){
					$this->db->where_in($Organization_Id_Row,$Organizations);
				}

				//Get the database raw data
				$Raw = $this->db->get($Object->Database_Table);

				return $Raw;
			} else {
				$this->api_response->Code = 400;
			}
		}
	}

	/**
	 * This function creates a array containing all the users organizations
	 * @since 1.0
	 * @access private
	 * @return array
	 */
	private function _Get_User_Organizations(){
		$Organizations = array();
		if(!is_null($this->_User->organizations) && is_array($this->_User->organizations)){
			foreach ($this->_User->organizations as $Organization) {
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
		} else if(!is_null($this->_User->organizations) && is_integer($this->_User->organizations)){
			$Organizations[] = (int)$this->_User->organizations;
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
	private function _Computer_Search(){
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
	 * This function checks if the user has access to watch that content
	 * @param string $Node   The node where to check for a "organization" id etc
	 * @param object $Object The object to check in
	 * @param integer $Id     The id to check for
	 * @return boolean
	 * @since 1.0
	 * @access private
	 */
	private function _Has_Access($Node = NULL,$Object = NULL,$Id = NULL){
		if(is_object($Object) && property_exists($Object, "id")){
			$Id = (int)$Object->id;
		} else {
			return FALSE;
		}
		if(!is_null($Node) && is_string($Node) && !is_null($Object) && is_object($Object) && !is_null($Id) && is_integer($Id) && property_exists($Object, $Node)){
			if(is_array($Object->{$Node})){
				$Return = FALSE;
				foreach ($Object->{$Node} as $Element) {
					if(is_object($Element)){
						if(property_exists($Element, "id") && $Element->id == $Id){
							$Return = TRUE;
						}
					} else {
						if($Element === $Id){
							$Return = TRUE;
						}
					}
				}
				return $Return;
			} else {
				if(is_object($Object->{$Node})){
					if(property_exists($Object->{$Node}, "id")){
						return ($Object->{$Node}->id === $Id);
					} else {
						return FALSE;
					}
				} else {
					return ($Object->{$Node} === $Id);
				}
			}
		} else {
			return FALSE;
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
				$this->api_response->Code = 400;
				return;
			}
			//Ensure that all the parameters are right
			$Computer->created_time = time();
			$Computer->last_updated = time();
			if($Computer->Save()){
				$this->api_response->Code = 200;
				$this->api_response->Response = array("id" => $Computer->id);
			} else {
				$this->api_response->Code = 409;
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
				$this->api_response->Code = 400;
				return;
			}
			$Printer->created_time = time();
			$Printer->last_updated = time();
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
			$Printer->last_updated = time();
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
				$this->api_response->Code = 400;
				return;
			}
			$Device->created_time = time();
			$Device->last_updated = time();
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
			$Device->last_updated = time();
			if($Device->Save()){
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
			if(isset($Request_Data["q"]) && is_array($this->api_request->Request_Data()) && count($this->api_request->Request_Data()) > 0 && ($this->api_request->Request_Method() === "post" || "get")){				
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
						$Response[] = $Object->Export();
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
						$Response[] = $Object->Export();
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
}