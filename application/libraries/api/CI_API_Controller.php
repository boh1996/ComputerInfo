<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'libraries/api/API_Controller.php');  

/**
 * ComputerInfo API Controller for CodeIgniter
 *
 * An Wrapper for the API Controller
 *
 * @uses 			API Controller Extends the API_Controller and REST Controller <https://github.com/philsturgeon/codeigniter-restserver>
 * @package        	ComputerInfo
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Bo Thomsen
 * @version 		1.0
 */
class CI_API_Controller extends API_Controller {

	/**
	 * The current user
	 *
	 * @since 1.0
	 * @access protected
	 * @var object
	 */
	public $user = null;

	/**
	 * The requested fields to use
	 * @since 1.0
	 * @var array
	 */
	public $fields = null;

	/**
	 * The constructor
	 */
	public function __construct () {
		parent::__construct();
		$this->load->library("user");
	}

	/**
	 * This function is called just before the controller methods
	 *
	 * @since 1.0
	 * @access protected
	 */
	protected function before_method () {
		$this->fields = ($this->get("fields") != false) ? explode(",", $this->get("fields")) : null;
	}

	/**
	 * Returns an array of selected fields
	 *
	 * @since 1.0
	 * @return array|null
	 */
	protected function fields () {
		return ( ! is_null($this->fields) ) ? $this->fields : null;
	}

	/**
	 * This function checks if the token is valid
	 * 
	 * @see REST_Controller->_is_key_valid
	 * @param  object  $row The database row
	 * @return boolean      If the key is valid
	 */
	protected function _is_key_valid ( $row ) {
		$this->user = new User();
		$this->user->Load($row->user_id);
		define("STD_LIBRARY_CURRENT_USER",$this->user->id);
		if ( $row->offline == "1" ) {
			return $this->user->_INTERNAL_LOADED === true;
		} else {
			$current_time = (int)time();
			$valid = $row->created_time + $row->time_to_live > $current_time;
			return $valid && $this->user->_INTERNAL_LOADED === true;
		}
	}

	/**
	 * Returns if the user agent is from the ComputerInfo android or windows application
	 *
	 * @since 1.0
	 * @access public
	 * @return boolean
	 */
	protected function is_application () {
		return ( $this->server("HTTP_USER_AGENT") == "CI/Windows" || $this->server("HTTP_USER_AGENT") == "CI/Android" ) ? true : false;
	}

	/**
	 * This function checks if the user has access to watch that content
	 * @param string $node   The node where to check for a "organization" id etc
	 * @param object $object The object to check in
	 * @param integer $id     The id to check for
	 * @return boolean
	 * @since 1.0
	 * @access protected
	 */
	protected function has_access($node = null,$object = null,$id = null){
		$id = $this->get_id($id);
		if ( $id === false ) return false;
		if ( ! is_null($node) && is_string($node) && ! is_null($object) && ! is_null($id) && is_integer($id) ) {
			if ( is_array($object) ) {
				$return = false;
				foreach ( $object as $key => $element ) {
					if ( $this->check_access($element,$id,$node) ) {
						$return = true;
					}
				}
				return $return;
			} else {
				return $this->check_access($object, $id, $node);
			}
		} else {
			return false;
		}
		
	}

	/**
	 * Wraps output data in "result" object
	 * 
	 * @param  string|integer|array|object $data Data to output
	 * @param  null|integer $code Error code
	 */
	public function response ( $data = null, $code = 200) {
		if ( count($data) > 0 && ! isset($data["status"]) ) {
			parent::response(array("result" => $data,"error_code" => null,"error" => null,"status" => true), $code);
		} else if ( count($data) > 0 ) {
			parent::response($data, $code);
		} else {
			parent::response(array(), $code);
		}
	}

	/**
	 * This function get's the id for the has access function
	 * @since 1.0
	 * @access protected
	 * @return boolean|integer
	 * @param object|array|integer|string $id The integer or object to check
	 */
	protected function get_id ( $id ) {
		if ( is_array($id) ) {
			return ( isset($id[0]) && is_object($id[0]) && property_exists($id[0], "id") ) ? $id[0]->id : false;
		} else if ( is_integer($id) ) {
			return $id;
		} else {
			if ( is_object($id) && property_exists($id, "id") ) {
				return $id->id;
			} else {
				return ( ! is_null($id) ) ? (int)$id : false;
			}
		}
	}

	/**
	 * This function is used to repeat the check access progress
	 * @since 1.0
	 * @access protected
	 * @param object $element The object to check in
	 * @param integer $id      The id to check for
	 * @param string $node    The node to check in
	 * @return boolean
	 */
	protected function check_access ( $element = null, $id = null,$node = null ) {
		if( ! is_null($node) && is_string($node) && ! is_null($element) && is_object($element) && ! is_null($id) && is_integer($id) && property_exists($element, $node) ){
			if( is_array($element->{$node}) ){
				$return = false;
				foreach ( $element->{$node} as $object ) {
					if( is_object($object) ){
						if( property_exists($object, "id") && $object->id == $id ){
							$return = true;
						}
					} else {
						if( $object == $id ){
							$return = true;
						}
					}
				}
				return $return;
			} else {
				if( is_object($element->{$node}) ){
					if( property_exists($element->{$node}, "id") ){
						return ( $element->{$node}->id == $id );
					} else {
						return false;
					}
				} else {
					return ( $element->{$node} == $id );
				}
			}
		} else {
			return false;
		}
	}
}
?>