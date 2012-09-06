<?php
class Computerinfo_Security{

	/**
	 * A pointer to the current instance of CodeIgniter
	 * @var object
	 * @since 1.0
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
		
		if($Result && !isset($_SESSION["user_id"])){
			redirect($this->_CI->config->item("login_page"));
			die();
		} else if(isset($_SESSION["user_id"]) && !self::User_Exists($_SESSION["user_id"])){
			unset($_SESSION["user_id"]);
			redirect($this->_CI->config->item("login_page"));
			die();
		}
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
	 * This function checks if http should be enabled
	 * @since 1.0
	 * @access public
	 */
	public function CheckHTTPS ($url) {
		$url = str_replace("http://", "", $url);
		return ($this->_CI->config->item("https") == true) ? "https://" . $url:  "http://" . $url;
	}
}
?>