<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Physical_Drive extends Std_Library{

	/**
	 * The database id of the physical drive
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
	 * The physical drive model
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $model = null;

	/**
	 * The size of the physical drive
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $disk_size = null;

	/**
	 * The drive serial number
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $serial_number = null;

	/**
	 * An array containing all the partions made of this drive
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $partitions = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "physical_drives";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id","partitions");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = 		array(
			"model"
		);
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"device_identifier",
			"computer_id"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Physical_Drive_Model",
			"partitions" => "Drive_Partition"
		); 
		$this->_INTERNAL_FORCE_ARRAY = 					array(
			"partitions"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"drive_model_id" => "model"
		);
		$this->_INTERNAL_LINK_PROPERTIES = array(
			"partitions"				=> array("computer_drive_partitions",			array("physical_drive_id" 		=> "id"),null,array("device_identifier","physical_drive_id"))
 		);
	}
}