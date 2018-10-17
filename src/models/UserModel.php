<?php

    class UserModel {

        private $db;

        public function __construct() {
            $this->db = new Database;
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

        private function getClubPermissions($permissions) {

            // If permissions is an empty string, -1 to return an empty array, else explode as normal.
            $permissions_array = (empty($permissions)) ? explode(',', $permissions, -1) : explode(',', $permissions);
            $club_permissions = []; // Blank array to start off with.

            foreach ($permissions_array as $club_id) {
                $club_permissions[$club_id] = Club::getClubName($club_id);
            }
            return $club_permissions;
        }

        public function logout() {
            // Unset all SESSION variables.
            unset($_SESSION['user']);
            // Destroy the session just in case.
            // Note: This destroys the flash_messages as well, so we can't display a successful logout page.
            session_destroy();
        }

        public function register() {
            // Need to write a salting function.
        }
    }