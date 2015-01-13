<?php

echo "BS2";
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

define( 'PBP_CORE_PREFIX', 'PbP_' );
define( 'PBP_PLUGIN_BASE_PATH', realpath(dirname( __FILE__ ) . '/../..'));


spl_autoload_register( function ( $path_to_include ) {

	// Only autoload plugin functions
    if ( substr( $path_to_include, 0, strlen( PBP_CORE_PREFIX ) ) === PBP_CORE_PREFIX ) {
		
		$path_to_include = strtolower( strtr( $path_to_include, array( '\\' => '/', '_' => '-') ) );
	
		$class_name = basename( $path_to_include );
		
		$path_to_include = str_replace($class_name, 'class-' . $class_name, $path_to_include);
		
		$path_to_include  = PBP_PLUGIN_BASE_PATH . '/' . $path_to_include . '.php';
		
		if (  !file_exists( $path_to_include )) {
			print_r( "Can't include file: $path_to_include ");
			return false;
		}
		
		require_once $path_to_include; 

		return true;
    }
} );


