<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen_Pixel_Type extends Std_Library{

	/**
	 * The database id of the screen pixel type
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The name of the screen screen pixel type
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
	public $Database_Table = "screen_pixel_types";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("name");
	}
}