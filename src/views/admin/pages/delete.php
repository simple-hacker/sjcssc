<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('pages');
?>

<div class="wrap">
    <h3>Delete Page</h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/pages/delete/' . $data['page']->page_id;  ?>" method="POST">
        <p>Are you sure you want to delete the the <?php echo $data['page']->page; ?>?</p>
        <div class="row">
            <div class="col-6 text-center"><input type="submit" value="Yes, delete page <?php echo $data['page']->page; ?>!" class="btn btn-brown"/></div>
            <div class="col-6 text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/pages'; ?>" class="btn btn-brown-secondary">No, take me back!</a></div>
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