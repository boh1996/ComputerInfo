<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Translations extends CI_Controller {

	/**
	 * This function can be seen as a AutoLoader for this controller
	 * @since 1.0
	 * @access public
	 */
	public function __construct (){
		parent::__construct();
		$this->user_control->batch_load_lang_files(array(
			"ui_table",
			"datatables"
		));
		header("Content-Type: text/javascript");
	}

	/**
	 * This function loads the selected translated view
	 * @param string $file The "file"/"view" to load
	 * @since 1.0
	 * @access public
	 */
	public function File ($file) {
		switch ($file) {
			case 'settings':
				$this->load->view("settings");
			break;

			case 'datatable':
				$this->load->view("datatables");
			break;
		}
	}
}
?>