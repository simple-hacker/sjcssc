<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<?php
    display_flash_messages('user');
?>
<div class="wrap">
    <h3>User Settings</h3>
    <form action="<?php echo ADMIN_URLROOT . 'user'; ?>" method="POST">
        <input name="userDetailsForm" type="hidden"/>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-10">
                <input name="email" type="email" class="form-control" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email Address"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-10">
                <input name="name" type="text" class="form-control" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Name"/>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <input type="submit" value="Save Changes" class="btn btn-block btn-brown"/>
            </div>
        </div>
    </form>
</div>
<div class="wrap">
    <h3>Reset Password <?php echo isset($data['username']) ? 'for ' . $data['username'] : ''; ?></h3>
    <form action="<?php echo ADMIN_URLROOT . 'user'; ?>" method="POST">
        <input name="resetPasswordForm" type="hidden"/>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Old Password</label>
            <div class="col-10">
                <input name="old_password" type="password" class="form-control" value="<?php echo isset($data['old_password']) ? $data['old_password'] : ''; ?>" placeholder="Old Password"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-10">
                <input name="new_password" type="password" class="form-control" value="<?php echo isset($data['new_password']) ? $data['new_password'] : ''; ?>" placeholder="New Password"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Confirm New Password</label>
            <div class="col-10">
                <input name="confirm_new_password" type="password" class="form-control" value="<?php echo isset($data['confirm_new_password']) ? $data['confirm_new_password'] : ''; ?>" placeholder="Confirm New Password"/>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <input type="submit" value="Change Password" class="btn btn-block btn-brown"/>
            </div>
        </div>
    </form>
</div>
    <?php
        echo (!empty($data['old_password_err'])) ? $data['old_password_err'] . "<br>" : '';
        echo (!empty($data['new_password_err'])) ? $data['new_password_err'] . "<br>" : '';
        echo (!empty($data['confirm_new_password_err'])) ? $data['confirm_new_password_err'] . "<br>" : '';
    ?>
<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
