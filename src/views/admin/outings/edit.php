<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('outings');
?>

<div class="wrap">
    <h3>Edit Outing</h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/outings/edit/' . $data['outing']->id; ?>" method="POST">
        <div class="row">
<?php
            if (isset(CLUBS[$data['club']->club]['outings']['fields'])) {
                foreach (CLUBS[$data['club']->club]['outings']['fields'] as $field) {
                    $output = '';
                    $name = $field['name'];
                    $size = isset($field['size']) ? $field['size'] : '12';
                    $label = isset($field['label']) ? $field['label'] : ucwords($field['name']);
                    $placeholder = isset($field['placeholder']) ? $field['placeholder'] : '';
                    $input_data = isset($data['outing']->{$field['name']}) ? $data['outing']->{$field['name']} : '';                
                    // First check if there are multiple of the same field, mainly for Rinks and Players
                    if (!isset($field['count'])) {
                        if ($field['type'] === 'textarea') {
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-2 col-form-label d-none d-md-flex\">{$label}</label>";
                            $output .= "<div class=\"col-12 col-md-10\">";
                            $output .= "<textarea name=\"{$name}\"";
                            $output .= (!empty($placeholder)) ? " placeholder=\"{$placeholder}\"" : "";
                            $output .= " class=\"form-control\">{$input_data}</textarea>";
                            $output .= "</div></div></div>";
                        } elseif ($field['type'] === 'select') {
                            //First need to check if the select_item exists in config.
                            if (isset($field['select_item_model']) && isset($field['select_item'])) {
                                // Loop through all $select_items
                                $output = "<div class=\"col-{$size}\">";
                                $output .= "<div class=\"form-group row\">";
                                $output .= "<label for=\"{$name}\" class=\"col-2 col-form-label d-none d-md-flex\">{$label}</label>";
                                $output .= "<div class=\"col-12 col-md-10\">";
                                $output .= "<select name=\"{$field['name']}\" class=\"form-control\">";
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
                                    $output .= "</div></div></div>";
                                } else {
                                    // Put a disabled input box telling user to enter items in Settings page.
                                    $output = "<div class=\"col-{$size}\">";
                                    $output .= "<div class=\"form-group row\">";
                                    $output .= "<label for=\"{$name}\" class=\"col-2 col-form-label d-none d-md-flex\">{$label}</label>";
                                    $output .= "<div class=\"col-12 col-md-10\">";
                                    $output .= "<input type=\"text\" name=\"{$field['name']}}\" class=\"form-control\" value=\"No " . ucwords($field['name']) . "s Found.  Please enter " . ucwords($field['name']) . " in Settings page.\" disabled><br/>";
                                    $output .= "</div></div></div>";
                                }
                            } else {
                                die("<b>Fatal error:</b> There is no select_item_model or select_item for {$field['name']} for the club " . ucwords($data['club']->club) . " in the config.php file.");
                            }
                        }
                        else {
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-2 col-form-label d-none d-md-flex\">{$label}</label>";
                            $output .= "<div class=\"col-12 col-md-10\">";
                            $output .= "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"form-control\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
                            $output .= (isset($input_data)) ? " value=\"{$input_data}\"" : "";
                            $output .= "></input>";
                            $output .= "</div></div></div>";
                        }
                        echo $output;
                    } else {
                        for ($i = 1; $i <= $field['count']; $i++) {
                            // Put all names together for each array at position index.
                            $names = isset($data['outing']->squad[$i]) ? $data['outing']->squad[$i] : "";
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-2 col-form-label d-none d-md-flex\">{$label} {$i}</label>";
                            $output .= "<div class=\"col-12 col-md-10\">";
                            $output .= "<input name=\"{$field['name']}[]\" type=\"{$field['type']}\" class=\"form-control\"";
                            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']} {$i}\"" : "";
                            $output .= (isset($names)) ? " value=\"{$names}\"" : "";
                            $output .= "></input>";
                            $output .= "</div></div></div>";

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
                    <input type="submit" value="Save Changes" class="btn btn-brown btn-block">
                </div>
            </div>
        </form>
    </div>


<?php
    if (!empty($data['outings'])) {
?>
        <div class="wrap">
            <h3>Edit Outings</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="thead-light text-center">
                            <th>Date</th>
                            <th>Title</th>
                            <th>Venue</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
                foreach ($data['outings'] as $outing) {
    ?>
                    <tr>
                        <td><?php echo date("d/m/y", strtotime($outing->date)); ?></td>
                        <td><?php echo $outing->title; ?></td>
                        <td><?php echo $outing->venue; ?></td>
                        <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/outings/edit/" . $outing->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                        <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/outings/delete/" . $outing->id; ?>" class="btn btn-small btn-danger"><i class="fas fa-sm fa-trash-alt"></i></a></td>
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