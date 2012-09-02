<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Token extends Std_Library{

	/**
	 * The database id of the token
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $id = NULL;

	/**
	 * The actual token
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $token = NULL;

	/**
	 * The user that owns the token
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $user = NULL;

	/**
	 * The time where the token was created
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $created = NULL;

	/**
	 * If this property is set to
	 * 1 then it indicates that the token lives as long as the user 
	 * doenst revocs it
	 * @var integer
	 * @since 1.0
	 * @access public
	 */
	public $offline = NULL;

	/**
	 * The time in seconds this token is available,
	 * 0 means for ever
	 * @var integer
	 */
	public $time_to_live = 0;

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
	public $Database_Table = "tokens";

	/**
	 * This is the constructor, it configurates the std library
	 * @since 1.0
	 * @access private
	 */
	public function __construct(){
		parent::__construct();
		$this->_CI =& get_instance();
		$this->_INTERNAL_EXPORT_INGNORE = 	array(
			"CI",
			"Database_Table",
			"_CI"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = 	array(
			"user" => "User"
		);
		$this->_INTERNAL_SIMPLE_LOAD = 		array(
			"user" => true
		);
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"user_id" => "user",
			"created_time" => "created"
		);
	}

	/**
	 * This function overrides the normal behaviur of create,
	 * instead it generates a token
	 * @param boolean $Save If the token is going to be saved to the database
	 * @param integer $UserId The id of the user to create the token for
	 * @since 1.0
	 * @access public
	 */
	public function Create($UserId = NULL,$Save = true){
		if(!is_null($UserId)){
			self::Import(array("user" => $UserId));
		}
		if(is_null($this->offline)){
			$this->offline = 0;
		}
		$this->_CI->load->config("api");
		$this->_CI->load->helper("string");
		if ($this->offline == 0) {
			$this->time_to_live = $this->_CI->config->item("token_time_to_live");
		} else {
			$this->time_to_live = 0;
		}	
		$this->token = Rand_Str($this->_CI->config->item("token_length"));
		$this->created = time();
		if($Save && isset($this->user->id) && isset($this->user->name)){
			self::Save();
		}
	}
}