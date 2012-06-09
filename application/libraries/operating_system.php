<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Operating_System extends Std_Library{

	/**
	 * The database id of the operating system
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The name of the operating system Windows XP etc
	 * @since 1.0
	 * @access public
	 * @var strign
	 */
	public $name = NULL;

	/**
	 * The input detection string of the os
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $detection_string = NULL;

	/**
	 * The version of the operating system
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $version = NULL;

	/**
	 * The family object of the family that the os belongs too Windows/Android/Linux etx
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $family = NULL;

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
	public $Database_Table = "operating_systems";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function Operating_System(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","family");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"family_id" => "family"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"family" => "Operating_System_Family"
		);
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}