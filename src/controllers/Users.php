<?php
    class Users extends Controller {

        private $admin;

        public function __construct($admin = true) {
            $this->admin = $admin;

            $this->userModel = $this->model('UserModel');
            
            if ($this->admin === true) {
                $this->userModel->adminCheckRedirect();  // Admin check because only admins can see this page.
            }
        }

        public function index() {
            $data = [
                'users' => $this->userModel->getUsers(),
            ];
            $this->view('users/index', $data);
        }

        public function add(){
            
            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Validate Create User Form
                if (empty($_POST['username'])) {
                    $username_err = 'Please enter a username.';
                } else {
                    // Check if Username already exists.
                    if ($this->userModel->usernameExists($_POST['username'])) {
                        $username_err = "Username already in use. Please try another username.";
                    }
                }

                // Password Validation
                if (empty($_POST['password'])) {
                    $password_err = 'Please enter a password.';
                } elseif (strlen($_POST['password']) < 3) {
                    $password_err = 'Password needs to be at least 3 characters long.';
                } elseif (!empty($_POST['confirm_password']) && $_POST['password'] != $_POST['confirm_password']) {
                    $password_err = "Passwords do not match.";
                }

                // Confirm Password Validation
                if (empty($_POST['confirm_password'])) {
                    $confirm_password_err = 'Please confirm your password.';
                } elseif (!empty($_POST['password']) && $_POST['password'] != $_POST['confirm_password']) {
                    $confirm_password_err = "Passwords do not match.";
                }

                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'name' => trim($_POST['name']),
                    'password' => $_POST['password'],
                    'confirm_password' => $_POST['confirm_password'],
                    'permissions' => isset($_POST['permissions']) ? $_POST['permissions'] : [],
                    'admin' => isset($_POST['admin']) ? $_POST['admin'] : '',
                    'username_err' => isset($username_err) ? $username_err : '',
                    'password_err' => isset($password_err) ? $password_err : '',
                    'confirm_password_err' => isset($confirm_password_err) ? $confirm_password_err : ''
                ];
                
                // If no errors exists then register new user.
                if (!isset($username_err) && !isset($password_err) && !isset($confirm_password_err)) {
                    // Perform Create User
                    if ($this->userModel->register($data)) {
                        // If successful register, then redirect back to users/index with success message.
                        create_flash_message('users', "Successfully created user <strong>{$data['username']}</strong>.");
                        redirect('users', true);
                    } else {
                        die('<strong>Fatal Error: </strong>Something went wrong when registering a new user.');
                    }
                }
            } else {
                $data = [
                    'username' => '',
                    'email' => '',
                    'name' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'permissions' => [],
                    'admin' => '',
                    'username_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
            }            
            $this->view('users/add', $data);
        }

        public function edit($user_id){
            $user = $this->userModel->getUserByID($user_id);
            // Check if user exists first, if not then redirect back to Manage Users with error message.  This is to prevent changing id in the URL.
            if ($user) {
                
                if ($_SERVER['REQUEST_METHOD'] === "POST") {

                    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    
                    if (isset($_POST['userDetailsForm'])) {
                        // The change user details form was submitted.
                        // Validate Change User Details Form
                        // TODO: Currently no validation required because it's okay to have a user with blank email, name and permissions.
                        $data = [
                            'id' => $user->id,
                            'username' => $user->username,
                            'email' => trim($_POST['email']),
                            'name' => trim($_POST['name']),
                            'permissions' => isset($_POST['permissions']) ? $_POST['permissions'] : [],
                            'admin' => isset($_POST['admin']) ? $_POST['admin'] : '',
                        ];
                        // If no errors exist, then proceed with Saving Changes.
                        // TODO: Currently no errors can exist so always true.  Not sure whether to have validation yet but need to make sure no errors exist in the if statement below.
                        if (true) {
                            // Perform Save Changes
                            if ($this->userModel->updateUserWithPermissions($data)) {
                                // If successful user update, then redirect back to users/index with success message.
                                create_flash_message('users', "Saved changes for user <strong>{$data['username']}</strong>.");
                                redirect('users', true);
                            } else {
                                die('<strong>Fatal Error: </strong>Something went wrong when saving changes to user.');
                            }
                        }
                    } elseif (isset($_POST['resetPasswordForm'])) {
                        // The reset password form was submitted.
                        // Validate Reset Password Form

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
                            // Need to get data for the change details form.
                            'id' => $user->id,
                            'username' => $user->username,
                            'name' => $user->name,
                            'email' => $user->email,
                            'permissions' => $this->userModel->getClubPermissions($user->permissions),
                            'admin' => $user->admin,
                            // Data for the reset password form.
                            'new_password' => !empty($_POST['new_password']) ? $_POST['new_password'] : '',
                            'confirm_new_password' => !empty($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : '',
                            'new_password_err' => isset($new_password_err) ? $new_password_err : '',
                            'confirm_new_password_err' => isset($confirm_new_password_err) ? $confirm_new_password_err : ''
                        ];

                        // If no errors exist then proceed with password change.
                        if (!isset($new_password_err) && !isset($confirm_new_password_err)) {
                            // Perform password change.
                            if ($this->userModel->changePassword($user->id, $_POST['new_password'])) {
                                // If successful password change, then redirect back to users/index with success message.
                                create_flash_message('users', "Password for user <strong>{$data['username']}</strong> has been changed.");
                                redirect('users', true);
                            } else {
                                die('<strong>Fatal Error: </strong>Something went wrong when saving changes to user.');
                            }
                        }
                    }
                } else {
                    $data = [
                        'id' => $user->id,
                        'username' => $user->username,
                        'password' => $user->password,
                        'salt' => $user->salt,
                        'name' => $user->name,
                        'email' => $user->email,
                        'permissions' => $this->userModel->getClubPermissions($user->permissions),
                        'admin' => $user->admin,
                        'username_err' => '',
                        'password_err' => '',
                        'password_confirm_err' => ''
                    ];
                }
                $this->view('users/edit', $data);
            } else {
                // User doesn't exist.  Redirect with error message.
                create_flash_message('users', 'User does not exist.', 'danger');
                redirect('users', true);
            }
        }

        public function delete($user_id){

            $user = $this->userModel->getUserByID($user_id);

            // Check if user exists first.
            if ($user) {
                // If confirmed user deletion then proceed and redirect to users/index.
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    // If request method is POST then admin submitted form confirming deleting user, so no validation needed.
                    if ($this->userModel->deleteUser($user->id)) {
                        create_flash_message('users', "User <strong>{$user->username}</strong> has been deleted.");
                        redirect('users', true);
                    } else {
                        die('<strong>Fatal Error: </strong>Something went wrong when deleting a user.');
                    }
                } else {
                    // Else grad data and display confirmation page in users/delete.
                    $data = [
                        'user_id' => $user->id,
                        'username' => $user->username
                    ];
                }
                $this->view('users/delete', $data);

            } else {
                // User doesn't exist.  Redirect with error message.
                create_flash_message('users', 'User does not exist.', 'danger');
                redirect('users', true);
            }
        }
    }
?>