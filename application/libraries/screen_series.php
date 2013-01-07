<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Series extends Std_Library{

	/**
	 * The database id of the screen series
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The manufacturer object, that has manufactured the screen series
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The screen pixel type
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $pixel_type = null;

	/**
	 * The name of the screen series
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "screen_series";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","pixel_type");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("manufacturer","name");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"screen_pixel_type_id" => "pixel_type"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"pixel_type"	=> "Screen_Pixel_Type"
		);
	}
}