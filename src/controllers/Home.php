<?php

    class Home extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->fixtureModel = $this->model('Fixture');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
                // 'unpublished_results' => $this->fixtureModel->getUnpublishedResults($this->club_name),
            ];

            $this->view('home/index', $data);
        }
    }