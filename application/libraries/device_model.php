<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Device_Model extends Std_Library{

	/**
	 * The database id of the device model
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The manufacturer object, of the manufacturer of the device
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The type of device "camera" etc
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $type = NULL;

	/**
	 * The url to an image representing the model
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $image_url = null;

	/**
	 * The name of the model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "device_models";

	/**
	 * This constructor configurates the behavior of the Std_Library,
	 * so it corresponds the details of the Device Model
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufaturer","type");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"type" => "Device_Type"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"device_type_id" => "type",
			"manufacturer_id" => "manufacturer"
		);
	}
}