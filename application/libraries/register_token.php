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

	### Class Settings ###

	/**
	 * This property contains a pointer to Code Igniter
	 * @var object
	 * @since 1.0
	 * @access private
	 * @internal This is just a local container for Code Igniter
	 */
	private $_CI = NULL;

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
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
	}

	/**
	 * This function creates a new token and saves the class
	 * @since 1.0
	 * @access public
	 */
	public function Create(){
		$this->_CI->load->config("api");
		$this->_CI->load->helper("string");
		$this->token = Rand_Str(64);
		self::Save();
	}
}