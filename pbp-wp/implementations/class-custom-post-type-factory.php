<?php
namespace PbP_WP\Implementations;

use PbP_Core\Interfaces\Entity_Type;

class Custom_Post_Type_Factory {

	private $available_types;

	function __construct() {

		$this->available_types = array(
			Entity_Type::CARD()->get_value() => new Custom_Post_Type( Entity_Type::CARD()->get_value(), 'PbP Card', 'PbP Cards' ),
			Entity_Type::GAME()->get_value() => new Custom_Post_Type( Entity_Type::GAME()->get_value(), 'PbP Game', 'PbP Games' ),
			Entity_Type::CHARACTER()->get_value() => new Custom_Post_Type( Entity_Type::CHARACTER()->get_value(), 'PbP Character', 'PbP Characters' ),
		);

	}

	/**
	 *
	 * @param Entity_Type $type
	 *
	 * @return Custom_Post_Type
	 */
	public function get_type( $type ) {

		try {
		return $this->available_types[ $type->get_value() ];
		} catch (\Exception $exception){
			throw new \Exception("There is no CustomPostType defined for '{$type->get_value()}' entity type'", 0, $exception);
		}
	}
}
	
	