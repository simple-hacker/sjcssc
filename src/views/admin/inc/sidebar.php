<?php 
    // Double check someone is logged in.  Else don't display sidebar.
    if (isset($_SESSION['user'])) {
        echo "<ul>";
        // Only if user has permissions to view clubs.
        if (sizeof($_SESSION['user']['permissions']) > 0) {
            // List all clubs user has permission for, along with the subsections of those clubs.
            foreach ($_SESSION['user']['permissions'] as $club_id => $club_name) {
                echo '<li>';
                echo '<a href="' . ADMIN_URLROOT . $club_name . '/dashboard">' . ucwords($club_name) . '</a>';
                    echo '<ul><li>';
                    echo '<a href="' . ADMIN_URLROOT . $club_name . '/dashboard">Settings</a> | ';
                    foreach (CLUBS[$club_name]['sections'] as $section) {
                        echo '<a href="' . ADMIN_URLROOT . $club_name . '/' . $section . '">' . ucwords($section) . '</a> | ';
                    }
                    echo '</li></ul>';
                echo '</li>';
            }
        }

        echo '<li>';
        echo '<a href="' . ADMIN_URLROOT . 'user/settings">User Settings</a>';
        echo '</li>';

        // If user is an admin then display Manager Users link.
        if ($_SESSION['user']['admin'] === true) {
            echo '<li>';
            echo '<a href="' . ADMIN_URLROOT . 'users">Manage Users</a>';
            echo '</li>';
        }
        echo "</ul>";
        
    }