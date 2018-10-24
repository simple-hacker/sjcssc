<?php

    class Outings extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->outingModel = $this->model('Outing');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($outing_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('outings/index', $data);
        }

        public function add() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('outings/add', $data);
        }

        public function edit($outing_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
             $this->view('outings/edit', $data);
        }

        public function delete($outing_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('outings/delete', $data);
        }
    }