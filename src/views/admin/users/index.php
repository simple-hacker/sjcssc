<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('users');
?>

<div class="wrap">
    <h3>Add User</h3>
    <a href="<?php echo ADMIN_URLROOT . 'users/add'; ?>" class="btn btn-brown-secondary">Add User</a>
</div>

<div class="wrap">
    <h3>Users</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="thead-light">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($data['users'] as $user) {
?>
                <tr>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->name; ?></td>
                <td><a href="<?php echo ADMIN_URLROOT . "users/edit/" . $user->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                <td><a href="<?php echo ADMIN_URLROOT . "users/delete/" . $user->id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
                </tr>
<?php
            }
?>
            </tbody>
        </table>
    </div>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
