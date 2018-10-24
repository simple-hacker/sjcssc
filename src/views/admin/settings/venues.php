<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('venues');
?>

    <h1>Venues</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/venues'; ?>" method="POST">

        <h2>Add Venue</h2>
            <input type="hidden" name="venue_id[]" value=""/>
            <input type="text" name="venue[]" value="" placeholder="Add Venue"/>
            <input type="text" name="venue_location[]" value="" placeholder="Add Venue Location"/>
        
        <h2>Edit Venues</h2>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Venue</th>
                    <th>Location</th>
                    <th>Delete?</th>
                <tr>
            </thead>
            <tbody>
<?php
    if (isset($data['venues'])) {
        foreach ($data['venues'] as $i => $venue) {
?>
            <tr>
                <td><input type="hidden" name="venue_id[]" value="<?php echo (!empty($venue->id)) ? $venue->id : ''; ?>"/></td>
                <td><input type="text" name="venue[]" value="<?php echo (!empty($venue->venue)) ? $venue->venue : ''; ?>" placeholder="Add Venue"/></td>
                <td><input type="text" name="venue_location[]" value="<?php echo (!empty($venue->location)) ? $venue->location : ''; ?>" placeholder="Add Venue Location"/></td>
                <td><?php echo !empty($venue->id) ? 'Remove?' : ''; ?></td>
            </tr>
<?php
            if (isset($data['venues_err'][$i])) {
                echo '<tr><td></td><td>' . $data['venues_err'][$i] . '</td></tr>';
            }
        }
    }
?>
            </tbody>
        </table>

        <h2>Save Changes?</h2>
        <input type="submit" value="Save Changes"/>
    </form>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>