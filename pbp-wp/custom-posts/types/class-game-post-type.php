<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 15:24
 */

namespace PbP_WP\Custom_Posts\Types;


use PbP_WP\Custom_Posts\Custom_Field;
use PbP_WP\Custom_Posts\Input_Type;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class Game_Post_Type implements ICustom_Post_Type {

	/**
	 * @return string
	 */
	public function get_type_name() {
		return 'tabletop_game';
	}

	/**
	 * @return Custom_Field[]
	 */
	public function get_post_fields() {
		return [
			new Custom_Field( 'location', Input_Type::SHORT_TEXT() ),
			new Custom_Field( 'author_note', Input_Type::LONG_TEXT() ),
			new Custom_Field( 'lore', Input_Type::LONG_TEXT() ),
			new Custom_Field( 'desired_number_of_players', Input_Type::NUMBER() ),
		];
	}
}