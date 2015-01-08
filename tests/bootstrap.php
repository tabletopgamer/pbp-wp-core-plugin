<?php

define('PBP_CORE_PREFIX', 'pbpCore');
define('PBP_PLUGIN_BASE_PATH', __DIR__ . '/..');


require_once (PBP_PLUGIN_BASE_PATH . '/../../../index.php');


spl_autoload_register(function ($class) {

    // Only autoload plugin functions
   if (substr($class, 0, strlen(PBP_CORE_PREFIX)) === PBP_CORE_PREFIX) 
                {
        $class = str_replace('\\', '/', $class);

        include PBP_PLUGIN_BASE_PATH . '/' . $class . '.php';
    }
});
?>
