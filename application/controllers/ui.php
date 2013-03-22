<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UI extends CI_Controller {

	/**
	 * This function recives all the calls when a page is requested
	 * @since 1.0
	 * @access public
	 */
	public function _remap($method = NULL,$params = array()) {
		$languages = $this->config->item("languages");
		$language = $this->user_control->GetUserLanguage();
		$this->user_control->batch_load_lang_files(array(
			"modals",
			"user_settings",
			"computers",
			"front",
			"device",
			"printer",
			"location",
			"ui_table",
			"datatables"
		));
		$data = array(
			"method" => $method,
			"params" => json_encode($params),
			"languageString" => $languages[$language],
			"language" => $language,
			"save_selections" => $this->user_control->GetSetting("save_selection","true"),
			"front_translations" => json_encode(array(
				"error_an_error_occured" => $this->lang->line('error_an_error_occured'),
				"computer_page" 	=> $this->lang->line('ui_computer_page'),
				"location_page"		=> $this->lang->line('ui_location_page'),
				"device_page"		=> $this->lang->line('ui_device_page'),
				"computers_page" 	=> $this->lang->line('ui_computers_page'),
				"brand_title" 		=> $this->lang->line('ui_title_brand'),
				"page_template" 	=> $this->lang->line("ui_page_title_template"),
				"printers_page"		=> $this->lang->line("ui_printers_page"),
				"units_page"		=> $this->lang->line("ui_units_page"),
				"roomts_page"		=> $this->lang->line("ui_rooms_page"),
				"screens_page"		=> $this->lang->line("ui_screens_page"),
				"users_page"		=> $this->lang->line("ui_users_page"),
				"settings_page"		=> $this->lang->line("ui_settings_page"),
				"computer_not_found"	=> $this->lang->line("ui_computer_not_found"),
				"page_not_found"	=> $this->lang->line("error_page_not_found"),
				"element_not_found" => $this->lang->line("ui_element_not_found"),
				"printer_page"		=> $this->lang->line("ui_printer_page"),
				"color_printer"		=> $this->lang->line("printer_color"),
				"black_white_printer"		=> $this->lang->line("printer_black_white"),
			))
		);
		$this->load->view("front_view",$this->computerinfo_security->ControllerInfo($data));
	}
}