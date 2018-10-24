<?php

    class Events extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->eventModel = $this->model('Event');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($event_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('events/index', $data);
        }

        public function add() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('events/add', $data);
        }

        public function edit($event_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
             $this->view('events/edit', $data);
        }

        public function delete($event_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('events/delete', $data);
        }
    }