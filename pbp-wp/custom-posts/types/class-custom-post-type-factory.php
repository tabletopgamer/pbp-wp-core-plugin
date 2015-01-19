<?php
namespace PbP_WP\Custom_Posts\Types;

use PbP_Core\Repository\Entity_Type;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class Custom_Post_Type_Factory implements ICustom_Post_Type_Factory {

	/**
	 * @var array
	 */
	private $known_post_types;

	/**
	 * @param ICustom_Post_Type []
	 */
	public function __construct( array $known_post_types ) {
		$this->known_post_types = array();

		foreach ( $known_post_types as $post_type ) {
			$this->add_known_post_type( $post_type );
		}
	}

	/**
	 * @param ICustom_Post_Type $post_type
	 */
	public function add_known_post_type( ICustom_Post_Type $post_type ) {
		$this->known_post_types[ $post_type->get_type_name() ] = $post_type;
	}

	/**
	 * @param string $type_name
	 *
	 * @return ICustom_Post_Type
	 */
	public function get_post_type( $type_name ) {

		if ( ! isset( $this->known_post_types[ $type_name ] ) ) {
			throw new \Exception( "There is no Custom_Post_Type defined for '$type_name''" );
		}

		return $this->known_post_types[ $type_name ];
	}


	/**
	 * @param Entity_Type $type
	 *
	 * @return ICustom_Post_Type
	 */
	public function create_post_from_entity_type( $type ) {

		switch ( $type ) {
			case Entity_Type::CARD() :
				return new Card_Post_Type();
			case Entity_Type::GAME():
				return new Game_Post_Type();
			default:
				throw new \Exception( "There is no CustomPostType defined for '{$type->get_value()}' entity type'" );
		}
	}
}
	