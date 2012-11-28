<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Graphic_Card_Model extends Std_Library{

	/**
	 * The database id of the graphic card
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The caption displayed in the OS
	 * @var string
	 * @since 1.03
	 * @access public
	 */
	public $caption = NULL;

	/**
	 * The manufacturer object of the graphic card manufacturer
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $manufacturer = NULL;

	/**
	 * The name of the graphic card
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The graphic card description
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $description = NULL;

	/**
	 * The name of the graphic card video processor
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $video_processor = NULL;

	/**
	 * The graphics card model detection string
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $detection_string = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "graphics_card_models";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"manufacturer" => "Manufacturer"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"manufacturer_id" => "manufacturer",
		);
	}
}