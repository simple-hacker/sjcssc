<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

ADMIN ONLY
<hr>
<?php
    display_flash_messages('users');
?>
<hr>
<a href="<?php echo ADMIN_URLROOT . 'users/add'; ?>">Add User</a>
<hr>
LIST OF USERS
<table>
    <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
<?php
    foreach ($data['users'] as $user) {
        echo "<tr>";
        echo "<td>{$user->id}</td>";
        echo "<td>{$user->username}</td>";
        echo "<td>{$user->email}</td>";
        echo "<td>{$user->name}</td>";
        echo "<td><a href=\"" . ADMIN_URLROOT . "users/edit/{$user->id}\">Edit</a>";
        echo "<td><a href=\"" . ADMIN_URLROOT . "users/delete/{$user->id}\">Delete?</a>";
        echo "</tr>";
    }
?>
    </tbody>
</table>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
