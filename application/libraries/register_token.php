<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Register_Token extends Std_Library{

	/**
	 * The database id of the user
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The full name of the user
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The register token
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $token = NULL;

	/**
	 * The users username
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $username = NULL;

	/**
	 * The users password
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $password = NULL;

	/**
	 * The users desired email
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $email = NULL;

	/**
	 * The users generated salt
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $user_salt = NULL;

	/**
	 * The number of iterations done by the hashing function
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $hashing_iterations = NULL;

	/**
	 * The timestamp when the token was created
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $created_time = NULL;

	/**
	 * A string identifier
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $identifier = NULL;



	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "register_tokens";
	
	/**
	 * This is the concstructor, it configurates the std library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_CI = self::CodeIgniter();
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_CREATED_TIME_PROPERTY 		= "created_time";
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"email",
			"username"
		);
	}

	/**
	 * This function creates a new token and saves the class
	 * @since 1.0
	 * @access public
	 */
	public function Create(){
		$this->_CI->load->config("api");
		$this->_CI->load->helper("rand");
		$this->token = Rand_Str(64);
		$this->identifier = Rand_Str(32);
		return self::Save();
	}
}