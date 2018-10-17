<?php

    class Fixtures extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->fixtureModel = $this->model('Fixture');
        }

        public function index($fixture_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('fixtures/index', $data);
        }

        public function add() {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('fixtures/add', $data);
        }

        public function edit($fixture_id) {
            $data = [
                'club_id' => $this->club_id
            ];
             $this->view('fixtures/edit', $data);
        }

        public function delete($fixture_id) {
            $data = [
                'club_id' => $this->club_id
            ];
            $this->view('fixtures/delete', $data);
        }
    }