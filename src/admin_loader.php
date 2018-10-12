<?php
    // Get all database and site variables.
    require_once('config/config.php');
    require_once('config/clubs.php');

    // Load all helpers
    require_once('helpers/flash_messages.php');
    require_once('helpers/printVar.php');

    // Autoload Core Classes
    spl_autoload_register(function ($className) {
        require_once ('classes/'. $className . '.php');
    });


    // // Default club and page if nothing is provided.
    // $clubLoad = 'social';
    // $pageLoad = 'index';
    // $mode = '';
    // $id = 0;

    // // If the url is provided then check to see if valid club, and valid page if provided too.
    // // Else the default page is social and index.
    // // URL configuration is http://stjosephscssc.co.uk/admin/CLUB/PAGE/PARAMETERS
    // if (isset($_GET['url'])) {
    //     // Get the url, remove  trailing /, filter, and explode into components.
    //     $url = rtrim($_GET['url'], '/');
    //     $url = strtolower($url);
    //     $url = filter_var($url, FILTER_SANITIZE_URL);
    //     $url = explode('/', $url);

    //     // Set the Club if it exists else redirect to 404.
    //     if (array_key_exists($url[0], $clubs_cfg)) {
    //         $clubLoad = $url[0];
    //         unset($url[0]);

    //         // Check if the club has the valid page
    //         if (isset($url[1])) {
    //             if(in_array($url[1], $clubs_cfg[$clubLoad]['sections']) || $url[1] === 'index') {
    //                 $pageLoad = $url[1];
    //                 unset($url[1]);

    //                 // Check what mode was set.
    //                 if (isset($url[2])) {
    //                     $modes = ["add", "edit", "delete", "view"];
    //                     if (in_array($url[2], $modes)) {
    //                         $mode = $url[2];
    //                         unset($url[2]);

    //                         // Get the id for edit and delete, make sure it's an integer.
    //                         if (isset($url[3]) && settype($url[3], "int")) {
    //                             $id = abs($url[3]); // Just get absolute value rather than checking if above 0.
    //                             unset($url[3]);

    //                             // Check if anything else was added incorrectly.  If so then redirect to 404.
    //                             if (count($url) > 0) {
    //                                 unset($url);
    //                                 redirect('404');
    //                             }
    //                         }
    //                     } else {
    //                         redirect('404');
    //                     }
    //                 }
    //             } else {
    //                 redirect('404');
    //             }
    //         }
    //     } else {
    //        redirect('404');
    //     }
    // }

    // // Get the all of the club's information.
    // $club = new Club($clubLoad);
    // $data = [];

    // // Classes can be Event, Fixture, Notice, Outing etc.
    // // But the pages are called, events, fixtures, notices, outings etc.
    // // Need to convert to ucwords and remove trailing s if there is one.
    // // so fixtures becomes Fixture
    // if ($pageLoad != "index") {
    //     $class_name = ucwords(rtrim($pageLoad, "s"));
    //     $currentClass = new $class_name;

    //     // Call the mode method in the $currentClass.
    //     if (isset($mode) && $mode != '') {
    //         if(method_exists($currentClass, $mode)){
    //             $data = call_user_func_array([$currentClass, $mode], [$club->id, $id]); //Pass the club_id and the object id for editing and saving.
    //             // Get all the data that was sent to the method.
    //             // Including flash messages etc.
    //         } else {
    //             die("Invalid method name {$mode} in class {$class_name}");
    //         }
    //     }
    // } 

    // // echo '<pre>',print_r($club,1),'</pre>';

    // // Load the relevant View from $loadPage
    // // If it's an invalid page then it should've been redirected to 404 before doing this.
    // // Check if file exists first, just incase it's been accidentally deleted.
    // // TODO: Check to see if it needs \\
    // if (file_exists(ADMIN_VIEWS . $pageLoad . '.php')) {
    //     require_once(ADMIN_VIEWS . $pageLoad . '.php');
    // } else {
    //     die("Fatal Error. The page <b>{$pageLoad}</b> has been deleted.");
    // }