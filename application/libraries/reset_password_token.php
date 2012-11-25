<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Reset_Password_Token extends Std_Library{

	/**
	 * The database id of the token
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The user requesting a new password
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $user = null;

	/**
	 * The reset token
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $token = null;

	/**
	 * The email the token was sent too
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $email = NULL;

	/**
	 * The timestamp when the token was created
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $created_time = NULL;

	/**
	 * A string identifier for the token
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;



	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "reset_password_tokens";
	
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
		$this->_INTERNAL_LOAD_FROM_CLASS = array("user" => "User");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"user",
			"token"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = 	array(
			"user" => "User"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array("user_id" 				=> "user");
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