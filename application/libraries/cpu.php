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
	 * This is the constructor, it does the configuration of the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufaturer");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = TRUE;
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
		);
		//$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		//$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}