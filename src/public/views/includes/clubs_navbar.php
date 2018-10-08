<p>CLUBS NAVBAR</p>

<?php
    foreach ($GLOBALS['clubs_config'] as $club_name => $club_info) {
        echo "<a href=\"" . URLROOT . $club_name . "\">" . ucwords($club_name) . "</a>";
        echo "-------";
    }
?>