<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * This class is used to authenticate with google
 * @package OAuth
 * @license http://illution.dk/copyright © Illution 2012
 * @subpackage Google
 * @category Login
 * @version 1.0
 * @author Illution <support@illution.dk>
 */ 
class Google{

	/**
	 * An internal pointer to CodeIgniter
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_CI = NULL;

	/**
	 * The google OAuth 2.0 url
	 * @var string
	 * @access private
	 * @since 1.0
	 */
	private $_api_url = "https://accounts.google.com/o/oauth2/";

	/**
	 * The url to be imploded in the scope parameter
	 * @var string
	 * @access private
	 * @since 1.0
	 */
	private $_scope_url = "https://www.googleapis.com/auth/";

	/**
	 * The url to the google account information endpoint
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_account_url = "https://www.googleapis.com/oauth2/v1/userinfo";

	/**
	 * The response type "code" or "token"
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_response_type = "code";

	/**
	 * This property stores the life time of the token
	 * @var integer
	 * @since 1.0
	 * @access private
	 */
	private $_expires_in = NULL;

	/**
	 * The authentication code
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_code = NULL;

	/**
	 * The client id for the google api
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_client_id = NULL;

	/**
	 * The google api key
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_api_key = NULL;

	/**
	 * The google api secret
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_client_secret = NULL;

	/**
	 * The client public api key
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_client_public = NULL;

	/**
	 * The refresh token for the apo
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_refresh_token = NULL;

	/**
	 * The requested scopes
	 * The scopes are "drive.file","userinfo.email" and "userinfo.profile"
	 * @var array
	 * @since 1.0
	 * @access private
	 */
	private $_scope = array();

	/**
	 * An optional state string
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_state = NULL;

	/**
	 * The url to redirect the user back too
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_redirect_uri = NULL;

	/**
	 * The access type for the response token/code
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_access_type = "online";

	/**
	 * The access token gotten from the api
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_access_token = NULL;

	/**
	 * If the user is going to be promted every time
	 * values are "auto" or "force"
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_approval_prompt = "auto";

	/**
	 * The response token type Bearer or OAuth
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_token_type = "NULL";

	/**
	 * The refresh token for the api
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_token = NULL;	

	/**
	 * The return token type
	 * @var string
	 * @since 1.0
	 * @access private
	 */
	private $_grant_type = "authorization_code";

	public function Google(){
		$this->_CI =& get_instance();
	}

