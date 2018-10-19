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
<h1>User Settings</h1>
<hr>
    <form action="<?php echo ADMIN_URLROOT . 'user'; ?>" method="POST">
        <input name="userDetailsForm" type="hidden"/>
        <input name="email" type="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email Address"/>
        <input name="name" type="text" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Name"/>
        <input type="submit" value="Save Changes"/>
    </form>
<hr>
    <h2>Reset Password <?php echo isset($data['username']) ? 'for ' . $data['username'] : ''; ?></h2>
    <form action="<?php echo ADMIN_URLROOT . 'user'; ?>" method="POST">
        <input name="resetPasswordForm" type="hidden"/>
        <input name="old_password" type="password" value="<?php echo isset($data['old_password']) ? $data['old_password'] : ''; ?>" placeholder="Old Password"/>
        <input name="new_password" type="password" value="<?php echo isset($data['new_password']) ? $data['new_password'] : ''; ?>" placeholder="New Password"/>
        <input name="confirm_new_password" type="password" value="<?php echo isset($data['confirm_new_password']) ? $data['confirm_new_password'] : ''; ?>" placeholder="Confirm New Password"/>
        <input type="submit" value="Reset Password"/>
    </form>

<hr>
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
