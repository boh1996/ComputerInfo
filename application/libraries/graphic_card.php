<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Graphic_Card extends Std_Library{

	/**
	 * The database id of the graphic card
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The Graphic Card Model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * The current driver version of the Computers Graphics Driver
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $driver_version = NULL;

	/**
	 * The release date of the current Graphics Driver
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $driver_date = NULL;

	/**
	 * The screen size object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $screen_size = NULL;

	/**
	 * The size of the Graphic card memory
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $ram_size = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "graphics_cards";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("screen_size");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"screen_size" => "Screen_Size",
			"model" => "Graphic_Card_Model"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"screen_size_id" => "screen_size",
			"graphics_card_model_id" => "model"
		);
	}
}