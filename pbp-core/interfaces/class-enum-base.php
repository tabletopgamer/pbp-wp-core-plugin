<?php namespace PbP_Core\Interfaces;

/**
 * Base implementation for EnumLike classes
 * 
 * @pachage core
 * @author tabletopgamer tablerpggamer@gmail.com
 */
abstract class Enum_Base {
	/**
	 * @return array A List with all values from this enum
	 */
	abstract protected function GetAllowedValues();
	
	/**
	 * @return mixed The value that is used in case the enum cannot be properly initialized
	 */
	abstract protected function GetDefaultValue();

	/**
	 * @var sring the current value
	 */
	private $current_value;
	
	/**
	 * @param string $name The name of the enumeration item you want to instantiate
	 */
	function __construct($name) {
		$allowed_values = $this->GetAllowedValues();
		
		if (isset($allowed_values[$name])){
			$this->current_value = $allowed_values[$name];
		} else {
			$this->current_value = $this->GetDefaultValue();	
		}
	}

	function get_name(){
		return $this->current_value;
	}
}