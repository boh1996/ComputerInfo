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
		if($this->_CI->config->item("dev_mode") !== true){
			session_start();
			$this->_CI->load->config("api");
			self::_Is_Logged_In();
		}
	}

	/**
	 * This function checks if the user is logged in and exists else the user is redirected to login
	 * @since 1.0
	 * @access private
	 */
	private function _Is_Logged_In(){
		$Result = FALSE;
		$Pass = $this->_CI->config->item("non_security");
		foreach ($Pass as $Keyword) {
			if(strpos($this->_CI->uri->ruri_string(), $Keyword) !== false){
				$Result = TRUE;
			}

			if(strpos($this->_CI->uri->uri_string(), $Keyword) !== false){
				$Result = TRUE;
			}	
		}
		if(!$Result && !isset($_SESSION["user_id"])){
			redirect($this->_CI->config->item("login_page"));
		} else if(isset($_SESSION["user_id"]) && !self::User_Exists($_SESSION["user_id"])){
			unset($_SESSION["user_id"]);
			redirect($this->_CI->config->item("login_page"));
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
			$Query = $this->_CI->db->select("id")->where(array("id" => $Id))->get($this->config->item("api_users_table"));
			return ($Query->num_rows() > 0);
		} else {
			return FALSE;
		}
	}
}
?>