<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>


<?php 
    $bg_url = URLROOT . 'img/parallax/' . $data['club']->club . '/2.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['reports']) ? CLUBS[$data['club']->club]['section_titles']['reports'] : 'Reports'; ?>
        </div>
    </div>

<section>
    <div class="container">
        <div class="row">
        <?php
    if (!empty($data['report'])) {
?>
        <div class="card mb-3">
            <div class="card-header table-striped text-center sj-heading-small">
                <?php echo $data['report']->title; ?>
            </div>
            <div class="card-body">
                <div class="container">
                <?php
                    if (!empty($data['report']->report)) {
                ?>
                        <div class="jumbotron">
                            <p><?php echo $data['report']->report; ?></p>
                        </div>
                <?php
                        }
                ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><i class="fa fa-star border"></i></div>
                        <div class="col-8"><?php echo $data['report']->title; ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Date</span><i class="fa fa-calendar-alt border"></i></div>
                        <div class="col-8"><?php echo date("l jS F, Y", strtotime($data['report']->date)); ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Time</span><i class="fa fa-clock border"></i></div>
                        <div class="col-8"><?php echo date("H:i", strtotime($data['report']->time)); ?></div>
                    </div>
            <?php
                    if (!empty($data['report']->venue)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Venue</span><i class="fa fa-map-marker-alt border"></i></div>
                        <div class="col-8"><?php echo $data['report']->venue; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['report']->meet_at)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Meet At</span><i class="fas fa-map-marked-alt border"></i></div>
                        <div class="col-8"><?php echo $data['report']->meet_at; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['report']->contact)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Contact</span><i class="fas fa-phone border"></i></div>
                        <div class="col-8"><?php echo $data['report']->contact; ?></div>
                    </div>
            <?php
                    }
            ?>
            <?php
                    if (!empty($data['report']->other_information)) {
            ?>
                    <div class="row mt-1">
                        <div class="col-4 text-right"><span class="mr-3">Other Information</span><i class="fas fa-comment-alt border"></i></div>
                        <div class="col-8"><?php echo $data['report']->other_information; ?></div>
                    </div>
            <?php
                    }
            ?>                         
                </div>
            </div>
        </div>
<?php
    } elseif (!empty($data['reports'])) {
?>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered text-center">
            <thead>
                <th>Date</th>
                <th>Title</th>
                <th class="d-none d-md-table-cell">Venue</th>
                <th>View Report</th>
            </thead>
            <tbody>
<?php
        foreach ($data['reports'] as $report) {
?>
                <tr>
                    <td><?php echo date("d/m/y", strtotime($report->date)); ?></td>
                    <td><?php echo $report->title; ?></td>
                    <td class="d-none d-md-table-cell"><?php echo $report->venue; ?></td>
                    <td><a href="<?php echo URLROOT . $data['club']->club . '/reports/' . $report->id; ?>" class="btn btn-brown">View Report</a></td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>
    </div>
<?php
    } else {
?>
        <div class="empty-section">
            <p>Unfortunately there aren't any reports to show.</p>
        </div>
<?php
    }
?>
        </div>
    </div>
</section>

<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/footer.php')) {
        require_once(PUBLIC_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>