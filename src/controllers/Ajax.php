<?php

    class Ajax extends Controller {

        private $admin;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->teamModel = $this->model('Team');
            $this->leagueModel = $this->model('League');
            $this->venueModel = $this->model('Venue');
            $this->peopleModel = $this->model('People');
            $this->noticeModel = $this->model('Notice');
            $this->resultModel = $this->model('Result');
            $this->reportModel = $this->model('Report');

            $this->admin = $admin;
            $this->club_id = $club_id; // Some ajax calls break when this is commented out for some reason.
            // $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function deleteRow() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['item']) && isset($_POST['id'])) {
                    $item = ucwords($_POST['item']);
                    $model = strtolower($_POST['item']) . 'Model';
                    $method = "delete" . $item;
                    $id = (int) $_POST['id'];
                    $data['item'] = $item;
                    $data['id'] = $id;
                    if (isset($this->{$model})) {
                        $data['success'] = $this->{$model}->{$method}($id);
                    }
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
        }

        public function toggleImportant() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['notice_id'])) {
                    $data['success'] = $this->noticeModel->toggleImportant($_POST['club_id'], $_POST['notice_id']);
                    // $data['success'] = true;
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

        public function toggleActive() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['person_id'])) {
                    $data['success'] = $this->peopleModel->toggleActive($_POST['club_id'], $_POST['person_id']);
                    // $data['success'] = true;
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

        public function getVenue() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['home_team_id'])) {
                    $data['venue'] = $this->teamModel->getVenue($_POST['club_id'], $_POST['home_team_id']);
                    $data['success'] = ($data['venue'] != "") ? true : false;
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

        public function changeSeason() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['season'])) {
                    $results = $this->resultModel->getResults($_POST['club_id'], 0, false, $_POST['season']);
                    $team_id = $this->clubModel->getTeamId($_POST['club_id']);
                    $club_name = $this->clubModel->getClubName($_POST['club_id']);
                    $season_data = CLUBS[$club_name]['season'];
                    $data['results'] = $results;
                    $data['success'] = true;
                    if (!empty($results)) {
                        $data['html'] = "<div class=\"table-responsive\">
                                            <table class=\"table table-sm table-bordered text-center\">
                                                <thead>
                                                    <th>Date</th>
                                                    <th class=\"d-none d-md-table-cell\">League</th>
                                                    <th>Home Team</th>
                                                    <th>Score</th>
                                                    <th>Away Team</th>
                                                    <th>View Fixture</th>
                                                </thead>
                                                <tbody>";
                        foreach ($results as $result) {
                            // Determine if win/draw/lose.
                            if ($result->home_team_score === $result->away_team_score) {
                                $bg_colour = "draw";
                            } elseif ($result->home_team_id === $team_id) {
                                $bg_colour = ($result->home_team_score > $result->away_team_score) ? "win" : "lose";
                            } elseif ($result->away_team_id === $team_id) {
                                $bg_colour = ($result->away_team_score > $result->home_team_score) ? "win" : "lose";
                            }
                            $data['html'] .= "<tr class=\"" . (isset($bg_colour) ? $bg_colour : '') . "\">
                                                <td>" . date("d M Y", strtotime($result->date)) . "</td>
                                                <td class=\"d-none d-md-table-cell\">{$result->league}</td>
                                                <td>" . (($result->home_team_score > $result->away_team_score) ? '<strong>' . $result->home_team . '</strong>' : $result->home_team) . "</td>
                                                <td>" . scoreline($club_name, $result, $team_id) . "</td>
                                                <td>" . (($result->away_team_score > $result->home_team_score) ? '<strong>' . $result->away_team . '</strong>' : $result->away_team) . "</td>
                                                <td><a href=\"" . URLROOT . $club_name . "/results/" . $result->id . "\" class=\"btn btn-brown\">View Fixture</a></td>
                                            </tr>";
                        }
                        $data['html'] .= "      </tbody>
                                            </table>
                                        </div>";
                    } else {
                        $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                        if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                        $data['html'] = "<div class=\"empty-section\"><p>There aren't any results to show for the {$season_wording}.</p></div>";
                    }
                    $data['title'] = ($season_data['span_years'] == true) ? $season_data['title'] . " " . $_POST['season'] . " / " . ($_POST['season'] + 1) : $season_data['title'] . " " . $_POST['season'];
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }


        public function changeSeasonAdmin() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['season'])) {
                    // $data['venue'] = $this->teamModel->getVenue($_POST['club_id'], $_POST['season']);
                    // $data['success'] = ($data['venue'] != "") ? true : false;
                    $results = $this->resultModel->getResults($_POST['club_id'], 0, true, $_POST['season']);
                    $team_id = $this->clubModel->getTeamId($_POST['club_id']);
                    $club_name = $this->clubModel->getClubName($_POST['club_id']);
                    $season_data = CLUBS[$club_name]['season'];
                    $data['results'] = $results;
                    $data['success'] = true;
                    if (!empty($results)) {
                        $data['html'] = "<div class=\"table-responsive\">
                                            <table class=\"table table-bordered table-striped table-sm\">
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
                        foreach ($results as $result) {
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

                            $data['html'] .= "<tr class=\"" . (isset($bg_colour) ? $bg_colour : '') . "\">
                                                <td>" . date("d M Y", strtotime($result->date)) . "</td>
                                                <td>{$result->league}</td>
                                                <td>{$result->home_team}</td>
                                                <td>{$result->home_team_score}</td>
                                                <td>{$result->away_team}</td>
                                                <td>{$result->away_team_score}</td>
                                                <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/results/edit/" . $result->id . "\" class=\"btn btn-primary\"><i class=\"fas fa-sm fa-edit\"></i></a></td>
                                            </tr>";
                        }
                        $data['html'] .= "      </tbody>
                                            </table>
                                        </div>";
                    } else {
                        $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                        if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                        $data['html'] = "<div class=\"empty-section\"><p>There aren't any results to show for the {$season_wording}.</p></div>";
                    }
                    $data['title'] = "Results - " . (($season_data['span_years'] == true) ? $season_data['title'] . " " . $_POST['season'] . " / " . ($_POST['season'] + 1) : $season_data['title'] . " " . $_POST['season']);
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

        public function changeYear() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['season'])) {
                    $reports = $this->reportModel->getReports($_POST['club_id'], 0, false, $_POST['season']);
                    $club_name = $this->clubModel->getClubName($_POST['club_id']);
                    $season_data = CLUBS[$club_name]['season'];
                    $data['reports'] = $reports;
                    $data['success'] = true;
                    if (!empty($reports)) {
                        $data['html'] = "<div class=\"table-responsive\">
                                            <table class=\"table table-sm table-striped table-bordered text-center\">
                                                <thead>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th class=\"d-none d-md-table-cell\">Venue</th>
                                                    <th>View Report</th>
                                                </thead>
                                                <tbody>";
                        foreach ($reports as $report) {
                            $data['html'] .= "<tr>
                                                <td>" . date("d M Y", strtotime($report->date)) . "</td>
                                                <td>{$report->title}</td>
                                                <td class=\"d-none d-md-table-cell\">{$report->venue}</td>
                                                <td><a href=\"" . URLROOT . $club_name . "/reports/" . $report->id . "\" class=\"btn btn-brown\">View Report</a></td>
                                            </tr>";
                        }
                        $data['html'] .= "      </tbody>
                                            </table>
                                        </div>";
                    } else {
                        $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                        if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                        $data['html'] = "<div class=\"empty-section\"><p>There aren't any reports to show for the {$season_wording}.</p></div>";
                    }
                    $data['title'] = ($season_data['span_years'] == true) ? $season_data['title'] . " " . $_POST['season'] . " / " . ($_POST['season'] + 1) : $season_data['title'] . " " . $_POST['season'];
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

        public function changeYearAdmin() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['club_id']) && isset($_POST['season'])) {
                    $reports = $this->reportModel->getReports($_POST['club_id'], 0, true, $_POST['season']);
                    $club_name = $this->clubModel->getClubName($_POST['club_id']);
                    $season_data = CLUBS[$club_name]['season'];
                    $data['reports'] = $reports;
                    $data['success'] = true;
                    if (!empty($reports)) {
                        $data['html'] = "<div class=\"table-responsive\">
                                            <table class=\"table table-sm table-striped table-bordered text-center\">
                                                <thead>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th>Report</th>
                                                    <th>Edit</th>
                                                </thead>
                                                <tbody>";
                        foreach ($reports as $report) {
                            $data['html'] .= "<tr>
                                                <td>" . date("d M Y", strtotime($report->date)) . "</td>
                                                <td>{$report->title}</td>
                                                <td>" . substr($report->report, 0, 100) . "...</td>
                                                <td class=\"text-center\"><a href=\"" . ADMIN_URLROOT . $club_name . "/reports/edit/" . $report->id . "\" class=\"btn btn-small btn-primary\"><i class=\"fas fa-sm fa-edit\"></i></a></td>
                                            </tr>";
                        }
                        $data['html'] .= "      </tbody>
                                            </table>
                                        </div>";
                    } else {
                        $season_wording = strtolower($season_data['title']) . " " . $_POST['season'];
                        if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                        $data['html'] = "<div class=\"empty-section\"><p>There aren't any reports to show for the {$season_wording}.</p></div>";
                    }
                    $data['title'] = ($season_data['span_years'] == true) ? $season_data['title'] . " " . $_POST['season'] . " / " . ($_POST['season'] + 1) : $season_data['title'] . " " . $_POST['season'];
                } else {
                    $data['success'] = false;
                }
            } else {
                $data['success'] = false;
            }
            echo json_encode($data);
            exit;
        }

    }