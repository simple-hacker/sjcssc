<?php

    class Home extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }

            // Load all the Models needed by looping through CLUBS sections.
            foreach (CLUBS[$this->club_name]['sections'] as $section) {
                $sectionModel = trim($section, "s") . 'Model';  // Get the model name by trimming s off sections and adding Model.;
                $this->{$sectionModel} = $this->model(ucwords(trim($section, "s")));  // e.g. $this->fixtureModel = $this->model(Fixture)
            }
        }

        public function index() {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];

            // Get all events, fixtures, results etc.
            foreach (CLUBS[$this->club_name]['sections'] as $section) {
                $n = ($section === "notices") ? 0 : 4;
                $sectionModel = trim($section, "s") . 'Model';  // Get the model name by trimming s off sections and adding Model.
                $sectionMethod = 'get' . ucwords($section); // Get method name by prepending get to section name, e.g getNotices.
                if (isset($this->{$sectionModel})) {
                    $data[$section] = $this->{$sectionModel}->{$sectionMethod}($this->club_id, $n);
                }
            }

            // Results/Reports
            foreach (RESULT_SECTIONS as $section) {
                if (in_array($section, CLUBS[$this->club_name]['sections'])) {
                        $sectionModel = trim($section, "s") . 'Model';  // Get the model name by trimming s off sections and adding Model.
                        $sectionMethod = 'getUnpublished' . ucwords($section); // Get method name by prepending get to section name, e.g getNotices.
                        if (isset($this->{$sectionModel})) {
                            $data['unpublished_'.$section] = $this->{$sectionModel}->{$sectionMethod}($this->club_name);
                        }
                }
            }

            $this->view('home/index', $data);
        }
    }