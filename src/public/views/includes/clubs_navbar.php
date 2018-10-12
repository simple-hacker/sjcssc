<p>CLUBS NAVBAR</p>

<?php
    foreach (CLUBS as $club_name => $club_info) {
        echo "<a href=\"" . URLROOT . $club_name . "\">" . ucwords($club_name) . "</a>";
        echo "-------";
    }
?>