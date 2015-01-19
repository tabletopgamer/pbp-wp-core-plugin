<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 11:45
 */

namespace PbP_WP\Custom_Posts;

/**
 * Class Custom_Field
 * @package PbP_WP
 *
 * @method static SHORT_TEXT()
 * @method static LONG_TEXT()
 * @method static NUMBER()
 * @method static IMAGE()
 */
class Custom_Field {

	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var Input_Type
	 */
	private $type;

	public function __construct( $name, Input_Type $type ) {
		$this->name = $name;
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * @return Input_Type
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * @param Input_Type $type
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}
}
