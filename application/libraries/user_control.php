<?php
class User_Control{

	/**
	 * A pointer to the current instance of CodeIgniter
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_CI = NULL;

	/**
	 * The current user language
	 * @var string
	 * @since 1.0
	 * @access public
	 */
	public $language = "english";

	/**
	 * This function calls all the needed security functions
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		$this->_CI =& get_instance();
		$this->_CI->load->config("settings");
		if (empty($this->language)) {
			$this->language = $this->_CI->config->item("language");
		}
		self::batch_load_lang_files(array(
			"pages",
			"info",
			"messages",
			"errors",
			"modals",
			"captcha",
			"login"
		));
	}

	/**
	 * This function loads up lang files using an array
	 * @param  array  $files The array of file without extension and _lang
	 * @since 1.0
	 * @access public
	 */
	public function batch_load_lang_files ( array $files ) {
 		foreach ($files as $file) {
 			$this->_CI->lang->load($file, $this->language);
 		}
	}
}
?>