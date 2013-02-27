<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The ednpoints used for updating CodeIgniter
 *
 * @author Bo Thomsen <bo@illution.dk>
 * @version 1.0
 */
class API_Codeigniter extends CI_API_Controller {

	/**
	 * Overrides $methods in REST_Controller,
	 * used to control which methods that should use keys and logging
	 *
	 * @var array
	 */
	protected $methods = array(
		"version_check_get" => array("key" => false),
		"remote_version_get" => array("key" => false),
		"version_get" => array("key" => false)
	);
	
	/**
	 * This function outputs the newest version of CodeIgniter
	 * 
	 * @since 1.0
	 * @return string The newest stable version of CodeIgniter
	 */
	protected function remote_version_get () {
		echo file_get_contents("http://versions.ellislab.com/codeigniter_version.txt");
	}

	/**
	 * This function outputs if the installed version is the newest available version of CodeIgniter
	 * 
	 * @since 1.0
	 */
	protected function version_check_get () {
		$newestVersion = file_get_contents("http://versions.ellislab.com/codeigniter_version.txt");
		$installedVersion = CI_VERSION;
		echo ($newestVersion == $installedVersion)? "false" : "true";
	}

	/**
	 * This function outputs the current version of CodeIgniter
	 * 
	 * @since 1.0
	 */
	protected function version_get () {
		echo CI_VERSION;
	}
}