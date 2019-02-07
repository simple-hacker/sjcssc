<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('fixtures');
?>

<div class="wrap">
    <h3>Add Fixture</h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/fixtures'; ?>" method="POST">
        <div class="row">
<?php
            if (isset(CLUBS[$data['club']->club]['fixtures']['fields'])) {
                $squad_title = false;
                foreach (CLUBS[$data['club']->club]['fixtures']['fields'] as $field) {
                    $output = '';
                    $name = $field['name'];
                    $size = isset($field['size']) ? $field['size'] : '12';
                    $label_size = 2 * (12/$size);
                    $input_size = 12 - (2 * (12/$size));
                    $label = isset($field['label']) ? $field['label'] : ucwords($field['name']);
                    $placeholder = isset($field['placeholder']) ? $field['placeholder'] : '';
                    $input_data = isset($data['fixture']->{$field['name']}) ? $data['fixture']->{$field['name']} : '';

                    if (($name == "squad" || $name == "substitutes") && $squad_title == false) {
                        $squad_title = (isset(CLUBS[$data['club']->club]['fixtures']['squad_title'])) ? CLUBS[$data['club']->club]['fixtures']['squad_title'] : 'Squaddd';
                        echo "<div class=\"col-12\"><h4>{$squad_title}</h4><p>If adding more than one person per position please separate names with a comma.</p></div>";
                        $squad_title = true;
                    }

                    // First check if there are multiple of the same field, mainly for Rinks and Players
                    if (!isset($field['count'])) {
                        if ($field['type'] === 'textarea') {
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label}</label>";
                            $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                            $output .= "<textarea name=\"{$name}\"";
                            $output .= (!empty($placeholder)) ? " placeholder=\"{$placeholder}\"" : "";
                            $output .= " class=\"form-control";
                            if (!empty($data[$name.'_err'])) $output .= ' is-invalid';
                            $output .= "\">{$input_data}</textarea>";
                            $output .= "</div></div>";
                            if (isset($data[$name.'_err'])) $output .= "<div class=\"form-group row\"><div class=\"col-12\">" . display_invalid($data[$name.'_err'], true) . "</div></div>";
                            $output .= "</div>";
                        } elseif ($field['type'] === 'select') {
                            //First need to check if the select_item exists in config.
                            if (isset($field['select_item_model']) && isset($field['select_item'])) {
                                // Loop through all $select_items
                                $output = "<div class=\"col-{$size}\">";
                                $output .= "<div class=\"form-group row\">";
                                $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label}</label>";
                                $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                                $output .= "<select name=\"{$field['name']}\" class=\"form-control";
                                if (!empty($data[$name.'_err'])) $output .= ' is-invalid';
                                $output .= "\">";
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
                                    $output .= "</select>";
                                    $output .= "</div></div>";
                                    if (isset($data[$name.'_err'])) $output .= "<div class=\"form-group row\"><div class=\"col-12\">" . display_invalid($data[$name.'_err'], true) . "</div></div>";
                                    $output .= "</div>";
                                } else {
                                    // Put a disabled input box telling user to enter items in Settings page.
                                    $output = "<div class=\"col-{$size}\">";
                                    $output .= "<div class=\"form-group row\">";
                                    $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label}</label>";
                                    $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                                    $output .= "<input type=\"text\" name=\"{$field['name']}}\" class=\"form-control";
                                    if (!empty($data[$name.'_err'])) $output .= ' is-invalid';
                                    $output .= "\" value=\"No " . ucwords($field['name']) . "s Found.  Please enter " . ucwords($field['name']) . " in Settings page.\" disabled><br/>";
                                    $output .= "</div></div>";
                                    if (isset($data[$name.'_err'])) $output .= "<div class=\"form-group row\"><div class=\"col-12\">" . display_invalid($data[$name.'_err'], true) . "</div></div>";
                                    $output .= "</div>";
                                }
                            } else {
                                die("<b>Fatal error:</b> There is no select_item_model or select_item for {$field['name']} for the club " . ucwords($data['club']->club) . " in the config.php file.");
                            }
                        }
                        else {
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label}</label>";
                            $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                            $output .= "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"form-control";
                            if (!empty($data[$name.'_err'])) $output .= ' is-invalid';
                            $output .= "\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
                            $output .= (isset($input_data)) ? " value=\"{$input_data}\"" : "";
                            $output .= "></input>";
                            $output .= "</div></div>";
                            if (isset($data[$name.'_err'])) $output .= "<div class=\"form-group row\"><div class=\"col-12\">" . display_invalid($data[$name.'_err'], true) . "</div></div>";
                            $output .= "</div>";
                        }
                        echo $output;
                    } else {
                        for ($i = 1; $i <= $field['count']; $i++) {
                            // Put all names together for each array at position index.
                            $names = isset($data['fixture']->squad[$i]) ? $data['fixture']->squad[$i] : "";
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label} {$i}</label>";
                            $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                            $output .= "<input name=\"{$field['name']}[]\" type=\"{$field['type']}\" class=\"form-control";
                            if (!empty($data[$name.'_err'])) $output .= ' is-invalid';
                            $output .= "\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']} {$i}\"" : "";
                            $output .= (isset($names)) ? " value=\"{$names}\"" : "";
                            $output .= "></input>";
                            $output .= "</div></div>";
                            if (isset($data[$name.'_err'])) $output .= "<div class=\"form-group row\"><div class=\"col-12\">" . display_invalid($data[$name.'_err'], true) . "</div></div>";
                            $output .= "</div>";

                            echo $output;
                        }
                    }
                }
            } else {
                die('Missing CLUBS field configuration');
            }
?>
            </div>
            <div class="form-group row mt-3">
                <div class="col-6 mx-auto text-center">
                    <input type="submit" value="Add Fixture" class="btn btn-brown btn-block">
                </div>
            </div>
        </form>
    </div>

<?php
    if (!empty($data['fixtures'])) {
?>
    <div class="wrap">
        <h3>Edit Fixtures</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="thead-light text-center">
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
                    <td><?php echo date("d/m/y", strtotime($fixture->date)); ?></td>
                    <td><?php echo $fixture->league; ?></td>
                    <td><?php echo $fixture->home_team; ?></td>
                    <td><?php echo $fixture->away_team; ?></td>
                    <td><?php echo $fixture->venue; ?></td>
                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/fixtures/edit/" . $fixture->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/fixtures/delete/" . $fixture->id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
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