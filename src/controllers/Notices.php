<?php

    class Notices extends Controller {

        public function __construct() {
            $this->noticeModel = $this->model('Notice');
        }

        public function index($club_id, $notice_id) {
            
            if (isset($club_id) && isset($notice_id)) {
                // Get single Notice
                $notice = $this->noticeModel->getNotice($club_id,$notice_id);

                $data = [
                    'notice' => $notice
                ];
            } else if (isset($club_id)) {
                // We're on index, so retrieve all Notices.
                // Default is 4 notices.  If left blank then all notices are returned.
                $notices = $this->noticeModel->getNotices($club_id, 4);

                $data = [
                    'notices' => $notices
                ];
            } else {
                die('<strong>Fatal Error:</strong> Did not supply $club_id or $notice_id when retrieving notices.');
            }

            $this->view('notices/index', $data);
        }

        public function add() {
            echo "ADDING NOTICE";
        }

        public function edit($club_id, $notice_id) {
            
            if (isset($club_id) && isset($notice_id)) {
                // Get single Notice
                $notice = $this->noticeModel->getNotice($club_id,$notice_id);

                $data = [
                    'notice' => $notice
                ];
            } else {
                die('<strong>Fatal Error:</strong> Did not supply $club_id or $notice_id when retrieving notices.');
            }

            $this->view('notices/edit', $data);
        }
    }