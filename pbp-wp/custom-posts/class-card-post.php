<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 15:24
 */

namespace PbP_WP\Custom_Posts;


class Card_Post extends Custom_Post_Base {

	/**
	 * @return string
	 */
	protected function get_post_type() {
		return 'tabletop_card';
	}

	/**
	 * @return Custom_Post_Field[]
	 */
	protected function get_post_fields() {
		return [
			new Custom_Post_Field( 'deck_count', Custom_Post_Field_Type::NUMBER() ),
		];
	}
}