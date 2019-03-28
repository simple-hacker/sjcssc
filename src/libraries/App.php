<?php

    // Main Application Loading Class
    // Obtains the URL, assigns controllers and methods to be executed.

    // URL Formats
    // ==========================================================
    // Public   http://www.stjosephscssc.co.uk/CLUB/PAGE/ID
    // e.g.     http://www.stjosephscssc.co.uk/social/events/8
    //
    // Admin    http://www.stjosephscssc.co.uk/admin/CLUB/CONTROLLER/PAGE/ID
    // e.g.     http://www.stjosephscssc.co.uk/admin/bowls/fixtures/edit/3


    class App extends Controller {

        public function __construct() {

            $this->clubModel = $this->model('Club');

            // Sort out non admin side first.
            if (!isset($_GET['admin'])) {

                // CLUB
                // =====================================================
                // Get club from URL and load data.
                // If club is given, then see if it's a valid club
                if (isset($_GET['club'])) {
                    $club_name = strtolower($_GET['club']); // strtolower in case user enters mix of case.
                } else {
                    $club_name = 'social';  // Default club.
                }
                
                // Check if it's an actual club first.
                if (array_key_exists($club_name, CLUBS)) {
                    // Check if it's an actual club first.
                    $club = $this->clubModel->getClubByName($club_name);
                } else {
                    // Incorrect URL, so redirect.
                    redirect('404.html');
                }
                
                // CONTROLLER
                // =====================================================        
                // If Controller is set, make sure it is a valid club section or admin controller.
                if (isset($_GET['controller'])) {
                    // Set controller to given in URL.
                    $controller = ucwords(strtolower($_GET['controller']));
                    // If $controller provided is not in club sections then an invalid controller was provided, so redirect.
                    if (!in_array(strtolower($controller), CLUBS[$club->club]['sections']) && !in_array(strtolower($controller), CONTROLLERS) ) {
                        redirect('404.html');
                    }
                } else {
                    // Default Controller is Home.
                    $controller = 'Home';
                }

                // ID
                // =====================================================
                // Page is always index in the public area
                // $page = 'index';
                // page is no longer always index because of Ajax methods
                $page = (isset($_GET['page'])) ? $_GET['page'] : 'index';
            } 
            // Work through admin URLS.
            else {    
                // CLUB
                // =====================================================
                // Get club from URL and load data.
                // strtolower in case user enters mix of case.

                // admin/User gives a club that is actually a controller.
                // admin/bowls should give a club as bowls, which is correct.
                if (isset($_GET['club'])) {
                    // If club is given, then see if it's a valid club
                    $club_name = strtolower($_GET['club']);

                    // Check if it's an actual club first.
                    if (array_key_exists($club_name, CLUBS)) {
                        // Check if it's an actual club first.
                        $club = $this->clubModel->getClubByName($club_name);
                    } elseif (in_array($club_name, CONTROLLERS)) {
                        // If not a club, check if it's an admin controller.
                        // This is only for User/Users/Settings etc
                        $controller = ucwords($club_name);
                        // Note, no $club is set at this condition.
                    } else {
                        // Incorrect URL, so redirect.
                        redirect('404.html');
                    }
                }

                // CONTROLLER
                // =====================================================        
                // If Controller is set, make sure it is a valid club section or admin controller.
                if (isset($_GET['controller'])) {
                    // Set controller to given in URL.
                    $controller = ucwords(strtolower($_GET['controller']));
                    if (isset($club)) {
                        // Check in Controller in both club SECTIONS and admin CONTROLLERS
                        if (!in_array(strtolower($controller), CLUBS[$club->club]['sections']) && !in_array(strtolower($controller), CONTROLLERS)) {
                            redirect('404.html');
                        }
                    }
                    else {
                        // Club not provided, only check in CONTROLLERS
                        if (!in_array(strtolower($controller), CONTROLLERS)) {
                            redirect('404.html');
                        }
                    }
                } else {
                    // Default Controller is Home.
                    $controller = 'Home';
                }

                // TODO: Delete the below PAGES comment?
                // // PAGE (i.e. edit/delete etc)
                // // =====================================================
                // if (isset($_GET['page'])) {
                //     $page = strtolower($_GET['page']);
                //     // If $page provided is not a valid mode, such as add, delete etc, then redirect as invalid URL.
                //     if (!in_array($page, PAGES)) {
                //         redirect('404.html');
                //     }
                // } else {
                //     $page = 'index';
                // }

                // PAGE (i.e. edit/delete etc)
                // =====================================================
                $page = (isset($_GET['page'])) ? strtolower($_GET['page']) : 'index';
            }


            // ID - This doesn't need any special admin checks so is outside the if admin statement.
            // =====================================================
            // Get id if provided, else NULL.
            // In controller method that pass id, need to check if id is empty or has value.
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                $id = NULL;
            }


            // APP
            // =====================================================
            // Check to see if the Controller file exists.
            if (file_exists('../src/controllers/' . $controller . '.php')) {
                // Open up controller file and instantiate.
                // We can set default functions to run in the __construct function, such as any redirects if not logged in etc.
                // We also load the models in the __construct function so that we can load data from the models.
                require_once('../src/controllers/' . $controller . '.php');
                // Need to provide whether admin or not in each Controller's __construct function.
                // This is so that we can perform logged in and permission checks before loading the model.
                // If $admin === false then we still need to be able to load the model as we're in the public section.
                $admin = (isset($_GET['admin'])) ? true : false;
                if (isset($club)) {
                    // If $club was set, then send club_id along with item id.
                    $controller = new $controller($admin, $club->id);
                } else {
                    // Else it's only /admin/users CONTROLLERS which doesn't need a club.
                    $controller = new $controller($admin, -1);
                }
            } else {
                die('<strong>Fatal Error:</strong> Controller ' . $controller . ' does not exist');
            }

            // Next we need to call the the function in the Controller.
            // Each function is essentially it's own page.
            // They gather the data needed from the model and then loads the relevant view.
            // First check if the function exists in the controller.
            if (method_exists($controller, $page)) {
                // Call the function within controller, passing $id as the only parameter.
                call_user_func([$controller, $page], $id);
            } else {
                create_flash_message(strtolower(get_class($controller)), 'Invalid Page', 'danger', true);
                redirect($club_name . '/' . strtolower(get_class($controller)), true);
                // die('<strong>Fatal Error:</strong> Method <em>' . $page . '</em> does not exist within <em>' . get_class($controller) . '</em>');
            }
        }
    }