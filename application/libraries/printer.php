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
	 * If the printer is a local or network printer
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $local = null;

	/**
	 * Indicicates what the printer is capable of
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $capabilities = null;

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

	/**
	 * The year the printer was aquired
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $year_of_purchase = null;

	### Class Settings ###

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
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_OVERWRITE_ON_DUBLICATE = true;
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier");
		$this->_INTERNAL_FORCE_ARRAY = array("capabilities");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("model","organization","location");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id","groups","capabilities");
		$this->_INTERNAL_LAST_UPDATED_PROPERTY = array("last_updated");
		$this->_INTERNAL_CREATED_TIME_PROPERTY = array("created_time");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Printer_Model",
			"organization" => "Organization",
			"connected_devices" => "Computer",
			"location" => "Location",
			"groups" => "Printer_Group",
			"capabilities" => "Printer_Capability"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"model_id" => "model",
			"location_id" => "location"
		);
		$this->_INTERNAL_IMPORT_OVERWRITE = array(
			"identifier",
			"name",
			"model",
			"mac",
			"ip",
			"location"
		);
		$this->_INTERNAL_LINK_PROPERTIES = array(
			"groups" => array("printer_group_members",array("printer_id" => "id"),"group_id"),
			"capabilities" => array("printer_capabilities",array("printer_id" => "id"),"printer_capability_type_id",array("printer_capability_type_id","printer_id"))
		);
	}
}