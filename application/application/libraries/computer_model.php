<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer_Model extends Std_Library{

	/**
	 * The database id of this Computer model
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The id of the manufacturer of the computer
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * Th computer type "Laptop","Stationary" etc
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $type = NULL;

	/**
	 * The manufacturer calling code of the model
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $model_code = NULL;

	/**
	 * The name of the model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The string returned from windows, when detecting model
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $detection_string = NULL;

	/**
	 * The series object of the computer series that the model belongs too
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $computer_series = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "computer_models";

	/**
	 * This is the constructor it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"device_type" => "type",
			"computer_series_id" => "computer_series"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"type" => "Device_Type",
			"computer_series" => "Computer_Series"
		);
	}
}