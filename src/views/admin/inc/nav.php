<?php 
    if (isset($_SESSION['user'])) {
        $name = (!empty($_SESSION['user']['name'])) ? $_SESSION['user']['name'] : $_SESSION['user']['username'];  // Either display name if given, or username.
        echo "<h3>Welcome {$name}!</h3>";
        echo '<a href="' . URLROOT . '">Back to Website</a> | ';
        echo '<a href="' . ADMIN_URLROOT . 'user/settings">Settings</a> | ';
        echo '<a href="' . ADMIN_URLROOT . 'user/logout">Logout</a>';
    } else {
        echo '<a href="' . URLROOT . '">Back to Website</a> | ';
        echo '<a href="' . ADMIN_URLROOT . 'user/login">Login</a>';
    }
?>