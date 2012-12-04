<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Manufacturer extends Std_Library{

	/**
	 * The database id of the manufaturer
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The name of the manufacturer
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $name = NULL;

	/**
	 * The webiste of the manufacturer
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $website = NULL;

	/**
	 * The hardware detection string
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $detection_string = NULL;

	/**
	 * The abbrevation of the manufacturer HP as an example
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $abbrevation = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "manufacturers";

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
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array(
			"manufacturer"
		);
	}
}