<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Operating_System_Installation extends Std_Library{

	/**
	 * The database id of the operating system installation
	 * @since 1.0
	 * @access public
	 * @var integer
	 */
	public $id = NULL;

	/**
	 * The computer named, showed in the OS
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $computer_name = NULL;

	/**
	 * A integer representing the date and time,
	 * when the OS was installed on the current machine
	 * @since 1.0
	 * @access public
	 * @var string|integer
	 */
	public $install_date = NULL;

	/**
	 * If the current installation is 65-bit or 32-bit
	 * @var string
	 * @since 1.0
	 */
	public $architecture = NULL;

	/**
	 * The current service pack, that is installed,
	 * this feature is mostly used on Windwos
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $service_pack = NULL;

	/**
	 * The partition where the OS is installed
	 * @since 1.0
	 * @access public
	 * @var string
	 * @todo Add a link to the "Hard Drive Object" instead
	 */
	public $system_drive = NULL;

	/**
	 * The current major, minor, and build number of the installed OS
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $version = NULL;

	/**
	 * An object containing the current edition of the current installed OS
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $edition = NULL;

	/**
	 * An object linking the the real OS object
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $core = NULL;

	### Class Settings ###

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = "operation_system_installations";

	/**
	 * The constructor, it configurates the Std Library
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		$this->_INTERNAL_EXPORT_INGNORE = array("CI","Database_Table","_CI");
		$this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = array("computer_id");
		$this->_INTERNAL_SAVE_THESE_CHILDS_FIRST = array("core","edition");
		$this->_INTERNAL_ROW_NAME_CONVERT = array(
			"operating_system_version_id" => "core",
			"operating_system_edition_id" => "edition"
		);
		$this->_INTERNAL_LOAD_FROM_CLASS = array(
			"core" => "Operating_System_Version",
			"edition" => "Operating_System_Edition"
		);
	}
}