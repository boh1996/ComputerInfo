<?php
class Login_Model extends CI_Model{

	/**
	 * This function is the constructor it loads up the api config
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->load->config("api");
	}

	/**
	 * This function either set the user id of the current user to
	 * &$UserId or creates a new user and set the id
	 * @param integer $Id      The users Google identifier
	 * @param string $Name    The users name taken from Google
	 * @param string $Email   The email of the user gotten from Google
	 * @param integer &$UserId A variable to store the users id
	 * @return boolean
	 * @since 1.0
	 * @access public
	 */
	public function Google($Id = NULL,$Name = NULL,$Email = NULL,&$UserId){
		if(self::User_Exists("google",$Id,$UserId)){
			return TRUE;
		} else {
			$Data = array(
				"google" => $Id,
				"email" => $Email,
				"name" => $Name
			);
			$this->db->insert($this->config->item("api_users_table"),$Data);
			$UserId = $this->db->insert_id();
			return TRUE;
		}
	}

	/**
	 * This function checks if a user exists with a specific provider id
	 * @param string $Provider The provider/row to search for/in "Google" or "id" etc
	 * @param integer $Id       The id to search for
	 * @param pointer|integer &$UserId  A variable to store the userid if the user exists
	 * @since 1.0
	 * @access public
	 * @return boolean
	 */
	public function User_Exists($Provider = NULL,$Id = NULL,&$UserId = NULL){
		if(!is_null($Provider) && !is_null($Id)){
			$Query = $this->db->select("id")->where(array($Provider => $Id))->get($this->config->item("api_users_table"));
			if($Query->num_rows() > 0){
				$Row = current($Query->result());
				$UserId = $Row->id;
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
}
?>