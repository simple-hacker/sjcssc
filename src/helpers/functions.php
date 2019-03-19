<?php
    function getDates($club_name, $season) {
        $dates = array();
        $season_data = CLUBS[$club_name]['season'];
        $current_year = date("Y");
        if ($season == 0 || $season == $current_year) {
            $create_date = new DateTime($season_data['start_date'] . " " . $current_year);
            $date = date_format($create_date, "Y-m-d H:i:s");
            $now = date("Y-m-d H:i:s");
            if ($date < $now) {
                $dates = [$date, date("Y-m-d H:i:s", strtotime($date . " +1 year -1 second"))];
            } else {
                $dates = [date("Y-m-d H:i:s", strtotime($date . " -1 year")), date("Y-m-d H:i:s", strtotime($date . " -1 second"))];
            }
        } else {
            $season = ($season < $season_data['start_year']) ? $season_data['start_year'] : (int) $season;
            $create_date = new DateTime($season_data['start_date'] . " " . $season);
            $date = date_format($create_date, "Y-m-d H:i:s");
            $dates = [$date, date("Y-m-d H:i:s", strtotime($date . " +1 year -1 second"))];
        }
        return $dates;
    }

    function getSeason($club_name) {
        $current_year = (int)date("Y");
        $season_data = CLUBS[$club_name]['season'];

        $create_date = new DateTime($season_data['start_date'] . " " . $current_year);
        $date = date_format($create_date, "Y-m-d H:i:s");
        $now = date("Y-m-d H:i:s");

        return ($date < $now) ? $current_year : ($current_year - 1);
    }

    function getTable($club_name, $section, $admin, $items, $team_id) {
        $html = "";
        $season_data = CLUBS[$club_name]['season'];
        if ($section == "fixtures") {
            if ($admin == false) {
                // Fixtures front page
                if (!empty($items)) {
                    $html = "<table class=\"table table-sm table-bordered text-center\">
                                <thead>
                                    <th class=\"w-10\">Date</th>
                                    <th class=\"d-none d-md-table-cell w-10\">League</th>
                                    <th>Match</th>
                                    <th class=\"w-40\">Venue</th>
                                    <th>View Fixture</th>
                                </thead>
                                <tbody>";
                    foreach ($items as $fixture) {
                        $html .= "<tr>
                                    <td>" . date("D d M", strtotime($fixture->date)) . "</td>
                                    <td>{$fixture->league}</td>
                                    <td>" . $fixture->home_team . " v " . $fixture->away_team . "</td>
                                    <td><a href=\"" . google_maps($fixture->venue) . "\" target=\"_blank\">" . $fixture->venue . "</a></td>
                                    <td><a href=\"" . URLROOT . $club_name . "/fixtures/" . $fixture->id . "\" class=\"btn btn-brown\">View Fixture</a></td>
                                </tr>";
                    }
                    $html .= "</tbody>
                            </table>";
                } else {
                    $html = "<div class=\"empty-section\"><p>There aren't any fixtures to show.</p></div>";
                }
            } else {
                // Fixtures admin area
                if (!empty($items)) {
                    $html = "<table class=\"table table-bordered table-sm\">
                                <thead>
                                    <tr class=\"thead-light text-center\">
                                        <th>Date</th>
                                        <th>League</th>
                                        <th>Home Team</th>
                                        <th>Away Team</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    foreach ($items as $fixture) {
                        $html .= "<tr>
                                    <td>" . date("D d M", strtotime($fixture->date)) . "</td>
                                    <td>{$fixture->league}</td>
                                    <td>{$fixture->home_team}</td>
                                    <td>{$fixture->away_team}</td>
                                    <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/fixtures/edit/" . $fixture->id . "\" class=\"btn btn-small btn-primary\"><i class=\"fas fa-sm fa-edit\"></i></a></td>
                                    <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/fixtures/delete/" . $fixture->id . "\" class=\"btn btn-small btn-danger\"><i class=\"fas fa-sm fa-trash-alt\"></i></a></td>
                                </tr>";
                    }
                    $html .= "</tbody>
                            </table>";
                } else {
                    $html = "<div class=\"empty-section\"><p>There aren't any fixtures to show.</p></div>";
                }
            }
        } elseif ($section == "results") {
            if ($admin == false) {
                // Results front page
                if (!empty($items)) {
                    $html = "<table class=\"table table-sm table-bordered text-center\">
                                            <thead>
                                                <th>Date</th>
                                                <th class=\"d-none d-md-table-cell\">League</th>
                                                <th>Home Team</th>
                                                <th>Score</th>
                                                <th>Away Team</th>
                                                <th>View Result</th>
                                            </thead>
                                            <tbody>";
                    foreach ($items as $result) {
                        // Determine if win/draw/lose.
                        if ($result->home_team_score === $result->away_team_score) {
                            $bg_colour = "draw";
                        } elseif ($result->home_team_id === $team_id) {
                            $bg_colour = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
                        } elseif ($result->away_team_id === $team_id) {
                            $bg_colour = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
                        }
                        $html .= "<tr class=\"" . (isset($bg_colour) ? $bg_colour : '') . "\">
                                            <td>" . date("d M Y", strtotime($result->date)) . "</td>
                                            <td class=\"d-none d-md-table-cell\">{$result->league}</td>
                                            <td>" . (($result->home_team_score > $result->away_team_score) ? '<strong>' . $result->home_team . '</strong>' : $result->home_team) . "</td>
                                            <td>" . scoreline($club_name, $result, $team_id) . "</td>
                                            <td>" . (($result->away_team_score > $result->home_team_score) ? '<strong>' . $result->away_team . '</strong>' : $result->away_team) . "</td>
                                            <td><a href=\"" . URLROOT . $club_name . "/results/" . $result->id . "\" class=\"btn btn-brown\">View Result</a></td>
                                        </tr>";
                        unset($bg_colour);
                    }
                    $html .= "      </tbody>
                                </table>";
                } else {
                    $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                    if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                    $html = "<div class=\"empty-section\"><p>There aren't any results to show for the {$season_wording}.</p></div>";
                }
            } else {
                // Results admin area
                if (!empty($items)) {
                    $html = "<table class=\"table table-bordered table-striped table-sm\">
                                <thead>
                                    <tr class=\"thead-light text-center\">
                                        <th>Date</th>
                                        <th>League</th>
                                        <th>Home Team</th>
                                        <th>Home Team Score</th>
                                        <th>Away Team</th>
                                        <th>Away Team Score</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    foreach ($items as $result) {
                        // Determine if win/draw/lose.
                        if ($result->publish_results == true) {
                            if ($result->home_team_score === $result->away_team_score) {
                                $bg_colour = "draw";
                            } elseif ($result->home_team_id === $team_id) {
                                $bg_colour = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
                            } elseif ($result->away_team_id === $team_id) {
                                $bg_colour = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
                            }
                        }

                        $html .= "<tr class=\"" . (isset($bg_colour) ? $bg_colour : '') . "\">
                                    <td>" . date("d M Y", strtotime($result->date)) . "</td>
                                    <td>{$result->league}</td>
                                    <td>{$result->home_team}</td>
                                    <td>{$result->home_team_score}</td>
                                    <td>{$result->away_team}</td>
                                    <td>{$result->away_team_score}</td>
                                    <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/results/edit/" . $result->id . "\" class=\"btn btn-primary\"><i class=\"fas fa-sm fa-edit\"></i></a></td>
                                </tr>";
                        unset($bg_colour);
                    }
                    $html .= "     </tbody>
                            </table>";
                } else {
                    $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                    if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                    $html = "<div class=\"empty-section\"><p>There aren't any results to show for the {$season_wording}.</p></div>";
                }
            }
        } elseif ($section == "reports") {
            if ($admin == false) {
                // Reports front page
                if (!empty($items)) {
                    $html = "<table class=\"table table-sm table-striped table-bordered text-center\">
                                <thead>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th class=\"d-none d-md-table-cell\">Venue</th>
                                    <th>View Report</th>
                                </thead>
                                <tbody>";
                    foreach ($items as $report) {
                        $html .= "  <tr>
                                        <td>" . date("d M Y", strtotime($report->date)) . "</td>
                                        <td>{$report->title}</td>
                                        <td class=\"d-none d-md-table-cell\">{$report->venue}</td>
                                        <td><a href=\"" . URLROOT . $club_name . "/reports/" . $report->id . "\" class=\"btn btn-brown\">View Report</a></td>
                                    </tr>";
                    }
                    $html .= "  </tbody>
                            </table>";
                } else {
                    $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                    if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                    $html = "<div class=\"empty-section\"><p>There aren't any reports to show for the {$season_wording}.</p></div>";
                }
            } else {
                // Reports admin area
                if (!empty($items)) {
                    $html = "<table class=\"table table-sm table-striped table-bordered text-center\">
                                <thead>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Report</th>
                                    <th>Edit</th>
                                </thead>
                                <tbody>";
                    foreach ($items as $report) {
                        $html .= "  <tr>
                                        <td>" . date("d M Y", strtotime($report->date)) . "</td>
                                        <td>{$report->title}</td>
                                        <td>" . substr($report->report, 0, 100) . "...</td>
                                        <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/reports/edit/" . $report->id . "\" class=\"btn btn-small btn-primary\"><i class=\"fas fa-sm fa-edit\"></i></a></td>
                                    </tr>";
                    }
                        $html .= "</tbody>
                            </table>";
                } else {
                    $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                    if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                    $html = "<div class=\"empty-section\"><p>There aren't any reports to show for the {$season_wording}.</p></div>";
                }
            }
        }
        return $html;
    }
?>