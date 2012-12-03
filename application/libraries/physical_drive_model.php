<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Physical_Drive_Model extends Std_Library{

	/**
	 * The database id of the physical drive model
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The manufacturer object of the physical drive
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The physical drive model detection string
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $detection_string = null;

	/**
	 * The human readable name of the model
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
	public $Database_Table = "physical_drive_models";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
		);
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = 		array(
			"manufacturer"
		);
	}
}