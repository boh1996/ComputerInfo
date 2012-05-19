<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Cpu extends Std_Library{

	/**
	 * The database id of the cpu
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The manufacturer object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The number of cores,
	 * in this cpu
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $cores = NULL;

	/**
	 * The clock rate of this cpu
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $clock_rate = NULL;

	/**
	 * The name of the cpu, in text
	 * "i7" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The string returned from windows when detecting the CPU
	 * @var string
	 * @since 1.0
	 * @access public
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
	public $Database_Table = "cpus";

	/**
	 * This property can contain properties to be ignored when exporting
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 */
	public static $_INTERNAL_EXPORT_INGNORE = NULL;

	/**
	 * This property can contain properties to be ignored, when the database flag is true in export.
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 */
	public static $_INTERNAL_DATABASE_EXPORT_INGNORE = NULL;

	/**
	 * This property contains the database model to use
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public static $_INTERNAL_DATABASE_MODEL = NULL;

	/**
	 * This property contain values for converting databse rows to class properties
	 * @var array
	 * @see $_INTERNAL_DATABASE_NAME_CONVERT
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal databse column to class property convert table
	 * @example
	 * $_INTERNAL_ROW_NAME_CONVERT = array("Facebook" => "Facebook_Id");
	 */
	public static $_INTERNAL_ROW_NAME_CONVERT = NULL;

	/**
	 * This property is used to define class properties that should be filled with objects,
	 * with the data that the property contains
	 * The data is deffined like this:
	 * $_INTERNAL_LOAD_FROM_CLASS = array("Property Name" => "Class Name To Load From");
	 * @var array
	 * @since 1.0
	 * @access public
	 * @static
	 * @internal This is a class setting variable
	 * @example
	 * $_INTERNAL_LOAD_FROM_CLASS = array("TargetGroup" => "Group");
	 */
	public static $_INTERNAL_LOAD_FROM_CLASS = NULL;

	/**
	 * This is the constructor, it does the configuration of the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function Cpu(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = TRUE;
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
		);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}