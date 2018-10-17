<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    function loggedInCheckRedirect() {
        // If user is not logged in, then redirect to login page.  Else do nothing.
        if (!isset($_SESSION['user'])) {
            create_flash_message('user', 'You need to log in before you view this page.', 'warning');
            redirect('user/login', true);
        }
    }

    function permissionCheckRedirect($club_id) {
        // Perform log in check first.
        loggedInCheckRedirect();

        // If club_id is not within the user's permissions array as a key, then they don't have permission so need to redirect.
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if (!array_key_exists($club_id, $_SESSION['user']['permissions'])) {
            create_flash_message('user', 'You do not have permission to view the page you requested.', 'danger');
            permissionRedirect();
        }
    }

    function adminCheckRedirect() {
        // Perform log in check first.
        loggedInCheckRedirect();

        // If admin is false then redirect with error message.
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if ($_SESSION['user']['admin'] === false) {
            create_flash_message('user', 'You do not have permission to view the page you requested.', 'danger');
            permissionRedirect();
        }
    }

    function permissionRedirect(){
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if (sizeof($_SESSION['user']['permissions']) > 0) {
            $club_name = Club::getClubName(key($_SESSION['user']['permissions'])); // Get the club name of the first permission available.  The first club_id will be the first key of the permissions array.
            redirect($club_name . '/dashboard', true); // i.e. bowls/dashboard
        } else {
            redirect('user', true); // user/index
        }
    }
