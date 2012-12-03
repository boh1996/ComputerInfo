<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Network_Card_Adapter_Type extends Std_Library{

	/**
	 * The database id of the network card adapter type
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The network adapter type detection string
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $detection_string = null;
 	
 	/**
 	 * The readable name of the network adapter type
 	 * @since 1.0
 	 * @access public
 	 * @var string
 	 */
	public $name = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "network_card_adapter_types";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"detection_string"
		);
	}
}