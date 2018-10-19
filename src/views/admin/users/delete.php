<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

ADMIN ONLY
<hr>
DELETE USER
<form action="<?php echo ADMIN_URLROOT . 'users/delete/' . $data['user_id'];  ?>" method="POST">
    <h2>Are you sure you want to delete the user <?php echo $data['username']; ?>?</h2>
    <input type="submit" value="Yes, delete <?php echo $data['username']; ?>."/>
    <a href="<?php echo ADMIN_URLROOT . 'users'; ?>">No, take me back!</a>
</form>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
