<?php
namespace PbP_Cards;

use PbP_Core\IPbP_Plugin;
use PbP_Core\Models\Included_File;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class PbP_Card_Shortcode implements IPbP_Plugin {

	public function __construct() {
		add_shortcode( 'pbpcard', array( $this, 'handle_shortcode' ) );

		add_filter( 'comment_text', 'do_shortcode' );
	}

	//TODO: make tempate loader

	function handle_shortcode( $atts, $content = null ) {

		$cards = array();
		$i     = 0;

		foreach ( $atts as $att ) {
			$i ++;

			$model = (object) [
				'id'          => "$att$i",
				'text'        => 'this is the card description',
				'attr'        => "$att",
				'content'     => $content,
				'show_hidden' => $content == null
			];

			$cards[] = $this->renderTemplate( 'card-main-template', $model);
/*

			if ( $model->show_hidden ) {
				$cards[] = "<div id=\"div-{$model->id}\" class='pbp-card' ><p>{$model->attr}</p>{$model->text}</div></span>";
			} else {
				$cards[] = "<span class='pbp-container'><span id=\"$att$i\" title='{$model->content}' class='pbp-card-handle'>{$model->content}</span>" .
				           "<div id=\"div-{$model->id}\" class='pbp-card--hidden' ><p>{$model->attr}</p>{$model->text}</div></span>";
			}
*/

		}

		$result = implode( ' ', $cards );

		return $result;
	}

	function renderTemplate( $templateName, $model ) {
		$templateLocation = dirname(__FILE__) . '/templates/' . $templateName . '.php';

		$cacheLocation    = dirname(__FILE__) . '/templates_cache/' . $templateName . '.php';
	//	if ( ! file_exists( $cacheLocation ) || filemtime( $cacheLocation ) < filemtime( $templateLocation ) )
	//	{
return include $templateLocation;

			$code = file_get_contents( $templateLocation );

			$code = preg_replace( '~\{\s*(.+?)\s*\}~', '<?php echo htmlspecialchars($model->$1, ENT_QUOTES) ?>', $code );
			$code = preg_replace( '~\{!!\s*(.+?)\s*\}~', '<?php echo $1 ?>', $code );
			$code = preg_replace( '~\{%\s*(.+?)\s*\}~', '<?php $1 ?>', $code );

		//	file_put_contents( $cacheLocation, $code );
	//	}

		// run template
		//include 'tplCache/' . $templateName . '.php';
		ob_start();
		include ($cacheLocation);

		$result = ob_get_contents();
		ob_clean();
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