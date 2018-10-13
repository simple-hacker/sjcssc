<?php

    // Main Application Loading Class
    // Obtains the URL, assigns controllers and methods to be executed.

    // URL Formats
    // ==========================================================
    // Public   http://www.stjosephscssc.co.uk/CLUB/PAGE/ID
    // e.g.     http://www.stjosephscssc.co.uk/social/events/8
    //
    // Admin    http://www.stjosephscssc.co.uk/admin/CLUB/PAGE/MODE/ID
    // e.g.     http://www.stjosephscssc.co.uk/admin/bowls/fixtures/edit/3
    
    // TODO:    Need to work out how to load User controllers etc.
    //          /admin/user
    //          /admin/settings

    class App {

        public function __construct() {
            print_var($_GET);

            if (isset($_GET['club']) && array_key_exists($_GET['club'], CLUBS)) {
                $club = new Club($_GET['club']);
            }
            else {
                // TODO: Delete line below and add redirect with error message.
                // Maybe Top Banner which disappears?
                $club = new Club('social');  // Else load default Social club.
            }

            if (isset($_GET['page'])) {
                // Lots of ucwords and strtolower in case users enter mixes of upper and lower cases in URL
                $controller = ucwords(strtolower(trim($_GET['page'])));
                // If a invalid controller is provided, i.e. not in Sections, then rever controller to Home.
                // Convert back to lowercase as sections are all in lwoer case.
                if (!in_array(strtolower($controller), CLUBS[$club->club]['sections'])) {
                    $controller = 'Home';
                }
            }
            else {
                // TODO: Redirect as invalid page.
                // Redirect to $club->club
                $controller = 'Home';
            }

            // TODO: Need to edit .htaccess to make add/edit/delete/view case INSENSITIVE
            if (isset($_GET['mode'])) {
                $mode = $_GET['mode'];
            } else {
                $mode = 'index';
            }

            // Get id if provided, else empty array.
            // In controller method that pass id, need to check if id is empty or has value.
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                $id = NULL;
            }

            if (file_exists('../src/controllers/' . $controller . '.php')) {
                // Open up controller file and instantiate.
                // We can set default functions to run in the __construct function, such as any redirects if not logged in etc.
                // We also load the models in the __construct function so that we can load data from the models.
                require_once('../src/controllers/' . $controller . '.php');
                $controller = new $controller;
            } else {
                die('<strong>Fatal Error:</strong> Controller' . $controller . ' does not exist');
            }

            // Next we need to call the the function in the Controller.
            // Each function is essentially it's own page.
            // They gather the data needed from the model and then loads the relevant view.
            // First check if the function exists in the controller.
            if (method_exists($controller, $mode)) {
                // Call the function within controller, passing $id as the only parameter.
                // Need to pass club_id with it so we know which page we're dealing with.
                call_user_func_array([$controller, $mode], [$club->id, $id]);
            } else {
                die('<strong>Fatal Error:</strong> Method <em>' . $mode . '</em> does not exist within <em>' . get_class($controller) . '</em>');
            }




        }
    }