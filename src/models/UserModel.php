<?php

    class UserModel extends Controller {

        private $db;

        public function __construct() {
            $this->db = new Database;

            $this->clubModel = $this->model('Club');
        }

        public function login($username, $password) {
            // Triple check username and password are somehow not empty.
            if (!empty($username) && !empty($password)) {
                // First get user from database.
                $sql = 'SELECT * FROM `users` WHERE `username`=:username LIMIT 1'; // Limit by one just in case.  Though username in database is UNIQUE.
                $this->db->query($sql);
                $this->db->bind(':username', $username);
                $user = $this->db->result();

                // If user is not empty, i.e. found a user with the provided username
                if (!empty($user)) {
                    // Get the user's salt, prepend it to provided password.
                    $salt = $user->salt;
                    $password = $salt . $password;
                    // Compare the $password with the hashed_password in the database.
                    if (password_verify($password, $user->password)) {
                        // Successful login.
                        // First create user's session
                        $this->createUserSession($user);
                        return true;
                    } else {
                        return false; // Incorrect password
                    }
                } else {
                    return false; // No user found
                }
            } else {
                return false;
            }
        }

        private function createUserSession($user) {
            $_SESSION['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'permissions' => $this->getClubPermissions($user->permissions),
                'admin' => boolval($user->admin)
            ];
        }

        public function getClubPermissions($permissions) {
            // If permissions is an empty string (i.e. no permissions), return an empty array, else explode as normal.
            $permissions_array = (empty($permissions)) ? [] : explode(',', $permissions);
            $club_permissions = []; // Blank array to start off with.

            foreach ($permissions_array as $club_id) {
                $club_permissions[$club_id] =$this->clubModel->getClubName($club_id);
            }
            // Returns key value array of club_id => club_name
            // e.g. $club_permissions[2] => bowls
            return $club_permissions;
        }

        public function logout() {
            // Unset all SESSION variables.
            unset($_SESSION['user']);
            // Destroy the session just in case.
            // Note: This destroys the flash_messages as well, so we can't display a successful logout page.
            session_destroy();
        }

        public function register($user) {
            $sql = 'INSERT INTO `users` (`username`, `password`, `salt`, `name`, `email`, `permissions`, `admin`) VALUES (:username, :password, :salt, :name, :email, :permissions, :admin)';
            $salt = $this->generateSalt();

            $this->db->query($sql);
            $this->db->bind(':username', $user['username']);
            $password = password_hash($salt . $user['password'], PASSWORD_DEFAULT); // Hash the generated salt and user's password together.
            $this->db->bind(':password', $password) ;
            $this->db->bind(':salt', $salt);
            $this->db->bind(':name', trim($user['name']));
            $this->db->bind(':email', trim($user['email']));
            $permissions = $this->generatePermissionsString($user['permissions']);
            $this->db->bind(':permissions', $permissions);
            $admin = (!empty($user['admin'])) ? true : false;
            $this->db->bind(':admin', $admin);

            return $this->db->execute();

        }

        public function updateUser($user) {
            $sql = 'UPDATE `users` SET `name`=:name, `email`=:email WHERE `id`=:id';
            $this->db->query($sql);
            $this->db->bind(':id', $user['id']);
            $this->db->bind(':name', trim($user['name']));
            $this->db->bind(':email', trim($user['email']));
            return $this->db->execute();
        }

        public function updateUserWithPermissions($user) {
            $sql = 'UPDATE `users` SET `name`=:name, `email`=:email, `permissions`=:permissions, `admin`=:admin WHERE `id`=:id';
            $this->db->query($sql);
            $this->db->bind(':id', $user['id']);
            $this->db->bind(':name', trim($user['name']));
            $this->db->bind(':email', trim($user['email']));
            $permissions = $this->generatePermissionsString($user['permissions']);
            $this->db->bind(':permissions', $permissions);
            $admin = (!empty($user['admin'])) ? true : false;
            $this->db->bind(':admin', $admin);
            return $this->db->execute();
        }

        public function deleteUser($user_id) {
            $sql = 'DELETE FROM `users` WHERE `id`=:user_id';
            $this->db->query($sql);
            $this->db->bind(':user_id', $user_id);
            return $this->db->execute();
        }

        public function changePassword($user_id, $new_password) {
            $salt = $this->generateSalt();
            $password = password_hash($salt . $new_password, PASSWORD_DEFAULT); // Hash the generated salt and user's password together.

            $sql = 'UPDATE `users` SET `password`=:password, `salt`=:salt WHERE `id`=:id';
            $this->db->query($sql);
            $this->db->bind(':id', $user_id);
            $this->db->bind(':password', $password);
            $this->db->bind(':salt', $salt);

            return $this->db->execute();
        }

        private function generateSalt() {
            return bin2hex(random_bytes(16));
        }

        private function generatePermissionsString($permissions) {
            // Loop through given permission array.
            $string = []; //Empty string array, ready for imploding.
            foreach($permissions as $permission) {
                $string[] = $this->clubModel->getClubID($permission); // Add club_id to $string array
            }
            return implode(',', $string);
        }

        public function usernameExists($username) {
            $sql = 'SELECT `username` FROM `users` WHERE `username`=:username';
            $this->db->query($sql);
            $this->db->bind(':username', $username);
            $user = $this->db->result();
            return ($user) ? true : false;
        }

        public function getUsers() {
            $sql = 'SELECT * FROM `users`';
            $this->db->query($sql);
            return $this->db->results();
        }

        public function getUserByID($user_id) {
            $sql = 'SELECT * FROM `users` WHERE `id`=:id';
            $this->db->query($sql);
            $this->db->bind(':id', $user_id);
            return $this->db->result();
        }

        public function getUserByUsername($username) {
            $sql = 'SELECT * FROM `users` WHERE `username`=:username';
            $this->db->query($sql);
            $this->db->bind(':username', $username);
            return $this->db->result();
        }

        public function loggedInCheckRedirect() {
            if (!isset($_SESSION)) {
                session_start();
            }

            // If user is not logged in, then redirect to login page.  Else do nothing.
            if (!isset($_SESSION['user'])) {
                create_flash_message('user', 'You need to log in before you view this page.', 'warning', true);
                redirect('user/login', true);
            }
        }

        public function permissionCheckRedirect($club_id) {

            // This is not a nice way.  This was so we can use Ajax calls in the admin area.
            // Re: App.php Line 163
            // $controller = new $controller($admin, -1);
            if ($club_id === -1) return true;
            
            // Perform log in check first.
            $this->loggedInCheckRedirect();
    
            // If club_id is not within the user's permissions array as a key, then they don't have permission so need to redirect.
            // Redirect to first club with permission available.
            // If no permissions exists then redirect to user/index.
            if (!array_key_exists($club_id, $_SESSION['user']['permissions'])) {
                create_flash_message('user', 'You do not have permission to view the page you requested.', 'danger');
                $this->permissionRedirect();
            }
        }

        public function adminCheckRedirect() {
            // Perform log in check first.
            $this->loggedInCheckRedirect();
    
            // If admin is false then redirect with error message.
            // Redirect to first club with permission available.
            // If no permissions exists then redirect to user/index.
            if ($_SESSION['user']['admin'] === false) {
                create_flash_message('user', 'You do not have permission to view the page you requested.', 'danger');
                $this->permissionRedirect();
            }
        }

        public function permissionRedirect(){
            // Redirect to first club with permission available.
            // If no permissions exists then redirect to user/index.
            if (sizeof($_SESSION['user']['permissions']) > 0) {
                $club_name = $this->clubModel->getClubName(key($_SESSION['user']['permissions'])); // Get the club name of the first permission available.  The first club_id will be the first key of the permissions array.
                redirect($club_name . '/dashboard', true); // i.e. bowls/dashboard
            } else {
                redirect('user', true); // user/index
            }
        }
    }