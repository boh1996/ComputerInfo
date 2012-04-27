<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Api_Request{

	/**
	 * The HTTP response codes
	 * @var array
	 * @since 1.0
	 * @access private
	 */
	private $_Codes = NULL;

	/**
	 * A local instance of CodeIgniter
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_CI = NULL;

	/**
	 * The response format json or xml
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_Format = NULL;

	/**
	 * The request format
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_Request_Format = NULL;

	/**
	 * The request methos "get","post","put" or "delete"
	 * @var string
	 * @access private
	 * @since 1.0
	 */
	private $_Request_Method = NULL;

	/**
	 * This property will contain the json_decode data from the request vars
	 * @var array
	 * @since 1.0
	 * @access private
	 */
	private $_Request_Data = NULL;

	/**
	 * The "post","get","put" or "delete" data
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	private $_Request_Vars = NULL;

	/**
	 * This function sets the HTTP error codes
	 * @access private
	 * @since 1.0
	 */
	private function Set_Codes(){
		$this->_Codes = array(
		    100 => 'Continue',
		    101 => 'Switching Protocols',
		    200 => 'OK',
		    201 => 'Created',
		    202 => 'Accepted',
		    203 => 'Non-Authoritative Information',
		    204 => 'No Content',
		    205 => 'Reset Content',
		    206 => 'Partial Content',
		    300 => 'Multiple Choices',
		    301 => 'Moved Permanently',
		    302 => 'Found',
		    303 => 'See Other',
		    304 => 'Not Modified',
		    305 => 'Use Proxy',
		    306 => '(Unused)',
		    307 => 'Temporary Redirect',
		    400 => 'Bad Request',
		    401 => 'Unauthorized',
		    402 => 'Payment Required',
		    403 => 'Forbidden',
		    404 => 'Not Found',
		    405 => 'Method Not Allowed',
		    406 => 'Not Acceptable',
		    407 => 'Proxy Authentication Required',
		    408 => 'Request Timeout',
		    409 => 'Conflict',
		    410 => 'Gone',
		    411 => 'Length Required',
		    412 => 'Precondition Failed',
		    413 => 'Request Entity Too Large',
		    414 => 'Request-URI Too Long',
		    415 => 'Unsupported Media Type',
		    416 => 'Requested Range Not Satisfiable',
		    417 => 'Expectation Failed',
		    418 => "I'm a teapot",
		    500 => 'Internal Server Error',
		    501 => 'Not Implemented',
		    502 => 'Bad Gateway',
		    503 => 'Service Unavailable',
		    504 => 'Gateway Timeout',
		    505 => 'HTTP Version Not Supported'
		);
	}

	/**
	 * This function converts a format to a content type
	 * @param string $Format The format to convert
	 * @return string The content type
	 * @since 1.0
	 * @access public
	 */
	public function Content_Type($Format = NULL){
		if(!is_null($Format)){
			$Formats = array(
				"xml" => "application/xml",
				"json" => "application/json"
			);
			if(array_key_exists(strtolower($Format), $Formats)){
				return $Formats[$Format];
			} else {
				return $Format;;				
			}
		} else {
			return "application/json";
		}
	}

	/**
	 * This function get's a response message of a HTTP code
	 * @param integer $Code The code to get the message of
	 * @return string The http response message
	 * @access public
	 * @since 1.0
	 */
	public function Get_Message($Code = NULL){
		if(is_null($Code)){
			$Code = 400;
		}
		return $this->_Codes[$Code];
	}

	/**
	 * This function is the constructor,
	 * it handles all the request data
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		self::Set_Codes();
		$this->_CI =& get_instance();
		$this->_CI->load->helper("array_xml");
		if(!isset($_GET["format"])){
			$this->_Format = (strpos($_SERVER['HTTP_ACCEPT'], 'xml')) ? 'xml' : 'json';
		} else {
			$Formats = array("xml","json");
			if(in_array($_GET["format"], $Formats)){
				$this->_Format = $_GET["format"];
			} else {
				$this->_Format = "json";
			}
		}
		if(!isset($_GET["method"])){
			$this->_Request_Method = (strtolower($_SERVER['REQUEST_METHOD'])) ? strtolower($_SERVER['REQUEST_METHOD']) : "get"; 
		} else {
			$this->_Request_Method = $_GET["method"];
		}
		$this->_Request_Vars = array(); 
		if(isset($_SERVER["CONTENT_TYPE"])){
			$this->_Request_Format = (strpos($_SERVER["CONTENT_TYPE"], 'xml')) ? 'xml' : 'json';
		} else {
			$this->_Request_Format = "json";
		}
	}

	/**
	 * This function gets the request data
	 * @access public
	 * @since 1.0
	 */
	public function Perform_Request(){
		switch ($this->_Request_Method)
		{
			case 'get':
				$this->_Request_Vars = $_GET;
				break;
			case 'post':
				if(isset($GLOBALS["HTTP_RAW_POST_DATA"])){
					$this->_Request_Vars = $GLOBALS["HTTP_RAW_POST_DATA"];
				}
				break;
			case 'put':
				parse_str(file_get_contents('php://input', $this->_Request_Vars));
				break;
			case 'delete':
				parse_str(file_get_contents('php://input'), $this->_Request_Vars);
				break;
			case 'head':
				ob_start();
				header("Content-type: ".$this->_Format);
		       	header('Allow: ' . implode(", ", array("POST","GET","PUT","DELETE","HEAD","PATCH","OPTIONS")), true, 200);
		       	header("Date:".time());
		       	header("X-Powered-By: PHP/5.2.0");
		       	header("X-UA-Compatible: IE=EmulateIE7 X-UA-Compatible: IE=edge X-UA-Compatible: Chrome=1");
		       	header("X-Forwarded-Proto: http");
		       	header("X-XSS-Protection: 1; mode=block");
		       	header("Retry-After: 120");
		       	header("Content-MD5:".md5(ob_get_contents()));
				header("Content-Length:".ob_get_length());
				break;
			case 'options':
				break;
			case 'patch':
				parse_str(file_get_contents('php://input', $this->_Request_Vars));
				break;
			default:
				header("Content-type:application/json");
		       	header('Allow: ' . json_encode(array("POST","GET","PUT","DELETE","HEAD","PATCH","OPTIONS")), true, 200);
		        break;
		}
		if($this->_Request_Method == "put" || $this->_Request_Method == "post" || $this->_Request_Method == "patch"){
			if($this->_Request_Format == "xml"){
				self::Request_Data(object_to_array(simplexml_load_string($this->_Request_Vars)));
			} else {
				if(is_string(self::Request_Data())){
					self::Request_Data(json_decode($this->_Request_Vars,true));
				}
			}
			if(is_null($this->_Request_Data) && $this->_Request_Method == "post"){
				$this->_Request_Data = $_POST;
			}
		} else {
			$this->_Request_Data = $this->_Request_Vars;
		}
	}

	/**
	 * This function gets or sets the response format
	 * @param string $Format The new response format
	 * @return string If the $Format parameter isn't set then, the response format is returned
	 * @since 1.0
	 * @access public
	 */
	public function Format($Format = NULL){
		if(!is_null($Format)){
			$this->_Format = $Format;
		} else {
			return $this->_Format;
		}
	}

	/**
	 * This function gets or sets the request format
	 * @param string $Format The new request format
	 * @return string If the request format is set then the format is returned
	 * @since 1.0
	 * @access public
	 */
	public function Request_Format($Format = NULL){
		if(!is_null($Format)){
			$this->_Request_Format = $Format;
		} else {
			return $this->_Request_Format;
		}
	}

	/**
	 * This function gets or sets the request method
	 * @param string $Request_Method The new request method
	 * @since 1.0
	 * @return string The request method
	 * @access public
	 */
	public function Request_Method($Request_Method = NULL){
		if(!is_null($Request_Method)){
			$this->_Request_Method = $Request_Method;
		} else {
			return $this->_Request_Method;
		}
	}

	/**
	 * This function is used to add data to the request vars, property
	 * @param string $Name  The name of the key
	 * @access public
	 * @since 1.0
	 * @param string $Value The value of the request var
	 */
	public function Add_Request_Var($Name = NULL,$Value = NULL){
		if(!is_null($Name) && !is_null($Value)){
			$this->Request_Vars[$Name] = $Value; 
		}			
	}

	/**
	 * This function gets or sets the Request data parameter
	 * @param arrat $Request_Data The new request data
	 * @since 1.0
	 * @return array The request data
	 * @access public
	 */
	public function Request_Data($Request_Data = NULL){
		if(!is_null($Request_Data)){
			$this->_Request_Data = $Request_Data;
		} else {
			return $this->_Request_Data;
		}
	}

	/**
	 * This function gets or sets the $Request_Vars parameters
	 * @param array $Request_Vars The new $Request_Vars data
	 * @return array If the $Request_Vars parameter isn't set then the data is returned
	 * @since 1.0
	 * @access public
	 */
	public function Request_Vars($Request_Vars = NULL){
		if(!is_null($Request_Vars)){
			$this->_Request_Vars = $Request_Vars;
		} else {
			return $this->_Request_Vars;
		}
	}
}
?>