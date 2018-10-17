<?php
    class Users extends Controller {

        private $admin;

        public function __construct($admin = true) {
            $this->admin = $admin;

            if ($this->admin === true) {
                adminCheckRedirect();  // Admin check because only admins can see this page.
            }
            $this->userModel = $this->model('UserModel');
        }

        public function index() {
            $data = [

            ];
            $this->view('users/index', $data);
        }

        public function add(){
            $data = [
                
            ];
            $this->view('users/add', $data);
        }

        public function edit($user_id){
            $data = [
                
            ];
            $this->view('users/edit', $data);
        }

        public function delete($user_id){
            $data = [
                
            ];
            $this->view('users/delete', $data);
        }
    }
?>