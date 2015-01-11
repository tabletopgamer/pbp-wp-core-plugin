<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( !$_tests_dir )
    $_tests_dir = '/tmp/wordpress-tests-lib';

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin(  ) {
    require dirname( __FILE__ ) . '/../../pbp-wp-core-plugin.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );
print_r( "error: " . $_tests_dir );
require $_tests_dir . '/includes/bootstrap.php';


define( 'PBP_CORE_PREFIX', 'pbpcore' );
define( 'PBP_PLUGIN_BASE_PATH', __DIR__ . '/../..' );


spl_autoload_register( function ( $path_to_include ) {
	echo "\n Searching for: [" . $path_to_include . ']';
	
	// Only autoload plugin functions
    if ( substr( $path_to_include, 0, strlen( PBP_CORE_PREFIX ) ) === PBP_CORE_PREFIX ) {
		$path_to_include = strtolower( strtr( $path_to_include, array( '\\' => '/', '_' => '-') ) );
	
		$class_name = basename( $path_to_include );
		
		$class_filename = "class-" . $class_name;
		
		$path_to_include = str_replace($class_name, $class_filename, $path_to_include);
		
		$path_to_include  = PBP_PLUGIN_BASE_PATH . '/' . $path_to_include . '.php';
		
		echo "\n Trying to include : [" . $path_to_include . ']';
        
		require_once $path_to_include; 
		
    }
} );
