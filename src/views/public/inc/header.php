<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data['club']->name; ?></title>
</head>
<body>

<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/clubs_nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/clubs_nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Clubs navigation bar file has been deleted');
    }
?>
<hr>
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Nav file has been deleted');
    }
?>
<hr>