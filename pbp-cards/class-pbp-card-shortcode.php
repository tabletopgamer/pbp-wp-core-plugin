<?php
namespace PbP_Cards;

use PbP_Core\Included_File;
use PbP_Core\IPbP_Plugin;
use PbP_WP\Custom_Posts\Types\Card_Post_Type;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class PbP_Card_Shortcode implements IPbP_Plugin {

	public function __construct() {

		add_shortcode( 'pbpcard', array( $this, 'handle_shortcode' ) );

		add_filter( 'comment_text', 'do_shortcode' );
	}

	function handle_shortcode( $atts, $content = null ) {

		$cards = array();
		$i     = 0;
		foreach ( $atts as $att ) {
			$i ++;
			$text = "this is the card description";
			if ( $content == null ) {
				$cards[] = "<div id=\"div-$att$i\" class='pbp-card' ><p>$att</p>$text</div></span>";
			} else {
				$content = do_shortcode( $content );
				$cards[] = "<span class='pbp-container'><span id=\"$att$i\" title='$att' class='pbp-card-handle'>$content</span>" .
				           "<div id=\"div-$att$i\" class='pbp-card--hidden' ><p>$att</p>$text</div></span>";
			}


		}

		$result = implode( ' ', $cards );

		return $result;
	}

	/**
	 * @return Included_File[]
	 */
	function get_included_scripts() {
		return [
			new Included_File( 'pbp-cards-js', 'pbp-cards/js/cards.js' )
		];
	}

	/**
	 * @return Included_File[]
	 */
	function get_included_styles() {
		return [
			new Included_File( 'pbp-cards-css', 'pbp-cards/css/cards.css' )
		];
	}

	/**
	 * @return ICustom_Post_Type[]
	 */
	function get_custom_post_types() {
		return [
			new Card_Post_Type(),
		];
	}
}