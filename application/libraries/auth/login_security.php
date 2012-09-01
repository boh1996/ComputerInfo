<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Login_Security extends Std_Library{

	public function __construct () {}

	public function check ( $password, $user_password, $user_salt, $hashing_iterations = 10 ) {
		$password = self::_check_security($password);
		if (self::_correct_length($password, $this->config->item("password_length")) && self::_has_number($password)) {
			$salts = array(
				$user_salt,
				$this->config->item("app_hashing_salt"),
				"fdd3606ec5da81bf410b57828df77caba7fb870edc3307369adf179f838f20fc"
			);
			$salt = self::_create_salt( $salts );
		} else {
			return false;
		}
	}

	/**
	 * This function creates a salt based on salts in an array
	 * @since 1.0
	 * @param  string $salts An array containing the salts to use to create the final salt
	 * @return string
	 * @access private
	 */
	private function _create_salt ( $salts) {
		if (!is_null($salts) && is_array($salts)) {
			$string = "";
			foreach ($salts as $salt) {
				$string .= $salt;
			}
			return $string:
		} else {
			if (!is_null($salts)) {
				return $salts;
			} else {
				return "kK40kOpkP1";
			}
		}
	}

	private function _hash ( $password, $salts, $hashing_iterations ) {

	}

	/**
	 * This function checks if the text length is larger or equals to the specified length
	 * @param  string  $text   The text to check
	 * @param  integer $length The wished min length
	 * @since 1.0
	 * @access private
	 * @return boolean
	 */
	private function _correct_length ( $text, $length = 7) {
		return (strlen($text) >= $length);
	}

	/**
	 * This function checks if the string contains minimum one integer
	 * @since 1.0
	 * @access private
	 * @param  string  $text The text to check in
	 * @return boolean
	 */
	private function _has_number ( $text ) {
		return (preg_match('#[0-9]#',$text));
	}

	/**
	 * This function removes all un-autherized entities from the password
	 * @param  string $password The password to secure
	 * @since 1.0
	 * @access private
	 * @return string
	 */
	private function _check_security ( $password) {
		$password = mysql_real_escape_string($password);
		$password = addslashes($password);
		$password = strip_tags($password);
		$password = htmlspecialchars($password, ENT_QUOTES);
		return $password;
	}
}