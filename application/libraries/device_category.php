<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Device_Category extends Std_Library{

	/**
	 * The database id of the device category
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The name of the device category
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
	//private $_CI = NULL;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "device_categories";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		//$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
	}
}