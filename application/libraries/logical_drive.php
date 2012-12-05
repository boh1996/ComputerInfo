<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Logical_Drive extends Std_Library{

	/**
	 * The database id of the logical drive
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The OS device slot identifier
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $device_identifier = null;

	/**
	 * The amount of space available on the logical drive
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $free_space = null;

	/**
	 * The size of the logical drive
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $disk_size = null;

	/**
	 * The name of the logical drive
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $volume_name = null;

	/**
	 * The unique serial number of the logical drive
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $volume_serial_number = null;

	/**
	 * A string name of the OS file system
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $file_system = null;

	/**
	 * The drive type
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $drive_type = null;

	/**
	 * The drive letter
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "logical_drives";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"device_identifier",
			"computer_id"
		);
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = 		array(
			"drive_type"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"drive_type" => "Drive_Type"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"drive_type_id" => "drive_type"
		);
	}
}