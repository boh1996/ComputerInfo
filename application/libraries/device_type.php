<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Device_Type extends Std_Library{

	/**
	 * The database id of the device type
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The name of the device type
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The device category, "Computer","Other" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $category = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "device_types";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("category");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"device_category_id" => "category"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"category" => "Device_Category"
		);
	}
}