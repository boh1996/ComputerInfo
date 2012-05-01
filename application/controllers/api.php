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
	    	}
	    }
	    show_404();
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
					$this->api_response->Response = $Computer->Export(false);
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
	 * @since 1.0
	 * @access private
	 * @return array
	 */
	private function _Search_Build_Query($Object = NULL){
		if(!is_null($Object)){
			$Request_Data = $this->api_request->Request_Data();

			//Loop through the fields that the requester reqeusts or use all fields
			if(isset($Request_Data["fields"])){
				$Fields = explode(",",$Request_Data["fields"]);
			} else {
				$Fields = array_keys($Object->Export(false,true));
			}

			//Build the query
			$InputQuery = array();
			foreach ($Fields as $Field) {
				$InputQuery[$Field] = $Request_Data["q"];
			}

			$Organizations = self::_Get_User_Organizations();
			if(is_null($Organizations)){
				$this->api_response->Code = 401;
				return;
			}

			//If the object has an organization row use it
			$Organization_Id_Row = self::_Convert(array("organization" => "1"),$Object);
			if(count($Organization_Id_Row) > 9){
				$Organization_Id_Row = key($Organization_Id_Row);
			} else {
				$Organization_Id_Row = NULL;
			}

			//Build the query array
			$Secure = $Object->Export(false,true);
			$Query = self::_Convert($InputQuery,$Object,$Secure,$Fields);
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
					$Response[] = $Object->Export(false,true);
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
		if(is_object($Id) && property_exists($Id, "id")){
			$Id = (int)$Id->id;
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
				$this->api_response->Response = $ComputerModel->Export(false,true);
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
					$this->api_response->Response = $Device->Export(false,true);
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
				$this->api_response->Response = $Cpu->Export(false,true);
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
				$this->api_response->Response = $DeviceModel->Export(false,true);
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
				$this->api_response->Response = $Manufaturer->Export(false,true);
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
					$this->api_response->Response = $Printer->Export(false,true);
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
				$this->api_response->Response = $PrinterModel->Export(false,true);
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
	 * @since 1.0
	 * @access private
	 */
	private function _Simple_Search($Key = NULL,$Library = NULL){
		if(!is_null($Key)){
			if(is_null($Library)){
				$Library = $Key;
			}

			if(substr($Key, -1) !== "s"){
				$ResponseKey = $Key."s";
			} else {
				$ResponseKey = $Key;
			}
			$Request_Data = $this->api_request->Request_Data();
			if(isset($Request_Data["q"]) && is_array($this->api_request->Request_Data()) && count($this->api_request->Request_Data()) > 0 && ($this->api_request->Request_Method() === "post" || "get")){		
				$this->load->library($Library);
				$this->api_response->ResponseKey = $ResponseKey;
				$Class = new $Library();			

				//Get the response
				$Raw = self::_Search_Build_Query($Class);
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
						$Response[] = $Object->Export(false,true);
					}
					$this->api_response->Response = $Response;
					$this->api_response->Code = 200;
				} else {
					$this->api_response->Code = 404;
				}
			} else {
				$this->api_response->Code = 400;
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