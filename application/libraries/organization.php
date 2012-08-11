<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Organization extends Std_Library{

	/**
	 * The database id of the organization
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The readable name of the organization
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The contact email of the organization
	 * @var string
	 * @since 1.o
	 * @access public
	 */
	public $email = NULL;

	/**
	 * An array containing the organization employees
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $employees = NULL;

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
	public $Database_Table = "organizations";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("email","name");
		$this->_INTERNAL_SIMPLE_LOAD = array("employees" => true);
		$this->_INTERNAL_LOAD_FROM_CLASS = array("employees" => "User");
		$this->_INTERNAL_LINK_PROPERTIES = array("employees" => array("employees",array("organization_id" => "id")));
		$this->_INTERNAL_SECURE_EXPORT_IGNORE = array("email");
	}
}