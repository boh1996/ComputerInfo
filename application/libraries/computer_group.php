<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Computer_Group extends Std_Library{

	/**
	 * The database id of the object
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The owner organization object of the group
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $organization = NULL;

	/**
	 * The name of the group
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $name = NULL;

	/**
	 * An array of the members of the group
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $members = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "computer_groups";

	/**
	 * This function is the constructor it configurates the,
	 * Std_Library.
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array(
			"id"
		);
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array(
			"organization"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"members" => "Computer",
			"organization" => "Organization"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization"
		);
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array(
			"name",
			"organization"
		);
		$this->_INTERNAL_FORCE_ARRAY = array(
			"members"
		);
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_SIMPLE_LOAD = array(
			"members" => true
		);
		$this->_INTERNAL_LINK_PROPERTIES = array("members" => array("computer_groups_members",array("group_id" => "id"),"computer_id",array("group_id","computer_id")));
	}
}