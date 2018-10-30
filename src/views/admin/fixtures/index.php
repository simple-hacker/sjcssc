<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('fixtures');
?>

<h1>Add Fixture</h1>

<form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/fixtures'; ?>" method="POST">
<?php
            if (isset(CLUBS[$data['club']->club]['fixtures']['fields'])) {

                foreach (CLUBS[$data['club']->club]['fixtures']['fields'] as $field) {

                    $input_data = isset($data['fixture']->{$field['name']}) ? $data['fixture']->{$field['name']} : '';                
                    // First check if there are multiple of the same field, mainly for Rinks and Players
                    if (!isset($field['count'])) {
                        if ($field['type'] === 'textarea') {
                            $output = "<textarea name=\"{$field['name']}\" class=\"col-{$field['size']}\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
                            $output .= ">{$input_data}</textarea><br/>";
                        } elseif ($field['type'] === 'select') {
                            //First need to check if the select_item exists in config.
                            if (isset($field['select_item_model']) && isset($field['select_item'])) {
                                // Loop through all $select_items
                                $output = "<select name=\"{$field['name']}\" class=\"col-{$field['size']}\">";
                                // Get all the select items from the data. e.g. get all the teams, league or venues.
                                $select_items = $data[$field['select_item_model']];
                                if (!empty($select_items)) {

                                    // Puts placeholder in options.
                                    $output .= "<option value=\"\"";
                                    $output .= empty($input_data) ? " selected" : "";
                                    $output .= " disabled class=\"placeholder\">{$field['placeholder']}</option>";
                                    // Loop through all returned $select_items and display them as options.
                                    foreach ($select_items as $select_item) {
                                        $select_item_value = $select_item->{$field['select_item']};
                                        $output .= "<option value=\"{$select_item->id}\"";
                                        $output .= ($select_item->id === $input_data) ? ' selected' : '';
                                        $output .= ">{$select_item_value}</option>";
                                    }
                                    $output .= "</select><br/>";
                                } else {
                                    // Put a disabled input box telling user to enter items in Settings page.
                                    $output = "<input type=\"text\" name=\"{$field['name']}}\" value=\"No " . ucwords($field['name']) . "s Found.  Please enter " . ucwords($field['name']) . " in Settings page.\" disabled><br/>";
                                }
                            } else {
                                die("<b>Fatal error:</b> There is no select_item_model or select_item for {$field['name']} for the club " . ucwords($data['club']->club) . " in the config.php file.");
                            }
                        }
                        else {
                            $output = "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"col-{$field['size']}\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
                            $output .= (isset($input_data)) ? " value=\"{$input_data}\"" : "";
                            $output .= "></input><br/>";
                        }
                        echo $output;
                    } else {
                        for ($i = 1; $i <= $field['count']; $i++) {
                            // Put all names together for each array at position index.
                            $names = isset($data['fixture']->squad[$i]) ? $data['fixture']->squad[$i] : "";
                            $output = "<input name=\"{$field['name']}[]\" type=\"{$field['type']}\" class=\"col-{$field['size']}\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']} {$i}\"" : "";
                            $output .= (isset($names)) ? " value=\"{$names}\"" : "";
                            $output .= "></input><br/>";

                            echo $output;
                        }
                    }
                }
            } else {
                die('Missing CLUBS field configuration');
            }
?>
            <input type="submit" value="Add Fixture">
        </form>

<?php
    if (!empty($data['fixtures'])) {
?>
        <h1>Edit Fixtures</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>League</th>
                    <th>Home Team</th>
                    <th>Away Team</th>
                    <th>Venue</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
            foreach ($data['fixtures'] as $fixture) {
?>
            <tr>
                <td><?php echo $fixture->id; ?></td>
                <td><?php echo $fixture->date; ?></td>
                <td><?php echo $fixture->league; ?></td>
                <td><?php echo $fixture->home_team; ?></td>
                <td><?php echo $fixture->away_team; ?></td>
                <td><?php echo $fixture->venue; ?></td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/fixtures/edit/" . $fixture->id;  ?>">Edit</a></td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/fixtures/delete/" . $fixture->id; ?>">Delete?</a></td>
            </tr>
<?php
            }
?>
            </tbody>
        </table>
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