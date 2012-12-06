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
			"save_selections" => $this->user_control->GetSetting("save_selection","true")
		);
		$this->user_control->batch_load_lang_files(array(
			"modals",
			"user_settings",
			"computers"
		));
		$this->load->view("front_view",$this->computerinfo_security->ControllerInfo($data));
	}
}