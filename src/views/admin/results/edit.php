<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('results');
?>

    <h1>Edit Result for <?php echo $data['result']->home_team; ?> v <?php echo $data['result']->away_team; ?></h1>

    <form action="<?php echo ADMIN_URLROOT . $data['club']->club . '/results/edit/' . $data['result']->id; ?>" method="POST">
<?php
        if (isset(CLUBS[$data['club']->club]['results']['fields'])) {

            foreach (CLUBS[$data['club']->club]['results']['fields'] as $field) {

                $input_data = isset($data['result']->{$field['name']}) ? $data['result']->{$field['name']} : '';                
                // First check if there are multiple of the same field, mainly for Rinks and Players
                $output = "<input name=\"{$field['name']}\" type=\"{$field['type']}\" class=\"col-{$field['size']}\"";
                $output .= (isset($field['placeholder'])) ? " placeholder=\"{$field['placeholder']}\"" : "";
                $output .= (isset($input_data)) ? " value=\"{$input_data}\"" : "";
                $output .= "></input><br/>";
                echo $output;
            }
        } else {
            die('Missing CLUBS results configuration');
        }
?>
            <input type="submit" value="Save Result">
    </form>

<?php
    if (!empty($data['home_team_score_err'])) {
        print_var($data['home_team_score_err']);
    }
    if (!empty($data['away_team_score_err'])) {
        print_var($data['away_team_score_err']);
    }
?>

    <h1>Edit Results</h1>
<?php
    if (!empty($data['results'])) {
?>
        <table>
            <thead>
                <tr>
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
                <td><?php echo $result->date; ?></td>
                <td><?php echo $result->league; ?></td>
                <td><?php echo $result->home_team; ?></td>
                <td><?php echo $result->home_team_score; ?></td>
                <td><?php echo $result->away_team; ?></td>
                <td><?php echo $result->away_team_score; ?></td>
                <td><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/results/edit/" . $result->id;  ?>">Edit</a></td>
            </tr>
<?php
        }
?>
            </tbody>
        </table>
<?php
    } else {
?>
        <p>No Results available.</p>
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