<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Printer extends Std_Library{

	/**
	 * The database id of the printer
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * An optonal identifier of the printer
	 * "BUF1234" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;

	/**
	 * An optional name of the printer
	 * "The printer on the street" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The UNIX timestap when the
	 * printer was created
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $created_time = NULL;

	/**
	 * The UNIX timestap when the printer last was
	 * updated using the API
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $last_updated = NULL;

	/**
	 * An optional location of the printer
	 * "In the toilet" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $location = NULL;

	/**
	 * The IP address of the printer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ip = NULL;

	/**
	 * The MAC address of the printer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $mac = NULL;

	/**
	 * The model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * This property holds all the computers connected to this printer
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $connected_devices = NULL;

	/**
	 * The owner organization of the device
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $organization = NULL;

	/**
	 * The printer groups
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $groups = NULL;

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
	public $Database_Table = "printers";

	/**
	 * This function is the constructor it configurates the,
	 * Std_Library.
	 * @since 1.0
	 * @access public
	 */
	public function Printer(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier");
		$this->_INTERNAL_FORCE_ARRAY = array("connected_devices");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("model","organization","location","connected_devices");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id","groups");
		$this->_INTERNAL_LAST_UPDATED_PROPERTY = array("last_updated");
		$this->_INTERNAL_CREATED_TIME_PROPERTY = array("created_time");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Printer_Model",
			"organization" => "Organization",
			"connected_devices" => "Computer",
			"location" => "Location",
			"groups" => "Printer_Group"
		);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"model_id" => "model",
			"location_id" => "location"
		);
		$this->_INTERNAL_SIMPLE_LOAD = array("connected_devices" => true);
		$this->_INTERNAL_LINK_PROPERTIES = array("connected_devices" => array("connected_to_printers",array("printer_id" => "id"),"device_id"),"groups" => array("printer_group_members",array("printer_id" => "id"),"group_id"));
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}