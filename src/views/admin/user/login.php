LOGIN FORM

<?php
    display_flash_messages('user');
?>

<form action="<?php echo ADMIN_URLROOT . 'user/login'?>" method="POST">
    <input name="username" type="text" value="<?php echo $data['username']; ?>" placeholder="Username">
    <input name="password" type="password" value="<?php echo $data['password']; ?>" placeholder="Password">
    <input name="submit" type="submit" value="Log In">
    <hr>
    <?php
        echo (!empty($data['username_err'])) ? $data['username_err'] . "<br>" : '';
        echo (!empty($data['password_err'])) ? $data['password_err'] . "<br>" : '';
    ?>
</form>

<?php
    if (isset($_SESSION)) {
        print_var($_SESSION);
    }
?>