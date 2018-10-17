<?php

    class User extends Controller {

        private $admin;

        public function __construct($admin = true) {
            $this->admin = $admin;
            $this->userModel = $this->model('UserModel');
        }

        public function index() {
            
            loggedInCheck();  // Check log in first.  This isn't in __construct because it creates an infinite loop.

            // This will load the page full of settings.
            // Email change, password change.
            // If POST data then resave all data.
            
            // Load user/index view.
            $this->view('user/index');
        }

        public function login() {

            // If user is logged in then
            // Redirect to first CLUB/dashboard of the first permission.
            // If no permissions are provided, then redirect to user/index instead.
            if (isset($_SESSION['user'])) {
                permissionRedirect();
            }

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if (empty($_POST['username'])) {
                    $username_err = 'Please enter your username.';
                }

                if (empty($_POST['password'])) {
                    $password_err = 'Please enter your password.';
                }

                // Store errors in $data to be passed to view.
                $data = [
                    'username' => (!empty($_POST['username'])) ? $_POST['username'] : '',
                    'password' => (!empty($_POST['password'])) ? $_POST['password'] : '',
                    'username_err' => (isset($username_err)) ? $username_err : '',
                    'password_err' => (isset($password_err)) ? $password_err : '',
                ];

                // Try to log in.  Make sure username and password are not empty first.  This is because username and password could be ''.  Don't want to try and log in with values '' and '';
                if (!empty($data['username']) && !empty($data['password'])) {
                    // Send username and password to userModel login function.  If return true then create successful log in message and redirect to either CLUB/dashboard or user/index page.
                    if ($this->userModel->login($data['username'], $data['password'])) {
                        create_flash_message('user', 'You have successfully logged in.');
                        permissionRedirect();
                    } else {
                        // Else there was an error logging in.  Create error message because we want to reload this same page with previous username.
                        $data['password'] = ''; // Clear given password so user has to give it another try.  Note, password could've been correct and username incorrect, but most likely password is wrong.
                        create_flash_message('user', 'Login Error.  Please check your credentials', 'danger');
                    }
                }
            }
            else {
                $data = [
                    'username' => '',
                    'password' => '',
                    'username_err' => '',
                    'password_err' => ''
                ];
            }
            $this->view('user/login', $data);

        }

        public function logout() {
            // Destroy all session[user] data.
            $this->userModel->logout();
            // TODO:  This flash message won't work because we session_destroy on logout.
            // If we want successful logout message then remove session_destory and just double check we remove all user-data.
            // create_flash_message('user', 'You have have been logged out.', 'danger');
            redirect('user/login', true);
        }
    }
