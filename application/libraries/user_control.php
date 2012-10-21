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
	public $language = "danish";

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
		$this->_CI->lang->load('pages', $this->language);

	}
}
?>