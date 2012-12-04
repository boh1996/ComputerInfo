<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer_Series extends Std_Library{

	/**
	 * The database id of the computer series
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The manufacturer object of the computer series manufacturer
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $manufacturer = NULL;

	/**
	 * The name of the computer series
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "computer_series";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufaturer");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("manufaturer,name");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
	}
}