<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer_Memory extends Std_Library{

	/**
	 * The database id of the device
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The total amount of physical memory
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $total_physical_memory = NULL;

	/**
	 * An array containing the memory slot objects
	 * @since 1.0
	 * @access private
	 * @var array
	 */
	public $slots = NULL;

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
	public $Database_Table = "computer_memory";

	/**
	 * This is the constructor, it configurates the Std_Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id","slots");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("slots");
		$this->_INTERNAL_FORCE_ARRAY = array("slots");
		$this->_INTERNAL_LINK_PROPERTIES = array(
			"slots" 		=> array("computer_memory_slots",			array("computer_memory_id" 		=> "id"))
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"slots" => "Memory_Slot"
		);
	}
}