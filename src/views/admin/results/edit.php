<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('results');
?>

<div class="wrap">
    <h3>Edit Result for <?php echo $data['result']->home_team; ?> v <?php echo $data['result']->away_team; ?></h3>
    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/results/edit/' . $data['result']->id; ?>" method="POST">
        <div class="row">
<?php
    if (isset(CLUBS[$data['club']->club]['results']['fields'])) {
        foreach (CLUBS[$data['club']->club]['results']['fields'] as $field) {
            $input_data = isset($data['result']->{$field['name']}) ? $data['result']->{$field['name']} : '';
            $size = (isset($field['size'])) ? $field['size'] : 12;
            $label = (isset($field['label'])) ? $field['label'] : ucwords($field['name']);
            $label = result_label($label, $data['result']->home_team, $data['result']->away_team);
            $output = "<div class=\"col-12 col-md-{$size}\">";
            $output .= "<div class=\"form-group row\">";
            $output .= "<label for=\"{$field['name']}\" class=\"col-12 col-md-6 col-form-label\">{$label}</label>";
            $output .= "<div class=\"col-12 col-md-6\">";
            $output .= "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"form-control\"";
            $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
            $output .= (isset($input_data)) ? " value=\"{$input_data}\"" : "";
            $output .= "></input>";
            $output .= "</div></div></div>";
            echo $output;
        }
    } else {
        die('Missing CLUBS results configuration');
    }
?>
        </div>
        <div class="row mt-3">
            <div class="col-6 mx-auto">
                <input type="submit" value="Save Result" class="btn btn-block btn-brown">
            </div>
        </div>
    </form>

<?php
    if (!empty($data['home_team_score_err'])) {
        print_var($data['home_team_score_err']);
    }
    if (!empty($data['away_team_score_err'])) {
        print_var($data['away_team_score_err']);
    }
?>
</div>

<?php
    if (!empty($data['results'])) {
?>
    <div class="wrap">
        <h3>Results</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="thead-light text-center">
                        <th>Date</th>
                        <th>League</th>
                        <th>Home Team</th>
                        <th>Home Team Score</th>
                        <th>Away Team</th>
                        <th>Away Team Score</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
<?php
            foreach ($data['results'] as $result) {
?>
                    <tr>
                        <td><?php echo date("d/m/y", strtotime($result->date)); ?></td>
                        <td><?php echo $result->league; ?></td>
                        <td><?php echo $result->home_team; ?></td>
                        <td><?php echo $result->home_team_score; ?></td>
                        <td><?php echo $result->away_team; ?></td>
                        <td><?php echo $result->away_team_score; ?></td>
                        <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/results/edit/" . $result->id;  ?>" class="btn btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
                    </tr>
<?php
            }
?>
                </tbody>
            </table>
        </div>
    </div>
<?php   } ?>

<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>