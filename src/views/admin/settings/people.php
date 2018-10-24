<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('people');
?>

    <h1>People</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/people'; ?>" method="POST">

        <h2>Add People</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Person</th>
                    <th>Email</th>
                <tr>
            </thead>
            <tbody>
<?php
    if (isset($data['people'])) {
        foreach ($data['people'] as $i => $person) {
            if (empty($person->id)) {
?>
                <tr>
                    <td><input type="hidden" name="people_id[]" value="<?php echo (!empty($person->id)) ? $person->id : ''; ?>"/></td>
                    <td><input type="text" name="people[]" value="<?php echo (!empty($person->name)) ? $person->name : ''; ?>" placeholder="Add Person"/></td>
                    <td><input type="email" name="people_email[]" value="<?php echo (!empty($person->email)) ? $person->email : ''; ?>" placeholder="Add Person's Email"/></td>
                    <td><?php echo !empty($person->id) ? 'Remove?' : ''; ?></td>
                </tr>
<?php
                if (isset($data['people_err'][$i])) {
                    echo '<tr><td></td><td>' . $data['people_err'][$i] . '</td></tr>';
                }
            }
        }
    }
?>
                <tr>
                <td><input type="hidden" name="people_id[]" value=""/></td>
                <td><input type="text" name="people[]" value="" placeholder="Add Person"/></td>
                <td><input type="email" name="people_email[]" value="" placeholder="Add Person's Email"/></td>
                </tr>
            </tbody>
        </table>
        
        <h2>Edit People</h2>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Person</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Delete?</th>
                <tr>
            </thead>
            <tbody>
<?php
    if (isset($data['people'])) {
        foreach ($data['people'] as $i => $person) {
            if (!empty($person->id)) {
?>
                <tr>
                    <td><input type="hidden" name="people_id[]" value="<?php echo (!empty($person->id)) ? $person->id : ''; ?>"/></td>
                    <td><input type="text" name="people[]" value="<?php echo (!empty($person->name)) ? $person->name : ''; ?>" placeholder="Add Person"/></td>
                    <td><input type="email" name="people_email[]" value="<?php echo (!empty($person->email)) ? $person->email : ''; ?>" placeholder="Add Person's Email"/></td>
                    <td><input type="checkbox" name="people_active[]" value="<?php echo $person->id; ?>" placeholder="Active?" <?php echo ($person->active) ? ' checked' : ''; ?>/></td>
                    <td><?php echo !empty($person->id) ? 'Remove?' : ''; ?></td>
                </tr>
<?php
                if (isset($data['people_with_id_err'][$person->id])) {
                    echo '<tr><td></td><td>' . $data['people_with_id_err'][$person->id] . '</td></tr>';
                }
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