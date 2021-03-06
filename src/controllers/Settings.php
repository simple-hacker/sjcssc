<?php

    class Settings extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->teamModel = $this->model('Team');
            $this->leagueModel = $this->model('League');
            $this->venueModel = $this->model('Venue');
            $this->peopleModel = $this->model('People');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index() {

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Validate all form.
                if (empty($_POST['name'])) {
                    $name_err = "Please enter the club's full name.";
                }

                if (empty($_POST['message'])) {
                    $message_err = "Please enter the front page message.";
                }

                if (empty($_POST['team_name'])) {
                    $team_name_err = "Please enter the club's team name.";
                }

                // Validate Addresses
                foreach ($_POST['address_id'] as $i => $id) {
                    // Only put in to array if value is not null, and title and address are not empty.
                    if (empty($_POST['address_title'][$i]) && !empty($_POST['address'][$i])) {
                        // If title is empty but address is not empty, then title err.
                        $addresses_title_err[$i] = 'Please enter an address title.';
                    } 
                    if (empty($_POST['address'][$i]) && !empty($_POST['address_title'][$i])) {
                        // If address is empty but title is not empty, then address err.
                        $addresses_err[$i] = 'Please enter an address.';
                    }
                    
                    if (!empty($_POST['address_title'][$i]) || !empty($_POST['address'][$i])) {
                        // Add POST data to addresses array as long as title or address aren't empty 
                        $addresses[$i] = (object) ['id' => $id, 'address_title' => $_POST['address_title'][$i], 'address' => $_POST['address'][$i]];
                    } elseif (!empty($id) && empty($_POST['address_title'][$i]) && empty($_POST['address'][$i])) {
                        // Still add to array if the id exists but both title and address field are empty.  This means the user wants to delete the record.
                        $addresses[$i] = (object) ['id' => $id, 'address_title' => '', 'address' => ''];
                    }
                }

                // Validate Emails
                foreach ($_POST['email_id'] as $i => $id) {
                    // Only put in to array if value is not null, and title and email are not empty.
                    if (empty($_POST['email_title'][$i]) && !empty($_POST['email'][$i])) {
                        // If title is empty but email is not empty, then title err.
                        $emails_title_err[$i] = 'Please enter an email title.';
                    }
                    if (empty($_POST['email'][$i]) && !empty($_POST['email_title'][$i])) {
                        // If email is empty but title is not empty, then email err.
                        $emails_err[$i] = 'Please enter an email address.';
                    }
                    // Add POST data to addresses array as long as title or emails aren't empty.
                    if (!empty($_POST['email_title'][$i]) || !empty($_POST['email'][$i])) {
                        $emails[$i] = (object) ['id' => $id, 'email_title' => $_POST['email_title'][$i], 'email' => $_POST['email'][$i]];
                    } elseif (!empty($id) && empty($_POST['email_title'][$i]) && empty($_POST['email'][$i])) {
                        // Still add to array if the id exists but both title and email field are empty.  This means the user wants to delete the record.
                        $emails[$i] = (object) ['id' => $id, 'email_title' => '', 'email' => ''];
                    }
                }

                // Validate Phone Numbers
                foreach ($_POST['phone_number_id'] as $i => $id) {
                    // Only put in to array if value is not null, and title and phone_number are not empty.
                    if (empty($_POST['phone_number_title'][$i]) && !empty($_POST['phone_number'][$i])) {
                        // If title is empty but phone number link is not empty, then title err.
                        $phone_numbers_title_err[$i] = 'Please enter a phone number title.';
                    }
                    if (empty($_POST['phone_number'][$i]) && !empty($_POST['phone_number_title'][$i])) {
                        // If phone number is empty but title is not empty, then phone number err.
                        $phone_numbers_err[$i] = 'Please enter a phone number.';
                    }
                    // Add POST data to addresses array as long as title or phone numbers aren't empty.
                    if (!empty($_POST['phone_number_title'][$i]) || !empty($_POST['phone_number'][$i])) {
                        $phone_numbers[$i] = (object) ['id' => $id, 'phone_number_title' => $_POST['phone_number_title'][$i], 'phone_number' => $_POST['phone_number'][$i]];
                    } elseif (!empty($id) && empty($_POST['phone_number_title'][$i]) && empty($_POST['phone_number'][$i])) {
                        // Still add to array if the id exists but both title and phone_number field are empty.  This means the user wants to delete the record.
                        $phone_numbers[$i] = (object) ['id' => $id, 'phone_number_title' => '', 'phone_number' => ''];
                    }
                }

                // Validate Menu Links
                foreach ($_POST['menu_link_id'] as $i => $id) {
                    // Only put in to array if value is not null, and title and menu_link are not empty.
                    if (empty($_POST['menu_link_title'][$i]) && !empty($_POST['menu_link'][$i])) {
                        // If title is empty but menu link is not empty, then title err.
                        $menu_links_title_err[$i] = 'Please enter a menu link title.';
                    }
                    if (empty($_POST['menu_link'][$i]) && !empty($_POST['menu_link_title'][$i])) {
                        // If menu link is empty but title is not empty, then menu link err.
                        $menu_links_err[$i] = 'Please enter a menu link.';
                    }
                    // Add POST data to addresses array as long as title or phone numbers aren't empty.
                    if (!empty($_POST['menu_link_title'][$i]) || !empty($_POST['menu_link'][$i])) {
                        $menu_links[$i] = (object) ['id' => $id, 'menu_link_title' => $_POST['menu_link_title'][$i], 'menu_link' => $_POST['menu_link'][$i]];
                    } elseif (!empty($id) && empty($_POST['menu_link_title'][$i]) && empty($_POST['menu_link'][$i])) {
                        // Still add to array if the id exists but both title and menu_link field are empty.  This means the user wants to delete the record.
                        $menu_links[$i] = (object) ['id' => $id, 'menu_link_title' => '', 'menu_link' => ''];
                    }
                }

                // TODO: HOME TEAM
                $team_id = (!empty($_POST['team_id'])) ? $_POST['team_id'] : 0;

                // TODO: Need to do HTML entities.
                $data = [
                    'club' => (object) ['id' => $this->club_id, 'club' => $this->club_name ,'name' => trim($_POST['name']), 'message' => trim($_POST['message']), 'team_id' => $team_id] , // Need to convert POST data to objects.
                    'addresses' => isset($addresses) ? $addresses : [],
                    'emails' => isset($emails) ? $emails : [],
                    'phone_numbers' => isset($phone_numbers) ? $phone_numbers : [],
                    'menu_links' => isset($menu_links) ? $menu_links : [],
                    'teams' => isset($teams) ? $teams : [],
                    'name_err' => isset($name_err) ? $name_err : '',
                    'message_err' => isset($message_err) ? $message_err : '',
                    'addresses_title_err' => isset($addresses_title_err) ? $addresses_title_err : [],
                    'addresses_err' => isset($addresses_err) ? $addresses_err : [],
                    'emails_title_err' => isset($emails_title_err) ? $emails_title_err : [],
                    'emails_err' => isset($emails_err) ? $emails_err : [],
                    'phone_numbers_title_err' => isset($phone_numbers_title_err) ? $phone_numbers_title_err : [],
                    'phone_numbers_err' => isset($phone_numbers_err) ? $phone_numbers_err : [],
                    'menu_links_title_err' => isset($menu_links_title_err) ? $menu_links_title_err : [],
                    'menu_links_err' => isset($menu_links_err) ? $menu_links_err : [],
                ];

                // If no errors exist then proceed with saving all data.
                if (!isset($name_err) && !isset($message_err) && !isset($addresses_title_err) && !isset($addresses_err) && !isset($emails_title_err) && !isset($emails_err) && !isset($phone_numbers_title_err) && !isset($phone_numbers_err) && !isset($menu_links_title_err) && !isset($menu_links_err) && !isset($teams_err) && !isset($leagues_err) && !isset($venues_err)) {
                    // Save all data as long as all items successfully update.
                    if ($this->clubModel->updateClub($data) && $this->teamModel->updateTeams($this->club_id, $data['teams']) && $this->leagueModel->updateLeagues($this->club_id, $data['leagues']) && $this->venueModel->updateVenues($this->club_id, $data['venues'])) {
                        create_flash_message('settings', 'Successfully saved club settings.');
                        redirect($this->club_name . '/settings', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when updating club details.');
                    }
                } else {
                    create_flash_message('settings', 'Please correct the errors highlighted and try again.', 'danger');
                }
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'addresses' => $this->clubModel->getData('addresses', $this->club_id),
                    'emails' => $this->clubModel->getData('emails', $this->club_id),
                    'phone_numbers' => $this->clubModel->getData('phone_numbers', $this->club_id),
                    'menu_links' => $this->clubModel->getData('menu_links', $this->club_id),
                    'teams' => $this->teamModel->getTeams($this->club_id),
                ];
            }
            $this->view('settings/index', $data);
        }


        public function teams() {

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate Team
                foreach ($_POST['team'] as $i => $team) {
                    if (empty($team) && !empty($_POST['team_location'][$i])) {
                        // If user enters location without a team name, then team name error.
                        if (empty($_POST['team_id'][$i])) {
                            $teams_err[] = 'Please make sure you enter the team name.';
                        } else {
                            // Else put it error with id array.
                            $teams_with_id_err[$_POST['team_id'][$i]] = 'Please make sure you enter the team name.';
                        }
                    }
                    
                    // Add all POST data to teams array as long as at least one data is not empty.
                    if (!empty($_POST['team_id'][$i]) || !empty($team) || !empty($_POST['team_location'][$i])) {
                        $teams[] = (object) ['id' => $_POST['team_id'][$i], 'club_id' => $this->club_id, 'team' => $team, 'location' => $_POST['team_location'][$i]];
                    }
                }

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'teams' => isset($teams) ? $teams : [],
                    'teams_err' => isset($teams_err) ? $teams_err : [],
                    'teams_with_id_err' => isset($teams_with_id_err) ? $teams_with_id_err : [],
                ];

                // If no errors exist then proceed with saving all data.
                if (!isset($teams_err) && !isset($teams_with_id_err)) {
                    // Save all data.
                    if ($this->teamModel->updateTeams($this->club_id, $data['teams'])) {
                        create_flash_message('teams', 'Successfully saved club teams.');
                        redirect($this->club_name . '/settings/teams', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when saving club teams.');
                    }
                } else {
                    create_flash_message('teams', 'Please correct the errors highlighted and try again.', 'danger');
                }

            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'teams' => $this->teamModel->getTeams($this->club_id),
                ];
            }           
            $this->view('settings/teams', $data);
        }

        public function leagues() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate Team
                foreach ($_POST['league'] as $i => $league) {
                    if (empty($league) && (!empty($_POST['league_full'][$i]) || !empty($_POST['league_website'][$i]))) {
                        // If user enters league_full or league_website without a league, then league error.
                        if (empty($_POST['league_id'][$i])) {
                            $leagues_err[] = 'Please make sure you enter the league.';
                        } else {
                            // Else put it error with id array.
                            $leagues_with_id_err[$_POST['league_id'][$i]] = 'Please make sure you enter the league.';
                        }
                    }
                    // Add all POST data to teams array as long as at least one data is not empty.
                    if (!empty($_POST['league_id'][$i]) || !empty($league) || !empty($_POST['league_full'][$i]) || !empty($_POST['league_website'][$i])) {
                        $leagues[] = (object) ['id' => $_POST['league_id'][$i], 'club_id' => $this->club_id, 'league' => $league, 'league_full' => $_POST['league_full'][$i], 'league_website' => $_POST['league_website'][$i]];
                    }
                }

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'leagues' => isset($leagues) ? $leagues : [],
                    'leagues_err' => isset($leagues_err) ? $leagues_err : [],
                    'leagues_with_id_err' => isset($leagues_with_id_err) ? $leagues_with_id_err : [],
                ];

                // If no errors exist then proceed with saving all data.
                if (!isset($leagues_err) && !isset($leagues_with_id_err)) {
                    // Save all data.
                    if ($this->leagueModel->updateLeagues($this->club_id, $data['leagues'])) {
                        create_flash_message('leagues', 'Successfully saved club leagues.');
                        redirect($this->club_name . '/settings/leagues', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when saving club leagues.');
                    }
                } else {
                    create_flash_message('leagues', 'Please correct the errors highlighted and try again.', 'danger');
                }

            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'leagues' => $this->leagueModel->getLeagues($this->club_id),
                ];
            }           
            $this->view('settings/leagues', $data);
        }

        public function venues() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate Team
                foreach ($_POST['venue'] as $i => $venue) {
                    if (empty($venue) && !empty($_POST['venue_location'][$i])) {
                        // If user enters location without a venue name, then venue name error.
                        if (empty($_POST['venue_id'][$i])) {
                            $venues_err[] = 'Please make sure you enter the venue name.';
                        } else {
                            // Else put it error with id array.
                            $venues_with_id_err[$_POST['venue_id'][$i]] = 'Please make sure you enter the venue\'s name.';
                        }
                    }
                    // Add all POST data to venues array as long as at least one data is not empty.
                    if (!empty($_POST['venue_id'][$i]) || !empty($venue) || !empty($_POST['venue_location'][$i])) {
                        $venues[] = (object) ['id' => $_POST['venue_id'][$i], 'club_id' => $this->club_id, 'venue' => $venue, 'location' => $_POST['venue_location'][$i]];
                    }
                }

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'venues' => isset($venues) ? $venues : [],
                    'venues_err' => isset($venues_err) ? $venues_err : [],
                    'venues_with_id_err' => isset($venues_with_id_err) ? $venues_with_id_err : [],
                ];

                // If no errors exist then proceed with saving all data.
                if (!isset($venues_err) && !isset($venues_with_id_err)) {
                    // Save all data.
                    if ($this->venueModel->updateVenues($this->club_id, $data['venues'])) {
                        create_flash_message('venues', 'Successfully saved club venues.');
                        redirect($this->club_name . '/settings/venues', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when saving club venues.');
                    }
                } else {
                    create_flash_message('venues', 'Please correct the errors highlighted and try again.', 'danger');
                }

            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'venues' => $this->venueModel->getVenues($this->club_id),
                ];
            }           
            $this->view('settings/venues', $data);
        }

        public function people() {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Validate People
                foreach ($_POST['people'] as $i => $person) {

                    $active = in_array($_POST['people_id'][$i], $_POST['people_active']);  // Returns true if checkbox was ticked, else false.

                    if (empty($person) && !empty($_POST['people_email'][$i])) {
                        // If user enters an email without a name, then name error.
                        // If no id was provided then make sure errors go in normal array.
                        if (empty($_POST['people_id'][$i])) {
                            $people_err[] = 'Please make sure you enter the person\'s name.';
                        } else {
                            // Else put it error with id array.
                            $people_with_id_err[$_POST['people_id'][$i]] = 'Please make sure you enter the person\'s name.';
                        }   
                    }
                    // Add all POST data to venues array as long as at least one data is not empty.
                    if (!empty($_POST['people_id'][$i]) || !empty($person) || !empty($_POST['people_email'][$i])) {
                    // if (!empty($_POST['people_id'][$i]) || !empty($people) || !empty($_POST['people_email'][$i])) {
                        $people[] = (object) ['id' => $_POST['people_id'][$i], 'club_id' => $this->club_id, 'name' => $person, 'email' => $_POST['people_email'][$i], 'active' => $active];
                    }
                }

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'people' => isset($people) ? $people : [],
                    'people_err' => isset($people_err) ? $people_err : [],
                    'people_with_id_err' => isset($people_with_id_err) ? $people_with_id_err : [],
                ];

                // If no errors exist then proceed with saving all data.
                if (!isset($people_err) && !isset($people_with_id_err)) {
                    // Save all data.
                    if ($this->peopleModel->updatePeople($this->club_id, $data['people'])) {
                        create_flash_message('people', 'Successfully saved club people.');
                        redirect($this->club_name . '/settings/people', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when saving club people.');
                    }
                } else {
                    create_flash_message('people', 'Please correct the errors highlighted and try again.', 'danger');
                }

            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'people' => $this->peopleModel->getPeople($this->club_id),
                ];
            }           
            $this->view('settings/people', $data);
        }

        public function images() {
            
            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (isset($_FILES)) {
                    // print_var($_FILES);
                    foreach ($_FILES as $section => $image) {
                        if ($image['error'] == 4) continue; // Error 4 is no image uploaded, so continue to next one.
                        image_upload($this->club_name, $section, $image);
                    }
                    // die();
                } else {
                    create_flash_message('images', 'No files were selected to be uploaded.', 'warning');
                }

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                ];
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                ];
            }

            $this->view('settings/images', $data);
        }
    }