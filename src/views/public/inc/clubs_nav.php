<?php 

    foreach (CLUBS as $club_name => $club_data) {
        $url = URLROOT . $club_name;
        echo '<a href="' . $url . '">' . ucwords($club_name) . '</a> | ';
    }