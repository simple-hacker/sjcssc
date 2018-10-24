<?php

    class Notices extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->noticeModel = $this->model('Notice');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($notice_id) {
            
            if (isset($notice_id)) {
                // Get single Notice
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'notice' => $this->noticeModel->getNotice($this->club_id,$notice_id)
                ];
            } else {
                // We're on index, so retrieve all Notices.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'notices' => $this->noticeModel->getNotices($this->club_id, 4)  // Default is 4 notices.  If left blank then all notices are returned.
                ];
            }

            $this->view('notices/index', $data);
        }

        public function add() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('notices/add', $data);
        }

        public function edit($notice_id) {
            
            if (isset($notice_id)) {
                // Get single Notice
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'notice' => $this->noticeModel->getNotice($this->club_id,$notice_id)
                ];
            } else {
                die('<strong>Fatal Error:</strong> Did not supply $notice_id when retrieving notices.');
            }

            $this->view('notices/edit', $data);
        }

        public function delete($notice_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('notices/delete', $data);
        }
    }