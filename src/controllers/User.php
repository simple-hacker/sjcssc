<?php

    class User extends Controller {

        private $admin;

        public function __construct($admin = true) {
            $this->admin = $admin;
            $this->userModel = $this->model('UserModel');
        }

        public function index() {
            
            $this->userModel->loggedInCheckRedirect();  // Check log in first.  This isn't in __construct because it creates an infinite loop.

            $user = $this->userModel->getUserByID($_SESSION['user']['id']);

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if (isset($_POST['userDetailsForm'])) {
                    // Validate change of user's data form.
                    // TODO: No validation needed because email and name can be empty.

                    $data = [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => trim($_POST['email']),
                        'name' => trim($_POST['name'])
                    ];

                    // I have this if true statement here in case I want to add validation later.  Then it'd be if(!isset($email_err) && !isset($name_err))
                    if (true) {
                        if ($this->userModel->updateUser($data)) {
                            create_flash_message('user', 'User Settings changes saved.');
                            redirect('user', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when saving changes to user.');
                        }
                    }

                } elseif (isset($_POST['resetPasswordForm'])) {
                    // Validate reset password form.

                    // Validate old_password
                    if (empty($_POST['old_password'])) {
                        $old_password_err  = 'Please enter your old password.';
                    } elseif (!password_verify($user->salt . $_POST['old_password'], $user->password)) {
                        // If user's salt + old_password does not verify with users stored hashed password then incorrect old_password was given.
                        $old_password_err = 'Incorrect Password.';
                    }

                    // New Password Validation
                    if (empty($_POST['new_password'])) {
                        $new_password_err = 'Please enter a new password.';
                    } elseif (strlen($_POST['new_password']) < 3) {
                        $new_password_err = 'Password needs to be at least 3 characters long.';
                    } elseif (!empty($_POST['confirm_new_password']) && $_POST['new_password'] != $_POST['confirm_new_password']) {
                        $new_password_err = "Passwords do not match.";
                    }

                    // Confirm New Password Validation
                    if (empty($_POST['confirm_new_password'])) {
                        $confirm_new_password_err = 'Please confirm your password.';
                    } elseif (!empty($_POST['new_password']) && $_POST['new_password'] != $_POST['confirm_new_password']) {
                        $confirm_new_password_err = "Passwords do not match.";
                    }

                    $data = [
                        // Get user's data first so the above form displays correctly.
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'name' => $user->name,
                        'old_password_err' => (isset($old_password_err)) ? $old_password_err : '',
                        'new_password_err' => (isset($new_password_err)) ? $new_password_err : '',
                        'confirm_new_password_err' => (isset($confirm_new_password_err)) ? $confirm_new_password_err : '',
                    ];

                    if (!isset($old_password_err) && !isset($new_password_err) && !isset($confirm_new_password_err)) {
                        // If no errors exist then change user's password.
                        if ($this->userModel->changePassword($user->id, $_POST['new_password'])) {
                            // If successful password change, then redirect back to users/index with success message.
                            create_flash_message('user', "Password for user <strong>{$data['username']}</strong> has been changed.");
                            redirect('user', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when saving changes to user.');
                        }
                    }
                }
            } else {
                $data = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name
                ];
            }
            // Load user/index view.
            $this->view('user/index', $data);
        }

        public function login() {

            // If user is logged in then
            // Redirect to first CLUB/dashboard of the first permission.
            // If no permissions are provided, then redirect to user/index instead.
            if (isset($_SESSION['user'])) {
                $this->userModel->permissionRedirect();
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
                if (!isset($username_err) && !isset($password_err)) {
                    // Send username and password to userModel login function.  If return true then create successful log in message and redirect to either CLUB/dashboard or user/index page.
                    if ($this->userModel->login($data['username'], $data['password'])) {
                        create_flash_message('user', 'Welcome ' . $data['username'] . '. You have successfully logged in.');
                        $this->userModel->permissionRedirect();
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
