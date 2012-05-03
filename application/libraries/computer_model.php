<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer_Model extends Std_Library{

	/**
	 * The database id of this Computer model
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The id of the manufacturer of the computer
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * Th computer type "Laptop","Stationary" etc
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $type = NULL;

	/**
	 * The name of the model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

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
	public $Database_Table = "computer_models";

	/**
	 * This is the constructor it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function Computer_Model(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"device_type" => "type"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"type" => "Device_Type"
		);
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}