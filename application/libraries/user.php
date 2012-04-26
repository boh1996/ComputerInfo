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
	 * This property is used to determine what properties is going to be ignored,
	 * if the secrure parameter is turned on in the export function
	 * @var array
	 * @since 1.0
	 * @static
	 * @access public
	 * @example
	 * $this->_INTERNAL_LINK_PROPERTIES = array("Email,"Google_Id");
	 */
	public static $_INTERNAL_SECURE_EXPORT_IGNORE = NULL;

	public function User(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"organizations" => "Organization"
		);
		$this->_INTERNAL_FORCE_ARRAY = array("organizations");
		$this->_INTERNAL_SECURE_EXPORT_IGNORE = array("username","password","google");
		$this->_INTERNAL_LINK_PROPERTIES = array("organizations" => array("employees",array("user_id" => "id"),"organization_id"));
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
	}
}