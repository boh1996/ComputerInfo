<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Floor extends Std_Library{

	/**
	 * The id of the floor
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The building object of the floor
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $building = NULL;

	/**
	 * The name of the floor
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
	public $Database_Table = "floors";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		//$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("building,name");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("building");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"building_id" => "building"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"building" => "Building"
		);
		//$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}