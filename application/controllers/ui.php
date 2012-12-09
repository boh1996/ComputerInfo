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
		$data = array(
			"method" => $method,
			"params" => json_encode($params),
			"languageString" => $languages[$language],
			"language" => $language,
			"save_selections" => $this->user_control->GetSetting("save_selection","true"),
			"front_translations" => json_encode(array(
				"computer_page" 	=> $this->lang->line('ui_computer_page'),
				"computers_page" 	=> $this->lang->line('ui_computers_page'),
				"brand_title" 		=> $this->lang->line('ui_title_brand'),
				"page_template" 	=> $this->lang->line("ui_page_title_template"),
				"printers_page"		=> $this->lang->line("ui_printers_page"),
				"units_page"		=> $this->lang->line("ui_units_page"),
				"roomts_page"		=> $this->lang->line("ui_rooms_page"),
				"screens_page"		=> $this->lang->line("ui_screens_page"),
				"users_page"		=> $this->lang->line("ui_users_page"),
				"settings_page"		=> $this->lang->line("ui_settings_page"),
				"computer_not_found"	=> $this->lang->line("ui_computer_not_found")
			))
		);
		$this->user_control->batch_load_lang_files(array(
			"modals",
			"user_settings",
			"computers",
			"front"
		));
		$this->load->view("front_view",$this->computerinfo_security->ControllerInfo($data));
	}
}