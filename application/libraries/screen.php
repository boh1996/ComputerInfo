<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Screen extends Std_Library{

	/**
	 * The database id of the screen
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The identifier of the screen
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $identifier = NULL;

	/**
	 * The screen model object
	 * @var object
	 * @since 1.0
	 * @access public
	 */
	public $model = NULL;

	/**
	 * The organization object
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $organization = NULL;

	/**
	 * The location object of the screen
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $location = NULL;

	/**
	 * The timestamp of the time when the object last was updated
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $last_updated = NULL;

	/**
	 * The timestamp of the time when the object was created in the database
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $created_time = NULL;

	/**
	 * The obect of the user that created the object
	 * @since 1.21
	 * @access public
	 * @var object
	 */
	public $creator_user = NULL;

	/**
	 * The user object of the user that last updated the object
	 * @since 1.21
	 * @access public
	 * @var object
	 */
	public $last_updated_user = NULL;

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "screens";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("identifier","organization");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("organization","model","location");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = true;
		$this->_INTERNAL_OVERWRITE_ON_DUBLICATE = true;
		$this->_INTERNAL_LAST_UPDATED_PROPERTY = "last_updated";
		$this->_INTERNAL_CREATED_TIME_PROPERTY = "created_time";
		$this->_INTERNAL_LAST_UPDATED_USER_PROPERTY = "last_updated_user";
		$this->_INTERNAL_CREATED_USER_PROPERTY = "creator_user";
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"organization_id" => "organization",
			"screen_model_id" => "model",
			"location_id" => "location",
			"creator_user_id" => "creator_user",
			"last_updated_user_id" => "last_updated_user"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"model" => "Screen_Model",
			"organization" => "Organization",
			"location" => "Location",
			"last_updated_user" => "User",
			"creator_user" => "User"
		);
		$this->_INTERNAL_IMPORT_OVERWRITE = array(
			"identifier",
			"model",
			"location"
		);
	}
}