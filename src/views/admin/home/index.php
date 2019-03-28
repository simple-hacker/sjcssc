<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
    display_flash_messages('user');
?>

<div class="wrap">
    <h3><?php echo $data['club']->name; ?> Dashboard</h3>
    <p>Welcome <?php echo (!empty($_SESSION['user']['name'])) ? $_SESSION['user']['name'] : $_SESSION['user']['username']; ?>!</p>
    <?php
        $contact_titles = array('addresses', 'emails', 'phone_numbers');
        foreach ($contact_titles as $i => $contact) {
            if (empty($data['club']->{$contact})) {
                echo "<div class=\"alert alert-warning mb-2\" role=\"alert\">";
                echo "Warning: You do not have any contact information for " . str_replace("_", " ", $contact) . ".  Please add in <a href=\"" . ADMIN_URLROOT . $data['club']->club . "/settings" . "\">Settings</a>";
                echo "</div>";
            }
        }
    ?>
</div>

<div class="wrap">
    <h3>Quick Add</h3>
    <div class="row text-center">
        <div class="col-12">
        <?php
            $ignore_sections = array('results', 'reports');
            foreach (CLUBS[$data['club']->club]['sections'] as $i => $section) {
                if (!in_array($section, $ignore_sections)) {
        ?>
                    <a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/" . $section; ?>" class="db-btn">
                        <div class="db-btn-icon">
                            <?php echo (isset(ICONS[$section])) ? ICONS[$section] : ICONS['default']; ?>
                        </div>
                        <div class="db-btn-text">
                            <?php echo ucwords($section); ?>
                        </div>
                    </a>
        <?php
                }
            }
        ?>
        <a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/pages/add/"; ?>" class="db-btn">
            <div class="db-btn-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="db-btn-text">
                Page
            </div>
        </a>
        </div>
    </div>
</div>

<?php 
        if (isset($data['unpublished_results']) && count($data['unpublished_results']) > 0) {
            $count = count($data['unpublished_results']);
?>
            <div class="wrap">
                <h3>Unpublished Results</h3>
                <div class="alert alert-danger mb-4">
                    You have <strong><?php echo $count; ?></strong> unpublished <?php echo ($count < 2) ? 'result' : 'results'; ?>.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="thead-light text-center">
                                <th>Date</th>
                                <th>League</th>
                                <th>Home Team</th>
                                <th>Away Team</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($data['unpublished_results'] as $result) {
                        ?>
                                <tr>
                                    <td><?php echo date("d/m/y", strtotime($result->date)); ?></td>
                                    <td><?php echo $result->league; ?></td>
                                    <td><?php echo $result->home_team; ?></td>
                                    <td><?php echo $result->away_team; ?></td>
                                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/results/edit/" . $result->id;  ?>" class="btn btn-primary"><i class="fas fa-sm fa-edit"></i> Enter Result</a></td>
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

        if (isset($data['unpublished_reports']) && count($data['unpublished_reports']) > 0) {
            $count = count($data['unpublished_reports']);
?>
            <div class="wrap">
                <h3>Unpublished Reports</h3>
                <div class="alert alert-danger mb-4">
                    You have <strong><?php echo $count; ?></strong> unpublished <?php echo ($count < 2) ? 'report' : 'reports'; ?>.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="thead-light text-center">
                                <th>Date</th>
                                <th>Title</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($data['unpublished_reports'] as $report) {
                        ?>
                                <tr>
                                    <td><?php echo date("d/m/y", strtotime($report->date)); ?></td>
                                    <td><?php echo $report->title; ?></td>
                                    <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/reports/edit/" . $report->id; ?>" class="btn btn-small btn-primary"><i class="fas fa-sm fa-edit"></i> Enter Report</a></td>
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