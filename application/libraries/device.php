<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Device extends Std_Library{

	/**
	 * The database id of the device
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * An optional identifier for you device etc a physic number on it
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;

	/**
	 * An optional description of the device usage etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $description = NULL;

	/**
	 * The device model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * An optional location description
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $location = NULL;

	/**
	 * The time when the device was created
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $created_time = NULL;

	/**
	 * The time when the device last was updated
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $last_updated = NULL;

	/**
	 * An optional serial number of the device
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $serial = NULL;

	/**
	 * An optional integer, to describe what year the device was purchased
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $year_of_purchase = NULL;

	/**
	 * The organization object, showing the organization details
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $organization = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "devices";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier","organization","model");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("location","organization","model");
		$this->_INTERNAL_LAST_UPDATED_PROPERTY = array("last_updated");
		$this->_INTERNAL_CREATED_TIME_PROPERTY = array("created_time");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"model_id" => "model",
			"location_id" => "location"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"organization" => "Organization",
			"model" => "Device_Model",
			"location" => "Location"
		);
		$this->_INTERNAL_IMPORT_OVERWRITE = array(
			"identifier",
			"description",
			"location",
			"model",
			"serial",
			"year_of_purchase"
		);
		$this->_INTERNAL_SIMPLE_LOAD = array("organization" => true);
	}
}