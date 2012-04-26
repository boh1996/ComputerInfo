<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Api_Response{

	/**
	 * The HTTP response code to send
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $Code = NULL;

	/**
	 * The format to respond with
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $Format = NULL;

	/**
	 * An error containg the errors to send
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $Errors = NULL;

	/**
	 * The response data to send,
	 * this data will be converted to the response format
	 * @var array|object|string
	 * @since 1.0
	 * @access public
	 */
	public $Response = NULL;

	/**
	 * The JSONP callback function
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $Callback = NULL;

	/**
	 * The data that will be sent to the client
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ResponseString = NULL;

	/**
	 * A variable used to store the data when the response is created
	 * @var array
	 * @since 1.0
	 * @access private
	 */
	private $ResponseData = NULL;

	/**
	 * Extra headers to send
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $Headers = NULL;

	##### Response Header Data #####

	/**
	 * The content language
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $Language = "en";

	/**
	 * An array to store the response data
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ResponseKey = NULL;

	/**
	 * An optional string that explains why an error occured
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ErrorReason = NULL;

	/**
	 * The age of the content
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $Age = "1";

	/**
	 * The time alive of the content
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $Expires = 100;

	/**
	 * How many seconds the content is going to be stored in cache
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $CacheControl = 100;

	/**
	 * The response location, the host of the api
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ContentLocation = NULL;

	/**
	 * The allow origin header
	 * @var string|array
	 * @since 1.0
	 */
	public $AllowOrigin = NULL;

	/**
	 * The HTTP methods to allow
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $Allow = array("POST","GET","PUT","DELETE","HEAD","PATCH","OPTIONS");

	/**
	 * This function is the constructor
	 * @since 1.0
	 * @access public
	 */
	public function Api_Reponse(){}

	/**
	 * This function sends a api response with all the headers and so
	 * @since 1.0
	 * @access public
	 */
	public function Send_Response(){
		if(is_null($Response)){
			$this->Code = 204;
		}
		self::_Create_Response();
		self::_Response_Format();
		self::_Build_Headers();
		self::_Send_Headers();
	}

	/**
	 * This function converts the response data to the appropriate format
	 * @since 1.0
	 * @access private
	 */
	private function _Response_Format(){
		if(!is_null($this->ResponseData)){
			switch ($this->Format) {
				case 'json':
					$this->ResponseString = json_encode($this->ResponseData);
					break;
				
				case "xml":
					$this->ResponseString = array_to_xml($this->ResponseData);
					break;

				case "jsonp" :
					if(is_null($this->Callback)){
						$this->Callback = "callback";
					}
					$this->ResponseString = $this->Callback."(".json_encode($this->ResponseData).")";
					break;
			}
		}
	}

	/**
	 * This function assemblies the response
	 * @since 1.0
	 * @access private
	 * @since 1.0
	 */
	private function _Create_Response(){
		$Response = array();
		if($this->Code == 200){
			if(!is_null($this->ResponseKey)){
				$Response[$this->ResponseKey] = $this->Response;
			} else {
				$Response = $this->Response;
			}
			if(is_array($Response)){
				$Response["error_message"] = NULL;
				$Response["error_code"] = NULL;
			}
		} else {
			$Response["error_message"] = Status_Message($this->Code);
			$Response["error_code"] = $this->Code;
			if(!is_null($this->ErrorReason)){
				$Response["error_reason"] = $this->ErrorReason;
			}
		}
		$this->ResponseData = $Response;
	}

	/**
	 * This function sends all the reponse headers deffined in Headers
	 * @since 1.0
	 * @access private
	 */
	private function _Send_Headers(){
		foreach ($this->Headers as $Header => $Value) {
			if($Headers != "" && !is_integer($Headers)){
				header($Headers.": ".$Value);
			} else {
				header($Value);
			}
		}
	}

	/**
	 * The function gets the mime type based on the response format
	 * @since 1.0
	 * @access private
	 * @return string
	 */
	private function _Get_Mime(){
		$Mimes = array(
			"json" => "application/json",
			"xml" => "application/xml",
			"jsonp" => "application/json"
		);
		return (isset($Mimes[$this->Format]))? $Mimes[$this->Format] : $Mimes["json"];
	}

	/**
	 * This function inserts the standard headers to the Headers array
	 * @since 1.0
	 * @access public
	 */
	private function _Build_Headers(){
		$Headers = array();
		$Headers[""] = 'HTTP/1.1 ' . $Code . ' ' . Status_Message($this->Code);
		$Headers["Content-Language"] = $this->Language;
		$Headers["Age"] = $this->Age;
		$Headers["Expires"] = $this->Expires;
		$Headers["Cache-Control"] = $this->CacheControl;
		if(!is_null($this->ContentLocation)){
			$Headers["Content-Location"] = $this->ContentLocation;
		}
		$Headers["Date"] = time();
		if(!is_null($this->AllowOrigin)){
			if(is_array($this->AllowOrigin)){
				$Headers["Access-Control-Allow-Origin"] = implode(",", $this->AllowOrigin);
			} else {
				$Headers["Access-Control-Allow-Origin"] = $this->AllowOrigin;
			}
		}
		$Headers["Allow"] = implode(",", $this->Allow);
		if(!is_null($this->ResponseString)){
			$Headers["Content-type"] = self::_Get_Mime();
			$Headers["Content-MD5"] = md5($this->ResponseString);
			$Headers["Content-Length"] = strlen($this->ResponseString);
		}
	}
}