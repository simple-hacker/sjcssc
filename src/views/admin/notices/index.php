<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('notices');
?>
    <div class="wrap">
        <h3>Add Notice</h3>
        <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/notices'; ?>" method="POST">
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control<?php if (!empty($data['title_err'])) echo ' is-invalid'; ?>" placeholder="Enter Notice Title" value="<?php echo (isset($data['notice']->title)) ? $data['notice']->title : ''; ?>"/>
                    <?php if (isset($data['title_err'])) display_invalid($data['title_err']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="notice" class="col-sm-2 col-form-label">Notice</label>
                <div class="col-sm-10">
                    <textarea name="notice" class="form-control<?php if (!empty($data['notice_err'])) echo ' is-invalid'; ?>" rows="5" placeholder="Enter Notice Body"><?php echo (isset($data['notice']->notice)) ? $data['notice']->notice : ''; ?></textarea>
                    <?php if (isset($data['notice_err'])) display_invalid($data['notice_err']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="important" class="col-sm-2 col-form-label">Important</label>
                <div class="col-sm-10">
                    <input type="checkbox" class="form-control form-control-sm" name="important" <?php echo (isset($data['notice']->important) && $data['notice']->important == 1) ? 'checked' : ''; ?>/>
                </div>
            </div>
            <div class="form-group row">
                <label for="expiry_date_select" class="col-sm-2 col-form-label">Expiry Date</label>
                <div class="col-sm-10">
                    <select name="expiry_date_select" class="form-control">
                        <?php
                            if (!isset($data['notice']->expiry_date_option)) {
                                $data['notice']->expiry_date_option = '+1 Month'; // If we're in add mode, we want +1 Month to be default.
                            }
                        ?>
                        <option value="NULL" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === 'NULL') ? 'selected' : ''; ?>>Doesn't Expire</option>
                        <option value="+1 Week" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === '+1 Week') ? 'selected' : ''; ?>>1 Week</option>
                        <option value="+2 Weeks" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === '+2 Weeks') ? 'selected' : ''; ?>>2 Weeks</option>
                        <option value="+1 Month" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === '+1 Month') ? 'selected' : ''; ?>>1 Month</option>
                        <option value="+3 Months" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === '+3 Months') ? 'selected' : ''; ?>>3 Months</option>
                        <option value="+6 Months" <?php echo (isset($data['notice']->expiry_date_option) && $data['notice']->expiry_date_option === '+6 Months') ? 'selected' : ''; ?>>6 Months</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="event_id" value="<?php echo (isset($data['notice']->event_id)) ? $data['notice']->event_id : NULL; ?>"/>
            <input type="hidden" name="expiry_date" value="<?php echo (isset($data['notice']->expiry_date)) ? $data['notice']->expiry_date : NULL; ?>"/>
                
            <div class="form-group row mt-5">
                <div class="col-6 mx-auto text-center">
                    <input type="submit" value="Add Notice" class="btn btn-brown btn-block">
                </div>
            </div> 
        </form>
    </div>

<?php
    if (!empty($data['notices'])) {
?>
    <div class="wrap">
        <h3>Notices</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="thead-light">
                        <th>Date</th>
                        <th>Important</th>
                        <th>Title</th>
                        <th>Notice</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
    <?php
        foreach($data['notices'] as $i => $notice) {
    ?>
                    <tr>
                        <td><?php echo date("d/m/y", strtotime($notice->created_date)); ?></td>
                        <td><input type="checkbox" class="form-control form-control-sm" name="important_<?php echo $i; ?>" <?php echo (isset($data['notice']->important) && $data['notice']->important == 1) ? 'checked' : ''; ?>/></td>
                        <td><?php echo $notice->title; ?></td>
                        <td><?php echo strlen($notice->notice) > 50 ? substr($notice->notice,0,50)."..." : $notice->notice; ?></td>
                        <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/notices/edit/" . $notice->notice_id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                        <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/notices/delete/" . $notice->notice_id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
                    </tr>
    <?php
        }
    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    }
?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>