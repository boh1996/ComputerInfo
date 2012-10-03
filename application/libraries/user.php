<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class User extends Std_Library{

	/**
	 * The database id of the user
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * An array containing the organizations that
	 * the users is member of
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $organizations = NULL;

	/**
	 * The email of the user
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $email = NULL;

	/**
	 * An optional Google Account Id
	 * for loging in with Google
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $google = NULL;

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

	/**
	 * The number of times to iterate when hashing the users password
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $hashing_iterations = NULL;

	/**
	 * The user salt
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $login_token = NULL;

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
	public $Database_Table = "users";
	
	/**
	 * This is the concstructor, it configurates the std library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array(
			"CI",
			"Database_Table",
			"_CI",
			"username",
			"password",
			"login_token",
			"hashing_iterations"
		);
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"organizations" => "Organization"
		);
		$this->_INTERNAL_OVERWRITE_ON_DUBLICATE = false; //This can changed
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"email",
			"username"
		);
		$this->_INTERNAL_IMPORT_IGNORE = array(
			"username",
			"password",
			"CI",
			"Database_Table",
			"_CI",
			"login_token",
			"hashing_iterations"
		);
		$this->_INTERNAL_FORCE_ARRAY = array("organizations");
		$this->_INTERNAL_SECURE_EXPORT_IGNORE = array("username","password","google");
		$this->_INTERNAL_LINK_PROPERTIES = array("organizations" => array("employees",array("user_id" => "id"),"organization_id", array("organization_id","user_id")));
	}
}