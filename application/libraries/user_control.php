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
	 * The current users object
	 * @since 1.0
	 * @access public
	 * @var object
	 */
	public $user = null;

	/**
	 * The standard language files to load
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public $languageFiles = array(
		"pages",
		"info",
		"messages",
		"errors",
		"modals",
		"captcha",
		"login"
	);

	/**
	 * This function calls all the needed security functions
	 * @since 1.0
	 * @access public
	 */
	public function __construct(){
		$this->_CI =& get_instance();

		$this->_CI->load->library("user");
		$this->_CI->load->config("settings");
		$this->_CI->load->model("settings");
		
		if (isset($_SESSION[$this->_CI->config->item("user_id_session")]) && $this->_CI->computerinfo_security->User_Exists($_SESSION[$this->_CI->config->item("user_id_session")])) {
			$this->user = new User();
			$this->user->Load($_SESSION[$this->_CI->config->item("user_id_session")]);
		} else if (isset($_SESSION[$this->_CI->config->item("user_id_session")])) {
			$this->_CI->computerinfo_security->Logout();
		}
		
		if (isset($_GET["language"]) && array_key_exists($_GET["language"], $this->_CI->config->item("languages"))) {
			$this->language = $_GET["language"];
		} else if (!is_null($this->user)) {
			$language = $this->_CI->settings->Get($this->user->id,array("language"));
			if ($language !== false && array_key_exists($language->value , $this->_CI->config->item("languages"))) {
				$this->language = $language->value;
			}
		}
		if (empty($this->language)) {
			$this->language = $this->_CI->config->item("language");
		}
		self::batch_load_lang_files($this->languageFiles);
	}

	/**
	 * This function loads up lang files using an array
	 * @param  array  $files The array of file without extension and _lang
	 * @since 1.0
	 * @access public
	 */
	public function batch_load_lang_files ( array $files ) {
		$this->languageFiles = array_unique(array_merge($this->languageFiles,$files));
 		foreach ($files as $file) {
 			if (is_file(FCPATH."application/language/".$this->language."/".$file."_lang.php")) {
 				$this->_CI->lang->load($file, $this->language);
 			}
 		}
	}

	/**
	 * This function changes the current language and reloads the standard language files
	 * @since 1.0
	 * @access public
	 * @param string $language The language to change too
	 */
	public function ReloadLanguageFiles ($language) {
		if (array_key_exists($language , $this->_CI->config->item("languages"))) {
			$this->language = $language;
			self::batch_load_lang_files($this->languageFiles);
		}
	}

	/**
	 * This function determines the users language
	 * @since 1.0
	 * @access public
	 */
	public function GetUserLanguage () {
		if (!is_null($this->user)) {	
			$this->_CI->load->model("settings");
			$userLanguage = $this->_CI->settings->Get($this->user->id,array("language"));
			if ($userLanguage === false) {
				$userLanguage = $this->_CI->config->item("language");
			} else {
				$userLanguage = $userLanguage->value;
			}
		} else {
			$userLanguage = $this->_CI->config->item("language");
		}
		return $userLanguage;
	}

	/**
	 * This function returns a users setting if it exists else is the standard returned
	 * @param string $key      The setting key to check for
	 * @param string|boolean|array|integer $standard The standard value if the key doesn't exist
	 * @since 1.0
	 * @access public
	 * @return boolean|string|integer
	 */
	public function GetSetting ($key, $standard) {
		if (!is_null($this->user)) {	
			$this->_CI->load->model("settings");
			$value = $this->_CI->settings->Get($this->user->id,array($key));
			if ($value === false) {
				$value = $standard;
			} else {
				$value = $value->value;
			}
		} else {
			$value = $standard;
		}
		return $value;
	}

	/**
	 * This function replaces all the template variables with the desired value
	 * @param array $variables An array of the keys to replace and the values to replace them with
	 * @param string $template  The template as string
	 * @return string
	 * @since 1.0
	 * @access private
	 */
	public function Template ( $variables, $template ) {
		$content = $template;
		foreach ($variables as $variable => $value) {
			$content = str_replace($variable, $value, $content);
		}
		return $content;
	}
}
?>