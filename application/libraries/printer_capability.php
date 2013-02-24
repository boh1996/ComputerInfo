<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Printer_Capability extends Std_Library{

	/**
	 * The database id of the object
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The PrinterCapability Detection string
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $detection_string = NULL;

	/**
	 * The name of the printer capability
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "printer_capability_types";

	/**
	 * This function is the constructor it configurates the,
	 * Std_Library.
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
	}
}
?>