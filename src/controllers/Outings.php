<?php

    class Outings extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->outingModel = $this->model('Outing');
            $this->venueModel = $this->model('Venue');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($outing_id) {

            if (isset($outing_id)) {
                // Get single fixture.
                // This should be PUBLIC_VIEWS because in admin fixtures with an id will have page of add/edit/delete etc.  Public views will be i.e. bowls/fixtures/2 which loads index.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'outing' => $this->outingModel->getOuting($outing_id),
                ];
            } else {

                if ($_SERVER['REQUEST_METHOD'] === "POST") {

                    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    // Validate Form
                    if (empty($_POST['title'])) {
                        $title_err = 'Please enter a title.';
                    }
                    if (empty($_POST['date'])) {
                        $date_err = 'Please select a date.';
                    } elseif ($_POST['date'] < date("Y-m-d")) {
                        $date_err = 'Date cannot be in the past.';
                    }
                    if (empty($_POST['time'])) {
                        $time_err = 'Please select a time.';
                    }

                    $outing_arr = [
                        'title' => isset($_POST['title']) ? trim($_POST['title']) : '',
                        'date' => isset($_POST['date']) ? $_POST['date'] : '',
                        'time' => isset($_POST['time']) ? $_POST['time'] : '',
                        'venue_id' => isset($_POST['venue_id']) ? $_POST['venue_id'] : '',
                        'meet_at' => isset($_POST['meet_at']) ? trim($_POST['meet_at']) : '',
                        'contact' => isset($_POST['contact']) ? trim($_POST['contact']) : '',
                        'other_information' => isset($_POST['other_information']) ? trim($_POST['other_information']) : '',
                    ];

                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'outings' => $this->outingModel->getOutings(),
                        'outing' => (object) $outing_arr,
                        'title_err' => isset($title_err) ? $title_err : '',
                        'date_err' => isset($date_err) ? $date_err : '',
                        'time_err' => isset($time_err) ? $time_err : '',
                    ];
                    
                    // If no errors then proceeed with adding Outing.
                    if (!isset($title_err) && !isset($date_err) && !isset($time_err)) {
                        if ($this->outingModel->addOuting($data['outing'])) {
                            create_flash_message('outings', 'Successfully added the outing <strong>' . $data['outing']->title . '</strong>');
                            redirect($this->club_name . '/outings', true);
                        } else {
                            die('<strong>Fatal Error: </strong> Something went wrong when adding a fixture.');
                        }
                    } else {
                        create_flash_message('outings', 'Please correct all highlighted errors and try again', 'danger');
                    }
                } else {
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'outings' => $this->outingModel->getOutings(),
                        'venues' => $this->venueModel->getVenues($this->club_id)
                    ];
                }
            }
            $this->view('outings/index', $data);
        }

        public function edit($outing_id) {
        
            if (isset($outing_id)) {
                // Check if such a fixture exists.
                $outing = $this->outingModel->getOuting($outing_id);

                if ($outing) {

                    if ($_SERVER['REQUEST_METHOD'] === "POST") {

                        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate Form
                        if (empty($_POST['title'])) {
                            $title_err = 'Please enter a title.';
                        }
                        if (empty($_POST['date'])) {
                            $date_err = 'Please select a date.';
                        } elseif ($_POST['date'] < date("Y-m-d")) {
                            $date_err = 'Date cannot be in the past.';
                        }
                        if (empty($_POST['time'])) {
                            $time_err = 'Please select a time.';
                        }

                        $outing_arr = [
                            'id' => $outing_id,
                            'title' => isset($_POST['title']) ? trim($_POST['title']) : '',
                            'date' => isset($_POST['date']) ? $_POST['date'] : '',
                            'time' => isset($_POST['time']) ? $_POST['time'] : '',
                            'venue_id' => isset($_POST['venue_id']) ? $_POST['venue_id'] : '',
                            'meet_at' => isset($_POST['meet_at']) ? trim($_POST['meet_at']) : '',
                            'contact' => isset($_POST['contact']) ? trim($_POST['contact']) : '',
                            'other_information' => isset($_POST['other_information']) ? trim($_POST['other_information']) : '',
                        ];

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'outings' => $this->outingModel->getOutings(),
                            'outing' => (object) $outing_arr,
                            'title_err' => isset($title_err) ? $title_err : '',
                            'date_err' => isset($date_err) ? $date_err : '',
                            'time_err' => isset($time_err) ? $time_err : '',
                        ];
                        
                        // If no errors then proceeed with adding Outing.
                        if (!isset($title_err) && !isset($date_err) && !isset($time_err)) {
                            if ($this->outingModel->updateOuting($data['outing'])) {
                                create_flash_message('outings', 'Successfully edited the outing <strong>' . $data['outing']->title . '</strong>');
                                redirect($this->club_name . '/outings', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when adding an outing.');
                            }
                        } else {
                            create_flash_message('outings', 'Please correct all highlighted errors and try again', 'danger');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'outing' => $this->outingModel->getOuting($outing_id),
                            'outings' => $this->outingModel->getOutings(),
                            'venues' => $this->venueModel->getVenues($this->club_id)
                        ];
                    } 
                } else {
                    create_flash_message('outings', 'Invalid Outing ID', 'warning');
                    redirect($this->club_name . '/outings', true);
                }
            } else {
                create_flash_message('outings', 'Please supply a valid Outing ID.', 'warning');
                redirect($this->club_name . '/outings', true);
            }
            
             $this->view('outings/edit', $data);
        }

        public function delete($outing_id) {
            if (isset($outing_id)) {
                $outing = $this->outingModel->getOuting($outing_id);
                // If outing exist then proceed with deletion.
                if ($outing) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        if ($this->outingModel->deleteOuting($outing_id)) {
                            create_flash_message('outings', 'Successfully deleted the outing <strong>' . $outing->title . '</strong>.');
                            redirect($this->club_name . '/outings', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when deleting a outing.');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'outing' => $outing,
                        ];
                    }
                } else {
                    // Invalid outing id so redirect.
                    create_flash_message('outings', 'Invalid outing ID', 'warning');
                    redirect($this->club_name . '/outings', true);
                }
            } else {
                create_flash_message('outings', 'Please supply a valid outing id.', 'warning');
                redirect($this->club_name . '/outings', true);
            }
            $this->view('outings/delete', $data);
        }
    }