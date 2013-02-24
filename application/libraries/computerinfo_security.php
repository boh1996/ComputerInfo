<?php
class Computerinfo_Security{

	/**
	 * A pointer to the current instance of CodeIgniter
	 * @var object
	 * @since 1.1
	 * @access private
	 */
	private $_CI = NULL;

	/**
	 * This function calls all the needed security functions
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		$this->_CI =& get_instance();
		$this->_CI->load->config("settings");
		if(($this->_CI->config->item("login_off") !== true && $this->_CI->config->item("dev_mode") == true) || ( $this->_CI->config->item("login_off") != true)){
			session_start();
			$this->_CI->load->config("api");
			self::_Is_Logged_In();
		}
	}

	/**
	 * This function returns if the current page requires security
	 * @since 1.1
	 * @access private
	 * @return booelan
	 */
	private function _RequiresSecurity () {
		$this->_CI->load->helper("array_data");
		$pass = $this->_CI->config->item("non_security");
		$segments = $this->_CI->uri->rsegment_array();
		foreach ($pass as $page => $in_array) {
			$use_in_array = FALSE;
			if (is_bool($in_array)) {
				$use_in_array = $in_array;
			} else {	
				$page = $in_array;
			}
			if ($use_in_array) {
				if (in_array($page, $segments)) {
					return FALSE;
				}
			} else {
				if (isset($segments) && @array_position($segments,0) != null && @array_position($segments,0) != false &&  strtolower(current(@array_position($segments,0))) == strtolower($page)) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	/**
	 * This function checks if the user is logged in and exists else the user is redirected to login
	 * @since 1.0
	 * @access private
	 */
	private function _Is_Logged_In(){
		if ($this->_CI->config->item("dev_mode") == true && $this->_CI->config->item("login_off") == true) {
			return;
		}

		$Result = self::_RequiresSecurity();

		if($Result && !isset($_SESSION[$this->_CI->config->item("user_id_session")])){
			self::Logout();
			redirect($this->_CI->config->item("not_logged_in_page"));
			return;
		} else if(isset($_SESSION[$this->_CI->config->item("user_id_session")]) && !self::User_Exists($_SESSION[$this->_CI->config->item("user_id_session")])){
			self::Logout();
			redirect($this->_CI->config->item("not_logged_in_page"));
			return;		
		}

		if (!$Result) {
			return;
		}

		if (isset($_SESSION[$this->_CI->config->item("user_id_session")])) {
			if (!self::VerifyToken()) {
				self::Logout();
				redirect($this->_CI->config->item("not_logged_in_page"));	
				return;
			}
		} else {
			self::Logout();
		}
	}

	/**
	 * This function verifies that the token is correct and has time left,
	 * if no time is left a new token is created
	 * @since 1.1
	 * @access public
	 */
	public function VerifyToken () {
		$this->_CI->load->library("token");
		$Token = new Token();
		if (isset($_SESSION[$this->_CI->config->item("user_id_session")]) && self::User_Exists($_SESSION[$this->_CI->config->item("user_id_session")])) {
			if (isset($_COOKIE["token"]) && $Token->Load(array("token" => $_COOKIE["token"])) && !is_null($Token->token) && $Token->user->id == $_SESSION[$this->_CI->config->item("user_id_session")]) {
				if (!$Token->IsValid()) {
					$this->_CI->load->library("user");
					$User = new User();
					$User->Load($_SESSION[$this->_CI->config->item("user_id_session")]);
					self::CreateToken($User);
					return TRUE;
				} else {
					return TRUE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates a new token for a user
	 * @since 1.1
	 * @access public
	 * @param object $User The user object
	 */
	public function CreateToken ($User) {
		$this->_CI->load->library("token");
		$Token = new Token();
		$Token->Create($User->id);
		$this->_CI->load->helper("cookie");
		set_cookie("token",$Token->token,$Token->time_to_live);
	}

	/**
	 * This function checks if a user exists, by that id
	 * @param integer $Id The users id
	 * @since 1.0
	 * @access public
	 * @return boolean
	 */
	public function User_Exists($Id = NULL){
		if(!is_null($Id)){
			$Query = $this->_CI->db->select("id")->where(array("id" => $Id))->get($this->_CI->config->item("api_users_table"));
			return ($Query->num_rows() > 0);
		} else {
			return FALSE;
		}
	}

	/**
	 * This function destroys all session data
	 * @since 1.1
	 * @access public
	 */
	public function Logout () {
		$this->_CI->load->helper("cookie");
		if (isset($_SESSION[$this->_CI->config->item("user_id_session")])) {
			unset($_SESSION[$this->_CI->config->item("user_id_session")]);
		}
		session_destroy();
		delete_cookie($this->_CI->config->item("session_id_cookie"));
		delete_cookie("token");
	}

	/**
	 * This function checks if http should be enabled
	 * @since 1.0
	 * @access public
	 */
	public function CheckHTTPS ($url) {
		$url = str_replace("http://", "", $url);
		$url = str_replace("https://","", $url);
		return ($this->_CI->config->item("https") == true) ? "https://" . $url:  "http://" . $url;
	}

	/**
	 * This function can merge Víew data and Standard view data
	 * @since 1.0
	 * @access public
	 * @param array $params The view data
	 * @return array
	 */
	public function ControllerInfo ($params = null) {
		$settings = array(
			"base_url" => $this->Proxy(""),
			"asset_url" => $this->Proxy($this->_CI->config->item("asset_url")),
			"jquery_url" => $this->_CI->config->item("jquery_url"),
			"jqueryui_version" => $this->_CI->config->item("jqueryui_version"),
			"dev_mode" => $this->_CI->config->item("dev_mode")
		);
		if (!is_null($params)) {
			return array_unique(array_merge($params, $settings));
		} else {
			return array_unique($settings);
		}
	}

	/**
	 * This function replaces the base_url with a proxy url if set
	 * @since 1.0
	 * @access public
	 * @param string $url The url to check proxy for
	 */
	public function Proxy ( $url ) {
		if ( isset($_SERVER["HTTP_X_FORWARDED_HOST"]) ) {
			if ( array_key_exists($_SERVER["HTTP_X_FORWARDED_HOST"], $this->_CI->config->item("proxy_host_base_urls")) ) {
				$proxies = $this->_CI->config->item("proxy_host_base_urls");
				$proxy = $proxies[$_SERVER["HTTP_X_FORWARDED_HOST"]];
			} else {
				$proxy = $_SERVER["HTTP_X_FORWARDED_HOST"]."/";
			}
			return self::CheckHTTPS($proxy.$url);
		} else {
			return self::CheckHTTPS(base_url().$url);
		}
	}
}
?>