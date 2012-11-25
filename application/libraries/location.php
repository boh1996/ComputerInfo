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
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name","organization_id");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("organization","building","floor");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"floor_id" => "floor",
			"building_id" => "building"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"building" => "Building",
			"floor" => "Floor"
		);
		$this->_INTERNAL_IMPORT_OVERWRITE = array(
			"name",
			"building",
			"floor"
		);
	}
}