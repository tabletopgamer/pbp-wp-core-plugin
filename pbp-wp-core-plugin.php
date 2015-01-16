<?php

use PbP_WP\Implementations\Custom_Post_Type_Factory;
use PbP_WP\Implementations\Custom_Post_Register;

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
        
		$typeProvider = new Custom_Post_Type_Factory();
		$postRegister = new Custom_Post_Register();
//
//		foreach ($typeProvider->get_available_types() as $availablePostType){
//			$postRegister->add_custom_post($availablePostType);
//		}

		$postRegister->register_all();
    }

}

define( 'PBP_CORE_PREFIX', 'PbP_' );
define( 'PBP_PLUGIN_BASE_PATH', dirname( __FILE__ ) );


spl_autoload_register( function ( $path_to_include ) {

	// Only autoload plugin functions
    if ( substr( $path_to_include, 0, strlen( PBP_CORE_PREFIX ) ) === PBP_CORE_PREFIX ) {
		
		$path_to_include = strtolower( strtr( $path_to_include, array( '\\' => '/', '_' => '-') ) );
	
		$class_name = basename( $path_to_include );
		
		$path_to_include = str_replace($class_name, 'class-' . $class_name, $path_to_include);
		
		$path_to_include  = PBP_PLUGIN_BASE_PATH . '/' . $path_to_include . '.php';
		
		if (  !file_exists( $path_to_include ))
			return false;
		
		require_once $path_to_include; 

		return true;
    }
} );



$pbpCore = PbP_Tabletop_Core::instance();




