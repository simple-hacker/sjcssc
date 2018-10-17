<?php

    class Home extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheckRedirect($this->club_id);
            }
            // Load all models needed.
        }

        public function index() {

            $data = [
                'club_id' => $this->club_id
            ];

            $this->view('home/index', $data);
        }

    }