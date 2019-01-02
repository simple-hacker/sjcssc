<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<div class="wrap">
    <h1>Delete Notice</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/notices/delete/' . $data['notice']->notice_id;  ?>" method="POST">
        <p>Are you sure you want to delete the notice <strong><?php echo $data['notice']->title; ?></strong>?</p>
        <div class="form-group row">
            <div class="col-6 text-center"><input type="submit" value="Yes, delete <?php echo $data['notice']->title; ?>." class="btn btn-brown w-50"/></div>
            <div class="col-6 text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/notices'; ?>" class="btn btn-brown-secondary w-50">No, take me back!</a></div>
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