<?php require_once(APPROOT . 'classes\\Notice.php'); ?>

<p>NOTICES SECTION</p>

<?php
    $num_notices = 4;
    $notices = Notice::getNotices($club->id, $num_notices);

    printVar($notices);
?>