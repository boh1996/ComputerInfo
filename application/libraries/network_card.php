<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Network_Card extends Std_Library{

	/**
	 * The database id of the network card
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The Network Card Model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * The network card device identifier
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	public $device_identifier = null;

	/**
	 * The Windows GUID for the network card
	 * This identifier should be unique
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $guid = null;

	/**
	 * The Adapter type object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $adapter_type = null;

	/**
	 * The mac address for the network card
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $mac_address = null;

	/**
	 * The max speed of the network card
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $max_speed = null;

	/**
	 * The ip addresses of the network card
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $ip_addresses = null;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "network_cards";

	/**
	 * This is the constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array(
			"adapter_type",
			"model"
		);
		$this->_INTERNAL_DATABASE_EXPORT_INGNORE = array("id");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = 	array(
			"device_identifier",
			"computer_id"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"adapter_type" => "Network_Card_Adapter_Type",
			"model" => "Network_Card_Model"
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"network_card_model_id" => "model",
			"network_adapter_type_id" => "adapter_type"
		);
	}
}