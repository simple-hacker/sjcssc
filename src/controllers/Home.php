<?php

    class Home extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheck($this->club_id);
            }
            // Load all models needed.
        }

        public function index() {
            $this->view('home/index');
        }

    }