<?php
/**
 * User: tabletopgamer
 * Date: 25.01.2015
 * Time: 10:56
 */

namespace PbP_Core\Events;

use Event_Args;

class Event {
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var Event_Args
	 */
	private $arguments;

	/**
	 * @param string $name
	 * @param Event_Args $arguments
	 */
	public function __construct($name, Event_Args $arguments){

		if (!is_string($name)){
			throw new \InvalidArgumentException("Argument 'name' should be a string. ('name:'$name)");
		}

		$this->name = $name;
		$this->$arguments = $arguments;
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * @return Event_Args
	 */
	public function get_arguments() {
		return $this->arguments;
	}

}