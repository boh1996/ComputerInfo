<?php
class Settings extends CI_Model{

	/**
	 * The class contructor
	 * @since 1.0
	 * @access public
	 */
	public function Settings () {
		parent::__construct();
	}

	/**
	 * This function sets the settings db from ann array
	 * @param integer $user_id  The user id of the user that owns the settings
	 * @param array  $settings The array of settings to set in the format "key" => "value"
	 * @since 1.0
	 * @access public
	 */
	public function Set ($user_id, array $settings) {
		foreach ($settings as $key => $value) {
			if (self::Exists($user_id,$key)) {
				$this->db->where(array("user_id" => $user_id,"key" => $key))->update("user_settings",array("value" => $value));
			} else {
				$this->db->insert("user_settings",array("value" => $value,"key" => $key,"user_id" => $user_id));
			}
		}
	} 

	/**
	 * This function checks if a specific setting exists for a particular user
	 * @param integer $user_id The users database id
	 * @param string $key     The setting key to check for
	 * @since 1.0
	 * @access public
	 * @return boolean
	 */
	public function Exists ($user_id, $key) {
		return ($this->db->select("id")->from("user_settings")->where(array("user_id" => $user_id,"key" => $key))->get()->num_rows > 0);
	}

	/**
	 * This function gets either all the user's settings or just the selected 
	 * @param integer $user_id  The users database id
	 * @param array $settings An optional array of settings to fetch
	 * @since 1.0
	 * @access public
	 * @return boolean|array
	 */
	public function Get ( $user_id, $settings = null) {
		if (!is_null($settings) && is_array($settings)) {
			$this->db->from("user_settings");
			$this->db->select("key,value");
			$this->db->where(array("user_id" => $user_id));
			$this->db->where_in("key",$settings);
			$query = $this->db->get();
		} else {
			$this->from("user_settings");
			$this->db->select("key,value");
			$this->db->where(array("user_id" => $user_id));
			$query = $this->db->get();
		}
		if ($query->num_rows() > 0) {
			if ($query->num_rows() > 1) {
				$result = array();
				foreach ($query->result() as $key => $value) {
					$result[$key] = $value;
				}
			} else {
				$result = $query->row();
			}
			return $result;
		} else {
			return FALSE;
		}
	}
}
?>