	/**
	 * The parameters to set
	 * @param  array $parameters An array of parameters to set
	 * @return boolean
	 * @since 1.0
	 * @access public
	 */
	public function parameters($parameters = NULL){
		if(!is_null($parameters) && is_array($parameters)){
			foreach ($parameters as $key => $value) {
				if(property_exists($this, "_".$key)){
					if($key != "scope"){
						$key = "_".$key;
						$this->{$key} = $value;
					} else {
						self::scopes($value);
					}
				}
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function sets or gets the approval_prompt value
	 * @param  string $approval_prompt The approval promt typr "auto" or "force"
	 * @return string
	 * @since 1.0
	 * @access public
	 */
	public function approval_prompt($approval_prompt = NULL){
		if(!is_null($approval_prompt)){
			$this->_approval_prompt = $approval_prompt;
		} else {
			return $this->_approval_prompt;
		}
	}

	/**
	 * This function gets or set the access token
	 * @param  string $access_token The new access token
	 * @return string
	 * @since 1.0
	 * @access public
	 */
	public function access_token($access_token = NULL){
		if(!is_null($access_token)){
			$this->_access_token = $access_token;
		} else {
			return $this->_access_token;
		}
	}

	/**
	 * This function is used to set the access type
	 * @param  string $access_type "online" or "offline"
	 * @since 1.0
	 * @access public
	 */
	public function access_type($access_type = NULL){
		if(!is_null($access_type)){
			$this->_access_type = $access_type;
		} else {
			return $this->_access_type;
		}
	}

	/**
	 * This function is used to set the redirect url
	 * @param  string $redirect_uri The redirect url
	 * @since 1.0
	 * @access public
	 */
	public function redirect_uri($redirect_uri = NULL){
		if(!is_null($redirect_uri)){
			$this->_redirect_uri = $redirect_uri;
		} else {
			return $this->_redirect_uri;
		}
	}

	/**
	 * This function is used to add scopes
	 * @param  array $scopes The requested api scopes
	 * @since 1.0
	 * @access public
	 */
	public function scopes($scopes = NULL){
		if(!is_null($scopes)){
			foreach ($scopes as $scope) {
				$this->_scope[] = $this->_scope_url.$scope;
			}
		}
	}

	/**
	 * This function returns the token type
	 * @return string
	 * @since 1.0
	 * @access public
	 */
	public function token_type(){
		return $this->_token_type;
	}

	/**
	 * This function sets or gets the refresh token
	 * @param  string $refresh_token The new refresh token
	 * @return string
	 * @since 1.0
	 * @access private
	 */
	public function refresh_token($refresh_token = NULL){
		if(!is_null($refresh_token)){
			$this->_refresh_token = $refresh_token;
			$this->_token = $refresh_token;
		} else {
			if(!is_null($this->_refresh_token)){
				return $this->_refresh_token;
			} else {
				return $this->_token;
			}
		}
	}

	/**
	 * This function validates if the
	 * @param  array $parameters The parameters to check
	 * @return boolean
	 */
	private function _check_parameters($parameters = NULL){
		if(!is_null($parameters) && is_array($parameters)){
			$return = true;
			foreach ($parameters as $key) {
				$key = "_".$key;
				if(!property_exists($this, $key) && is_null($key)){
					$return = false;
				}
			}
			return $return;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function is used to set the api client id.
	 * If no parameters are set the the data is loaded from the config file google.
	 * @param  string $client_id The google api client id
	 * @param string $client_secret The google api secret
	 * @param string $client_public The public client api key
	 * @param string $api_key The google api key
	 * @since 1.0
	 * @access public
	 */
	public function client($client_id = NULL,$client_secret = NULL,$client_public = NULL,$api_key = NULL){
		$this->_CI->load->config("google");
		if(!is_null($client_id)){
			$this->_client_id = $client_id;
		} else {
			if(is_string($this->_CI->config->item("google_client_id"))){
				$this->_client_id = $this->_CI->config->item("google_client_id");
			}
		}
		if(!is_null($client_secret)){
			$this->_client_secret = $client_secret;
		} else {
			if(is_string($this->_CI->config->item("google_client_secret"))){
				$this->_client_secret = $this->_CI->config->item("google_client_secret");
			}
		}
		if(!is_null($client_public)){
			$this->_client_public = $client_public;
		} else {
			if(is_string($this->_CI->config->item("google_client_public"))){
				$this->_client_public = $this->_CI->config->item("google_client_public");
			}
		}
		if(!is_null($api_key)){
			$this->_api_key = $api_key;
		} else {
			if(is_string($this->_CI->config->item("google_api_key"))){
				$this->_api_key =$this->_CI->config->item("google_api_key");
			}
		}
	}

	/**
	 * This function builds a url based on the method and parameters
	 * @param  string $method     The api method "auth" etc
	 * @param  array $parameters The parameters to use
	 * @return boolean|string
	 * @since 1.0
	 * @access private
	 */
	private function _build_url($method = "auth",$parameters = NULL){
		if(!is_null($parameters) && is_array($parameters)){
			$url = $this->_api_url.$method."?";
			$request_string = self::_build_request_string($parameters);
			if($request_string !== false){
				$url .= $request_string;
				return $url;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function builds the request string
	 * @param  array $parameters The properties to use
	 * @return string
	 * @since 1.0
	 * @access private
	 */
	private function _build_request_string($parameters = NULL){
		if(!is_null($parameters) && is_array($parameters)){
			$url = "";
			foreach ($parameters as $key) {
				$property = "_".$key;
				if(property_exists($this,$property) && !is_null($this->{$property})){
					if(is_array($this->{$property})){
						$url .= $key."=".implode(" ", $this->{$property})."&";
					} else {
						$url .= $key."=".$this->{$property}."&";
					}
				}
			}
			$url = rtrim($url,"&");
			return $url;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function redirects the user to the auth url,
	 * use parameters and scopes to set the parameters
	 * @return boolean
	 */
	public function auth(){
		if(self::_check_parameters(array("client_id","scope","response_type","redirect_uri"))){
			$request_url = self::_build_url("auth",array("client_id","scope","response_type","redirect_uri","access_type","approval_prompt"));
			header("Location: ".$request_url);
			return TRUE;
		} else {
			return false;
		}
	}

	/**
	 * This function handles the auth response
	 * @return boolean
	 * @since 1.0
	 * @access public
	 */
	public function callback(){
		if(isset($_GET["code"])){
			$this->_code = $_GET["code"];
			$url = $this->_api_url."token";
			if(self::_check_parameters(array("code","client_id","client_secret","redirect_uri","grant_type"))){
				$fields = array("code","client_id","client_secret","redirect_uri","grant_type");
			} else {
				return FALSE;
			}
		} else if(!is_null($this->_refresh_token)){
			$this->_grant_type = "refresh_token";
			if(self::_check_parameters(array("refresh_token","client_id","client_secret","grant_type"))){

				$fields = array("code","client_id","client_secret","redirect_uri","grant_type");
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
		$request_string = self::_build_request_string($fields);
		$ch = curl_init();

		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$request_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		$data = json_decode($result);
		print_r($data);
	
		curl_close($ch);
		if(!isset($data->error)){
			self::_set_data($data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * This function sets properties based on a response object
	 * @param object$data The response object
	 * @since 1.0
	 * @access private
	 */
	private function _set_data($data = NULL){
		if(!is_null($data)){
			foreach (get_object_vars($data) as $key => $value) {
				if(property_exists($this, "_".$key)){
					$property = "_".$key;
					$this->{$property} = $value;
				}
			}
		}
	}

	/**
	 * This function revokes an refresh token set in _token
	 * @param  string $refresh_token the refresh token to revoke
	 * @since 1.0
	 * @access public
	 * @return boolean
	 */
	public function revoke($refresh_token = NULL){
		if(!is_null($refresh_token)){
					$this->_token = $refresh_token;
		}
		if(!is_null($this->_token)){
			$ch = curl_init();

			$url = self::_build_url("revoke",array("token"));

			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$result = curl_exec($ch);

			curl_close($ch);
		} else {
			return FALSE;
		}
	}

	/**
	 * This function returns the json decoded data from 
	 * the account information api
	 * @return object|boolean
	 * @since 1.0
	 * @access public
	 */
	public function account_data(){
		if(self::_check_parameters(array("access_token","auth"))){
			$url = $this->_account_url;

			$ch = curl_init();

			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Authorization: OAuth ".$this->_access_token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$result = curl_exec($ch);

			$data = json_decode($result);

			curl_close($ch);
			if(!isset($data->error)){
				return $data;
			} else {
				return FALSE;
			}
		}
	}
}