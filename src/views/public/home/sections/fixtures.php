<section>
    <div class="container-fluid">
        <div class="row">
<?php
    if (!empty($data['fixtures'])) {
        $col = (int)(12 / sizeof($data['fixtures']));
        foreach ($data['fixtures'] as $fixture) {
?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-<?php echo $col; ?>">
                <div class="card mb-3">
                    <div class="card-header text-center sj-heading-small">
                        <?php echo $fixture->league; ?>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row align-items-center mt-1">
                                <div class="col-3"><i class="fa fa-star border"></i></div>
                                <div class="col-9">
                                    <?php
                                        // echo ($fixture->home_team_id === $data['club']->team_id) ? '<strong>' . $fixture->home_team . '</strong>' : $fixture->home_team;
                                        // echo ' v ';
                                        // echo ($fixture->away_team_id === $data['club']->team_id) ? '<strong>' . $fixture->away_team . '</strong>' : $fixture->away_team;
                                        echo $fixture->home_team . " v " . $fixture->away_team;
                                    ?>
                                </div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-3"><i class="fa fa-calendar-alt border"></i></div>
                                <div class="col-9"><?php echo date("l jS F, Y", strtotime($fixture->date)); ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-3"><i class="fa fa-clock border"></i></div>
                                <div class="col-9"><?php echo date("H:i", strtotime($fixture->time)); ?></div>
                            </div>
                    <?php
                            if (!empty($fixture->venue)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-3"><i class="fa fa-map-marker-alt border"></i></div>
                                <div class="col-9"><?php echo $fixture->venue; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="<?php echo URLROOT . $data['club']->club . '/fixtures/' . $fixture->id; ?>" class="btn btn-brown">View Fixture</a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
?>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo URLROOT . $data['club']->club . '/fixtures/'; ?>" class="btn btn-lg btn-brown">View All Upcoming Fixtures</a>
            </div>
        </div>
    </div>
</section>