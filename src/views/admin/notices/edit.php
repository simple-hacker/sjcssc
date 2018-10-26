<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('notices');
?>
    <h1>Edit Notice</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/notices/edit/' . $data['notice']->notice_id; ?>" method="POST">
            <input type="hidden" name="notice_id" value="<?php echo (isset($data['notice']->notice_id)) ? $data['notice']->notice_id : ''; ?>"/>
            <input type="text" name="title" placeholder="Enter Notice Title" value="<?php echo (isset($data['notice']->title)) ? $data['notice']->title : ''; ?>"/>
            <input type="hidden" name="event_id" value="<?php echo (isset($data['notice']->event_id)) ? $data['notice']->event_id : NULL; ?>"/>
            <input type="hidden" name="expiry_date" value="<?php echo (isset($data['notice']->expiry_date)) ? $data['notice']->expiry_date : NULL; ?>"/>
            <textarea name="notice" cols="30" rows="5" placeholder="Enter Notice Body"><?php echo (isset($data['notice']->notice)) ? $data['notice']->notice : ''; ?></textarea>
            Important? :<input type="checkbox" name="important" <?php echo (isset($data['notice']->important) && $data['notice']->important == 1) ? 'checked' : ''; ?>/>
            <select name="expiry_date_select">
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
<?php
        if (!empty($data['title_err'])) {
            print_var($data['title_err']);
        }
        if (!empty($data['notice_err'])) {
            print_var($data['notice_err']);
        }
?>
            <h2>Save Changes</h2>
            <input type="submit" value="Save Changes">
    </form>

    <h1>All Notices</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Created Date</th>
                <th>Important</th>
                <th>Title</th>
                <th>Notice</th>
                <th>Edit</th>
                <th>Delete?</th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach($data['notices'] as $notice) {
?>
            <tr>
                <td><?php echo $notice->notice_id; ?></td>
                <td><?php echo $notice->created_date; ?></td>
                <td><?php echo $notice->important; ?></td>
                <td><?php echo $notice->title; ?></td>
                <td><?php echo $notice->notice; ?></td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/notices/edit/" . $notice->notice_id;  ?>">Edit</td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/notices/delete/" . $notice->notice_id; ?>">Delete?</td>
            </tr>
<?php
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