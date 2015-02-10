<?php
namespace PbP_Game;

use PbP_Core\IPbP_Plugin;
use PbP_Core\Templates\ITemplate_Engine;
use PbP_WP\Custom_Posts\ICustom_Post_Type;

class PbP_Base_Game implements IPbP_Plugin {

	/**
	 * @param ITemplate_Engine $template_engine
	 */
	public function __construct( ) {
	}

	/**
	 * @return \PbP_Core\Models\Included_File[]
	 */
	function get_included_scripts() {
		return [
		];
	}

	/**
	 * @return \PbP_Core\Models\Included_File[]
	 */
	function get_included_styles() {
		return [
		];
	}

	/**
	 * @return ICustom_Post_Type[]
	 */
	function get_custom_post_types() {
		return [
			new Game_Post_Type(),
		];
	}
}