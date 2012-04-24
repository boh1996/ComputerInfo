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
	public $organization_id = NULL;

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
	public $model_id = NULL;

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
	public $cpu_id = NULL;

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
	 * An array containig all the lan macs
	 * @var array
	 * @since 1.0
	 * @access public
	 */
	public $lan_macs = NULL;

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
	 * This property is used to force a specific property to be an array
	 * @var array
	 * @static
	 * @access public
	 * @since 1.0
	 * @example
	 * $this->_INTERNAL_FORCE_ARRAY = array("Questions");
	 */
	public static $_INTERNAL_FORCE_ARRAY = NULL;

	/**
	 * This property is used to deffine a set of rows that is gonna be
	 * unique for this row of data
	 * @var array
	 * @access public
	 * @since 1.1
	 * @static
	 * @internal This is a internal settings variable
	 * @example
	 * array("SeriesId","Title");
	 */
	public static $_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = NULL;

	/**
	 * This is the constructor, it configurates the std library
	 * @since 1.0
	 * @access private
	 */
	public function Computer(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_FORCE_ARRAY = array("lan_macs");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
	}
}