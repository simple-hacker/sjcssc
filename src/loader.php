<?php   

    // Load Configs
    require_once 'config/config.php';
    require_once 'config/clubs.php';

    // Load Helpers
    require_once 'helpers/print_var.php';
    // require_once 'helpers/flash_messages.php';
    
    // Autoload Core Classes
    spl_autoload_register(function ($className) {
        require_once 'libraries/'. $className . '.php';
    });

    // Load Classes
    require_once 'classes/Club.class.php';