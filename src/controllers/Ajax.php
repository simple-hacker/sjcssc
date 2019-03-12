<?php

    class Ajax extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->teamModel = $this->model('Team');
            $this->leagueModel = $this->model('League');
            $this->venueModel = $this->model('Venue');
            $this->peopleModel = $this->model('People');
            $this->noticeModel = $this->model('Notice');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

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

    }