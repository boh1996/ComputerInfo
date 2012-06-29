<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Model extends Std_Library{

	/**
	 * The database id of the screen model
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The number of pixels per inch of the screen model
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $pixed_per_inch = NULL;

	/**
	 * The manufacturer object, that has manufactured the screen model
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The screen size object of the screen model
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $screen_size = NULL;

	/**
	 * The name of the screen model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The usage of power per hour in watt
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $power_usage = NULL;

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
	public $Database_Table = "screen_models";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		//$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","screen_size");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("manufacturer,name","screen_size");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"model_name" => "name",
			"screen_size_id" => "screen_size",
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"screen_size" => "Screen_Size"
		);
		//$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}