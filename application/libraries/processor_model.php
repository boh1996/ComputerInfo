<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Processor_Model extends Std_Library{

	/**
	 * The database id of the processor
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
	 * The clock rate of this processor
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $clock_rate = NULL;

	/**
	 * The name of the processor model, in text
	 * "i7" etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The string returned from windows when detecting the Processor Model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $detection_string = NULL;

	/**
	 * The max clock speed of the Processor
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $max_clock_speed = NULL;

	/**
	 * The number of threads that the proceessor can use
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $threads = NULL;

	/**
	 * The processor family, the Processor is a member of i.e Intel I7 Series
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $family = NULL;

	/**
	 * The processors model number
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $model_number = NULL;

	/**
	 * If the model is 32 bit or 64 bit
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $data_width = null;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "processor_models";

	/**
	 * This is the constructor, it does the configuration of the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","family");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = TRUE;
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"family_id" => "family"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"family" => "Processor_Family"
		);
	}
}