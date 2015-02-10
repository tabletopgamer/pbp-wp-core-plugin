<?php

use PbP_Cards\PbP_Card_Shortcode;
use PbP_Game\PbP_Base_Game;
use PbP_WP\PbP_Plugin_Loader;

/**
 * Plugin Name: PlayByPost Games
 * Plugin URI: https://github.com/tabletopgamer/pbp-wp-core-plugin
 * Description: A custom plugin that allows you to create your own play by post
 * games. It is also the core needed for all other PbP plugins
 * Version: 1.0 -b
 * Author: tabletopgamer
 * Author URI: https://github.com/tabletopgamer
 * */

define( 'PBP_CORE_PREFIX', 'PbP_' );
define( 'PBP_PLUGIN_BASE_PATH', dirname( __FILE__ ) );

include( 'class-di-handler.php' );    //TODO: take this out

spl_autoload_register( function ( $path_to_include ) {

	// Only autoload plugin functions
	if ( substr( $path_to_include, 0, strlen( PBP_CORE_PREFIX ) ) === PBP_CORE_PREFIX ) {

		$path_to_include = strtolower( strtr( $path_to_include, array( '\\' => '/', '_' => '-' ) ) );

		$class_name = basename( $path_to_include );

		$path_to_include = str_replace( $class_name, 'class-' . $class_name, $path_to_include );

		$path_to_include = PBP_PLUGIN_BASE_PATH . '/' . $path_to_include . '.php';

		if ( ! file_exists( $path_to_include ) ) {
			return false;
		}
		require_once $path_to_include;

		return true;
	}
} );


class PbP_Tabletop_Core {
	private static $instance = null;

	public static function instance() {

		if ( self::$instance === null ) {
			self::$instance = new PbP_Tabletop_Core();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->file = __FILE__;

		$di = DI_Handler::create_di();

		$plugin_loader = new PbP_Plugin_Loader();

		$plugin_loader->add_plugin( new PbP_Card_Shortcode( $di->resolve( 'PbP_Core\Templates\ITemplate_Engine' ) ) );
		$plugin_loader->add_plugin( new PbP_Base_Game());

		$plugin_loader->load_all();
	}

}

$pbpCore = PbP_Tabletop_Core::instance();





