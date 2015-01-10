<?php

/**
 * Plugin Name: PlayByPost Games
 * Plugin URI: https://github.com/tabletopgamer/pbp-wp-core-plugin
 * Description: A custom plugin that allows you to create your own play by post
 * games. It is also the core needed for all other PbP plugins
 * Version: 1.0
 * Author: tabletopgamer
 * Author URI: https://github.com/tabletopgamer
 * */

class PbpTabletopCore {

    private static $instance = null;

    public static function instance() {

        if (self::$instance === null) {
            self::$instance = new PbpTabletopCore();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->file = __FILE__;
        $this->basename = plugin_basename($this->file);

        $this->plugin_dir = plugin_dir_path($this->file);
        $this->plugin_url = plugin_dir_url($this->file);
        
        $this->include_classes();
    }

    private function include_classes() {
        $files_to_include = array(
            // cards plugin
           'cards/PbpCardShortcode.php',
            
            // post plugin
           'game-post/PbpGameCustomPost.php',
        );
        
        foreach($files_to_include as $file_relative_path){
            require($this->plugin_dir . $file_relative_path);
        }
    }
}

$pbpCore = PbpTabletopCore::instance();

PbpCardShortcode::init();
PbpGameCustomPost::init();