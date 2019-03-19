<?php   

    error_reporting(E_ALL|E_STRICT);

    // Load Configs
    require_once 'config/setup.php';
    require_once 'config/config.php';

    // Load Helpers
    require_once 'helpers/print_var.php';
    require_once 'helpers/flash_messages.php';
    require_once 'helpers/redirect.php';
    require_once 'helpers/scoreline.php';
    require_once 'helpers/image.php';
    require_once 'helpers/url.php';
    require_once 'helpers/functions.php';
    // require_once 'helpers/user_session.php';
    
    
    // Autoload Core Classes
    spl_autoload_register(function ($className) {
        require_once 'libraries/'. $className . '.php';
    });