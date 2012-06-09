<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen extends Std_Library{

	/**
	 * The database id of the screen
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The identifier of the screen
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;

	/**
	 * The screen model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * The organization object
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $organization = NULL;

	/**
	 * The location object of the screen
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $location = NULL;


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
	public $Database_Table = "screens";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function Screen(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier,organization");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("organization","model","location");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"model_id" => "model",
			"location_id" => "location"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Screen_Model",
			"organization" => "Organization",
			"location" => "Location"
		);
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}