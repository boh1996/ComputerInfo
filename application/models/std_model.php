<?php
/**
 * This is the standard model, for normal data
 * @package Standard Model
 * @license http://illution.dk/copyright © Illution 2012
 * @subpackage Std_Model
 * @category Models
 * @version 1.1
 * @author Illution <support@illution.dk>
 */ 
class Std_Model extends CI_Model{

	/**
	 * This property contains data to convert, 
	 * class property names to databse rows
	 * @var array
	 * @since 1.1
	 * @access private
	 */
	private $_INTERNAL_DATABASE_NAME_CONVERT = NULL;

	/**
	 * This property do the opposite as _INTERNAL_DATABASE_NAME_CONVERT
	 * @var array
	 * @see $_INTERNAL_DATABASE_NAME_CONVERT
	 * @access private
	 * @since 1.1
	 */
	private $_INTERNAL_ROW_NAME_CONVERT = NULL;

	/**
	 * This function is the constructor, it creates a local instance of CodeIgniter
	 * @access public
	 * @since 1.0
	 */
	public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function sets the _INTERNAL_DATABASE_NAME_CONVERT and the _INTERNAL_ROW_NAME_CONVERT property,
     * that is used to convert property names to database rows
     * @param array $Names The names convert array
     * @param string $Type The config option to set properties are "DATABASE_NAME_CONVERT" or "ROW_NAME_CONVERT"
     * @access public
     * @since 1.1
     */
    public function Set_Names($Names = NULL,$Type = "DATABASE_NAME_CONVERT"){
    	if(!is_null($Names) && !is_null($Type) && is_array($Names)){
    		switch($Type){
    			case "DATABASE_NAME_CONVERT":
		        	$this->_INTERNAL_DATABASE_NAME_CONVERT = $Names;
		        	$this->_INTERNAL_ROW_NAME_CONVERT = array();
		        	foreach($Names as $Key => $Value){
		        		$this->_INTERNAL_ROW_NAME_CONVERT[$Value] = $Key;
		        	}
		        break;

		        case "ROW_NAME_CONVERT":
		        	if(!is_null($this->_INTERNAL_ROW_NAME_CONVERT)){
		        		$this->_INTERNAL_ROW_NAME_CONVERT = array_merge($this->_INTERNAL_ROW_NAME_CONVERT,$Names);
		        	} else {
		        		$this->_INTERNAL_ROW_NAME_CONVERT = $Names;
		        	}
		        	if(is_null($this->_INTERNAL_DATABASE_NAME_CONVERT)){
		        		foreach ($Names as $Key => $Value) {
		        			$this->_INTERNAL_DATABASE_NAME_CONVERT[$Value] = $Key;
		        		}
		        	}
		        break;
        	}
        }
    }

