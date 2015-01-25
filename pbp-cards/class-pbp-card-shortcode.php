<?php
namespace PbP_Cards;

use PbP_Core\IPbP_Plugin;
use PbP_Core\Models\Included_File;
use PbP_Core\Templates\ITemplate_Engine;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class PbP_Card_Shortcode implements IPbP_Plugin {

	private $template_engine;

	/**
	 * @param ITemplate_Engine $template_engine
	 */
	public function __construct( ITemplate_Engine $template_engine ) {
		add_shortcode( 'pbpcard', array( $this, 'handle_shortcode' ) );

		add_filter( 'comment_text', 'do_shortcode' );
		$this->template_engine = $template_engine;
	}

	function handle_shortcode( $atts, $content = null ) {

		$cards = array();
		$i     = 0;
		foreach ( $atts as $att ) {
			$i ++;

			$model = [
				'id'          => "$att$i",
				'text'        => 'this is the card description',
				'attr'        => "$att",
				'content'     => "$content",
				'has_content' => ($content != null),
			];

			$cards[] = $this->template_engine->render( Card_Constants::PBP_CARD_TEMPLATE , $model );
		}

		$result = implode( ' ', $cards );

		return $result;
	}

	/**
	 * @return \PbP_Core\Models\Included_File[]
	 */
	function get_included_scripts() {
		return [
			new Included_File( 'pbp-cards-js', 'pbp-cards/js/cards.js' )
		];
	}

	/**
	 * @return \PbP_Core\Models\Included_File[]
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