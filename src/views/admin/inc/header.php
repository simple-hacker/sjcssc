<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN</title>
</head>
<body>


<?php
    if (file_exists(ADMIN_VIEWS . 'inc/nav.php')) {
        require_once(ADMIN_VIEWS . 'inc/nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Nav file has been deleted');
    }
?>
<hr>
<?php
    if (file_exists(ADMIN_VIEWS . 'inc/sidebar.php')) {
        require_once(ADMIN_VIEWS . 'inc/sidebar.php');
    } else {
        die('<strong>Fatal Error: </strong>Sidebar navigation bar file has been deleted');
    }
?>
<hr>
