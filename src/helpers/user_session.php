<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    function loggedInCheck() {
        // If user is not logged in, then redirect to login page.  Else do nothing.
        if (!isset($_SESSION['user'])) {
            create_flash_message('user', 'You need to log in before you view this page.', 'warning');
            redirect('user/login', true);
        }
    }

    function permissionCheck($club_id) {
        // // Perform log in check first.
        // loggedInCheck();

        // If club_id is not within the user's permissions array then they don't have permission so need to redirect.
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if (!in_array($club_id, $_SESSION['user']['permissions'])) {
            create_flash_message('user', 'You do not have permission to view this page.', 'danger');
            permissionRedirect();
        }
    }

    function permissionRedirect(){
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if (!empty($_SESSION['user']['permissions'][0])) { // sizeof(permissions) is always > 0, because first item is [0] => *null*.  So check if first item is not empty instead.
            $club_name = Club::getClubName($_SESSION['user']['permissions'][0]); // Get the club name of the first permission available.
            redirect($club_name . '/dashboard', true); // i.e. bowls/dashboard
        } else {
            redirect('user', true); // user/index
        }
    }

    function adminCheck() {
        // // Perform log in check first.
        // loggedInCheck();

        // If admin is false then redirect with error message.
        // Redirect to first club with permission available.
        // If no permissions exists then redirect to user/index.
        if ($_SESSION['user']['admin'] === false) {
            create_flash_message('user', 'You do not have permission to view this page.', 'danger');
            permissionRedirect();
        }
    }
