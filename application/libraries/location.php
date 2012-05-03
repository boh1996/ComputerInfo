<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Location extends Std_Library{

	/**
	 * The database id of the location
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * An optional name of the location
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * An optional floor where the location is based
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $floor = NULL;

	/**
	 * An optional building if there is more buildings
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $building = NULL;

	/**
	 * An optional room number for this location
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $room_number = NULL;

	/**
	 * The organization this location belongs too
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $organization = NULL;

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
	public $Database_Table = "locations";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function Location(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name","organization_id");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization"
		);
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}