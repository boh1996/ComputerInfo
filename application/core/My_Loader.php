<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Loader extends CI_Loader {

	/**
	 * Constructor function, defines the standard template dir
	 */
	public function __construct () {
		if( ! defined('TEMPLATE_PATH') ) {
			$directory = config_item("template_dir");
			
			if ( $directory != "" || $directory !== false ) {
				define("TEMPLATE_PATH", str_replace("{{APPPATH}}", APPPATH, $directory));
			} else {
				define('TEMPLATE_PATH', APPPATH . 'templates/');
			}

			$extension = config_item("template_ext");

			if ( $extension != "" || $extension !== false ) {
				define("TEMPLATE_FILE_EXTENSION", $extension);
			} else {
				define('TEMPLATE_FILE_EXTENSION', '.php');
			}
		}

		parent::__construct();
	}

	/**
	 * Loads up templates, from the templates directory
	 *
	 * @param  string $template  The template and extra directory for the template
	 * @param  array $variables The variables to extract for the template
	 * @param boolean $return If the content should be returned
	 * @return boolean
	 */
	public function template ( $template, $variables = null, $return = false ) {
		if ( is_bool($variables) ) {
			$return = $variables;
		}

		if ( is_array($template) ) {

			foreach ( $template as $t) {
				$this->template($t);
			}

			return true;
		}

		$template = ltrim($template,"/");
		$template = rtrim($template,"/");

		$template_path = TEMPLATE_PATH . "/" . $template . TEMPLATE_FILE_EXTENSION;

		if ( ! file_exists($template_path) ) return false;

		if ( is_array($this->_ci_cached_vars) || is_array($variables) ) {
			if ( is_array($variables) ) {
				$this->_ci_cached_vars = array_merge($this->_ci_cached_vars, $variables);
			}
			extract($this->_ci_cached_vars);
		}

		ob_start();

		if ( ! is_php('5.4') && (bool) @ini_get('short_open_tag') === FALSE
			&& config_item('rewrite_short_tags') === TRUE && function_usable('eval') 
		) {
			echo eval('?>'.preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($_ci_path))));
		} else {
			include_once($template_path);
		}

		if ( $return === TRUE ) {
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}

		if ( ob_get_level() > $this->_ci_ob_level + 1) {
			ob_end_flush();
		} else {
			$_ci_CI->output->append_output(ob_get_contents());
			@ob_end_clean();
		}

		return true;
	}
}
?>