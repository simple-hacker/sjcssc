<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('user');
?>

<div class="row">
    <div class="col-8 mx-auto">
        <div class="wrap">
            <h3>Login</h3>
            <form action="<?php echo ADMIN_URLROOT . 'user/login'?>" method="POST">
                <div class="form-group row">
                    <label for="contact" class="col-sm-2 col-form-label d-none d-md-flex">Username</label>
                    <div class="col-10">
                        <input name="username" type="text" class="form-control<?php if (!empty($data['username_err'])) echo ' is-invalid'; ?>" value="<?php echo $data['username']; ?>" placeholder="Username">
                        <?php if (isset($data['username_err'])) display_invalid($data['username_err']); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contact" class="col-sm-2 col-form-label d-none d-md-flex">Password</label>
                    <div class="col-10">
                        <input name="password" type="password" class="form-control<?php if (!empty($data['password_err'])) echo ' is-invalid'; ?>" value="<?php echo $data['password']; ?>" placeholder="Password">
                        <?php if (isset($data['password_err'])) display_invalid($data['password_err']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <input name="submit" type="submit" class="btn btn-block btn-brown" value="Log In">
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
