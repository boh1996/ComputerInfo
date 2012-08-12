<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Memory_Slot extends Std_Library{

	/**
	 * The database id of the device
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * If the memory slot is empty
	 * @since 1.0
	 * @access public
	 * @var boolean
	 */
	public $empty = NULL;

	/**
	 * The size of the RAM inserted in this memory slot
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $capacity = NULL;

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
	public $Database_Table = "computer_memory_slots";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_EXPORT_FORMATING = array(
			"empty" => "boolean"
		);
	}
}