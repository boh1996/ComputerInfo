<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Memory_Slot extends Std_Library{

	/**
	 * The database id of the device
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * If the memory slot is empty
	 * @since 1.0
	 * @access public
	 * @var boolean
	 */
	public $empty = NULL;

	/**
	 * The size of the RAM inserted in this memory slot
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $capacity = NULL;

	/**
	 * If the Memory slot isn't empty,
	 * the this property will contain the menufacturer
	 * of the inserted Memory
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;	

	/**
	 * The memory's serial number,
	 * assosiacted with the inserted memory
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $serial = NULL;

	/**
	 * The memory's part number,
	 * associated with the inserted memory
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $part_number = NULL;

	/**
	 * The memory I/O speed
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $speed = NULL;

	/**
	 * The Windows DeviceID/Slot id
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $device_identifier = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "computer_memory_slots";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array("device_identifier","computer_memory_id");
		$this->_INTERNAL_EXPORT_FORMATING = array(
			"empty" => "boolean"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" 				=> "manufacturer"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
	}
}