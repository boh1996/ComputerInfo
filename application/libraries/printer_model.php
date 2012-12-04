<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Printer_Model extends Std_Library{

	/**
	 * The database id of the printer model
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The name of the printer series
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The name/calling sign of the printer model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $model_name = NULL;

	/**
	 * The manufacturer of the printer
	 * @var object
	 * @since 1.0
	 */
	public $manufacturer = NULL;

	/**
	 * If the model is a color printer or not
	 * @var boolean
	 * @since 1.0
	 */
	public $color = NULL;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "printer_models";

	/**
	 * This function configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer"
		);
	}
}