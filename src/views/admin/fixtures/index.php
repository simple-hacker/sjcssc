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
        <input type="hidden" id="club_id" name="club_id" value="<?php echo $data['club']->id; ?>">
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
                        $squad_title = (isset(CLUBS[$data['club']->club]['fixtures']['squad_title'])) ? CLUBS[$data['club']->club]['fixtures']['squad_title'] : 'Squad';
                        echo "<div class=\"col-12\"><h4>{$squad_title}</h4>";
                        if ($data['club']->club === 'bowls') echo "<p>Separate each player's name in each rink with a comma.</p>";
                        echo "</div>";
                        $squad_title = true;
                    }

                    // First check if there are multiple of the same field, mainly for Rinks and Players
                    if (!isset($field['count'])) {
                        if ($field['type'] === 'textarea') {
                            $output = "<div class=\"col-{$size}\">";
                            $output .= "<div class=\"form-group row\">";
                            $output .= "<label for=\"{$name}\" class=\"col-{$label_size} col-form-label d-none d-md-flex\">{$label}</label>";
                            $output .= "<div class=\"col-12 col-md-{$input_size}\">";
                            $output .= "<textarea id=\"{$name}\" name=\"{$name}\"";
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
                                $output .= "<select id=\"{$name}\" name=\"{$name}\" class=\"form-control";
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
                                    $output .= "<input type=\"text\" id=\"{$name}\" name=\"{$field['name']}}\" class=\"form-control";
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
                            $output .= "<input id=\"{$name}\" name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"form-control";
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
                            $output .= "<input id=\"{$name}\" name=\"{$field['name']}[]\" type=\"{$field['type']}\" class=\"form-control";
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
    <input type="hidden" id="season" name="season" value="<?php echo getSeason($data['club']->club); ?>">
    <input type="hidden" id="section" name="section" value="fixtures">
    <input type="hidden" id="club_id" name="club_id" value="<?php echo $data['club']->id; ?>">

    <div class="wrap">
        <h3>Edit Fixtures</h3>
        <!-- League filters -->
        <div id="league-filters" class="mb-3">
            <div class="btn-group" data-toggle="buttons" aria-label="Filter league">
<?php
                foreach ($data['leagues'] as $i => $league) {
?>
                    <label for="<?php echo $league->league; ?>" class="btn btn-lg btn-brown-secondary">
                        <input type="checkbox" id="<?php echo $league->league; ?>" name="leagues" value="<?php echo $league->id; ?>"><?php echo $league->league; ?>
                    </label>
<?php
                }
?>
            </div>
        </div>
        <div id="table" class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="thead-light text-center">
                        <th>Date</th>
                        <th>League</th>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
<?php
            foreach ($data['fixtures'] as $fixture) {
?>
                <tr>
                    <td><?php echo date("D d M", strtotime($fixture->date)); ?></td>
                    <td><?php echo $fixture->league; ?></td>
                    <td><?php echo $fixture->home_team; ?></td>
                    <td><?php echo $fixture->away_team; ?></td>
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
<script>
    $('#home_team_id').change(function(){
        var home_team_id = $('#home_team_id').val();
        var club_id = $('#club_id').val();
        $.ajax({
            url: "ajax/getVenue",
            type: "POST",
            data: { 'getVenue' : 1, 'club_id' : club_id, 'home_team_id' : home_team_id},
            dataType: "json",
            success: function(data) {
                if (data.success == true) {
                    var overwrite = true;
                    if ($('#venue').val() != "") {
                        overwrite = confirm("Do you want to overwrite the venue to "+data.venue+"?");
                    }
                    if (overwrite == true) {
                        $('#venue').val(data.venue);		
                    }
                } else {
                    alert("Something went wrong.  Please try again.");
                }
            },
            error: function (data) {
                console.log("Something went wrong.");
            }
        }, "json");
    });
</script>
<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>