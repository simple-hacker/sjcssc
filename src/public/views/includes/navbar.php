<p>NAVBAR</p>

<?php
    foreach ($GLOBALS['clubs_config'][$club->club]['sections'] as $section) {
        echo "<a href=\"" . URLROOT . $club->club . "\\" . $section . "\">" . ucwords($section) . "</a>";
        echo "-------";
    }
?>

<?php
    foreach ($club->menu_links as $menu_link) {
        echo "<a href=\"" . $menu_link->menu_link_url . "\">" . $menu_link->menu_link_title  . "</a>";
        echo "-------";
    }
?>