<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Drive_Partition extends Std_Library{

	/**
	 * The database id of the partition
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The os device identifier
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $device_identifier = null;

	/**
	 * The partition size
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $disk_size = null;

	/**
	 * If the partition is set as the boot partition
	 * @since 1.0
	 * @access public
	 * @var stirng
	 */
	public $boot_partition = null;

	/**
	 * The partition index
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $index = null;

	/**
	 * The disc byte starting index
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $starting_index = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "computer_drive_partitions";

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
			"physical_drive_id"
		);
	}
}