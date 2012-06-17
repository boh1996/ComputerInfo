<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer extends Std_Library{

	/**
	 * The id of the computer, taken from the database
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * An identifier for the computer,
	 * etc an unique name or so
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;

	/**
	 * The id of the organization that
	 * this device is connected too
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $organization = NULL;

	/**
	 * The primary LAN mac of the computer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $lan_mac = NULL;

	/**
	 * The primary WIFI mac of the computer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $wifi_mac = NULL;

	/**
	 * The primary ip address of the computer
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $ip = NULL;

	/**
	 * The amount of disk space left
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $disk_space = NULL;

	/**
	 * The printer groups that this computer is a member off
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $groups = NULL;

	/**
	 * The amount of available RAM 
	 * space at the computer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $ram_size = NULL;

	/**
	 * The database identifier
	 * of the model this computer belogns too
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * The computers serial key
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $serial = NULL;

	/**
	 * The operation system, the computer is running
	 * on.
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $operating_system = NULL;

	/**
	 * The screen size of the primary screen
	 * in the format width "x" height
	 * @var string
	 */
	public $screen_size = NULL;

	/**
	 * The id of the cpu build into this computer
	 * @var integer
	 * @access public
	 * @since 1.0
	 */
	public $cpu = NULL;

	/**
	 * The UNIX timestap of the time
	 * the row was created,
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $created_time = NULL;

	/**
	 * The UNIX timestap,
	 * when the row last was updated
	 * by the API
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $last_updated = NULL;

	/**
	 * An optional location
	 * where the computer is based
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $location = NULL;

	/**
	 * An array storing the connected printers to this device
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $printers = NULL;

	/**
	 * An array containig all the lan macs
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $lan_macs = NULL;

	/**
	 * A list of other connected devices
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $connected_devices = NULL;

	/**
	 * A string storing the power usage per
	 * hour of the computer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $power_usage_per_hour = NULL;

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
	public $Database_Table = "computers";

	/**
	 * This is the constructor, it configurates the std library
	 * @since 1.0
	 * @access private
	 */
	public function Computer(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_FORCE_ARRAY = array("lan_macs","printers","connected_devices");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier","organization");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("location","printers","model","cpu","organization","connected_devices");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array(
			"id",
			"printers",
			"connected_devices",
			"groups"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Computer_Model",
			"organization" => "Organization",
			"cpu" => "Cpu",
			"printers" => "Printer",
			"connected_devices" => "Device",
			"location" => "Location",
			"screen_size" => "Screen_Size",
			"operating_system" => "Operating_System",
			"groups" => "Computer_Group"
		);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_SIMPLE_LOAD = array("printers" => true);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"cpu_id" => "cpu",
			"model_id" => "model",
			"location_id" => "location",
			"screen_size_id" => "screen_size",
			"operating_system_id" => "operating_system"
		);
		$this->_INTERNAL_LINK_PROPERTIES = array("printers" => array("connected_to_printers",array("device_id" => "id"),"printer_id"),"connected_devices" => array("connected_devices",array("connected_id" => "id"),"device_id"),"groups" => array("computer_group_members",array("computer_id" => "id"),"group_id"));
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}