<?php

    class Events extends Controller {

        private $admin, $club_id, $club_name;

        public function __construct($admin = false, $club_id) {
            
            // Load all models needed.
            $this->userModel = $this->model('UserModel');
            $this->clubModel = $this->model('Club');
            $this->eventModel = $this->model('Event');

            $this->admin = $admin;
            $this->club_id = $club_id;
            $this->club_name = $this->clubModel->getClubName($this->club_id);

            if ($this->admin === true) {
                $this->userModel->permissionCheckRedirect($this->club_id);
            }
        }

        public function index($event_id) {
            if (isset($event_id)) {
                // Get single event.
                // This should be PUBLIC_VIEWS because in admin events with an id will have page of add/edit/delete etc.  Public views will be i.e. bowls/events/2 which loads index.
                $data = [
                    'club' => $this->clubModel->getClubByID($this->club_id),
                    'event' => $this->eventModel->getEvent($this->club_id, $event_id),
                ];
            } else {
                // We're on index, so retrieve all Events
                if ($this->admin === true){
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Sanitize POST data.
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate form.
                        if (empty($_POST['title'])) {
                            $title_err = 'Please enter a title for the event.';
                        }

                        if (empty($_POST['date'])) {
                            $date_err = 'Please enter a date.';
                        } elseif ($_POST['date'] < date("Y-m-d")) {
                            $date_err = 'Date cannot be in the past.';
                        }

                        if (empty($_POST['time'])) {
                            $time_err = 'Please enter a time.';
                        }

                        // TODO: Add venue id and location?

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'events' => $this->eventModel->getEvents($this->club_id),
                            'event' => (object) ['title' => trim($_POST['title']), 'date' => $_POST['date'], 'time' => $_POST['time'], 'location_id' => NULL, 'meet_at' => trim($_POST['meet_at']), 'contact' => trim($_POST['contact']), 'other_information' => trim($_POST['other_information'])],
                            'title_err' => isset($title_err) ? $title_err : '',
                            'date_err' => isset($date_err) ? $date_err : '',
                            'time_err' => isset($time_err) ? $time_err : '',
                        ];

                        // If no errors then proceed with adding event.
                        if (!isset($title_err) && !isset($date_err) && !isset($time_err)) {
                            if ($this->eventModel->addEvent($this->club_id, $data['event'])) {
                                create_flash_message('events', 'Successfully added the notice <strong>' . $data['event']->title . '</strong>');
                                redirect($this->club_name . '/events', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when adding an event.');
                            }
                        } else {
                            create_flash_message('events', 'Please correct all highlighted errors and try again.', 'danger');
                            redirect($this->club_name . '/events', true);
                        }
                    } else {
                        // No post submitted, so blank form.
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'events' => $this->eventModel->getEvents($this->club_id),
                        ];
                    }
                } else {
                    // In public so we only need the events and not the form data.
                    $data = [
                        'club' => $this->clubModel->getClubByID($this->club_id),
                        'events' => $this->eventModel->getEvents($this->club_id),
                    ];
                }
            }
            $this->view('events/index', $data);
        }

        public function edit($event_id) {
            if (isset($event_id)) {
                // If event exists then proceed
                if ($this->eventModel->getEvent($this->club_id, $event_id)) {

                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        // Validate POST data.
                        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // Validate form.
                        if (empty($_POST['title'])) {
                            $title_err = 'Please enter a title for the event.';
                        }

                        if (empty($_POST['date'])) {
                            $date_err = 'Please enter a date.';
                        } elseif ($_POST['date'] < date("Y-m-d")) {
                            $date_err = 'Date cannot be in the past.';
                        }

                        if (empty($_POST['time'])) {
                            $time_err = 'Please enter a time.';
                        }

                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'events' => $this->eventModel->getEvents($this->club_id),
                            'event' => (object) ['event_id' => $_POST['event_id'], 'title' => trim($_POST['title']), 'date' => $_POST['date'], 'time' => $_POST['time'], 'location_id' => NULL, 'meet_at' => trim($_POST['meet_at']), 'contact' => trim($_POST['contact']), 'other_information' => trim($_POST['other_information'])],
                            'title_err' => isset($title_err) ? $title_err : '',
                            'date_err' => isset($date_err) ? $date_err : '',
                            'time_err' => isset($time_err) ? $time_err : '',
                        ];

                        // If no errors then proceed with adding event.
                        if (!isset($title_err) && !isset($date_err) && !isset($time_err)) {
                            if ($this->eventModel->updateEvent($this->club_id, $data['event'])) {
                                create_flash_message('events', 'Successfully edited the event <strong>' . $data['event']->title . '</strong>');
                                redirect($this->club_name . '/events', true);
                            } else {
                                die('<strong>Fatal Error: </strong> Something went wrong when editing an event.');
                            }
                        } else {
                            create_flash_message('events', 'Please correct all highlighted errors and try again.', 'danger');
                            redirect($this->club_name . '/events', true);
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'event' => $this->eventModel->getEvent($this->club_id, $event_id),
                            'events' => $this->eventModel->getEvents($this->club_id),
                        ];
                    }
                } else {
                    create_flash_message('events', 'Invalid Event ID', 'warning');
                    redirect($this->club_name . '/events', true);
                }
            } else {
                create_flash_message('events', 'Please supply a valid Event ID.', 'warning');
                redirect($this->club_name . '/events', true);
            }
             $this->view('events/edit', $data);
        }

        public function delete($event_id) {
            if (isset($event_id)) {
                // Get single Notice
                $event = $this->eventModel->getEvent($this->club_id, $event_id);
                // If event exist then proceed with deletion.
                if ($event) {
                    if ($_SERVER['REQUEST_METHOD'] === "POST") {
                        if ($this->eventModel->deleteEvent($this->club_id, $event_id)) {
                            create_flash_message('events', 'Successfully deleted the event <strong>' . $event->title . '</strong>.');
                            redirect($this->club_name . '/events', true);
                        } else {
                            die('<strong>Fatal Error: </strong>Something went wrong when deleting a event.');
                        }
                    } else {
                        $data = [
                            'club' => $this->clubModel->getClubByID($this->club_id),
                            'event' => $event,
                        ];
                    }
                } else {
                    // Invalid event id so redirect.
                    create_flash_message('events', 'Invalid event ID', 'warning');
                    redirect($this->club_name . '/events', true);
                }
            } else {
                create_flash_message('events', 'Please supply a valid event id.', 'warning');
                redirect($this->club_name . '/events', true);
            }
            $this->view('events/delete', $data);
        }
    }