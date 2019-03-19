<?php
    if (file_exists(PUBLIC_VIEWS . 'inc/header.php')) {
        require_once(PUBLIC_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }
?>
<?php 
    $bg = 'img/parallax/' . $data['club']->club . '/' . strtolower(basename(dirname(__FILE__))) . '.jpg';
    $bg_url = (file_exists(PUBLIC_ROOT . $bg)) ? URLROOT . $bg : 'img/parallax/' . $data['club']->club . '/main.jpg';
?>
    <div class="parallax">
        <div class="parallax-background" style="background-image: url(<?php echo $bg_url; ?>)"></div>
        <div class="parallax-text sj-heading-large">
            <?php echo isset(CLUBS[$data['club']->club]['section_titles']['results']) ? CLUBS[$data['club']->club]['section_titles']['results'] : 'Fixtures'; ?>
        </div>
    </div>
    <section>
        <div class="container mt-2">
            <div class="row">
<?php
            if (!empty($data['result'])) {
?>
               <div class="card">
                    <div class="card-header text-center sj-heading">
                        <?php echo ($data['result']->home_team_id === $data['club']->team_id) ? '<strong>' . $data['result']->home_team . '</strong>' : $data['result']->home_team; ?>
                        <span> v </span>
                        <?php echo ($data['result']->away_team_id === $data['club']->team_id) ? '<strong>' . $data['result']->away_team . '</strong>' : $data['result']->away_team; ?>
                    </div>
                    <div class="card-body">
                        <div class="container">
                        <?php
                            // Determine if win/draw/lose.
                            if ($data['result']->home_team_score === $data['result']->away_team_score) {
                                $bg_colour = "draw";
                            } elseif ($data['result']->home_team_id === $data['club']->team_id) {
                                $bg_colour = ($data['result']->home_team_score > $data['result']->away_team_score) ? "win" : "lose";
                            } elseif ($data['result']->away_team_id === $data['club']->team_id) {
                                $bg_colour = ($data['result']->away_team_score > $data['result']->home_team_score) ? "win" : "lose";
                            }
                        ?>
                            <div class="jumbotron text-center <?php echo isset($bg_colour) ? $bg_colour : ''; ?>">
                                <h1 class="display-4"><?php echo scoreline($data['club']->club, $data['result'], $data['club']->team_id); ?></h1>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><i class="fa fa-star border"></i></div>
                                <div class="col-8">
                                    <?php
                                        echo ($data['result']->home_team_id === $data['club']->team_id) ? '<strong>' . $data['result']->home_team . '</strong>' : $data['result']->home_team;
                                        echo ' v ';
                                        echo ($data['result']->away_team_id === $data['club']->team_id) ? '<strong>' . $data['result']->away_team . '</strong>' : $data['result']->away_team;
                                    ?>
                                </div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">League</span><i class="fas fa-asterisk border"></i></div>
                                <div class="col-8"><?php echo $data['result']->league; ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Date</span><i class="fa fa-calendar-alt border"></i></div>
                                <div class="col-8"><?php echo date("l jS F, Y", strtotime($data['result']->date)); ?></div>
                            </div>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Time</span><i class="fa fa-clock border"></i></div>
                                <div class="col-8"><?php echo date("H:i", strtotime($data['result']->time)); ?></div>
                            </div>
                    <?php
                            if (!empty($data['result']->venue)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Venue</span><i class="fa fa-map-marker-alt border"></i></div>
                                <div class="col-8"><?php echo $data['result']->venue; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['result']->meet_at)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Meet At</span><i class="fas fa-map-marked-alt border"></i></div>
                                <div class="col-8"><?php echo $data['result']->meet_at; ?></div>
                            </div>
                    <?php
                            }
                    ?>  
                    <?php
                            if (!empty($data['result']->contact)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Contact</span><i class="fas fa-phone border"></i></div>
                                <div class="col-8"><?php echo $data['result']->contact; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['result']->squad)) {
                                foreach ($data['result']->squad as $position => $names) {
                    ?>
                                <div class="row align-items-center mt-1">
                                    <div class="col-4 text-right"><span class="mr-3"><?php echo isset(CLUBS[$data['club']->club]['fixtures']['position_title']) ? CLUBS[$data['club']->club]['fixtures']['position_title'] . ' ' . $position : 'Player ' . $position; ?></span><i class="fas fa-user border"></i></div>
                                    <div class="col-8"><?php echo implode(", ", $names); ?></div>
                                </div>
                    <?php
                                }
                            }
                    ?>  
                    <?php
                            if (!empty($data['result']->substitutes)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3"><?php echo isset(CLUBS[$data['club']->club]['fixtures']['substitutes_title']) ? CLUBS[$data['club']->club]['fixtures']['substitutes_title'] : 'Substitutes'; ?></span><i class="fas fa-users border"></i></div>
                                <div class="col-8"><?php echo $data['result']->substitutes; ?></div>
                            </div>
                    <?php
                            }
                    ?>
                    <?php
                            if (!empty($data['result']->other_information)) {
                    ?>
                            <div class="row align-items-center mt-1">
                                <div class="col-4 text-right"><span class="mr-3">Other Information</span><i class="fas fa-comment-alt border"></i></div>
                                <div class="col-8"><?php echo $data['result']->other_information; ?></div>
                            </div>
                    <?php
                            }
                    ?>  
                        </div>
                    </div>
                </div>
