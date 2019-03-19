<?php
    if (file_exists(ADMIN_VIEWS . 'inc/header.php')) {
        require_once(ADMIN_VIEWS . 'inc/header.php');
    } else {
        die('<strong>Fatal Error: </strong>Header file has been deleted');
    }

    display_flash_messages('results');
?>

<div class="wrap">
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
</div>

<div class="wrap">
    <h3 id="title">Latest Results</h3>
    <div id="table" class="table-responsive">
<?php
    if (!empty($data['results'])) {
?>
        
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
                // Determine if win/draw/lose.
                if ($result->publish_results == true) {
                    if ($result->home_team_score === $result->away_team_score) {
                        $bg_colour = "draw";
                    } elseif ($result->home_team_id === $data['club']->team_id) {
                        $bg_colour = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
                    } elseif ($result->away_team_id === $data['club']->team_id) {
                        $bg_colour = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
                    }
                }
?>
                    <tr class="<?php echo isset($bg_colour) ? $bg_colour : ''; ?>">
                        <td><?php echo date("d M Y", strtotime($result->date)); ?></td>
                        <td><?php echo $result->league; ?></td>
                        <td><?php echo $result->home_team; ?></td>
                        <td><?php echo $result->home_team_score; ?></td>
                        <td><?php echo $result->away_team; ?></td>
                        <td><?php echo $result->away_team_score; ?></td>
                        <td class="text-center"><a href="<?php echo ADMIN_URLROOT . $data['club']->club . "/results/edit/" . $result->id;  ?>" class="btn btn-primary"><i class="fas fa-sm fa-edit"></i></a></td>
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
            }
        }
?>
    </div>
</div>
    
<?php
    if (file_exists(ADMIN_VIEWS . 'inc/footer.php')) {
        require_once(ADMIN_VIEWS . 'inc/footer.php');
    } else {
        die('<strong>Fatal Error: </strong>Footer file has been deleted');
    }
?>