    /**
	 * This function uses the internal _INTERNAL_DATABASE_NAME_CONVERT to convert the property names,
	 * to the database row names
	 * @param array $Data The exported data, from the class
	 * @param object $Class The class to get the conversion table from
	 * @access private
	 * @since 1.0
	 * @see _INTERNAL_DATABASE_NAME_CONVERT
	 * @internal This function is only used inside this model, to convert the exported data to the right format
	 * @return array The data with the right key names
	 */
	private function Convert_Properties_To_Database_Row($Data = NULL,&$Class = NULL){
		if(!is_null($Data) && !is_null($Class)){
			if(isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) || isset($this->_INTERNAL_DATABASE_NAME_CONVERT)){
				$Array = array();
				foreach ($Data as $Key => $Value) {
					$Array[self::_Get_Database_Row_Name($Class,$Key)] = $Value;
				}
				return $Array;
			} else {
				return $Data;
			}	
		} else {
			return $Data;
		}
	}

	/**
	 * This function converts the class properties to database row names
	 * @param object $Object The object that is going to be converted
	 * @param string $Key    Thd class property to convert
	 * @since 1.1
	 * @access private
	 * @return string
	 */
	private function _Get_Database_Row_Name($Object = NULL,$Key = NULL){
		if(!is_null($Object) && isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) && array_key_exists($Key, $Object->_INTERNAL_DATABASE_NAME_CONVERT)){
			return $Object->_INTERNAL_DATABASE_NAME_CONVERT[$Key];
		} else if(isset($this->_INTERNAL_DATABASE_NAME_CONVERT) && array_key_exists($Key, $this->_INTERNAL_DATABASE_NAME_CONVERT)){
			return $this->_INTERNAL_DATABASE_NAME_CONVERT[$Key];
		} else {
			return $Key;
		}
	}

	/**
	 * This function loads data from $Table, based on the query in $Link
	 * @param string||array $Table  The table(s) to search in 
	 * @param array $Link   An array with the query
	 * @example
	 * Link("Questions",array("Lmmaa" => "Duck",$this));
	 * @param object &$Class The class where the data is taken from
	 * @param string|array $Select The row/rows to select
	 * @return array An array of the query result data
	 * @since 1.0
	 * @todo  Add a link like, example with, link all the users if their TargetGroup contains this group id
	 * @access public
	 */
	public function Link($Table = NULL,$Link = NULL,&$Class = NULL,$Select = NULL){
		if(!is_null($Table) && !is_null($Link) && !is_null($Class) && is_array($Link)){
			if(is_null($Select)){
				$Select = "Id";
			}
			if(is_array($Select)){
				$Select = implode(",", $Select);
			}
			if(!is_array($Table)){
				$this->db->select($Select);
				$Query = $this->db->get_where($Table,$Link);
				$Result = $Query->result();
				return $Query->result();
			} else {
				$Result = array();
				foreach ($Table as $Name) {
					$this->db->select($Select);
					$Query = $this->db->get_where($Name,$Link);
					$Temp = $Query->result();
					$Result[] = $Temp[0];
				}
				if(count($Result) > 0){
					return $Result;
				}

			}
		}
	}

	/**
	 * This function checks if a row exists in the database
	 * @param integer $Id The database row id for the row to check for
	 * @param string $Table The database table to look up in
	 * @access private
	 * @since 1.0
	 * @return boolean The result, if the user doesn't exist or the input is wrong then FALSE is returned,
	 * else TRUE is returned.
	 */
	private function Exists($Id = NULL,$Table = NULL){
		if(!is_null($Id) && !is_null($Table) && !is_array($Id)){
			$Query = $this->db->where(array("Id" => $Id))->get($Table);
			if(!is_null($Query) && $Query->num_rows() == 0){
				return false;
			}
			else{
				return true;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function loads class data from the database table,
	 * and assign it to the object in $Class
	 * @param integer $Id    An optional database id for the row, if it's not deffined the $Class->Id will be used.
	 * @param object &$Class The class to assign the data too
	 * @return boolean If there's data available and it's loaded true is returned else is false returned
	 * @access public
	 * @since 1.0
	 */
	public function Load($Id = NULL,&$Class = NULL){
		if(!is_null($Class) && property_exists(get_class($Class), "Database_Table")){
			if(!is_null($Id)){
				$Class->Id = $Id;
			}
			if(!is_null($Class->Id) && self::Exists($Class->Id,$Class->Database_Table)){
				$ClassQuery = $this->db->get_where($Class->Database_Table,array("Id" => $Class->Id));
				foreach($ClassQuery->result() as $Row){
					foreach ($Row as $Key => $Value) {
						if(property_exists($this,"_INTERNAL_ROW_NAME_CONVERT") 
							&& is_array($this->_INTERNAL_ROW_NAME_CONVERT) 
							&& array_key_exists($Key, $this->_INTERNAL_ROW_NAME_CONVERT))
						{
							if(property_exists(get_class($Class), $this->_INTERNAL_ROW_NAME_CONVERT[$Key])){
								if(!is_null($Value) && !empty($Value) && $Value != ""){
									if(strpos($Value, ";") !== false){
										$Value = rtrim($Value,";");
										$Value = ltrim($Value,";");
										$Class->{$this->_INTERNAL_ROW_NAME_CONVERT[$Key]} = explode(";", $Value);
									} else {
										$Class->{$this->_INTERNAL_ROW_NAME_CONVERT[$Key]} = $Value;
									}
								}
							}
						} else {
							if(property_exists(get_class($Class), $Key)){
								if(!is_null($Value) && !empty($Value) && $Value != ""){
									if(strpos($Value, ";") !== false){
										$Value = rtrim($Value,";");
										$Value = ltrim($Value,";");
										$Class->{$Key} = explode(";", $Value);
									} else {
										$Class->{$Key} = $Value;
									}
								}
							}
						}
					}
				}
				return TRUE;
			} else {
				return FALSE;
			}
			
		} else {
			return false;
		}
	}

	/**
	 * This function inserts data into the db and return the insert_id
	 * @param object &$Class The class to get the data from
	 * @since 1.0
	 * @access public
	 * @return integer The new database id
	 */
	public function Create(&$Class){
		if(method_exists($Class, "Export") && property_exists(get_class($Class), "Database_Table")){
			$data = $Class->Export(true);
			$this->CI->db->insert($Class->Database_Table, $data); 
			return $this->CI->db->insert_id();
		}
	}

	/**
	 * This function saves the class data to the server
	 * @param object &$Class The instance of the class, with the data to save
	 * @access public
	 * @since 1.0
	 * @return boolean If the operation was succes
	 */
	public function Save(&$Class = NULL){
		if( property_exists($Class, "Database_Table")){
			self::_Data_Exists($Class);
			if((isset($Class->Id) || isset($Class->id)) && self::Exists($Class->Id,$Class->Database_Table)){
				$Data = $Class->Export(true);
				if(property_exists($Class, "Database_Table") && count($Data) > 0){
					$this->db->where(array('Id' => $Class->Id))->update($Class->Database_Table, self::Convert_Properties_To_Database_Row($Data,$Class));
					return true; //Maybe a check for mysql errors
				} else {
					return false;
				}
			}
			else{
				if(isset($Class->Id)){
					$Id = $Class->Id;
				} else if($Class->id){
					$Id = $Class->id;
				} else {	
					$Id = NULL;
				}
				if(!self::Exists($Id)){
					$Data = $Class->Export(true);
					if(!is_null($Data) && !is_null($Class) && count($Data) > 0){
						$this->db->insert($Class->Database_Table, self::Convert_Properties_To_Database_Row($Data,$Class));
						$Class->Id = $this->db->insert_id();
						return true; //Maybe a check for mysql errors?
					} else {
						return FALSE;
					}
				}
			}
		} else {
			return false;
		}
	}

	/**
	 * This function gets an id of a dublicate, if it exists
	 * @param object &$Class The class to get the data from
	 * @return integer If there is an result then the id of the dublicate is returned
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Dublicate_Id(&$Class = NULL){
		if(!is_null($Class)){
			$Data = $Class->Export(true);
			$Data = self::Convert_Properties_To_Database_Row($Data);
			if(is_null($Class->Id)){
				$Query = $this->db->limit(1)->get_where($Class->$Database_Table,$Data);
			} else {
				$Query = $this->db->not_like("Id",$Class->Id)->limit(1)->get_where($Class->$Database_Table,$Data);
			}
			if($Query->num_rows() > 0){
				foreach ($Query->result() as $Row) {
					return $Row->$Id;
				}
			}
		}
	}

	/**
	 * This function get's the data of a classes _INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL,
	 * data
	 * @param object &$Class The reference class
	 * @return boolean The data of the settings property
	 * @since 1.1
	 * @access private
	 */
	private function _Check_For_Data_Dublicate(&$Class = NULL){
		if(!is_null($Class)){
			if(property_exists($Class, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL") && !is_null($Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && is_bool($Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL)){
				return $Class->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}
	}

	/**
	 * This function checks if a class has a full dublicate in the database, if the  true is returned
	 * @param object &$Class The class to get the data from
	 * @return boolean If it has a dublicate
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Duplicate(&$Class = NULL){
		if(!is_null($Class)){
			$Data = $Class->Export(true);
			$Data = self::Convert_Properties_To_Database_Row($Data);
			if(is_null($Class->Id)){
				$Query = $this->db->limit(1)->get_where($Class->$Database_Table,$Data);
			} else {
				if(self::_Check_For_Data_Dublicate($Class)){
					$Query = $this->db->not_like("Id",$Class->Id)->limit(1)->get_where($Class->$Database_Table,$Data);
				} else {
					$Query = NULL;
				}
			}
			if(!is_null($Query) && $Query->num_rows() > 0){
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * This function sets the id of the $Class to an
	 * id of a dublicate if one exists, so the dublicate would be overwritten
	 * @param object &$Class The object to use data for and set data too
	 * @since 1.1
	 * @access private
	 * @return boolean If dublicate data exists
	 */
	private function _Data_Exists(&$Class = NULL){
		if(!is_null($Class)){
			if(self::_Has_Duplicate() != false){
				if(property_exists($Class, "Id")){
					$Class->Id = self::_Get_Duplicate_Id($Class);
					return TRUE;
				}
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function matches, data in the database and if some data exists, then the 
	 * id of the $Class is set to the id of the dublicate
	 * @param object &$Class    The object to set the id of
	 * @param array $QueryData The data to check for
	 * @since 1.1
	 * @access public
	 * @return boolean If matched data was found
	 */
	public function Match_Data(&$Class = NULL,$QueryData = NULL){
		if(!is_null($QueryData) && !is_null($Class) && is_array($QueryData)){
			$QueryData = self::Convert_Properties_To_Database_Row($QueryData,$Class);
			if(property_exists($Class, "Database_Table")){
				$Query = $this->db->limit(1)->get_where($Class->Database_Table,$QueryData);
				if($Query->num_rows() > 0){
					foreach ($Query->result() as $Row) {
						if(property_exists($Class, "Id")){
							$Class->Id = $Row->Id;
							return TRUE;
						}
					}
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates the LIKE query,
	 * and tries to get the right result if the data is splitted
	 * @param array $Array The search query
	 * @param string $Table The table to search in
	 * @param object &$Class The class the is going to be filled with data
	 * @since 1.1
	 * @access private
	 * @return integer The database id of the data
	 */
	 private function _Get_Query_Data($Array = NULL,$Table = NULL,&$Class){
       if(!is_null($Array) && !is_null($Table)){
            $Like = array();
            $Or_Like = array();
            foreach ($Array as $Key => $Value) {
                if(strpos($Value, "$") !== false){
                    $Like[$Key] = str_replace("$", "", ";".$Value.";");
                    $Or_Like[$Key] = str_replace("$", "", $Value);
                } else {
                    $Like[$Key] = $Value;
                    $Or_Like[$Key] = $Value;
                }
            }
            if(property_exists($Class, "id")){
            	$Select = "id";
            } else {
            	$Select = "Id";
            }
           if(count($Like) > 0){
                $this->db->limit(1)->select($Select)->like($Like);
            }
            $Raw = $this->db->get($Table);
            if($Raw->num_rows == 0 && count($Or_Like) > 0){
                $Raw = $this->db->like($Or_Like)->limit(1)->select($Select)->get($Table);
            }
            return $Raw;
        } else {
            return array();
        }
    }

	/**
	 * This function finds a row based on a query, this function always select the first element.
	 * The column names are converted using the Convert_Properties_To_Row function.
	 * @param array $Query The assosiative array containing the search
	 * @param string $Table The table to search in
	 * @param object &$Class The current object
	 * @version 1.1
	 * @access public
	 * @example
	 * @return boolean|integer This function returns FALSE if fail and an id if success.
	 * Find("Name" => "Bo","Users");
	 */
	public function Find($Query = NULL,$Table = NULL,&$Class = NULL){
		if(!is_null($Query) && is_array($Query) && !is_null($Table)){
			$Data = self::Convert_Properties_To_Database_Row($Query,$Class);
			if(!is_null($Data)){
				$Raw = self::_Get_Query_Data($Data,$Table,$Class);
				if($Raw->num_rows() > 0){
					$Row = current($Raw->result());
					if(isset($Row->Id)){
						return $Row->Id;
					} else {
						return $Row->id;
					}
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
?>