<?php

    class Results extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->resultModel = $this->model('Result');
        }

        public function index($result_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('results/index', $data);
        }

        public function add() {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('results/add', $data);
        }

        public function edit($result_id) {
            $data = [
                'club_id' => $this->club_id
            ];
             $this->view('results/edit', $data);
        }

        public function delete($result_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('results/delete', $data);
        }
    }