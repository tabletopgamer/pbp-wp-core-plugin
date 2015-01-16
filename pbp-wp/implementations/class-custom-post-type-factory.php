<?php
namespace PbP_WP\Implementations;

use PbP_Core\Interfaces\Entity_Type;

class Custom_Post_Type_Factory {

	private $available_types;

	function __construct() {

		$this->available_types = array(
			Entity_Type::CARD      => new Custom_Post_Type( Entity_Type::CARD, 'PbP Card', 'PbP Cards' ),
			Entity_Type::GAME      => new Custom_Post_Type( Entity_Type::GAME, 'PbP Game', 'PbP Games' ),
			Entity_Type::CHARACTER => new Custom_Post_Type( Entity_Type::CHARACTER, 'PbP Character', 'PbP Characters' ),
		);

	}

	/**
	 *
	 * @param string $type
	 *
	 * @return Custom_Post_Type
	 */
	public function get_type( $type ) {


		return isset( $this->available_types[ $type ] )
			? $this->available_types[ $type ]
			: $this->available_types[ Entity_Type::UNKNOWN ];
	}
}
	
	