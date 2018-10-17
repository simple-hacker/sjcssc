<?php

    class Settings extends Controller {

        private $admin, $club_id;

        // Club Settings

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
            $this->resultModel = $this->model('Settings');
        }

        public function index($result_id) {
            $data = [

            ];
            $this->view('settings/index', $data);
        }
    }