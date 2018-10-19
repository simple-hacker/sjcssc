<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

ADMIN ONLY
<hr>
<h1>Edit User</h1>
<hr>
    <h2>Change details for <?php echo isset($data['username']) ? $data['username'] : ''; ?></h2>
    <form action="<?php echo ADMIN_URLROOT . 'users/edit/' . $data['id']; ?>" method="POST">
        <input name="userDetailsForm" type="hidden"/>
        <input name="email" type="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email Address"/>
        <input name="name" type="text" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Name"/>
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
        <h2>Save Changes?</h2>
        <input type="submit" value="Save Changes"/>
    </form>
<hr>
    <h2>Reset Password <?php echo isset($data['username']) ? 'for ' . $data['username'] : ''; ?></h2>
    <form action="<?php echo ADMIN_URLROOT . 'users/edit/' . $data['id']; ?>" method="POST">
        <input name="resetPasswordForm" type="hidden"/>
        <input name="new_password" type="password" value="<?php echo isset($data['new_password']) ? $data['new_password'] : ''; ?>" placeholder="New Password"/>
        <input name="confirm_new_password" type="password" value="<?php echo isset($data['confirm_new_password']) ? $data['confirm_new_password'] : ''; ?>" placeholder="Confirm New Password"/>
        <input type="submit" value="Reset Password"/>
    </form>

<hr>
<?php
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
