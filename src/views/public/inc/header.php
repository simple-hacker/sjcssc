<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data['club']->name; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/main.css">
</head>
<body>
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/clubs_nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/clubs_nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Clubs navigation bar file has been deleted');
    }
?>
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Nav file has been deleted');
    }
?>
