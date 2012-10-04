<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Login_Security{

	/**
	 * A local instance of CodeIgniter
	 * @since 1.0
	 * @access private
	 * @var object
	 */
	private $_CI = NULL;

	public function __construct () {
		$this->_CI =& get_instance();
	}

	/**
	 * This function hashes the input password, checks the length and if the password contains numbers
	 * and then it checks if it matches the database password
	 * @since 1.0
	 * @access public
	 * @param  string  $password           The password entered by the User
	 * @param  string  $user_password      The password taken from the database
	 * @param  string  $user_salt          The salt assosiacted with the user
	 * @param  integer $hashing_iterations The number of time to hash the password before check
	 * @return boolean
	 */
	public function check ( $password, $user_password, $user_salt, $hashing_iterations = 10 ) {
		$password = self::check_security($password);
		if (!empty($password) && self::_correct_length($password, $this->_CI->config->item("password_length")) && self::_has_number($password)) {
			$salts = self::_get_salts( $user_salt );
			$salt = self::_create_salt( $salts );
			$password = self::_hash($password, $salt, $hashing_iterations);
			return ($password == $user_password);
		} else {
			return false;
		}
	}

	/**
	 * This function returns the array of the salts
	 * @access private
	 * @since 1.0
	 * @return array
	 */
	private function _get_salts ( $user_salt ) {
		$salts = array(
			$user_salt
		);
		if (getenv("app_hashing_salt") !== false && getenv("app_hashing_salt") != null) {
			$salts[] = getenv("app_hashing_salt");
		} else if (getenv("COMPUTERINFO_SALT") !== false && getenv("COMPUTERINFO_SALT") != null) {
			$salts[] = getenv("COMPUTERINFO_SALT");
		}
		if ($this->_CI->config->item("app_hashing_salt") != null){
			$salts[] = $this->_CI->config->item("app_hashing_salt");
		}
		$salts[] = "fdd3606ec5da81bf410b57828df77caba7fb870edc3307369adf179f838f20fc";
		return $salts;
	}

	/**
	 * This function creates the user salt and hashes the password
	 * @since 1.0
	 * @access public
	 * @param  string  $password           The entered password
	 * @param  integer $hashing_iterations The number of hash iterations
	 * @param  integer $salt_length        The length of the users salt
	 * @param  string  &$user_salt         The returned user salt
	 * @return string
	 */
	public function createUser ( $password, $hashing_iterations = 10, $salt_length = 64, &$user_salt) {
		if (self::_correct_length($password, $this->_CI->config->item("password_length"))) {
			$user_salt = self::createSalt($salt_length);
			$salts = self::_get_salts( $user_salt );
			$salt = self::_create_salt( $salts );
			return self::_hash($password, $salt, $hashing_iterations);
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates a hashed password and returns the hashed password
	 * @since 1.0
	 * @access public
	 * @param  string $password           The password to hash
	 * @param  integer $hashing_iterations The number of hashing iterations
	 * @param  string $user_salt          The users salt
	 * @return string
	 */
	public function createHashedPassword ($password, $hashing_iterations, $user_salt) {
		$salts = self::_get_salts( $user_salt );
		$salt = self::_create_salt( $salts );
		return self::_hash($password, $salt, $hashing_iterations);
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
			return $string;
		} else {
			if (!is_null($salts)) {
				return $salts;
			} else {
				return "kK40kOpkP1";
			}
		}
	}

	/**
	 * This function creates a random salt
	 * @since 1.0
	 * @access public
	 * @param  integer $length The length of the desired salt
	 * @return string
	 */
	public function createSalt ( $length = 64) {
		$this->_CI->load->helper("rand");
		$rand = rand_sha1($length);
		return $rand;
	}

	/**
	 * This function hashes the password {x} times, with a user salts and a APP HMAC
	 * @param  strign  $password          The password to hash
	 * @param  string  $salt              The salt
	 * @param  integer $hashing_iterations The number of times to iterate
	 * @return string
	 * @since 1.0
	 * @access private
	 */
	private function _hash ( $password, $salt, $hashing_iterations = 10 ) {
		$pasword_hashed = $password;
		for ($i = 0; $i < $hashing_iterations; $i++) { 
			$pasword_hashed = hash_hmac("sha512", $pasword_hashed . $salt, $this->_CI->config->item("login_secret"));
		}
		return $pasword_hashed;
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
	 * @access public
	 * @return string
	 */
	public function check_security ( $password) {
		$password = mysql_real_escape_string($password);
		$password = addslashes($password);
		$password = strip_tags($password);
		$password = htmlspecialchars($password, ENT_QUOTES);
		return $password;
	}
}