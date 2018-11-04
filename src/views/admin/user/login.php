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
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
