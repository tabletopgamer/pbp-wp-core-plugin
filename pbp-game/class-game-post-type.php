<?php
/**
 * User: tabletopgamer
 * Date: 17.01.2015
 * Time: 15:24
 */

namespace PbP_Game;

use PbP_WP\Custom_Posts\Custom_Field;
use PbP_WP\Custom_Posts\ICustom_Post_Type;
use PbP_WP\Custom_Posts\Input_Type;

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
			new Custom_Field( 'category', Input_Type::SHORT_TEXT() ),
			new Custom_Field( 'world', Input_Type::SHORT_TEXT() ),
		];
	}
}