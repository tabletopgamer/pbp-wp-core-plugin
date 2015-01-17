<?php

use PbP_Core\Repository\Entity_Type;
use PbP_WP\Custom_Post_Register;
use PbP_WP\Implementations\Custom_Post_Factory;

/**
 * Plugin Name: PlayByPost Games
 * Plugin URI: https://github.com/tabletopgamer/pbp-wp-core-plugin
 * Description: A custom plugin that allows you to create your own play by post
 * games. It is also the core needed for all other PbP plugins
 * Version: 1.0 -b
 * Author: tabletopgamer
 * Author URI: https://github.com/tabletopgamer
 * */
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

		$postFactory = new Custom_Post_Factory();

		$postRegister = new Custom_Post_Register();
		$postRegister->add_custom_post( $postFactory->create_post_from_entity_type( Entity_Type::GAME() ) );
		$postRegister->add_custom_post( $postFactory->create_post_from_entity_type( Entity_Type::CARD() ) );

		$postRegister->register_all();
	}

}


define( 'PBP_CORE_PREFIX', 'PbP_' );
define( 'PBP_PLUGIN_BASE_PATH', dirname( __FILE__ ) );


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


$pbpCore = PbP_Tabletop_Core::instance();




