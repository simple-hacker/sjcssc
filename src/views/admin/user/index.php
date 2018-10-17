<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

THIS IS THE SETTINGS PAGE FOR USER
<br>
<ul>
    <li>Change Email</li>
    <li>Change Password</li>
    <li>Change Name</li>
</ul>

<?php
    display_flash_messages('user');
?>


<?php
    if (isset($_SESSION)) {
        print_var($_SESSION);
    }
?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
