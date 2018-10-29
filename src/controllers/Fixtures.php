<?php

    class Fixtures extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->fixtureModel = $this->model('Fixture');
            $this->teamModel = $this->model('Team');
            $this->leagueModel = $this->model('League');
            $this->venueModel = $this->model('Venue');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);
            
            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($fixture_id) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Validate Form
                if (empty($_POST['home_team_id'])) {
                    $home_team_err = 'Please select a home team.';
                }
                if (empty($_POST['away_team_id'])) {
                    $home_team_err = 'Please select an away team.';
                }
                // TODO: Make sure home_team and away_team are not the same.
                if (empty($_POST['league_id'])) {
                    $league_err = 'Please select a league.';
                }
                if (empty($_POST['date'])) {
                    $date_err = 'Please select a date.';
                } elseif ($_POST['date'] < date("Y-m-d")) {
                    $date_err = 'Date cannot be in the past.';
                }
                if (empty($_POST['time'])) {
                    $time_err = 'Please select a time.';
                }

                // Put Substitutes in 0th position in $squad array.
                // Go through all squad[] input boxes afterwards and push on to the squad array.
                $squad[0] = isset($_POST['substitutes']) ? $_POST['substitutes'] : '';
                if (isset($_POST['squad'])) {
                    foreach ($_POST['squad'] as $position) {
                        if (!empty($position)) {
                            array_push($squad, $position);
                        } else {
                            array_push($squad, '');
                        }
                    }
                }

                $fixture_arr = [
                    'home_team_id' => isset($_POST['home_team_id']) ? $_POST['home_team_id'] : '',
                    'home_team_name' => isset($_POST['home_team_id']) ? $this->teamModel->getTeamName($_POST['home_team_id']) : '',
                    'away_team_id' => isset($_POST['away_team_id']) ? $_POST['away_team_id'] : '',
                    'away_team_name' => isset($_POST['away_team_id']) ? $this->teamModel->getTeamName($_POST['away_team_id']) : '',
                    'league_id' => isset($_POST['league_id']) ? $_POST['league_id'] : '',
                    'date' => isset($_POST['date']) ? $_POST['date'] : '',
                    'time' => isset($_POST['time']) ? $_POST['time'] : '',
                    'venue_id' => isset($_POST['venue_id']) ? $_POST['venue_id'] : '',
                    'meet_at' => isset($_POST['meet_at']) ? $_POST['meet_at'] : '',
                    'contact' => isset($_POST['contact']) ? $_POST['contact'] : '',
                    'substitutes' => $squad[0],
                    'squad' => $squad,
                    'other_information' => isset($_POST['other_information']) ? $_POST['other_information'] : '',
                ];

                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'teams' => $this->teamModel->getTeams($this->club_id),
                    'leagues' => $this->leagueModel->getLeagues($this->club_id),
                    'venues' => $this->venueModel->getVenues($this->club_id),
                    'fixtures' => $this->fixtureModel->getFixtures($this->club_name),  // Send club_name instead of club_id because tables are fixtures_bowls etc
                    'fixture' => (object) $fixture_arr,
                    'home_team_err' => isset($home_team_err) ? $home_team_err : '',
                    'away_team_err' => isset($away_team_err) ? $away_team_err : '',
                    'league_err' => isset($league_err) ? $league_err : '',
                    'date_err' => isset($date_err) ? $date_err : '',
                    'time_err' => isset($time_err) ? $time_err : '',
                ];

                if (!isset($home_team_err) && !isset($away_team_err) && !isset($league_err) && !isset($date_err) && !isset($time_err)) {
                    // Proceed with saving fixture.
                    if ($this->fixtureModel->addFixture($this->club_id, $this->club_name, $data['fixture'])) {
                        create_flash_message('fixtures', 'Successfully added the fixture <strong>' . $data['fixture']->home_team_name . ' v ' . $data['fixture']->away_team_name . '</strong>');
                        redirect($this->club_name . '/fixtures', true);
                    } else {
                        die('<strong>Fatal Error: </strong> Something went wrong when adding a fixture.');
                    }
                } else {
                    create_flash_message('fixtures', 'Please correct all highlighted errors and try again.', 'danger');
                }
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'teams' => $this->teamModel->getTeams($this->club_id),
                    'leagues' => $this->leagueModel->getLeagues($this->club_id),
                    'venues' => $this->venueModel->getVenues($this->club_id),
                    'fixtures' => $this->fixtureModel->getFixtures($this->club_name),  // Send club_name instead of club_id because tables are fixtures_bowls etc
                ];
            }
            $this->view('fixtures/index', $data);
        }

        public function edit($fixture_id) {
            if (isset($fixture_id)) {
                // Check if such a fixture exists.
                $fixture = $this->fixtureModel->getFixture($this->club_id, $this->club_name, $fixture_id);

                if ($fixture) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Validate POST data.
                        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate Form
                        if (empty($_POST['home_team_id'])) {
                            $home_team_err = 'Please select a home team.';
                        }
                        if (empty($_POST['away_team_id'])) {
                            $home_team_err = 'Please select an away team.';
                        }
                        // TODO: Make sure home_team and away_team are not the same.
                        if (empty($_POST['league_id'])) {
                            $league_err = 'Please select a league.';
                        }
                        if (empty($_POST['date'])) {
                            $date_err = 'Please select a date.';
                        } elseif ($_POST['date'] < date("Y-m-d")) {
                            $date_err = 'Date cannot be in the past.';
                        }
                        if (empty($_POST['time'])) {
                            $time_err = 'Please select a time.';
                        }

                        // Put Substitutes in 0th position in $squad array.
                        // Go through all squad[] input boxes afterwards and push on to the squad array.
                        $squad[0] = isset($_POST['substitutes']) ? $_POST['substitutes'] : '';
                        if (isset($_POST['squad'])) {
                            foreach ($_POST['squad'] as $position) {
                                if (!empty($position)) {
                                    array_push($squad, $position);
                                } else {
                                    array_push($squad, '');
                                }
                            }
                        }

                        $fixture_arr = [
                            'id' => $fixture_id,
                            'home_team_id' => isset($_POST['home_team_id']) ? $_POST['home_team_id'] : '',
                            'home_team_name' => isset($_POST['home_team_id']) ? $this->teamModel->getTeamName($_POST['home_team_id']) : '',
                            'away_team_id' => isset($_POST['away_team_id']) ? $_POST['away_team_id'] : '',
                            'away_team_name' => isset($_POST['away_team_id']) ? $this->teamModel->getTeamName($_POST['away_team_id']) : '',
                            'league_id' => isset($_POST['league_id']) ? $_POST['league_id'] : '',
                            'date' => isset($_POST['date']) ? $_POST['date'] : '',
                            'time' => isset($_POST['time']) ? $_POST['time'] : '',
                            'venue_id' => isset($_POST['venue_id']) ? $_POST['venue_id'] : '',
                            'meet_at' => isset($_POST['meet_at']) ? $_POST['meet_at'] : '',
                            'contact' => isset($_POST['contact']) ? $_POST['contact'] : '',
                            'substitutes' => $squad[0],
                            'squad' => $squad,
                            'other_information' => isset($_POST['other_information']) ? $_POST['other_information'] : '',
                        ];

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'teams' => $this->teamModel->getTeams($this->club_id),
                            'leagues' => $this->leagueModel->getLeagues($this->club_id),
                            'venues' => $this->venueModel->getVenues($this->club_id),
                            'fixtures' => $this->fixtureModel->getFixtures($this->club_name),  // Send club_name instead of club_id because tables are fixtures_bowls etc
                            'fixture' => (object) $fixture_arr,
                            'home_team_err' => isset($home_team_err) ? $home_team_err : '',
                            'away_team_err' => isset($away_team_err) ? $away_team_err : '',
                            'league_err' => isset($league_err) ? $league_err : '',
                            'date_err' => isset($date_err) ? $date_err : '',
                            'time_err' => isset($time_err) ? $time_err : '',
                        ];

                        if (!isset($home_team_err) && !isset($away_team_err) && !isset($league_err) && !isset($date_err) && !isset($time_err)) {
                            // Proceed with saving fixture.
                            if ($this->fixtureModel->updateFixture($this->club_id, $this->club_name, $data['fixture'])) {
                                create_flash_message('fixtures', 'Successfully edited the fixture <strong>' . $data['fixture']->home_team_name . ' v ' . $data['fixture']->away_team_name . '</strong>');
                                redirect($this->club_name . '/fixtures', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when editing a fixture.');
                            }
                        } else {
                            create_flash_message('fixtures', 'Please correct all highlighted errors and try again.', 'danger');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'fixture' => $fixture,
                            'fixtures' => $this->fixtureModel->getFixtures($this->club_name),
                            'teams' => $this->teamModel->getTeams($this->club_id),
                            'leagues' => $this->leagueModel->getLeagues($this->club_id),
                            'venues' => $this->venueModel->getVenues($this->club_id),
                        ];
                    }
                } else {
                    create_flash_message('fixtures', 'Invalid Fixture ID', 'warning');
                    redirect($this->club_name . '/fixtures', true);
                }
            } else {
                create_flash_message('fixtures', 'Please supply a valid Fixture ID.', 'warning');
                redirect($this->club_name . '/fixtures', true);
            }
            $this->view('fixtures/edit', $data);
        }

        public function delete($fixture_id) {
            if (isset($fixture_id)) {
                // Get single Notice
                $fixture = $this->fixtureModel->getFixture($this->club_name, $fixture_id);
                // If fixture exist then proceed with deletion.
                if ($fixture) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        if ($this->fixtureModel->deleteFixture($this->club_id, $this->club_name, $fixture_id)) {
                            create_flash_message('fixtures', 'Successfully deleted the fixture <strong>' . $fixture->home_team . ' v ' . $fixture->away_team . '</strong>.');
                            redirect($this->club_name . '/fixtures', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when deleting a fixture.');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'fixture' => $fixture,
                        ];
                    }
                } else {
                    // Invalid fixture id so redirect.
                    create_flash_message('fixtures', 'Invalid fixture ID', 'warning');
                    redirect($this->club_name . '/fixtures', true);
                }
            } else {
                create_flash_message('fixtures', 'Please supply a valid fixture id.', 'warning');
                redirect($this->club_name . '/fixtures', true);
            }
            $this->view('fixtures/delete', $data);
        }
    }