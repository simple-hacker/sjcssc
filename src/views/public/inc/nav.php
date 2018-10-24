<?php 
    foreach (CLUBS[$data['club']->club]['sections'] as $section) {
        $url = URLROOT . $data['club']->club . "/" . $section;
        echo '<a href="' . $url . '">' . ucwords($section) . '</a> | ';
    }

    // TODO: Get club's menu_links