<?php 
    if (isset($data['club_id'])) {
        $club_name = Club::getClubName($data['club_id']);

        foreach (CLUBS[$club_name]['sections'] as $section) {
            $url = URLROOT . $club_name . "/" . $section;
            echo '<a href="' . $url . '">' . ucwords($section) . '</a> | ';
        }
    }