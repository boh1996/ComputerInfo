<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * This class i used as a parent for all the data classes,
 * the most of the other libraries is inherited from this library.
 * @package Libraries
 * @license http://illution.dk/copyright © Illution 2012
 * @subpackage Std Data Library Template
 * @category Library template
 * @version 1.1
 * @author Illution <support@illution.dk>
 */ 
class Std_Library{

	/**
	 * This variable stores the database table for the class
	 * @var string
	 * @access public
	 * @since 1.0
	 */
	public $Database_Table = NULL;

	/**
	 * This property is used to convert class property names,
	 * to database row names
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal name convert table
	 * @example
	 * $_INTERNAL_DATABASE_NAME_CONVERT = array("Facebook_Id" =>"Facebook");
	 */
	public static $_INTERNAL_DATABASE_NAME_CONVERT = NULL;

	/**
	 * This property can contain properties to be ignored when exporting
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an class variable used for ignoring variables in export
	 * @example
	 * $_INTERNAL_EXPORT_INGNORE = array("CI","_CI");
	 */
	public static $_INTERNAL_EXPORT_INGNORE = NULL;

	/**
	 * This property can contain properties to be ignored, when the database flag is true in export.
	 * @var array
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal ignoring list for export with the database flag turned on
	 * @example
	 * $_INTERNAL_DATABASE_EXPORT_INGNORE = array("Id");
	 */
	public static $_INTERNAL_DATABASE_EXPORT_INGNORE = NULL;

	/**
	 * This property contain values for converting databse rows to class properties
	 * @var array
	 * @see $_INTERNAL_DATABASE_NAME_CONVERT
	 * @access public
	 * @static
	 * @since 1.0
	 * @internal This is an internal databse column to class property convert table
	 * @example
	 * $_INTERNAL_ROW_NAME_CONVERT = array("Facebook" => "Facebook_Id");
	 */
	public static $_INTERNAL_ROW_NAME_CONVERT = NULL;

	/**
	 * This property contains the database model to use
	 * @var object
	 * @since 1.0
	 * @access public
	 * @static
	 * @example
	 * $this->_CI->load->model("Model_User","_INTERNAL_DATABASE_MODEL");
	 * @internal This property holds the CodeIgniter database model, 
	 * for importing and saving data for the class
	 * @example
	 * $this->_CI->load->model("Std_Model","_INTERNAL_DATABASE_MODEL");
	 */
	public static $_INTERNAL_DATABASE_MODEL = NULL;

	/**
	 * This property is used to define class properties that should be filled with objects,
	 * with the data that the property contains
	 * The data is deffined like this:
	 * $_INTERNAL_LOAD_FROM_CLASS = array("Property Name" => "Class Name To Load From");
	 * @var array
	 * @since 1.0
	 * @access public
	 * @static
	 * @internal This is a class setting variable
	 * @example
	 * $_INTERNAL_LOAD_FROM_CLASS = array("TargetGroup" => "Group");
	 */
	public static $_INTERNAL_LOAD_FROM_CLASS = NULL;

	/**
	 * This property is used to declare link's between other databases and a class property in this class
	 * @var array
	 * @since 1.0
	 * @access public
	 * @example
	 * @static
	 * $this->_INTERNAL_LINK_PROPERTIES = array("Questions" => array("Questions",array("SeriesId" => "Id"),array("Properties to select data from")));
	 * @see Link
	 */
	public static $_INTERNAL_LINK_PROPERTIES = NULL;

	/**
	 * This property is used to determine what properties is going to be ignored,
	 * if the secrure parameter is turned on in the export function
	 * @var array
	 * @since 1.0
	 * @static
	 * @access public
	 * @example
	 * $this->_INTERNAL_LINK_PROPERTIES = array("Email,"Google_Id");
	 */
	public static $_INTERNAL_SECURE_EXPORT_IGNORE = NULL;

	/**
	 * This property is used to give a property of each childobject in a property a given value
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is a class settings property
	 * @example
	 * array("Class Property" => array("Property" => "Value or name of property of this class"));
	 */
	public static $_INTERNAL_SAVE_LINK = NULL;

	/**
	 * This property is used to force a specific property to be an array
	 * @var array
	 * @static
	 * @access public
	 * @since 1.0
	 * @example
	 * $this->_INTERNAL_FORCE_ARRAY = array("Questions");
	 */
	public static $_INTERNAL_FORCE_ARRAY = NULL;

	/**
	 * This property is used to deffine properties, in the LOAD_FROM_CLASS
	 * that should only load their children with the simple mode turned on
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @example
	 * array("Class Property" => "Boolean");
	 * @internal This is a class setting property
	 */
	public static $_INTERNAL_SIMPLE_LOAD = NULL;

	/**
	 * This property is used to deffine a set of rows that is gonna be
	 * unique for this row of data
	 * @var array
	 * @access public
	 * @since 1.1
	 * @static
	 * @internal This is a internal settings variable
	 * @example
	 * array("SeriesId","Title");
	 */
	public static $_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS = NULL;

	/**
	 * This property is used to abort the Dublicate check if
	 * one of the properties are empty.
	 * @var boolean
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is an internal class setting
	 */
	public static $_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL = NULL;

	/**
	 * This property is used to link data based on data in an array, and
	 * instead of using the id to load then you can specify a row to use to load from.
	 * @var array
	 * @since 1.1
	 * @access public
	 * @static
	 * @internal This is an internal settings var
	 * @example
	 * array("Property Name" => array("Table","Row"))
	 * @example
	 * $this->_INTERNAL_PROPERTY_LINK = array("Options" => array("Values","OptionId"));
	 */
	public static $_INTERNAL_PROPERTY_LINK = NULL;

	/**
	 * This property will contain a local instance of CodeIgniter,
	 * if the children set's it
	 * @var object
	 * @since 1.0
	 * @access private
	 */
	private $_CI = NULL;

	/**
	 * This function is the constructor
	 * @access public
	 * @since 1.0
	 */
	public function Std_Library(){
	}

	/**
	 * This function sets the CodeIgniter isntance
	 * @param object &$CI The instance of CodeIgniter to use
	 * @access public
	 * @since 1.0
	 */
	public function Config(&$CI = NULL){
		if(!is_null($CI)){
			$this->_CI =& $CI;
		}
	}

