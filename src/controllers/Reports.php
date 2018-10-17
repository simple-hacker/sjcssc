<?php

    class Reports extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->reportModel = $this->model('Report');
        }

        public function index($report_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('reports/index', $data);
        }

        public function add() {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('reports/add', $data);
        }

        public function edit($report_id) {
            $data = [
                'club_id' => $this->club_id
            ];
             $this->view('reports/edit', $data);
        }

        public function delete($report_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('reports/delete', $data);
        }
    }