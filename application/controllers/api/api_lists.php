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
		"data_endpoint_get" => array("key" => false),
		"languages_get" => array("key" => false),
	);

	/**
	 * Settings array for the simple data export endpoints
	 * 
	 * @since 1.0
	 * @var array
	 */
	protected $endpoints = array(
		"device_categories" => array("parameters" => array("name"), "class" => "Device_Category"),
		"manufacturers" => array("parameters" => array("name","abbrevation"), "class" => "Manufacturer"),
		"printer_models" => array("parameters" => array("name", "manufacturer"), "class" => "Printer_Model"),
		"screen_models" => array("parameters" => array("name", "manufacturer"), "class" => "Screen_Model"),
		"computer_models" => array("parameters" => array("name", "manufacturer"), "class" => "Computer_Model"),
		"device_models" => array("parameters" => array("name", "manufacturer"), "class" => "Device_Model"),
		"device_types" => array("parameters" => array("name","category"), "class" => "Device_Type"),
		"processor_models" => array("parameters" => array("name","family"), "class" => "Processor_Model"),
		"screen_sizes" => array("parameters" => array("name", "width", "height", "detection_string"), "class" => "Screen_Sie"),
		"graphics_card_models" => array("parameters" => array("name", "manufacturer"), "class" => "Graphic_Card_Model"),
		"physical_drive_models" => array("parameters" => array("name", "manufacturer"), "class" => "Physical_Drive_Model"),
		"operating_system_editions" => array("parameters" => array("name", "manufacturer"), "class" => "Operating_System_Edition"),
		"operating_system_versions" => array("parameters" => array("name", "operating_system"), "class" => "Operating_System_Version"),
		"computer_series" => array("parameters" => array("name", "manufacturer"), "class" => "Computer_Series"),
		"operating_systems" => array("parameters" => array("name", "family"), "class" => "Operating_System"),
		"operating_system_families" => array("parameters" => array("name", "manufacturer"), "class" => "Operating_System_Family"),
		"operating_system_cores" => array("parameters" => array("name", "manufacturer"), "class" => "Operating_System_Core"),
		"screen_series" => array("parameters" => array("name", "manufacturer"), "class" => "Screen_Series"),
		"processor_families" => array("parameters" => array("name", "manufacturer", "architecture"), "class" => "Processor_Family"),
		"processor_architectures" => array("parameters" => array("manufacturer", "name"), "class" => "Processor_Architecture"),
		"drive_types" => array("parameters" => array("name"), "class" => "Drive_Type"),
		"network_card_adapters" => array("parameters" => array("name", "manufacturer"), "class" => "Network_Card_Adapter"),
		"video_architectures" => array("parameters" => array(), "class" => "Video_Architecture"),
		"screen_pixel_types" => array("parameters" => array("name"), "class" => "Screen_Pixel_Type"),
		"printer_capabilities" => array("parameters" => array("name"), "class" => "Printer_Capability"),
	);

	/**
	 * Class constructor, to load up needed ressources
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("batch_loader");
	}

	/**
	 * Endpoint used for all simple data export endpoints
	 *
	 * @since 1.0
	 * @param  string $endpoint The endpoint setting name
	 * @return array
	 */
	public function data_endpoint_get ( $endpoint = null ) {
		if ( is_null($endpoint) || ! isset($this->endpoints[$endpoint]) ) {
			self::error(404);
		}

		$this->load->library($this->endpoints[$endpoint]["class"]);

		$Object = new $this->endpoints[$endpoint]["class"]();

		$Loader = new Batch_Loader();

		$parameters = ( isset($this->endpoints[$endpoint]["parameters"]) ) ? $this->endpoints[$endpoint]["parameters"] : null;

		$get_parameter = ( isset($this->endpoints[$endpoint]["objects_key"]) ) ? $this->endpoints[$endpoint]["objects_key"] : $endpoint;

		if ( $this->get($get_parameter) !== false ) {
			$this->db->where_in("id", explode(",", $this->get($get_parameter)));
		}

		$result = $Loader->Load($Object->Database_Table, $this->endpoints[$endpoint]["class"], null, $this->limit(), $this->offset(), $this->fields(), $this->query($parameters));

		if ( $result === false || is_null($result) ) {
			self::error(404);
		}

		$this->response($result);
	}

	/**
	 * Outputs all languages
	 * 
	 * @return array
	 */
	public function languages_get () {
		if ( $this->config->item("languages") != "" ) {
			$this->response($this->config->item("languages"));
		} else {
			self::error(404);
		}
	}
}
?>