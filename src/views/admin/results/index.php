<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('results');
?>

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