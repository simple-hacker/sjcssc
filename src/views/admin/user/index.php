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