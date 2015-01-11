<?php

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
        $this->basename = plugin_basename( $this->file );

        $this->plugin_dir = plugin_dir_path( $this->file );
        $this->plugin_url = plugin_dir_url( $this->file );
        
        $this->include_classes();
    }

    private function include_classes() {
        $files_to_include = array(
            // cards plugin
        //   'cards/PbpCardShortcode.php',
            
            // post plugin
		   'game-post/class-pbp-custom-post.php',
           'game-post/class-pbp-game-custom-post.php',
           'game-post/class-pbp-card-custom-post.php',
        );
        
        foreach( $files_to_include as $file_relative_path) {
            require( $this->plugin_dir . $file_relative_path );
        }
    }
}


//PbpCardShortcode::init();

$pbpCore = PbP_Tabletop_Core::instance();

$pbpGamePost = new PbP_Game_Custom_Post();
$pbpGardPost = new PbP_Card_Custom_Post();


$pbpGamePost->init();
$pbpGardPost->init();