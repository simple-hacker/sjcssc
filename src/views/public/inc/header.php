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
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo URLROOT; ?>img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo URLROOT; ?>img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URLROOT; ?>img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URLROOT; ?>img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URLROOT; ?>img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo URLROOT; ?>img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo URLROOT; ?>img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo URLROOT; ?>img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URLROOT; ?>img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="<?php echo URLROOT; ?>image/png" sizes="192x192"  href="<?php echo URLROOT; ?>img/favicons/android-icon-192x192.png">
    <link rel="icon" type="<?php echo URLROOT; ?>image/png" sizes="32x32" href="<?php echo URLROOT; ?>img/favicons/favicon-32x32.png">
    <link rel="icon" type="<?php echo URLROOT; ?>image/png" sizes="96x96" href="<?php echo URLROOT; ?>img/favicons/favicon-96x96.png">
    <link rel="icon" type="<?php echo URLROOT; ?>image/png" sizes="16x16" href="<?php echo URLROOT; ?>img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo URLROOT; ?>img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div id="wrapper" class="d-flex flex-column h-100">
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/clubs_nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/clubs_nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/nav.php')) {
        require_once(PUBLIC_VIEWS . 'inc/nav.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<main id="main-content" class="flex-grow-1">