	/**
	 * This function clears the local class data
	 * @access public
	 * @since 1.0
	 */
	public function Clear(){
		if(method_exists($this,"_RemoveUserData")){
			self::_RemoveUserData(false);
		}
	}

	/**
	 * This function loads data either by the $Id parameter or by the $Id property
	 * @param integer $Id The database id to load data from, this parameter is optional,
	 * if it's not deffined the $Id property value will be used
	 * @param boolean $Simple If this flag is set to true, then the Load From Class won't be done
	 * @since 1.0
	 * @access public
	 * @return boolean If the load is succes with data is true returned else is false returned
	 */
	public function Load($Id = NULL,$Simple = false) {
		if(!is_null($Id)){
			$this->Id = $Id;
		}
		if(isset($this->Id)){
			$Id = $this->Id;
		} else if(isset($this->id)){
			$Id = $this->id;
		} else {
			$Id = NULL;
		}
		if(!is_null($Id) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
			if(!$this->_CI->_INTERNAL_DATABASE_MODEL->Load($Id,$this)){
				return FALSE;
			}
		}
		self::_Load_Link();
		self::_Link_Properties();
		self::_Load_From_Class($Simple);
		self::_Force_Array();
		return TRUE;
	}

	/**
	 * This function Links data, based on data from an array.
	 * @since 1.1
	 * @access private
	 */
	private function _Load_Link(){
		if(property_exists($this, "_INTERNAL_PROPERTY_LINK") && isset($this->_INTERNAL_PROPERTY_LINK) && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)){
			foreach ($this->_INTERNAL_PROPERTY_LINK as $Property => $Data) {
				if(property_exists($this, $Property) && !is_null($this->{$Property})){
					$Table = $Data[0];
					$Row = $Data[1];
					if(isset($Data[2])){
						$Select = $Data[2];
					} else {
						$Select = NULL;
					}
					if(is_array($this->{$Property})){
						foreach ($this->{$Property} as $Key => $Value) {
							if(gettype($Value) != "object"){
								self::Link($Table,array($Row => $Value),$Property,true,$Select);
								unset($this->{$Property}[$Key]);
							}
						}
					} else {
						if(gettype($this->{$Property}) != "object"){
							self::Link($Table,array($Row => $this->{$Property}),$Property,true,$Select);
						}
					}
				}
			}
		}
	}

	/**
	 * This function checks if the specified property is set in the _INTERNAL_SIMPLE_LOAD array
	 * @param string $Property The property to check for
	 * @return boolean If the data exists in the settings properties
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Simple_Load_Key($Property = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(property_exists($this, "_INTERNAL_SIMPLE_LOAD") && isset($this->_INTERNAL_SIMPLE_LOAD) && !is_null($this->_INTERNAL_SIMPLE_LOAD) && is_array($this->_INTERNAL_SIMPLE_LOAD)){
				if(array_key_exists($Property, $this->_INTERNAL_SIMPLE_LOAD)){
					return TRUE;
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
	 * This function uses the _INTERNAL_LOAD_FROM_CLASS settings property,
	 * to load up data stored in the specified properties as classes
	 * @param boolean $Simple If this flag is set to true, then this function woundn't do a thing
	 * @since 1.0
	 * @access private
	 */
	private function _Load_From_Class($Simple = false){
		if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS") && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS) && !$Simple){
			if(!is_null($this->_INTERNAL_LOAD_FROM_CLASS)){
				foreach ($this->_INTERNAL_LOAD_FROM_CLASS as $Key => $Value) {
					if(property_exists($this, $Key) && !is_null($this->{$Key})){
						$ChildSimple = $Simple;
						if(self::_Has_Simple_Load_Key($Key)){
							$ChildSimple = $this->_INTERNAL_SIMPLE_LOAD[$Key];
						}
						if(!is_bool($ChildSimple)){
							$ChildSimple = false;
						}

						//If the CodeIgniter instance exists and isn't null, then load the library
						if(property_exists($this, "_CI") && !is_null($this->_CI)){
							@$this->_CI->load->library($Value);
						}
						if(!is_null($this->{$Key}) && $this->{$Key} != ""){
							//If the property is an array and it contains data, then make the output an array of objects
							if(is_array($this->{$Key}) && count($this->{$Key}) > 0){
								$Temp = array();
								foreach ($this->{$Key} as $Name) {
									if(gettype($Name) == "object"){
										$Temp[] = $Name;
									} else {
										if(!is_null($Value) && class_exists($Value) && !is_null($Name) && $Name != ""){
											$Object = new $Value();
											if($Object->Load($Name,$ChildSimple)){
												if(!is_null($Object)){
													$Temp[] = $Object;
												}
											}
										}
									}
								}
								if(count($Temp) > 0){
									$this->{$Key} = $Temp;
								}

							//Else just set the property as a single object
							} else {
								if(!is_null($this->{$Key})){
									if(class_exists($Value) && gettype($this->{$Key}) != "object"){
										$Object = new $Value();
										if($Object->Load($this->{$Key},$ChildSimple)){
											if(!is_null($Object)){
												$this->{$Key} = $Object;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function loops through the settings property _INTERNAL_LINK_PROPERTIES,
	 * and links the deffined properties with data from other database tables
	 * @see Link
	 * @access private
	 * @since 1.0
	 */
	private function _Link_Properties(){
		if(property_exists($this, "_INTERNAL_LINK_PROPERTIES") && isset($this->_INTERNAL_LINK_PROPERTIES) && !is_null($this->_INTERNAL_LINK_PROPERTIES) && is_array($this->_INTERNAL_LINK_PROPERTIES)){
			foreach ($this->_INTERNAL_LINK_PROPERTIES as $ClassProperty => $LinkData) {
				if(is_array($LinkData)){
					$Table = $LinkData[0];
					$Query = $LinkData[1];
					if(isset($LinkData[2])){
						$Select = $LinkData[2];
					} else {
						$Select = NULL;
					}
					if(method_exists($this, "Link")){
						self::Link($Table,$Query,$ClassProperty,true,$Select);
					}
				}
			}
		}
	}

	/**
	 * This function makes an ignore check, with the _INTERNAL_SECURE_EXPORT_IGNORE data,
	 * passed over as ExtraIgnore to the Ignore function
	 * @param string  $Key    The property name to check for
	 * @param boolean $Secure If this flag is set to true, the ignore check is done
	 * @see Ignore
	 * @access private
	 * @since 1.1
	 */
	private function _Secure_Ignore($Key = NULL,$Secure = true){
		if($Secure && !is_null($Key)){
			$Extra = array();
			if(property_exists($this, "_INTERNAL_SECURE_EXPORT_IGNORE") && isset($this->_INTERNAL_SECURE_EXPORT_IGNORE) && !is_null($this->_INTERNAL_SECURE_EXPORT_IGNORE) && is_array($this->_INTERNAL_SECURE_EXPORT_IGNORE)){
				$Extra = array_merge($Extra,$this->_INTERNAL_SECURE_EXPORT_IGNORE);
			}
			if(self::Ignore($Key,$Extra)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function imports data from an array with the same key name as the local property to import too.
	 * @param array $Array The data to import in Name => Value format
	 * @param boolean $Override If this flag is set to true, then if the data is an array the clas $s data is overridden
	 * @param boolean $Secure If this parameter is set to true, then the secure ignore check is done
	 * @since 1.0
	 * @access public
	 */
	public function Import($Array = NULL,$Override = false,$Secure = false){
		if(!is_null($Array) && is_array($Array)){
			foreach($Array as $Name => $Value){
				if(property_exists($this,$Name) && !self::_Secure_Ignore($Name,$Secure)){
					if(!is_array($Value) && !is_array($Name) && strpos($Value, ";") == true){
						if($Override == false){
							if(is_array($this->{$Name})){
								$this->{$Name} = array_merge($this->{$Name},explode(";", $Value));
							} else {
								$this->$Name = explode(";", $Value);
							}
						} else {
							$this->$Name = explode(";", $Value);
						}
					} else {
						if(self::_Has_Load_From_Class($Name) && is_array($Value) && self::_Has_Sub_Array($Value)){
							self::_Sub_Import($Value,$Name,$Override);
						} else {
							if(!is_integer($Value) && self::_Has_Load_From_Class($Name) && (self::_Has_Sub_Array($Value) || self::_Has_Sub_Array($Name))){
								self::_Sub_Import($Value,$Name,$Override);
							} else {
								$this->{$Name} = $Value;
							}
						}	
					}
				}
			}
			self::_Force_Array();
			self::_Load_From_Class();
		} else {
			return FALSE;
		}
	}

	/**
	 * This function loops through properties in the input an imports the data,
	 * with the class' import function, if needed 
	 * @param array $Array    The input data to use
	 * @param string $Property The class property to save the data in
	 * @param boolean $Overwrite If the data is going to be overwritten or not
	 */
	private function _Sub_Import($Array = NULL,$Property = NULL,$Overwrite = false){
		if(!is_null($Array) && !is_null($Property)){
			$ClassName = self::_Get_Load_From_Class_Data($Property);
			if(!is_null($ClassName)){
				$Temp = array();
				$Single = array();
				foreach ($Array as $Key => $Data) {
					if(is_array($Data)){
						$this->_CI->load->library($ClassName);
						$Class = new $ClassName();
						if(!is_null($Class) && method_exists($Class, "Import")){
							$Class->Import($Data,$Overwrite);
						}
						$Temp[] = $Class;
					} else {
						$Single[$Key] = $Data;
					}
				}
				if(count($Single) > 0){
						$this->_CI->load->library($ClassName);
						$Class = new $ClassName();
						if(!is_null($Class) && method_exists($Class, "Import")){
							$Class->Import($Single,$Overwrite);
						}
						$Temp[] = $Class;
				}
				if(count($Temp) > 0 && property_exists($this, $Property)){
					if(is_null($this->{$Property})){
						$this->{$Property} = $Temp;
					} else {
						if(is_array($this->{$Property}) && !$Overwrite){
							$this->{$Property} = array_merge($this->{$Property},$Temp); 
						} else {
							$this->{$Property} = $Temp;
						}
					}
				}
			}
		}
	}

	/**
	 * This function checks if a property exists in the force array settings array
	 * @param string $Property The property to search for
	 * @return boolean If the property is in the force array settings array
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Force_Array($Property = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(property_exists($this, "_INTERNAL_FORCE_ARRAY") && isset($this->_INTERNAL_FORCE_ARRAY) && !is_null($this->_INTERNAL_FORCE_ARRAY) && is_array($this->_INTERNAL_FORCE_ARRAY)){
				if(in_array($Property, $this->_INTERNAL_FORCE_ARRAY)){
					return TRUE;
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
	 * This function checks if the input data contains sub arrays
	 * @param array||string||object $Data The data to check for sub arrays
	 * @return boolean If the input contains an array
	 * @since 1.1
	 * @access private
	 */
	private function _Has_Sub_Array($Data = NULL){
		if(!is_null($Data)){
			if(is_array($Data)){
				$Has_Sub_Array = false;
				foreach ($Data as $Key => $Value) {
					if(is_array($Value) || is_array($Key)){
						$Has_Sub_Array = true;
					}
				}
				return $Has_Sub_Array;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function check's if a load from class key exists, in the _INTERNAL_LOAD_FROM_CLASS settings array
	 * @since 1.1
	 * @access private
	 * @param string $Property The property to search for
	 * @return boolean If the key exists, in the settings array
	 */
	private function _Has_Load_From_Class($Property = NULL){
		if(!is_null($Property)){
			if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS") && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS) && array_key_exists($Property, $this->_INTERNAL_LOAD_FROM_CLASS)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function gets data from the _INTERNAL_LOAD_FROM_CLASS settings array of a specific property.
	 * @param string $Property The property to get the data for
	 * @since 1.1
	 * @access private
	 * @return string The clas to load from of the specified property
	 */
	private function _Get_Load_From_Class_Data($Property = NULL){
		if(!is_null($Property) && self::_Has_Load_From_Class($Property)){
			return $this->_INTERNAL_LOAD_FROM_CLASS[$Property];
		}
	}

	/**
	 * This function loops through the setttings variable containing the properties to force as array
	 * and make them an array
	 * @since 1.1
	 * @access private
	 */
	private function _Force_Array(){
		if(property_exists($this, "_INTERNAL_FORCE_ARRAY") && isset($this->_INTERNAL_FORCE_ARRAY) && !is_null($this->_INTERNAL_FORCE_ARRAY) && is_array($this->_INTERNAL_FORCE_ARRAY)){
			foreach ($this->_INTERNAL_FORCE_ARRAY as $Force) {
				if(property_exists($this, $Force) && !is_array($this->{$Force})){
					if(!is_null($this->{$Force})){
						$Temp = array($this->{$Force});
						$this->{$Force} = $Temp;
					}
				}
			}
		}
	}

	/**
	 * This function gets the _INTERNAL_ROW_NAME_CONVERT array of an object if data exists for it
	 * or if the _INTERNAL_DATABASE_NAME_CONVERT exists it generates it.
	 * @param object $Object The object to get the data from
	 * @since 1.1
	 * @access private
	 * @return array The _INTERNAL_ROW_NAME_CONVERT data, if it exists
	 */
	private function _Get_Row_Name_Convert($Object = NULL){
		if(!is_null($Object) && gettype($Object) == "object"){
			if(property_exists($Object, "_INTERNAL_ROW_NAME_CONVERT") && isset($Object->_INTERNAL_ROW_NAME_CONVERT) && !is_null($Object->_INTERNAL_ROW_NAME_CONVERT)){
				return $Object->_INTERNAL_ROW_NAME_CONVERT;
			} else {
				if(property_exists($Object, "_INTERNAL_DATABASE_NAME_CONVERT") && isset($Object->_INTERNAL_DATABASE_NAME_CONVERT) && !is_null($Object->_INTERNAL_DATABASE_NAME_CONVERT)){
					$Temp = array();
					foreach ($Object->_INTERNAL_DATABASE_NAME_CONVERT as $Property => $Row) {
						$Temp[$Row] = $Property;
					}
					if(count($Temp) > 0){
						return $Temp;
					}
				}
			}
		}
	}

	/**
	 * This function loops through the _INTERNAL_LOAD_FROM_CLASS properties,
	 * if there's some extra information set in _INTERNAL_SAVE_LINK, that needs to be assigned
	 * to the object(s) then it's done, and the Save method is called on the child objects
	 * @since 1.1
	 * @access private
	 */
	private function _Save_ChildClasses_Properties(){
		if(property_exists($this, "_INTERNAL_LOAD_FROM_CLASS") && isset($this->_INTERNAL_LOAD_FROM_CLASS) && !is_null($this->_INTERNAL_LOAD_FROM_CLASS) && is_array($this->_INTERNAL_LOAD_FROM_CLASS)){
			foreach ($this->_INTERNAL_LOAD_FROM_CLASS as $Property => $ClassName) {
				if(!is_null($Property) && !self::_Is_Linked_Property($Property) && property_exists($this, $Property)){
					if(is_array($this->{$Property})){
						foreach ($this->{$Property} as $Key => $Object) {
							if(gettype($Object) == "object"){
								if(self::_Has_Save_Link($Property)){
									$Save_Link_Data = self::_Get_Save_Link_Data($Property);
									if(!is_null($Save_Link_Data)){
										self::_Set_Save_Link_Data($Save_Link_Data,$Object);
									}
								}
								if(!is_null($Object) && method_exists($Object, "Save")){
									$Object->Save();
								}
							}
						}
					} else {
						if(gettype($this->{$Property}) == "object"){
							if(self::_Has_Save_Link($Property)){
								$Save_Link_Data = self::_Get_Save_Link_Data($Property);
								$Object = $this->{$Property};
								if(!is_null($Save_Link_Data)){
									self::_Set_Save_Link_Data($Save_Link_Data,$Object);
								}
							} else {
								$Object = $this->{$Property};
							}
							if(!is_null($Object) && method_exists($Object, "Save")){
								$Object->Save();
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function checks if the $Property is a linked property
	 * @param string $Property The class property to check for
	 * @since 1.1
	 * @access private
	 * @return boolean if the property is a Linked property
	 */
	private function _Is_Linked_Property($Property = NULL){
		if(!is_null($Property)){
			if(property_exists($this, "_INTERNAL_LINK_PROPERTIES") && isset($this->_INTERNAL_LINK_PROPERTIES) && !is_null($this->_INTERNAL_LINK_PROPERTIES) && is_array($this->_INTERNAL_LINK_PROPERTIES)){
				if(array_key_exists($Property,$this->_INTERNAL_LINK_PROPERTIES)){
					return TRUE;
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
	 * This function checks if there exists Save link data about a given property
	 * @param string $Property The property to search for
	 * @since 1.1
	 * @access private
	 * @return boolean If the data exists
	 */
	private function _Has_Save_Link($Property = NULL){
		if(property_exists($this, "_INTERNAL_SAVE_LINK") && isset($this->_INTERNAL_SAVE_LINK) && !is_null($this->_INTERNAL_SAVE_LINK) && is_array($this->_INTERNAL_SAVE_LINK)){
			if(array_key_exists($Property, $this->_INTERNAL_SAVE_LINK)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function returns the Save Link data if it exists
	 * @param string $Property the property to get data for
	 * @return array The save link data if it exists
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Save_Link_Data($Property = NULL){
		if(!is_null($Property) && self::_Has_Save_Link($Property)){
			return (!is_null($this->_INTERNAL_SAVE_LINK[$Property]) && isset($this->_INTERNAL_SAVE_LINK[$Property]))? $this->_INTERNAL_SAVE_LINK[$Property] : NULL;
		}
	}

	/**
	 * This function assigns the Save_Link data to a object
	 * @param array $Data   The data to assign
	 * @param object $Object The object to assign it too
	 * @since 1.1
	 * @access private
	 */
	private function _Set_Save_Link_Data($Data = NULL,$Object = NULL){
		if(!is_null($Data) && !is_null($Object)){
			foreach ($Data as $Property => $Value) {
				if(property_exists($this, $Value)){
					$Value = $this->{$Value};
				}
				if(is_array($Object)){
					foreach ($Object as $TempObject) {
						$TempObject->{$Property} = $Value;
					}
				} else {
					if(property_exists($Object, $Property)){
						$Object->{$Property} = $Value;
					}
				}
			}
		}
	}

	/**
	 * This function loops through all the properties which is linked,
	 * and ensures that all the containing objects, have the right values in the linked fields.
	 * And then is the child objects saved
	 * @access private
	 * @since 1.0
	 */
	private function _Save_Linked_Properties(){
		if(property_exists($this, "_INTERNAL_LINK_PROPERTIES") && isset($this->_INTERNAL_LINK_PROPERTIES) && !is_null($this->_INTERNAL_LINK_PROPERTIES) && is_array($this->_INTERNAL_LINK_PROPERTIES)){
			foreach ($this->_INTERNAL_LINK_PROPERTIES as $Property => $LinkData) {
				$Link_Query = $LinkData[1];
				if(property_exists($this, $Property) && !is_null($this->{$Property})){
					if(is_array($this->{$Property})){
						foreach ($this->{$Property} as $Object) {
							self::_Set_Save_Link_Data($Link_Query,$Object);
							if(self::_Has_Save_Link($Property)){
								$Save_Link_Data = self::_Get_Save_Link_Data($Property);
								if(!is_null($Save_Link_Data)){
									self::_Set_Save_Link_Data($Save_Link_Data,$Object);
								}
							}
							if(method_exists($Object, "Save")){
								$Object->Save();
							}
						}
					} else {
						if(gettype($this->{$Property}) == "object"){
							$Object = $this->{$Property};
							self::_Set_Save_Link_Data($Link_Query,$Object);
							if(self::_Has_Save_Link($Property)){
								$Save_Link_Data = self::_Get_Save_Link_Data($Property);
								if(!is_null($Save_Link_Data)){
									self::_Set_Save_Link_Data($Save_Link_Data,$Object);
								}
							}
							if(method_exists($Object, "Save")){
								$Object->Save();
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This function get's the data of a classes _INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL,
	 * data
	 * @return boolean The data of the settings property
	 * @since 1.1
	 * @access private
	 */
	private function _Abort_On_Empty(){
		if(!is_null($this)){
			if(property_exists($this, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL") && isset($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && !is_null($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL) && is_bool($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL)){
				return $this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS_ABORT_ON_NULL;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * This function creates the query for the _Match_Data in the std_model,
	 * and executes it
	 * @since 1.1
	 * @access private
	 */
	private function _Not_Allowed_Dublicate_Rows(){
		if(property_exists($this, "_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS") && isset($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS) && !is_null($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS) && is_array($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS)){
			$Query = array();
			$Export = self::Export(true);
			foreach ($this->_INTERNAL_NOT_ALLOWED_DUBLICATE_ROWS as $Key) {
				if(isset($Export[$Key]) && !is_null($Export[$Key])){
					$Query[$Key] = $Export[$Key];
				} else {
					if(self::_Abort_On_Empty()){
						return false;
					}
				}
			}
			if(method_exists($this->_CI->_INTERNAL_DATABASE_MODEL, "Match_Data")){
				return !$this->_CI->_INTERNAL_DATABASE_MODEL->Match_Data($this,$Query);
			}
		}
	}

	/**
	 * This function saves the local class data to the database row of the Id property
	 * @return string This function can return a error string
	 * @todo Make the linked properties be saved to, and with the an updated id, etc SeriesId = $this->Id
	 * @since 1.0
	 * @access public
	 */
	public function Save() {
		if(!is_null($this->_CI) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL) ){
			if(!self::_Not_Allowed_Dublicate_Rows()){
				$this->_CI->_INTERNAL_DATABASE_MODEL->Save($this);		
				self::_Save_Linked_Properties();
				self::_Save_ChildClasses_Properties();
			return true;
			} else {
				return FALSE;
			}
		} else {
			return false;
		}
	}

	/**
	 * This function removes the key/keys with the specific value
	 * @param object $Property The property to search in
	 * @param string|boolean|integer $Value    The value to search for
	 * @since 1.1
	 * @access private
	 */
	private function _Remove_Where($Property = NULL,$Value = NULL){
		if(!is_null($Property) && property_exists($this, $Property)){
			if(is_array($this->{$Property})){
				$Keys = array_keys($this->{$Property},$Value);
				if(count($Keys) == 1){
					unset($this->{$Property}[$Keys[0]]);
				} else {
					foreach ($Keys as $Key) {
						unset($this->{$Property}[$Key]);
					}
				}
			}
		}
	}

	/**
	 * This function gets either one property
	 * from and object or more properties
	 * @param object $Object     The object to get the data from
	 * @param string|array $Properties The property/properties to get
	 * @return array|string
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Data_From_Object($Object = NULL,$Properties = NULL){
		if(!is_null($Object) && is_object($Object) && !is_null($Properties)){
			if(is_array($Properties)){
				$Temp = array();
				foreach ($Properties as $Property) {
					if(property_exists($Object, $Property)){
						$Temp[$Property] = $Object->{$Property};
					}
				}
				return $Temp;
			} else {
				if(property_exists($Object, $Properties)){
					return $Object->{$Properties};
				}
			}
		}
	}

	/**
	 * This function sets the data returned from a link query
	 * @param array $Data     The data to get the objects from
	 * @param string $Property The class property to set the data too
	 * @param string|array $Select   The row/rows to select
	 * @since 1.1
	 * @access private
	 */
	private function _Link_Set_Data($Data = NULL,$Property = NULL,$Select = NULL){
		if(!is_null($Data) && is_array($Data) &&!is_null($Property) && property_exists($this, $Property)){
			if(!is_null($Select)){
				$UseProperty = $Select;
			} else {
				$UseProperty = "Id";
			}

			if(count($Data) > 1){
				$Temp = array();
				foreach ($Data as $Object) {
					if(is_array($UseProperty)){
						$Temp[] = self::_Get_Data_From_Object($Object,$UseProperty);
					} else {
						if(property_exists($Object, $UseProperty)){
							self:: _Remove_Where($Property,$Object->{$UseProperty});
							$Temp[] = self::_Get_Data_From_Object($Object,$UseProperty);
						}	
					}
				}
				if(count($Temp) > 0){
					if(is_null($this->{$Property})){
						$this->{$Property} = $Temp;
					} else {
						if(is_array($this->{$Property})){
							$this->{$Property} = array_merge($this->{$Property},$Temp);
						} else {
							$this->{$Property} = $Temp;
						}
					}
				}
			} else {
				if(isset($Data[0])){
					$Data = $Data[0];
				}
				if(!is_null($Data) && is_object($Data)){
					if(is_array($this->{$Property})){
						$this->{$Property}[] = self::_Get_Data_From_Object($Data,$UseProperty);
					} else {
						$this->{$Property} = self::_Get_Data_From_Object($Data,$UseProperty);
					}
				}
			}
		}
	}

	/**
	 * This function links a class property to data collected from other databases
	 * @param string||array $Table    The table(s) to search in
	 * @param array $Link     An array in this format array("Row Name" => "Class property or  a value"...) 
	 * with the search queries to search with.
	 * @param string $Property The class property to link
	 * @param boolean $Simple if this flag is set to true, then the load from class isn't executed
	 * @param array $Select The rows to select/use
	 * @since 1.0
	 * @return boolean If success or fail
	 * @access public
	 */
	public function Link($Table = NULL,$Link = NULL,$Property = NULL,$Simple = false,$Select = NULL){
		if(!is_null($Table) && !is_null($Link) && is_array($Link) && !is_null($Property)){
			//Check if the properties exists else remove them from the list
			foreach($Link as $Search => $Key){
				if($Search == "" || $Key == ""){
					unset($Link[$Search]);
				} else {
					if(property_exists($this, $Key)){
						if(is_null($this->{$Key})){
							unset($Link[$Search]);
						}
						else if($this->{$Key} == ""){
							unset($Link[$Search]);
						} else {
							$Link[$Search] = $this->{$Key};
						}
					}
				}
			}

			//If there is properties left, then start linking
			if(count($Link) > 0){
				if(method_exists($this->_CI->_INTERNAL_DATABASE_MODEL, "Link")){
					$Data = $this->_CI->_INTERNAL_DATABASE_MODEL->Link($Table,$Link,$this,$Select);
					if(property_exists($this, $Property)){
						self::_Link_Set_Data($Data,$Property,$Select);
						if(count($Data) > 0){
							if(!$Simple){
								self::_Load_From_Class();
							}
							return TRUE;
						} else {
							return FALSE;
						}
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * This function converts a object to an array if there's more objects in the input or just a string if there's only one
	 * @param object||array $Data The object to convert to a string or array
	 * @return array||string This output will either be the id of the object or an array with the id's
	 * @access private
	 * @since 1.1
	 */
	private function _Convert_From_Object($Data = NULL){
		$Return = NULL;
		if(!is_null($Data)){
			if(is_array($Data) && count($Data) > 0){
				$Temp = array();
				foreach ($Data as $K => $Object) {
					if(!is_null($Object)){
						if(property_exists($Object, "Id")){
							$Temp[] = $Object->Id;
						} elseif(method_exists($Object, "Export")){
							$Temp[] = $Object->Export(true);
						}
					}
				}
				if(count($Temp) > 0){
					$Return = $Temp;
				}
			} else {
				if(property_exists($Data, "Id")){
					$Return = $Data->Id;
				} elseif(method_exists($Data, "Export")){
					$Return = $Data->Export(true);
				}
			}
			if(!is_null($Return)){
				return $Return;
			}
		}
	}

	/**
	 * This function checks if the input $Data is containing an object,
	 * either inside an array or just as the value
	 * @param object||array||boolean||string|integer $Data The data to check
	 * @since 1.1
	 * @access private
	 * @return boolean The check result
	 */
	private function _Contains_Object($Data = NULL){
		if(!is_null($Data)){
			if(is_array($Data)){
				foreach ($Data as $Key => $Value) {
					if(is_object($Key) || is_object($Value)){
						return true;
					} else {
						return false;
					}
				}
			} else {
				return (is_object($Data)) ? true : false;
			}
		} else {
			return false;
		}
	}

	/**
	 * This function gets a property of an object, and converts it with a Row Name table,
	 * if it exists
	 * @param array||object $Data The data to use
	 * @param string $Row  The property data to use
	 * @return string|integer The property data if anny
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Property_Linked_Row_Data_From_Object($Data = NULL,$Row = NULL){
		if(!is_null($Data) && !is_null($Row) && is_object($Data)){
			$Object = $Data;
			$Row_Names = self::_Get_Row_Name_Convert($Object);
			if(!is_null($Row_Names) && is_array($Row_Names) && array_key_exists($Row, $Row_Names)){
				$Row = $Row_Names[$Row];
			}
			if(property_exists($Object, $Row)){
				return $Object->{$Row};
			}
		}
	}

	/**
	 * This function is converting the data linked with,
	 * Property Link to a string used in export
	 * @param array|object $Data     The data to convert
	 * @param string $Property The class property where the data is from
	 * @return array|integer|object|string The data of the input converted
	 * @since 1.1
	 * @access private
	 */
	private function _Property_Linked_Row_Export($Data = NULL,$Property = NULL){
		if(!is_null($Data) && !is_null($Property)){
			$Row = self::_Get_Property_Linked_Row_Settings($Property);
			$Row = $Row[1];
			if(!is_null($Data) && !is_null($Row)){
				if(self::_Contains_Object($Data)){
					if(is_array($Data)){
						$Temp = array();
						foreach ($Data as $Key => $Data) {
							 $Return = self::_Get_Property_Linked_Row_Data_From_Object($Data,$Row);
							if(!is_null($Return)){
							 	$Temp[] = $Return;
							}
						}
						if(count($Temp) > 0){
							return $Temp;
						} else {
							return $Data;
						}
					} else {
						return self::_Get_Property_Linked_Row_Data_From_Object($Data,$Row);
					}
				} else {
					return $Data;
				}
			} else {
				return $Data;
			}
		} else {
			return $Data;
		}
	}

	/**
	 * This function extracts setting from the _INTERNAL_PROPERTY_LINK settings array
	 * @param string $Property The property to search for
	 * @return array The settings data
	 * @since 1.1
	 * @access private
	 */
	private function _Get_Property_Linked_Row_Settings($Property = NULL){
		if(!is_null($Property)){
			return (array_key_exists($Property, $this->_INTERNAL_PROPERTY_LINK))? $this->_INTERNAL_PROPERTY_LINK[$Property] : NULL;
		}
	}

	/**
	 * This function checks if a key is in the _INTERNAL_PROPERTY_LINK array
	 * @param string $Property The property to check for
	 * @since 1.1
	 * @access private
	 * @return boolean If it exists in the settings array
	 */
	private function _Is_Property_Linked_Row($Property = NULL){
		if(!is_null($Property)){
			if(property_exists($this, "_INTERNAL_PROPERTY_LINK") && isset($this->_INTERNAL_PROPERTY_LINK) && !is_null($this->_INTERNAL_PROPERTY_LINK) && is_array($this->_INTERNAL_PROPERTY_LINK)){
				if(array_key_exists($Property, $this->_INTERNAL_PROPERTY_LINK)){
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * This function returns all the class variable with name and values as an array
	 * @return array All the class vars and values
	 * @param boolean $Database If this flag is set to true, the data will be exported so the key names,
	 * fits the database row names
	 * @param boolean $Secure If this flag is set to true, then the $_INTERNAL_SECURE_EXPORT_IGNORE is used to ignore
	 * not public rows.
	 * @since 1.0
	 * @access public
	 * @return array The class data as an array
	 */
	public function Export ($Database = false,$Secure = false) {
		if ($Database) {
			$Array = array();
			$Ignore = NULL;
			//Loop through all class properties
			foreach (get_class_vars(get_class($this)) as $Name => $Value) {

				//If the property is the CodeIgniter instance, the id or an internal property dont do anything
				if (!self::Ignore($Name,$Ignore) && !is_null($this->{$Name}) && !self::_Is_Linked_Property($Name)) {
					$Data = $this->{$Name};
					if(self::_Contains_Object($Data) && !self::_Is_Property_Linked_Row($Name)){
						$Data = self::_Convert_From_Object($Data);
					}

					if($Database){
						if(self::_Is_Property_Linked_Row($Name)){
							$Data = self::_Property_Linked_Row_Export($Data,$Name);
						}
					}

					//If the class has an name convert table, check if the current property exists in it
					// , if it does use that as the array key
					if(property_exists($this, "_INTERNAL_DATABASE_NAME_CONVERT") 
						&& isset($this->_INTERNAL_DATABASE_NAME_CONVERT)
						&& is_array($this->_INTERNAL_DATABASE_NAME_CONVERT) 
						&& array_key_exists($Name, $this->_INTERNAL_DATABASE_NAME_CONVERT)
						&& !is_null($this->_INTERNAL_DATABASE_NAME_CONVERT)) {
						//If the data is an array implode it with a ";" sign else just assign it
						if(!is_null($Data) && is_array($Data) && count($Data) > 0){
							$String = ";";
							$String .= implode(";",$Data);
							$String .= ";";
							$Array[$this->_INTERNAL_DATABASE_NAME_CONVERT[$Name]] = $String;
						} else {
							$Array[$this->_INTERNAL_DATABASE_NAME_CONVERT[$Name]] = $Data;
						}
					} else {
						if(!is_null($Data) && is_array($Data) && count($Data) > 0 && !self::_Contains_Object($Data)){
							$String = ";".implode(";",$Data).";";
							$Array[$Name] = $String;

						} else {
							$Array[$Name] = $Data;
						}
					}
				}
			}
		} 
		else if(!$Database && !$Secure){
			$Array = array();
			$Array = self::_Normal_Export();
		} else if($Secure){
			if(property_exists($this, "_INTERNAL_SECURE_EXPORT_IGNORE") && isset($this->_INTERNAL_SECURE_EXPORT_IGNORE) && !is_null($this->_INTERNAL_SECURE_EXPORT_IGNORE) && is_array($this->_INTERNAL_SECURE_EXPORT_IGNORE)){
				$Array = array();
				$Array = self::_Secure_Export();
			} 
			else {
				$Array = array();
				$Array = self::_Normal_Export(true);
			}
		}
		return $Array;
	}

	/**
	 * This function uses the $_INTERNAL_SECURE_EXPORT_IGNORE,
	 * to remove the properties that's not gonna be available for the public
	 * @since 1.0
	 * @access private
	 * @return array The exported data as an array
	 */
	private function _Secure_Export(){
		$Array = array();
		foreach (get_class_vars(get_class($this)) as $Name => $Value) {
			if (!self::Ignore($Name,$this->_INTERNAL_SECURE_EXPORT_IGNORE)) {
				$Data = $this->{$Name};
				if(self::_Is_Property_Linked_Row($Name)){
					$Data = self::_Property_Linked_Row_Export($Data,$Name);
				}
				if(self::_Contains_Object($Data)){
					if(is_array($Data)){
						$TempArray = array();
						foreach ($Data as $Object) {
							if(method_exists($Object, "Export")){
								$TempArray[] = $Object->Export(false,true);
							}
						}
						if(count($TempArray) > 0){
							$Array[$Name] = $TempArray;
						} else {
							$Array[$Name] = $Data;
						}
					} else {
						if(method_exists($Data, "Export")){
							$Array[$Name] = $Data->Export(false,true);
						}
					}
				} else {
					$Array[$Name] = $Data;
				}
			}
		}	
		return $Array;		
	}

	/**
	 * This function does a normal export without any not normal ignores
	 * @since 1.0
	 * @param boolean $Secure If this flag is set to true then the sub objects will have the secure export added to the export function
	 * @access private
	 * @return array The exported data as an array
	 */
	private function _Normal_Export($Secure = false){
		$Array = array();
		foreach (get_class_vars(get_class($this)) as $Name => $Value) {
			if (!self::Ignore($Name)) {
				$Data = $this->{$Name};
				if(self::_Contains_Object($Data)){
					if(is_array($Data)){
						$TempArray = array();
						foreach ($Data as $Object) {
							if(method_exists($Object, "Export")){
								$TempArray[] = $Object->Export(false,$Secure);
							}
						}
						if(count($TempArray) > 0){
							$Array[$Name] = $TempArray;
						} else {
							$Array[$Name] = $Data;
						}
					} else {
						if(method_exists($Data, "Export")){
							$Array[$Name] = $Data->Export(false,$Secure);
						}
					}
				} else {
					$Array[$Name] = $Data;
				}
			}
		}	
		return $Array;
	}

	/**
	 * This function checks the local settings variable for export,
	 * to see if the $Key exists in one of them or if the Key contains the _INTERNAL keyword
	 * @param string||integer $Key         The key to check
	 * @param array $ExtraIgnore Some extra ignore rules if nessesary
	 * @return boolean if to be ignored true is returned else is false returned
	 * @access public
	 * @since 1.0
	 */
	public function Ignore($Key = NULL,$ExtraIgnore = NULL){
		if(!is_null($Key)){
			if(!strpos($Key, "INTERNAL_") === false){
				return true;
			} else {
				if(property_exists($this, "_INTERNAL_EXPORT_INGNORE") && isset($this->_INTERNAL_EXPORT_INGNORE) && !is_null($this->_INTERNAL_EXPORT_INGNORE)){
					if(in_array($Key,$this->_INTERNAL_EXPORT_INGNORE)){
						return true;
					} else {
						if(!is_null($ExtraIgnore) && in_array($Key, $ExtraIgnore)){
							return true;
						} else {
							return false;
						}
					}
				} else {
					if(!is_null($ExtraIgnore) && in_array($Key, $ExtraIgnore)){
						return true;
					} else {
						return false;
					}
				}
			}
		} else {
			return true;
		}
	}
	

	/**
	 * This function removes local data, set the id flag to true to remove the id too.
	 * @param boolean $Id If this is set to true then the id is cleared too
	 * @since 1.0
	 * @access private
	 */
	private function _RemoveUserData($Id = false){
		foreach(get_class_vars(get_class($this)) as $Name => $Value){
			if($Name != "CI" && $Name != "_CI" && $Name != "Database_Table" && strpos($Name, "INTERNAL_") === false){
				if($Name != "Id"){
					$this->{$Name} = NULL;
				}
				if($Id == true && $Name == "Id"){
					$this->{$Name} = NULL;
				}
			}
		}
	}

	/**
	 * This function takes an array and ads the data to the variable with the right key {Name},
	 * with the corrosponding data {Value}
	 * @param array $Array The data in Name => Value format to set
	 * @since 1.0
	 * @access private
	 */
	private function _SetDataArray($Array = NULL){
		if(!is_null($Array)){
			if(method_exists($this,"Import")){
				self::Import($Array);
			}
		}
	}

	/**
	 * This function removes data from the specified row in the $Id parameter
	 * @param integer $Id The database row id to remove
	 * @since 1.0
	 * @access private
	 */
	private function _RemoveDatabaseData($Id = NULL,$Table = NULL){
		if(!is_null($Id)){
			$this->Id = $Id;
		}
		if(!is_null($this->Id) && !is_null($Table)){
			if(property_exists($this, "_CI") && property_exists($this, "_CI")){
				$this->_CI->db->delete($Table,array("Id" => $this->Id));
			}
		}
	}

	/**
	 * This function only sets the output if input exists
	 * @param object||string||number &$Input  The input data to check if exists
	 * @param object||string||number &$Output The output data to set if the input isset
	 * @since 1.0
	 * @access private
	 */
	private function _CheckData(&$Input = NULL,&$Output = NULL){
		if(!is_null($Input) && !is_null($Output)){
			if(isset($Input) && @!is_null($Input)){
				$Output = $Input;
			}
		}
	}

	/**
	 * This function adds data from an class that has the same property names as the data you wish to add
	 * @param object $Class An instance of the object you wish to set
	 * @access private
	 * @since 1.0
	 */
	private function _SetDataClass(&$Class = NULL){
		if(!is_null($Class)){
			foreach (get_object_vars($Class) as $Key => $Value) {
				if(property_exists(get_class($this), $Key)){
					if(!is_null($Class->{$Key}) && $Class->{$Key} != "" && $Key != "CI" && strpos($Key, "INTERNAL_") === false){
						$this->{$Key} = $Class->{$Key};
					}
				}
			}
			
		}
	}

	/**
	 * This function refresh the class data from the database
	 * @see self::Load
	 * @since 1.0
	 * @return boolean If success or fail
	 * @access public
	 */
	public function Refresh(){
		if(property_exists($this, "Id")){
			if(!is_null($this->Id)){
				if(method_exists($this, "Load")){
					return self::Load($this->Id);
				}
			}
		}
	}

	/**
	 * This function delete's data local in the class, but if selected it can also delete the data from the database
	 * @param boolean $Database If this flag is set too true, the database data will be deleted too
	 * @since 1.0
	 * @access public
	 * @return object This function returns this object
	 */
	public function Delete($Database = false){
		if($Database){
			if(method_exists($this, "_RemoveDatabaseData") && property_exists(get_class($this), "Id")){
				self::_RemoveDatabaseData($this->Id,$this->Database_Table);
			}
			if(method_exists($this, "_RemoveUserData")){
				self::_RemoveUserData(true);
			}
		}
		else{
			if(method_exists($this, "_RemoveUserData")){
				self::_RemoveUserData(false);
			}
		}
		return $this;
	}

	/**
	 * This function takes the data from the $Array parameter and adds it to the local data,
	 * and if the database flag is set the data will be saved too. 
	 * @param array  $Array    The data in Name => Value format
	 * @param boolean $Database If this flag is set too true the data is saved too
	 * @access public
	 * @since 1.0
	 */
	public function Create($Array =  NULL,$Database = false){
		if(!is_null($Array)){
			self::_SetDataArray($Array);
			if($Database && !is_null($this->_CI) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
				$this->Id = $this->_CI->_INTERNAL_DATABASE_MODEL->Create($this);
				return $this->Id;
			}
		}
	}

	/**
	 * This function adds data, to this class either from a class or from an array,
	 * and if the Database flag is set to true the data will be saved to the database.
	 * @param object  &$Class   This parameter should contain a class that has the data to add deffined,
	 * with the same variable names, as this class. Not all variables need to be deffined only create them you need to.
	 * @param array  $Array    If this parameter is set and $Class is null the data from this parameter is used in Name => Value format
	 * @param boolean $Database If this flag is set to true, then the data will be saved in the database too
	 * @access public
	 * @since 1.0
	 */
	public function Add(&$Class = NULL,$Array = NULL, $Database = false){
		if(!is_null($Class)){
			self::_SetDataClass($Class);
		}
		else{
			if(!is_null($Array)){
				self::_SetDataArray($Array);
			}
			else{
				return 400;	
			}
		}
		if($Database && !is_null($this->Id) && !is_null($this->_CI) && !is_null($this->_CI->_INTERNAL_DATABASE_MODEL)){
			$this->Id = $this->_CI->_INTERNAL_DATABASE_MODEL->Create($this);
			return $this->Id;
		}
	}

	/**
	 * This function is used to load based under a query.
	 * The data row names is converted so in the query use the names of the class properties.
	 * @param array $Query The query array
	 * @since 1.1
	 * @access public
	 * @return boolean If it was a success
	 */
	public function Find($Query = NULL){
		if (!is_null($Query) && is_array($Query)) {
			$Data = $this->_CI->_INTERNAL_DATABASE_MODEL->Find($Query,$this->Database_Table,$this);
			if($Data !== false){
				return self::Load($Data);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}