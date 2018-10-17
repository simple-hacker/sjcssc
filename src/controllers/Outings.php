<?php

    class Outings extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->outingModel = $this->model('Outing');
        }

        public function index($outing_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('outings/index', $data);
        }

        public function add() {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('outings/add', $data);
        }

        public function edit($outing_id) {
            $data = [
                'club_id' => $this->club_id
            ];
             $this->view('outings/edit', $data);
        }

        public function delete($outing_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('outings/delete', $data);
        }
    }