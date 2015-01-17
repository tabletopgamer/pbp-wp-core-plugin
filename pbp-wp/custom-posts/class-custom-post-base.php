<?php
namespace PbP_WP\Custom_Posts;

use PbP_WP\Interfaces\ICustom_Post;

abstract class Custom_Post_Base implements ICustom_Post {
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $post_type;

	/**
	 * @var Custom_Post_Field[]
	 */
	private $fields;

	public function __construct() {
		$this->post_type = $this->get_post_type();
		$this->fields    = $this->get_post_fields();
	}

	/**
	 * @return string
	 */
	protected abstract function get_post_type();

	/**
	 * @return Custom_Post_Field[]
	 */
	protected abstract function get_post_fields();

	/**
	 * @return string
	 */
	public function get_type() {
		return $this->post_type;
	}

	/**
	 * @return Custom_Post_Field[]
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * @param Custom_Post_Field[] $fields
	 */
	public function set_fields( $fields ) {
		$this->fields = $fields;
	}

	/**
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}


}