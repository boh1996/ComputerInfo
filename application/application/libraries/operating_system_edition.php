<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Operating_System_Edition extends Std_Library{

	/**
	 * The database id of the operating system installation
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The manufactuer object of that OS edition
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $manufacturer = NULL;

	/**
	 * The name of the OS edition
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The consatant that can be used by the API/Read in program to 
	 * send the correct to the server
	 * @since 1.0
	 * @access public
	 * @var stirng
	 */
	public $detection_string = NULL;

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
	public $Database_Table = "operation_system_editions";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("core","edition");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
	}
}