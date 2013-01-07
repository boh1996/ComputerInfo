<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Model extends Std_Library{

	/**
	 * The database id of the screen model
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The number of pixels per inch of the screen model
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $pixel_per_inch = NULL;

	/**
	 * The manufacturer object, that has manufactured the screen model
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The size in inches of the screen
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $inches = null;

	/**
	 * The screen size object of the screen model
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $screen_size = NULL;

	/**
	 * The series the model belongs to
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $series = null;

	/**
	 * The name of the screen model
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The usage of power per hour in watt
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $power_usage = NULL;

	/**
	 * The screen pixel type
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $pixel_type = null;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "screen_models";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("manufacturer","screen_size","pixel_type","series");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("manufacturer","name","screen_size");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
			"model_name" => "name",
			"screen_size_id" => "screen_size",
			"screen_pixel_type_id" => "pixel_type",
			"screen_series_id"	=> "series"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer",
			"screen_size" => "Screen_Size",
			"pixel_type"	=> "Screen_Pixel_Type",
			"series"	=> "Screen_Series"
		);
	}

	/**
	 * This function saves the local class data to the database row of the Id property
	 * @return string This function can return a error string
	 * @param boolean $save_self If the object should save it self or only it's childrens
	 * @since 1.0
	 * @access public
	 */
	public function Save ($save_self = true) {
		if (!isset($this->pixel_per_inch) && isset($this->screen_size) && isset($this->screen_size->width) && isset($this->inches) && isset($this->screen_size->height)) {
			$this->pixel_per_inch = ($this->screen_size->width * $this->screen_size->height) / $this->inches;
		}
		return parent::Save($save_self);
	}
}