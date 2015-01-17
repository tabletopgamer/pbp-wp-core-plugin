<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 11:45
 */

namespace PbP_WP\Custom_Posts;

/**
 * Class Custom_Post_Field
 * @package PbP_WP
 *
 * @method static SHORT_TEXT()
 * @method static LONG_TEXT()
 * @method static NUMBER()
 * @method static IMAGE()
 */
class Custom_Post_Field {

	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var mixed
	 */
	private $value;
	/**
	 * @var Custom_Post_Field_Type
	 */
	private $type;



	public function __construct( $name, Custom_Post_Field_Type $type ) {
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
	 * @return Custom_Post_Field_Type
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * @param Custom_Post_Field_Type $type
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function get_value() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function set_value( $value ) {
		$this->value = $value;
	}
}
