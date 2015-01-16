<?php
namespace PbP_WP\Implementations;

use PbP_WP\Interfaces\ICustom_Post_Type;

class Custom_Post_Type implements ICustom_Post_Type {

	private $post_type;
	private $single_name;
	private $plural_name;

	public function __construct( $post_type, $single_name, $plural_name ) {
		$this->post_type   = $post_type;
		$this->single_name = $single_name;
		$this->plural_name = $plural_name;
	}

	public function get_post_type() {
		return $this->post_type;
	}

	public function get_singular_name() {
		return $this->single_name;
	}

	public function get_plural_name() {
		return $this->plural_name;
	}

	public function get_fields() {
		return null;
	}
}

//
//class Custom_Post_Field_Types {
//	const TEXT = 'text';
//	const TEXTAREA = 'textarea';
//
//
//}
//
//class Custom_Post_Field {
//	private $name;
//	private $type;
//
//	/**
//	 * @return string
//	 */
//	public function getName() {
//		return $this->name;
//	}
//
//	/**
//	 * @param string $name
//	 */
//	public function setName( $name ) {
//		$this->name = $name;
//	}
//
//	/**
//	 * @return string
//	 */
//	public function getType() {
//		return $this->type;
//	}
//
//	/**
//	 * @param string $type
//	 */
//	public function setType( $type ) {
//		$this->type = $type;
//	}
//}
//

	
	