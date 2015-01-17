<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 15:24
 */

namespace PbP_WP\Custom_Posts;


class Game_Post extends Custom_Post_Base {

	/**
	 * @return string
	 */
	protected function get_post_type() {
		return 'tabletop_game';
	}

	/**
	 * @return Custom_Post_Field[]
	 */
	protected function get_post_fields() {
		return [
			new Custom_Post_Field( 'location', Custom_Post_Field_Type::SHORT_TEXT() ),
			new Custom_Post_Field( 'author_note', Custom_Post_Field_Type::LONG_TEXT() ),
			new Custom_Post_Field( 'lore', Custom_Post_Field_Type::LONG_TEXT() ),
			new Custom_Post_Field( 'desired_number_of_players', Custom_Post_Field_Type::NUMBER() ),
		];
	}
}