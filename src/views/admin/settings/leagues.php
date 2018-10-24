<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('leagues');
?>

    <h1>Leagues</h1>
    <form action="<?php echo ADMIN_URLROOT . $data['club_name'] . '/settings/leagues'; ?>" method="POST">

        <h2>Add League</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>League</th>
                    <th>Location</th>
                    <th>Website</th>
                </tr>
            </thead>
<?php
    if (isset($data['leagues'])) {
        foreach ($data['leagues'] as $i => $league) {
            if (empty($league->id)) {
?>
                <tr>
                    <td><input type="hidden" name="league_id[]" value="<?php echo (!empty($league->id)) ? $league->id : ''; ?>"/></td>
                    <td><input type="text" name="league[]" value="<?php echo (!empty($league->league)) ? $league->league : ''; ?>" placeholder="Add League"/></td>
                    <td><input type="text" name="league_full[]" value="<?php echo (!empty($league->league_full)) ? $league->league_full : ''; ?>" placeholder="Add League Full"/></td>
                    <td><input type="text" name="league_website[]" value="<?php echo (!empty($league->league_website)) ? $league->league_website : ''; ?>" placeholder="Add League Website"/></td>
                </tr>
<?php
                if (isset($data['leagues_err'][$i])) {
                    echo '<tr><td></td><td>' . $data['leagues_err'][$i] . '</td></tr>';
                }
            }
        }
    }
?>
                <tr>
                    <td><input type="hidden" name="league_id[]" value=""/></td>
                    <td><input type="text" name="league[]" value="" placeholder="Add League"/></td>
                    <td><input type="text" name="league_full[]" value="" placeholder="Add League Full"/></td>
                    <td><input type="text" name="league_website[]" value="" placeholder="Add League Website"/></td>
                </tr>
            </tbody>
        </table>

        <h2>Edit Leagues</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>League</th>
                    <th>Location</th>
                    <th>Website</th>
                    <th>Delete?</th>
                <tr>
            </thead>
            <tbody>
<?php
    if (isset($data['leagues'])) {
        foreach ($data['leagues'] as $i => $league) {
            if (!empty($league->id)) {
?>
                <tr>
                    <td><input type="hidden" name="league_id[]" value="<?php echo (!empty($league->id)) ? $league->id : ''; ?>"/></td>
                    <td><input type="text" name="league[]" value="<?php echo (!empty($league->league)) ? $league->league : ''; ?>" placeholder="Add League"/></td>
                    <td><input type="text" name="league_full[]" value="<?php echo (!empty($league->league_full)) ? $league->league_full : ''; ?>" placeholder="Add League Full"/></td>
                    <td><input type="text" name="league_website[]" value="<?php echo (!empty($league->league_website)) ? $league->league_website : ''; ?>" placeholder="Add League Website"/></td>
                    <td><?php echo !empty($league->id) ? 'Remove?' : ''; ?></td>
                </tr>
<?php
                if (isset($data['leagues_with_id_err'][$league->id])) {
                    echo '<tr><td></td><td>' . $data['leagues_with_id_err'][$league->id] . '</td></tr>';
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