<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Lang extends CI_Lang{

    /**
     * This function fetches a line from the current selected langauge
     * @since 1.0
     * @access public
     * @param  string $line   The language key to fetch
     * @param boolean $log_errors If language errros should be logged
     * @param  array $params Optional "tokens/variables" to replace in the line
     * @return string
     */
    public function line ($line = "", $log_errors = true, $params = null) {

        if ( !is_bool($log_errors) ) {
            $params = $log_errors;
        }

        $return = parent::line($line, $log_errors);
            
        if ( $return === false ) {
            return "$line";
        } else{
            if (!is_null($params)){
                $return = $this->_ni_line($return, $params); 
            }
            return $return;
        }

    }
    
    /**
     * This function replaces the specified tokens in the language line
     * @since 1.0
     * @access public
     * @param  stirng $str    The string to replace the tokesn in
     * @param  array $params The tokens to replace and their replacements
     * @return string
     */
    private function _ni_line($str, $params){
        $return = $str;
        
        $params = is_array($params) ? $params : array($params);   
        
        $search = array();
        $cnt = 1;
        foreach($params as $param){
            $search[$cnt] = "/\\${$cnt}/";
            $cnt++;
        }
                
        unset($search[0]);
        
        $return = preg_replace($search, $params, $return);
        
        return $return;
    }
}
?>