<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('users');
?>

<div class="wrap">
    <form action="<?php echo ADMIN_URLROOT . 'users'; ?>" method="POST">
        <h3>Create User</h3>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label d-none d-md-flex">Username</label>
            <div class="col-10">
                <input name="username" type="text" class="form-control<?php if (!empty($data['username_err'])) echo ' is-invalid'; ?>" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" placeholder="Username"/>
                <?php if (isset($data['username_err'])) display_invalid($data['username_err']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label d-none d-md-flex">Email</label>
            <div class="col-10">
                <input name="email" type="email" class="form-control" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" placeholder="Email Address"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label d-none d-md-flex">Name</label>
            <div class="col-10">
                <input name="name" type="text" class="form-control" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Name"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label d-none d-md-flex">Password</label>
            <div class="col-10">
                <input name="password" type="password" class="form-control<?php if (!empty($data['password_err'])) echo ' is-invalid'; ?>" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" placeholder="Password"/>
                <?php if (isset($data['password_err'])) display_invalid($data['password_err']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="confirm_password" class="col-sm-2 col-form-label d-none d-md-flex">Confirm Passord</label>
            <div class="col-10">
                <input name="confirm_password" type="password" class="form-control<?php if (!empty($data['confirm_password_err'])) echo ' is-invalid'; ?>" value="<?php echo isset($data['confirm_password']) ? $data['confirm_password'] : ''; ?>" placeholder="Confirm Password"/>
                <?php if (isset($data['confirm_password_err'])) display_invalid($data['confirm_password_err']); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <h3>Permissions</h3>
                <?php
                    foreach (CLUBS as $club_name => $club_data) {
                ?>
                        <div class="form-check form-check-inline m-2">
                            <div class="pretty p-icon p-curve p-jelly small">
                                <input type="checkbox" name="permissions[]" value="<?php echo $club_name; ?>" <?php echo (in_array($club_name, $data['permissions'])) ? ' checked' : ''; ?>>
                                <div class="state p-warning">
                                    <i class="icon fas fa-check"></i>
                                    <label for="permissions[]"><?php echo ucwords($club_name); ?></label>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-6">
                <h3>Make Administrator</h3>
                <div class="form-check form-check-inline">
                    <div class="pretty p-icon p-curve p-jelly small">
                        <input name="admin" type="checkbox" value="admin" <?php echo !empty($data['admin']) ? 'checked' : ''; ?>/>
                        <div class="state p-warning">
                            <i class="icon fas fa-check"></i>
                            <label class="form-check-label" for="admin">Make Admin?</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <input type="submit" value="Create User" class="btn btn-block btn-brown"/>
            </div>
        </div>     
    </form>
</div>

<div class="wrap">
    <h3>Users</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="thead-light text-center">
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
                <td class="text-center"><a href="<?php echo ADMIN_URLROOT . "users/edit/" . $user->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                <td class="text-center"><a href="<?php echo ADMIN_URLROOT . "users/delete/" . $user->id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
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
