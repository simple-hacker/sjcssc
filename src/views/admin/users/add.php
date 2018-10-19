<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>


ADMIN ONLY
<hr>
<h1>Create User</h1>
<hr>
<form action="<?php echo ADMIN_URLROOT . 'users/add'; ?>" method="POST">
    <input name="username" type="text" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" placeholder="Username"/>
    <input name="email" type="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email Address"/>
    <input name="name" type="text" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Name"/>
    <input name="password" type="password" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" placeholder="Password"/>
    <input name="confirm_password" type="password" value="<?php echo isset($data['confirm_password']) ? $data['confirm_password'] : ''; ?>" placeholder="Confirm Password"/>
    <h2>Permissions</h2>
<?php
    foreach (CLUBS as $club_name => $club_data) {
        echo '<input name="permissions[]" type="checkbox" value="' . $club_name . '"';
        echo (in_array($club_name, $data['permissions'])) ? ' checked' : '';
        echo '/>' . ucwords($club_name) . '<br>';
    }
?>
    <h2>Make Administrator</h2>
    <input name="admin" type="checkbox" value="admin" <?php echo !empty($data['admin']) ? 'checked' : ''; ?>/> Make Admin?
    <h2>Submit</h2>
    <input type="submit" value="Create User"/>
</form>

<hr>
<?php
    echo (!empty($data['username_err'])) ? $data['username_err'] . "<br>" : '';
    echo (!empty($data['password_err'])) ? $data['password_err'] . "<br>" : '';
    echo (!empty($data['confirm_password_err'])) ? $data['confirm_password_err'] . "<br>" : '';
?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
