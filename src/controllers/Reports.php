<?php

    class Reports extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->reportModel = $this->model('Report');
            
            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($report_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('reports/index', $data);
        }

        public function add() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('reports/add', $data);
        }

        public function edit($report_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
             $this->view('reports/edit', $data);
        }

        public function delete($report_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('reports/delete', $data);
        }
    }