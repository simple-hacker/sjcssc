<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<div class="wrap">
    <h1>Delete Event</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/events/delete/' . $data['event']->event_id;  ?>" method="POST">
        <p>Are you sure you want to delete the event <?php echo $data['event']->title; ?>?</p>
        <div class="form-group row">
            <div class="col-6 text-center"><input type="submit" value="Yes, delete <?php echo $data['event']->title; ?>." class="btn btn-brown w-50"/></div>
            <div class="col-6 text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/events'; ?>" class="btn btn-brown-secondary w-50">No, take me back!</a></div>
        </div>
    </form>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>