<?php

    ini_set('display_errors', true);
    error_reporting(E_ALL);
    
    // Load config files.
    require_once('config/config.php');
    require_once('config/clubs.php');
    
    // Load all helpers
    require_once('helpers/printVar.php');
    require_once('helpers/flash_messages.php');
    // require_once('helpers/redirect.php');

    // Autoload Core Classes
    spl_autoload_register(function ($className) {
        require_once ('classes/'. $className . '.php');
    });

    // Default club and page to load if no URL is provided.
    $clubLoad = 'social';
    $pageLoad = 'index';

    if (isset($_GET['url'])) {
        // URL Format
        // https://www.stjosephscssc.co.uk/CLUB/PAGE/PARAMETERS
        // URL Example
        // https://www.stjosephscssc.co.uk/bowls/fixtures/23

        // Trim trailing whitespace, convert to lower and split URL.
        $url = trim($_GET['url']);
        $url = rtrim($url, '/');
        $url = strtolower($url);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        // If club exists in club_config then set clubLoad
        if (array_key_exists($url[0], CLUBS)) {
        // if (array_key_exists($url[0], CLUBS)) {
            $clubLoad = $url[0];
            unset($url[0]);

            // If the second parameter is a valid page of the club given then set pageLoad
            if (isset($url[1]) && in_array($url[1], CLUBS[$clubLoad]['sections'])) {
            // if (isset($url[1]) && in_array($url[1], CLUBS[$clubLoad]['sections'])) {    
                $pageLoad = $url[1];
                unset($url[1]);

                if (sizeof($url) > 0) {
                    unset($url);
                    // TODO: Redirect 404 or do single page event view.
                }
            } else {
                // TODO: Redirect 404
            }
        } else {
            // TODO: Redirect 404
            redirect('blah');
        }
    }

    // Get the all of the club's information.
    $club = new Club($clubLoad);

    // Load the relevant View from $pageLoad
    // If it's an invalid page then it should've been redirected to 404.php before doing this.
    // Check if file exists first, just incase it's been accidentally deleted.
    // TODO: Check to see if it needs \\
    if (file_exists(PUBLIC_VIEWS . $pageLoad . '.php')) {
    require_once(PUBLIC_VIEWS . $pageLoad . '.php');
    } else {
    die("Fatal Error. The page <b>{$pageLoad}</b> has been deleted.");
    }

