<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Print_Location extends Std_Library{

	/**
	 * The database id of the object
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The computer group which is assosiacted with the print location
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $computer_group = NULL;

	/**
	 * The printer group which is connected to the print_location
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $printer_group = NULL;

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
	public $Database_Table = "print_locations";

	/**
	 * This function is the constructor it configurates the,
	 * Std_Library.
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_CI =& get_instance();
		self::Config($this->_CI);
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("computer_group","printer_group");
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"computer_group" => "Computer_Group",
			"printer_group" => "Printer_Group"
		);
		$this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"computer_group_id" => "computer_group",
			"printer_group_id" => "printer_group"
		);
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("printer_group","computer_group");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_CI->_INTERNAL_DATABASE_MODEL->Set_Names($this->_INTERNAL_ROW_NAME_CONVERT,"ROW_NAME_CONVERT");
	}
}