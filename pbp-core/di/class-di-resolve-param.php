<?php
/**
 * User: tabletopgamer
 * Date: 01.02.2015
 * Time: 20:27
 */

namespace PbP_Core\DI;


class DI_Resolve_Param {
	/**
	 * @var string
	 */
	private $type_name;

	/**
	 * @param string $type_name
	 */
	public function __construct($type_name){

		if (!is_string($type_name)){
			throw new \InvalidArgumentException("Parameter 'type_name' should be of type 'string'.");
		}

		$this->type_name = $type_name;
	}

	/**
	 * @return string
	 */
	public function get_type_name() {
		return $this->type_name;
	}


}