<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>


<h1>DASHBOARD</h1>
<p>
    <ul>
        <li>List of items that need consolidating.</li>
        <ul><li>e.g. Fixtures without Results</li></ul>
    </ul>
</p>

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