<?php   

    // Load Configs
    require_once 'config/setup.php';
    require_once 'config/config.php';

    // Load Helpers
    require_once 'helpers/print_var.php';
    require_once 'helpers/redirect.php';
    require_once 'helpers/user_session.php';
    require_once 'helpers/flash_messages.php';
    
    // Autoload Core Classes
    spl_autoload_register(function ($className) {
        require_once 'libraries/'. $className . '.php';
    });

    // Load Classes
    require_once 'classes/Club.class.php';