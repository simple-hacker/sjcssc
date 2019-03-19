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
            $this->fixtureModel = $this->model('Fixture');
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

        public function deleteImage() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['item']) && isset($_POST['club']) && isset($_POST['section'])) {

                    // Determine if icon or image.
                    if ($_POST['item'] == "icon") {
                        $file = PUBLIC_ROOT . "img/sportsbar/" . strtolower($_POST['club']) . ".png";
                        $file_thumb = PUBLIC_ROOT . "img/sportsbar/" . strtolower($_POST['club']) . "_thumb.png";
                    } else {
                        $file = PUBLIC_ROOT . "img/parallax/" . strtolower($_POST['club']) . "/" . strtolower($_POST['section']) . ".jpg";
                        $file_thumb = PUBLIC_ROOT . "img/parallax/" . strtolower($_POST['club']) . "/" . strtolower($_POST['section']) . "_thumb.jpg";
                    }

                    if (file_exists($file)) $success_file = unlink($file);
                    if (file_exists($file_thumb)) $success_thumb = unlink($file_thumb);

                    $data['success'] = ($success_file && $success_thumb);
                    $data['message'] = ($data['success'] == true) ? "Successfully deleted the image." : "Something went wrong when deleting the image.";
                } else {
                    $data['success'] = false;
                    $data['message'] = "Not all POST values have been set.";
                }
            } else {
                $data['success'] = false;
                $data['message'] = "Invalid POST request.";
            }
            echo json_encode($data);
            exit;
        }
        
        public function filter() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['section']) && isset($_POST['club_id']) && isset($_POST['season'])) {
                    $leagues = (isset($_POST['leagues'])) ? $_POST['leagues'] : array();
                    $admin = isset($_POST['admin']) ? true : false;
                    $club_name = $this->clubModel->getClubName($_POST['club_id']);
                    $team_id = $this->clubModel->getTeamID($_POST['club_id']);
                    if ($_POST['section'] == "fixtures") {
                        $items = $this->fixtureModel->getFixtures($_POST['club_id'], 0, $leagues);
                    } elseif ($_POST['section'] == "results") {
                        $items = $this->resultModel->getResults($_POST['club_id'], 0, $admin, $_POST['season'], $leagues);
                    } elseif ($_POST['section'] == "reports") {
                        $items = $this->reportModel->getReports($_POST['club_id'], 0, $admin, $_POST['season']);
                    }
                    $data['success'] = true;
                    // Title
                    if ($_POST['section'] == "fixtures") {
                        $data['title'] = CLUBS[$club_name]['section_titles']['fixtures'];
                    } else {
                        $dates = getDates($club_name, $_POST['season']);
                        $now = date("Y-m-d H:i:s");
                        if (($now > $dates[0]) && ($now < $dates[1])) {
                            $data['title'] = CLUBS[$club_name]['section_titles'][$_POST['section']];
                        } else {
                            $season_data = CLUBS[$club_name]['season'];
                            $season_wording = $season_data['title'] . " " . $_POST['season'];
                            if ($season_data['span_years'] == true) $season_wording .= " / " . ((int)$_POST['season']+1);
                            $data['title'] = $season_wording;
                        }
                    }
                    $data['items'] = $items;
                    $data['html'] = getTable($club_name, $_POST['section'], $admin, $items, $team_id);
                } else {
                    $data['success'] = false;
                    $data['message'] = "Not all POST data has been set.";
                }
            } else {
                $data['success'] = false;
                $data['message'] = "Request was not POST";
            }
            echo json_encode($data);
            exit;
        }

    }