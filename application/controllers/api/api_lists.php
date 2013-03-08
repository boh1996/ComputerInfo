<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/CI_API_Controller.php');  

/**
 * The endpoints used to recieve different lists of manufacturers etc
 * 
 * @author Bo Thomsen <bo@illution.dk>
 */
class API_Lists extends CI_API_Controller {

	/**
	 * Used to control security, overrides the REST_Controller version
	 * @var array
	 * @since 1.0
	 */
	protected $methods = array(
		"manufacturers_get" => array("key" => false),
		"screen_models_get" => array("key" => false),
		"computer_models_get" => array("key" => false),
		"printer_models_get" => array("key" => false),
		"device_models_get" => array("key" => false)
	);	

	/**
	 * Class constructor, to load up needed ressources
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("batch_loader");
	}

	/**
	 * Outputs a list of manufacturers,
	 * use &limit, &fields and &offset to change the output
	 *
	 * @since 1.0
	 * @return array
	 */
	public function manufacturers_get () {
		$Loader = new Batch_Loader();

		$parameters = array("name","abbrevation");

		$result = $Loader->Load("manufacturers", "Manufacturer", null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs a list of the available printer models,
	 * use &fields, &limit, &offset to customize the output and different object properties for searching
	 *
	 * @since 1.0
	 * @return array
	 */
	public function printer_models_get () {
		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("printer_models", "Printer_Model", null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters))

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs a list of available device models.
	 * use &fields to select which fields to load,
	 * &limit and &offset to paginate,
	 * and different object properties to search
	 *
	 * @since 1.0
	 * @return array
	 */
	public function device_models_get () {
		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("device_models", "Device_Model", null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters))

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs a lists of the available screen models,
	 * use &fields to select which data members to load and output,
	 * &limit and &offset to perform pagination,
	 * and different data members to search
	 *
	 * @since 1.0
	 * @return array
	 */
	public function screen_models_get () {
		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("screen_models", "Screen_Model", null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters))

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs a list of available screen models,
	 * use &fields to select which data members to load and show,
	 * &limit and &offset to make pagination,
	 * and different data members to search for content
	 *
	 * @since 1.0
	 * @return array
	 */
	public function computer_models_get () {
		$Loader = new Batch_Loader();

		$parameters = array("name");

		$result = $Loader->Load("computer_models", "Computer_Model", null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters))

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}
}
?>