<?php
    // Flash Messaging
    // Flash messages are stored in $_SESSION variables.  This is so that flash messages are stored during page redirects
    // because we want to display messages such as 'Notice Deleted' but also redirect to the Notice homepage, rather than leaving 'delete/id' in the URL.

    // Providing $name in case we wanted to display multiple flash messages on a single page.

    // Flash Messages are created in classes and methods.
    // Flash Messages are displayed in views

    if (!isset($_SESSION)) {
        session_start();
    }

    function create_flash_message($name = '', $message = '', $alert = 'success') {
        // Create Flash Message
        $_SESSION['flash_messages'][$name][] = [
            "message" => $message,
            "alert" => $alert
        ];
    }

    function display_flash_messages($name) {
        // If flash message exists then display, then unset so we can reuse $name.
        if (isset($_SESSION['flash_messages'][$name])) {
            foreach ($_SESSION['flash_messages'][$name] as $i => $flash_message) {
                echo "<div class=\"alert alert-{$_SESSION['flash_messages'][$name][$i]['alert']}\" role=\"alert\">{$_SESSION['flash_messages'][$name][$i]['message']}<div>";
            } 
            unset($_SESSION['flash_messages'][$name]);
        }
    }