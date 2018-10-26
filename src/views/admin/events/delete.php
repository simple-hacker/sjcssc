<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<h1>Delete Event</h1>
<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/events/delete/' . $data['event']->event_id;  ?>" method="POST">
    <h2>Are you sure you want to delete the event <?php echo $data['event']->title; ?>?</h2>
    <input type="submit" value="Yes, delete <?php echo $data['event']->title; ?>."/>
    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/events'; ?>">No, take me back!</a>
</form>


<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>