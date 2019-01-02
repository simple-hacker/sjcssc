<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<div class="wrap">
    <h3>Delete User</h3>
    <form action="<?php echo ADMIN_URLROOT . 'users/delete/' . $data['user_id'];  ?>" method="POST">
        <p>Are you sure you want to delete the user <?php echo $data['username']; ?>?</p>
        <div class="form-group row">
            <div class="col-6 text-center"><input type="submit" value="Yes, delete <?php echo $data['username']; ?>." class="btn btn-brown"/></div>
            <div class="col-6 text-center"><a href="<?php echo ADMIN_URLROOT . 'users'; ?>" class="btn btn-brown-secondary">No, take me back!</a></div>
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
