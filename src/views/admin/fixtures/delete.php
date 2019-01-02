<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<div class="wrap">
    <h3>Delete Fixture</h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/fixtures/delete/' . $data['fixture']->id;  ?>" method="POST">
        <p>Are you sure you want to delete the fixture <?php echo $data['fixture']->home_team; ?> v <?php echo $data['fixture']->away_team; ?>?</p>
        <div class="row">
            <div class="col-6 text-center"><input type="submit" value="Yes, delete <?php echo $data['fixture']->home_team; ?> v <?php echo $data['fixture']->away_team; ?>." class="btn btn-brown"/></div>
            <div class="col-6 text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . '/fixtures'; ?>" class="btn btn-brown-secondary">No, take me back!</a></div>
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