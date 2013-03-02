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
	 * A datestring holding the date of purchase of the computer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $date_of_purchase = NULL;

	/**
	 * The printer groups that this computer is a member off
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $groups = NULL;

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
	 * The obect of the user that created the object
	 * @since 1.21
	 * @access public
	 * @var object
	 */
	public $creator_user = NULL;

	/**
	 * The user object of the user that last updated the object
	 * @since 1.21
	 * @access public
	 * @var object
	 */
	public $last_updated_user = NULL;

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

	/**
	 * An array containing all the computers graphic cards
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $graphics_cards = NULL;

	/**
	 * An array containing the processeor available for a specific PC
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $processors = NULL;

	/**
	 * The computer memory object storing the memory slots and the amout  of RAM
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $memory = NULL;

	/**
	 * A list of the computers network adapters
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $network_cards = null;

	/**
	 * An array containing the available logical drives of the computer
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $logical_drives = null;

	/**
	 * An array containing the physical instlaled drives in the computer
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $physical_drives = null;

	### Class Settings ###

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
	public function __construct( $input = null ){
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_EXPORT_INGNORE = 				array("CI","Database_Table","_CI");
		$this->_INTERNAL_FORCE_ARRAY = 					array(
			"printers",
			"connected_devices",
			"graphics_cards",
			"processors",
			"network_cards",
			"logical_drives"
		);
		$this->_INTERNAL_OVERWRITE_ON_DUBLICATE = true; //This can changed
		$this->_INTERNAL_IMPORT_OVERWRITE = 			array(
			"identifier",
			"serial",
			"ip",
			"date_of_purchase",
			"power_usage_per_hour",
			"location",
			"memory"
		);
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"identifier",
			"organization"
		);
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = 		array(
			"location",
			"model",
			"organization",
			"screen_size"
		);
		$this->_INTERNAL_IMPORT_IGNORE = array(
			"id",
			"last_updated",
			"created_time",
			"last_updated_user",
			"creator_user"
		);
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array(
			"id",
			"printers",
			"connected_devices",
			"groups",
			"graphic_cards",
			"processors",
			"memory",
			"operating_system",
			"network_cards",
			"logical_drives"
		);
		$this->_INTERNAL_LAST_UPDATED_PROPERTY 		= "last_updated";
		$this->_INTERNAL_CREATED_TIME_PROPERTY 		= "created_time";
		$this->_INTERNAL_LAST_UPDATED_USER_PROPERTY = "last_updated_user";
		$this->_INTERNAL_CREATED_USER_PROPERTY 		= "creator_user";
		/*$this->_INTERNAL_EXPORT_FORMATING = array(
			"created_time" => array("date","d/m-Y - H:i:s"),
			"last_updated" => array("date","d/m-Y - H:i:s")
		);*/
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" 			=> "Computer_Model",
			"organization" 		=> "Organization",
			"printers"			=> "Printer",
			"connected_devices" => "Device",
			"location" 			=> "Location",
			"screen_size" 		=> "Screen_Size",
			"groups" 			=> "Computer_Group",
			"last_updated_user" => "User",
			"graphics_cards" 	=> "Graphic_Card",
			"processors" 		=> "Processor",
			"creator_user" 		=> "User",
			"memory" 			=> "Computer_Memory",
			"operating_system" 	=> "Operating_System_Installation",
			"network_cards"		=> "Network_Card",
			"logical_drives"	=> "Logical_Drive"
		);
		$this->_INTERNAL_SIMPLE_LOAD = 		array(
			"printers" => true,
			"organization" => true
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" 				=> "organization",
			"model_id" 						=> "model",
			"location_id" 					=> "location",
			"screen_size_id" 				=> "screen_size",
			"creator_user_id" 				=> "creator_user",
			"last_updated_user_id" 			=> "last_updated_user"
		);
		$this->_INTERNAL_LINK_PROPERTIES = array(
			"printers" 					=> array("connected_to_printers",			array("device_id" 			=> "id"),"printer_id"),
			"connected_devices" 		=> array("connected_devices",				array("connected_id" 		=> "id"),"device_id",array("connected_id","device_id")),
			"groups" 					=> array("computer_group_members",			array("computer_id" 		=> "id"),"group_id"),
			"graphics_cards"			=> array("graphics_cards",					array("computer_id" 		=> "id"),null,array("device_identifier","computer_id")),
			"network_cards"				=> array("network_cards",					array("computer_id" 		=> "id"),null,array("device_identifier","computer_id")),
			"logical_drives"			=> array("logical_drives",					array("computer_id" 		=> "id"),null,array("device_identifier","computer_id")),
			"physical_drives"			=> array("physical_drives",					array("computer_id" 		=> "id"),null,array("device_identifier","computer_id")),
			"processors" 				=> array("computer_processors",				array("computer_id" 		=> "id"),null,array("device_identifier","computer_id")),
			"memory" 					=> array("computer_memory",					array("computer_id" 		=> "id"),null,array("computer_id")),
			"operating_system" 			=> array("operation_system_installations",	array("computer_id" 		=> "id"),null,array("computer_id"))
 		);
 		parent::__construct();
	}
}