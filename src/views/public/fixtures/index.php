<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>

<?php 
    $bg = 'img/parallax/' . $data['club']->club . '/' . strtolower(basename(dirname(__FILE__))) . '.jpg';
    $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : URLROOT . 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['fixtures']) ? CLUBS[$data['club']->club]['section_titles']['fixtures'] : 'Fixtures'; ?>
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
<?php
            if (!empty($data['fixture'])) {
?>
                <div class="card">
                    <div class="card-header text-center sj-heading">
                        <?php echo ($data['fixture']->home_team_id === $data['club']->team_id) ? '<strong>' . $data['fixture']->home_team . '</strong>' : $data['fixture']->home_team; ?>
                        <span> v </span>
                        <?php echo ($data['fixture']->away_team_id === $data['club']->team_id) ? '<strong>' . $data['fixture']->away_team . '</strong>' : $data['fixture']->away_team; ?>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><i class="fa fa-star border"></i></div>
                                <div class="col-8">
                                    <?php
                                        echo ($data['fixture']->home_team_id === $data['club']->team_id) ? '<strong>' . $data['fixture']->home_team . '</strong>' : $data['fixture']->home_team;
                                        echo ' v ';
                                        echo ($data['fixture']->away_team_id === $data['club']->team_id) ? '<strong>' . $data['fixture']->away_team . '</strong>' : $data['fixture']->away_team;
                                    ?>
                                </div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">League</span><i class="fas fa-asterisk border"></i></div>
                                <div class="col-8"><?php echo $data['fixture']->league; ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Date</span><i class="fa fa-calendar-alt border"></i></div>
                                <div class="col-8"><?php echo date("l jS F, Y", strtotime($data['fixture']->date)); ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Time</span><i class="fa fa-clock border"></i></div>
                                <div class="col-8"><?php echo date("H:i", strtotime($data['fixture']->time)); ?></div>
                            </div>
                    <?php
                            if (!empty($data['fixture']->venue)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Venue</span><i class="fa fa-map-marker-alt border"></i></div>
                                <div class="col-8"><a href="<?php echo google_maps($data['fixture']->venue); ?>" target="_blank"><?php echo $data['fixture']->venue; ?></a></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['fixture']->meet_at)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Meet At</span><i class="fas fa-map-marked-alt border"></i></div>
                                <div class="col-8"><?php echo $data['fixture']->meet_at; ?></div>
                            </div>
                    <?php
                            }
                    ?>  
                    <?php
                            if (!empty($data['fixture']->contact)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Contact</span><i class="fas fa-phone border"></i></div>
                                <div class="col-8"><?php echo $data['fixture']->contact; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['fixture']->squad)) {
                                foreach ($data['fixture']->squad as $position => $names) {
                    ?>
                                <div class="row align-items-center mt-1">
                                    <div class="col-4 text-right"><span class="mr-3"><?php echo isset(CLUBS[$data['club']->club]['fixtures']['position_title']) ? CLUBS[$data['club']->club]['fixtures']['position_title'] . ' ' . $position : 'Player ' . $position; ?></span><i class="fas fa-user border"></i></div>
                                    <div class="col-8"><?php echo $names; ?></div>
                                </div>
                    <?php
                                }
                            }
                    ?>  
                    <?php
                            if (!empty($data['fixture']->substitutes)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3"><?php echo isset(CLUBS[$data['club']->club]['fixtures']['substitutes_title']) ? CLUBS[$data['club']->club]['fixtures']['substitutes_title'] : 'Substitutes'; ?></span><i class="fas fa-users border"></i></div>
                                <div class="col-8"><?php echo $data['fixture']->substitutes; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['fixture']->other_information)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Other Information</span><i class="fas fa-comment-alt border"></i></div>
                                <div class="col-8"><?php echo $data['fixture']->other_information; ?></div>
                            </div>
                    <?php
                            }
                    ?>  
                        </div>
                    </div>
                </div>
<?php
            } elseif (!empty($data['fixtures'])) {
?>
            <input type="hidden" id="season" name="season" value="<?php echo getSeason($data['club']->club); ?>">
            <input type="hidden" id="section" name="section" value="fixtures">
            <input type="hidden" id="club_id" name="club_id" value="<?php echo $data['club']->id; ?>">

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
                <table class="table table-sm table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="w-10">Date</th>
                            <th class="d-none d-md-table-cell w-10">League</th>
                            <th>Match</th>
                            <th class="w-40">Venue</th>
                            <th>View Fixture</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                foreach ($data['fixtures'] as $fixture) {
?>
                    <tr>
                        <td><?php echo date("D d M", strtotime($fixture->date)); ?></td>
                        <td><?php echo $fixture->league; ?></td>
                        <td>
                            <?php echo $fixture->home_team . " v " . $fixture->away_team; ?>
                        </td>
                        <td><a href="<?php echo google_maps($fixture->venue); ?>" target="_blank"><?php echo $fixture->venue; ?></a></td>
                        <td><a href="<?php echo URLROOT . $data['club']->club . '/fixtures/' . $fixture->id; ?>" class="btn btn-brown">View Fixture</a></td>
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
                    <p>There aren't any fixtures to show.</p>
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