<?php
            } else {
?>
                <input type="hidden" id="season" name="season" value="<?php echo getSeason($data['club']->club); ?>">
                <input type="hidden" id="section" name="section" value="results">
                <input type="hidden" id="club_id" name="club_id" value="<?php echo $data['club']->id; ?>">

                <!-- Season Filters -->
                <div id="season-filters" class="mb-3">
                    <div class="btn-group" role="group" aria-label="Change Season">
<?php
                        if (CLUBS[$data['club']->club]['season']) {
                            $season_data = CLUBS[$data['club']->club]['season'];
                            $max_year = date("Y");
                            $create_date = new DateTime($season_data['start_date'] . " " . $max_year);
                            $date = date_format($create_date, "Y-m-d H:i:s");
                            $now = date("Y-m-d H:i:s");
                            if ($date > $now) {
                                $max_year--;
                            }

                            for ($year = $season_data['start_year']; $year <= $max_year; $year++) {
                                if ($season_data['span_years'] == true) {
                                    $next_year = $year + 1;
                                    echo "<button type=\"button\" class=\"btn btn-lg btn-light\" data-season=\"{$year}\">{$season_data['title']} {$year} / {$next_year}</button>";
                                } else {
                                    echo "<button type=\"button\" class=\"btn btn-lg btn-light\" data-season=\"{$year}\">{$season_data['title']} {$year}</button>";
                                }
                            }
                        } else {
                            die('<strong>Fatal Error:</strong> Club\'s season configuration is not set.');
                        }
?>
                    </div>
                </div>
                <!-- League Filters -->
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
<?php
                if (!empty($data['results'])) {
?>
                    <!-- Table -->
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                                <th>Date</th>
                                <th class="d-none d-md-table-cell">League</th>
                                <th>Home Team</th>
                                <th>Score</th>
                                <th>Away Team</th>
                                <th>View Result</th>
                            </thead>
                            <tbody>
<?php
                            foreach ($data['results'] as $result) {
                                // Determine if win/draw/lose.
                                if ($result->home_team_score === $result->away_team_score) {
                                    $bg_colour = "draw";
                                } elseif ($result->home_team_id === $data['club']->team_id) {
                                    $bg_colour = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
                                } elseif ($result->away_team_id === $data['club']->team_id) {
                                    $bg_colour = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
                                }
?>
                                <tr class="<?php echo isset($bg_colour) ? $bg_colour : ''; ?>">
                                    <td><?php echo date("d M Y", strtotime($result->date)); ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo $result->league; ?></td>
                                    <td><?php echo ($result->home_team_score > $result->away_team_score) ? '<strong>' . $result->home_team . '</strong>' : $result->home_team; ?></td>
                                    <td><?php echo scoreline($data['club']->club, $result, $data['club']->team_id); ?></td> <!-- Scoreline function is in helpers folder. -->
                                    <td><?php echo ($result->away_team_score > $result->home_team_score) ? '<strong>' . $result->away_team . '</strong>' : $result->away_team; ?></td>
                                    <td><a href="<?php echo URLROOT . $data['club']->club . '/results/' . $result->id; ?>" class="btn btn-brown">View Result</a></td>
                                </tr>
<?php
                                unset($bg_colour);
                            }
?>
                            </tbody>
                        </table>
<?php
                } else {
                    if (CLUBS[$data['club']->club]['season']) {
                        $season_data = CLUBS[$data['club']->club]['season'];
                        $year = date("Y");
                        $create_date = new DateTime($season_data['start_date'] . " " . $year);
                        $date = date_format($create_date, "Y-m-d H:i:s");
                        $now = date("Y-m-d H:i:s");
                        if ($date > $now) {
                            $year--;
                        }
?>
                        <div class="empty-section">
                            <p>There aren't any results to show for the <?php echo strtolower($season_data['title']) . " " . $year; if ($season_data['span_years'] == true) echo " / " . ($year+1); ?>.</p>
                        </div>
<?php
                    } else {
                        die('<strong>Fatal Error:</strong> Club\'s season configuration is not set.');
                    }
                }
?>
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