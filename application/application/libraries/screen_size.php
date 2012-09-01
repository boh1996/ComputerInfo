<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Size extends Std_Library{

	/**
	 * The database id of the screen size
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The width in pixels of the screen
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $width = NULL;

	/**
	 * The height in pixels of the screen
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $height = NULL;

	/**
	 * The input detection string of the screen size 1200x800 etc
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $detection_string = NULL;

	/**
	 * The name of the screen size
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = NULL;

	/**
	 * The aspect reation of the screen 4:3 etc
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $aspect_ratio = NULL;

	/**
	 * An optional abbrevation for the screen size
	 * @since 1.0
	 * @access public
	 * @var string
	 */
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
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("detection_string");
	}
}