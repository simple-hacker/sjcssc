<?php

    class Events extends Controller {

        private $admin, $club_id;

        public function __construct($admin = false, $club_id) {
            $this->admin = $admin;
            $this->club_id = $club_id;

            if ($this->admin === true) {
                permissionCheck($this->club_id);
            }
            // Load all models needed.
            $this->eventModel = $this->model('Event');
        }

        public function index($event_id) {
            $data = [

            ];
            $this->view('events/index', $data);
        }

        public function add() {
            $data = [
                
            ];
            $this->view('events/add', $data);
        }

        public function edit($event_id) {
            $data = [
                
            ];
             $this->view('events/edit', $data);
        }

        public function delete($event_id) {
            $data = [
                
            ];
            $this->view('events/delete', $data);
        }
    }