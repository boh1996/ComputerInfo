<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Building extends Std_Library{

	/**
	 * The database id of the building
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The organization object of the organization that the building belongs too
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $organization = NULL;

	/**
	 * The name of the building
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
	public $Database_Table = "buildings";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
		public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("organization","name");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_SIMPLE_LOAD = array(
			"organization" => true
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"organization" => "Organization"
		);
	}
}