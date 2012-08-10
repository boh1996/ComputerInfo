<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Operating_System_Version extends Std_Library{

	/**
	 * The database id of the operating system
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The name of the operating system Windows XP etc
	 * @since 1.0
	 * @access public
	 * @var strign
	 */
	public $name = NULL;

	/**
	 * The input detection string of the os
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $version_number = NULL;

	/**
	 * The version of the operating system
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $operating_system = NULL;

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
	public $Database_Table = "operating_system_versions";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("version_number");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("operating_system");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"operating_system_id" => "operating_system"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"operating_system" => "Operating_System"
		);
	}
}