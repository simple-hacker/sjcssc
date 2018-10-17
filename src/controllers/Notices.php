<?php

    class Notices extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->noticeModel = $this->model('Notice');
        }

        public function index($notice_id) {
            
            if (isset($notice_id)) {
                // Get single Notice
                $notice = $this->noticeModel->getNotice($this->club_id,$notice_id);

                $data = [
                    'club_id' => $this->club_id,
                    'notice' => $notice
                ];
            } else {
                // We're on index, so retrieve all Notices.
                // Default is 4 notices.  If left blank then all notices are returned.
                $notices = $this->noticeModel->getNotices($this->club_id, 4);

                $data = [
                    'club_id' => $this->club_id,
                    'notices' => $notices
                ];
            }

            $this->view('notices/index', $data);
        }

        public function add() {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('notices/add', $data);
        }

        public function edit($notice_id) {
            
            if (isset($notice_id)) {
                // Get single Notice
                $notice = $this->noticeModel->getNotice($this->club_id,$notice_id);

                $data = [
                    'club_id' => $this->club_id,
                    'notice' => $notice
                ];
            } else {
                die('<strong>Fatal Error:</strong> Did not supply $notice_id when retrieving notices.');
            }

            $this->view('notices/edit', $data);
        }

        public function delete($notice_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('notices/delete', $data);
        }
    }