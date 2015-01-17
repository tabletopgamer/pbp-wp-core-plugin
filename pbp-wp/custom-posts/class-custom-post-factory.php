<?php
namespace PbP_WP\Custom_Posts;

use PbP_Core\Repository\Entity_Type;
use PbP_WP\Interfaces\ICustom_Post;
use PbP_WP\Interfaces\ICustom_Post_Factory;

class Custom_Post_Factory implements ICustom_Post_Factory {

	/**
	 * @param \WP_Post $type
	 *
	 * @return ICustom_Post
	 */
	public function create_post( \WP_Post $post  ) {

		switch ( $post->post_type ) {
			case 'tabletop_card' :
				return new Card_Post();
			case 'tabletop_game':
				return new Game_Post();
			default:
				throw new \Exception( "There is no CustomPostType defined for '$type' entity type'" );
		}
	}


	/**
	 * @param Entity_Type $type
	 *
	 * @return ICustom_Post
	 */
	public function create_post_from_entity_type( $type ) {

		switch ( $type ) {
			case Entity_Type::CARD() :
				return new Card_Post();
			case Entity_Type::GAME():
				return new Game_Post();
			default:
				throw new \Exception( "There is no CustomPostType defined for '{$type->get_value()}' entity type'" );
		}
	}
}
	