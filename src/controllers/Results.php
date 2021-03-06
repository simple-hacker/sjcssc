<?php

    class Results extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->fixtureModel = $this->model('Fixture');
            $this->resultModel = $this->model('Result');
            $this->leagueModel = $this->model('League');
            
            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($result_id) {
            if (isset($result_id)) {
                // Get single result.
                // This should be PUBLIC_VIEWS because in admin results with an id will have page of add/edit/delete etc.  Public views will be i.e. bowls/results/2 which loads index.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'result' => $this->resultModel->getResult($this->club_id, $result_id),
                ];
            } else {
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'leagues' => $this->leagueModel->getLeagues($this->club_id),
                    'results' => ($this->admin === true) ? $this->resultModel->getResults($this->club_id, 0, true) : $this->resultModel->getResults($this->club_id, 0),
                ];
            }
            $this->view('results/index', $data);
        }

        public function edit($result_id) {
            if (isset($result_id)) {
                // Check if such a fixture exists.
                $result = $this->fixtureModel->getFixture($this->club_id, $this->club_name, $result_id);
                if ($result) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        //Validate Form
                        if (empty($_POST['home_team_score'])) {
                            $home_team_score_err = 'Please enter a home team score.';
                        } elseif ($_POST['home_team_score'] < 0) {
                            $home_team_score_err = 'Please enter a number greater than 0.';
                        }
                        if (empty($_POST['away_team_score'])) {
                            $away_team_score_err = 'Please enter an away team score.';
                        } elseif ($_POST['away_team_score'] < 0) {
                            $away_team_score_err = 'Please enter a number greater than 0.';
                        }

                        if (isset(CLUBS[$this->club_name]['results']['fields'])) {
                            // Loop through all results fields in CLUBS, and put the POST data in to the result object.
                            foreach (CLUBS[$this->club_name]['results']['fields'] as $field) {
                                $result->{$field['name']} = isset($_POST[$field['name']]) ? $_POST[$field['name']] : NULL;
                            }
                        } else {
                            die('Missing CLUBS results configuration');
                        }
                        
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'result' => $result,
                            'results' => $this->fixtureModel->getPastFixtures($this->club_name),
                            'leagues' => $this->leagueModel->getLeagues($this->club_id),
                            'home_team_score_err' => isset($home_team_score_err) ? $home_team_score_err : '',
                            'away_team_score_err' => isset($away_team_score_err) ? $away_team_score_err : '',
                        ];

                        if (!isset($home_team_score_err) && !isset($away_team_score_err)) {
                            // Proceed with saving results.
                            if ($this->resultModel->updateResult($this->club_name, $data['result'])) {
                                create_flash_message('results', 'Successfully saved the results for <strong>' . $data['result']->home_team . ' v ' . $data['result']->away_team . '</strong>');
                                redirect($this->club_name . '/results', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when saving a result.');
                            }
                        } else {
                            create_flash_message('results', 'Please correct all highlighted errors and try again.', 'danger');
                        }

                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'leagues' => $this->leagueModel->getLeagues($this->club_id),
                            'result' => $this->fixtureModel->getFixture($this->club_id, $this->club_name, $result_id),
                            'results' => $this->resultModel->getResults($this->club_id, 0, true),
                        ];
                    }
                } else {
                    create_flash_message('results', 'Invalid Fixture ID.', 'warning', true);
                    redirect($this->club_name . '/results', true);
                }
            } else {
                create_flash_message('results', 'Please supply a valid fixture ID.', 'warning', true);
                redirect($this->club_name . '/results', true);
            }
             $this->view('results/edit', $data);
        }

        public function delete($result_id) {
            $data = [
                'club' => $this->clubModel->getClubByID($this->club_id),
            ];
            $this->view('results/delete', $data);
        }
    }