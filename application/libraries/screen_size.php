<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Size extends Std_Library{

	public $id = NULL;

	public $width = NULL;

	public $height = NULL;

	public $detection_string = NULL;

	public $name = NULL;

	public $aspect_ratio = NULL;

	public $abbrevation = NULL;

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
	public $Database_Table = "screen_sizes";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function Screen_Size(){
		$this->_CI =& get_instance();
		self::Config($this->_CI);;
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
	}
}