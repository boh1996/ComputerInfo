<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Operating_System_Family extends Std_Library{

	/**
	 * The database id of the operating system family
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The manufacturer object of the operating system family
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The name of the operating system family
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = NULL;

	/**
	 * The operating system core object
	 * @var object
	 * @since 1.0
	 * 
	 * @access public
	 */
	public $core = NULL;

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
	public $Database_Table = "operating_system_families";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function Operating_System_Family(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("manufaturer,name");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","core");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"core_id" => "core"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"core" => "Operating_System_Core"
		);
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}