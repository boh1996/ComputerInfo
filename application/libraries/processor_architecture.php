<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Processor_Architecture extends Std_Library{

	/**
	 * The database id of the processor architecture
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
	 * The processor architecture "id"
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $detection_string = null;

	/**
	 * The name of the processor architecture
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = NULL;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "processor_architectures";

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
			"manufacturer_id" => "manufacturer"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
	}
}