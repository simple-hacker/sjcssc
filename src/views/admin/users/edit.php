<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<div class="wrap">
    <form action="<?php echo ADMIN_URLROOT . 'users/edit/' . $data['id']; ?>" method="POST">
        <h3>Edit User</h3>
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
            <div class="col-6">
                <h3>Permissions</h3>
                <?php
                    foreach (CLUBS as $club_name => $club_data) {
                ?>
                        <div class="form-check form-check-inline">
                            <input name="permissions[]" class="form-check-input" type="checkbox" value="<?php echo $club_name; ?>" <?php echo (in_array($club_name, $data['permissions'])) ? ' checked' : ''; ?>>
                            <label class="form-check-label" for="permissions[]"><?php echo ucwords($club_name); ?></label>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-6">
                <h3>Make Administrator</h3>
                <div class="form-check form-check-inline">
                    <input name="admin" type="checkbox" value="admin" <?php echo !empty($data['admin']) ? 'checked' : ''; ?> class="form-check-input"/>
                    <label class="form-check-label" for="admin">Make Admin?</label>
                </div>
                
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <input type="submit" value="Save Changes" class="btn btn-block btn-brown"/>
            </div>
        </div>     
    </form>
</div>

<div class="wrap">
    <h3>Reset Password <?php echo isset($data['username']) ? 'for ' . $data['username'] : ''; ?></h3>
    <form action="<?php echo ADMIN_URLROOT . 'users/edit/' . $data['id']; ?>" method="POST">
        <input name="resetPasswordForm" type="hidden"/>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-10">
                <input name="new_password" type="password" class="form-control<?php if (!empty($data['new_password_err'])) echo ' is-invalid'; ?>" value="<?php echo isset($data['new_password']) ? $data['new_password'] : ''; ?>" placeholder="New Password"/>
                <?php if (isset($data['new_password_err'])) display_invalid($data['new_password_err']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Confirm New Password</label>
            <div class="col-10">
                <input name="confirm_new_password" type="password" class="form-control<?php if (!empty($data['confirm_new_password_err'])) echo ' is-invalid'; ?>" value="<?php echo isset($data['confirm_new_password']) ? $data['confirm_new_password'] : ''; ?>" placeholder="Confirm New Password"/>
                <?php if (isset($data['confirm_new_password_err'])) display_invalid($data['confirm_new_password_err']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <input type="submit" value="Reset Password" class="btn btn-block btn-brown"/>
            </div>
        </div> 
    </form>
</div>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>
