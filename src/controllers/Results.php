<?php

    class Results extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheck($this->club_id);
            }
            // Load all models needed.
            $this->resultModel = $this->model('Result');
        }

        public function index($result_id) {
            $data = [

            ];
            $this->view('results/index', $data);
        }

        public function add() {
            $data = [
                
            ];
            $this->view('results/add', $data);
        }

        public function edit($result_id) {
            $data = [
                
            ];
             $this->view('results/edit', $data);
        }

        public function delete($result_id) {
            $data = [
                
            ];
            $this->view('results/delete', $data);
        }
    }