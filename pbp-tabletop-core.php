<?php

/**
 * Plugin Name: PbP Tabletop Core
 * Plugin URI: http://
 * Description: A custom plugin that allows you to create your own play by post
 * games. It is also the core needed for all other PbP plugins
 * Version: 1.0
 * Author: tabletopgamer
 * Author URI: 
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

        $this->includes_path = trailingslashit(plugin_dir_path($this->file) . 'includes');
        $this->includes_url = trailingslashit(plugin_dir_url($this->file) . 'includes');
        
        $this->include_classes();
    }

    private function include_classes() {
        $files_to_include = array(
           'PbpCardShortcode.php',
           'PbpGameCustomPost.php',
        );
        
        foreach($files_to_include as $file_relative_path){
            require($this->includes_path . $file_relative_path);
        }
    }
}

$pbpCore = PbpTabletopCore::instance();

PbpCardShortcode::init();
PbpGameCustomPost::init();