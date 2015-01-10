<?php

$_tests_dir = getenv('WP_TESTS_DIR');
if (!$_tests_dir)
    $_tests_dir = '/tmp/wordpress-tests-lib';

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
    require dirname(__FILE__) . '/../../pbp-wp-core-plugin.php';
}

tests_add_filter('muplugins_loaded', '_manually_load_plugin');
print_r("error: " . $_tests_dir);
require $_tests_dir . '/includes/bootstrap.php';


define('PBP_CORE_PREFIX', 'pbpCore');
define('PBP_PLUGIN_BASE_PATH', __DIR__ . '/../..');


spl_autoload_register(function ($class) {
// Only autoload plugin functions
    if (substr($class, 0, strlen(PBP_CORE_PREFIX)) === PBP_CORE_PREFIX) {
        $class = str_replace('\\', '/', $class);
        include PBP_PLUGIN_BASE_PATH . '/' . $class . '.php';
    }
});
