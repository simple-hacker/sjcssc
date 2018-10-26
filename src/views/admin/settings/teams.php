<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('teams');
?>

    <h1>Teams</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/teams'; ?>" method="POST">

        <h2>Add Team</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Team</th>
                    <th>Location</th>
                <tr>
            </thead>
            <tbody>
<?php                           
    if (isset($data['teams'])) {
        foreach ($data['teams'] as $i => $team) {
            if (empty($team->id)) {
?>
                <tr>
                    <td><input type="hidden" name="team_id[]" value="<?php echo (!empty($team->id)) ? $team->id : ''; ?>"/></td>
                    <td><input type="text" name="team[]" value="<?php echo (!empty($team->team)) ? $team->team : ''; ?>" placeholder="Add Team"/></td>
                    <td><input type="text" name="team_location[]" value="<?php echo (!empty($team->location)) ? $team->location : ''; ?>" placeholder="Add Team Location"/></td>
                    <td><?php echo !empty($team->id) ? 'Remove?' : ''; ?></td>
                </tr>
<?php
                if (isset($data['teams_err'][$i])) {
                    echo '<tr><td></td><td>' . $data['teams_err'][$i] . '</td></tr>';
                }
            }
        }
    }
?>
                <tr>
                    <td><input type="hidden" name="team_id[]" value=""/></td>
                    <td><input type="text" name="team[]" value="" placeholder="Add Team"/></td>
                    <td><input type="text" name="team_location[]" value="" placeholder="Add Team Location"/></td>
                </tr>
            </tbody>
        </table>
        
        <h2>Edit Teams</h2>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Team</th>
                    <th>Location</th>
                    <th>Delete?</th>
                <tr>
            </thead>
            <tbody>
<?php
    if (isset($data['teams'])) {
        foreach ($data['teams'] as $i => $team) {
            if (!empty($team->id)) {
?>
                <tr>
                    <td><input type="hidden" name="team_id[]" value="<?php echo (!empty($team->id)) ? $team->id : ''; ?>"/></td>
                    <td><input type="text" name="team[]" value="<?php echo (!empty($team->team)) ? $team->team : ''; ?>" placeholder="Add Team"/></td>
                    <td><input type="text" name="team_location[]" value="<?php echo (!empty($team->location)) ? $team->location : ''; ?>" placeholder="Add Team Location"/></td>
                    <td><?php echo !empty($team->id) ? 'Remove?' : ''; ?></td>
                </tr>
<?php
                if (isset($data['teams_with_id_err'][$team->id])) {
                    echo '<tr><td></td><td>' . $data['teams_with_id_err'][$team->id] . '</td></tr>';
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