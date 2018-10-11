<?php

    // TODO:  I replace information with other_information
    // TODO:  I'll need to change the input box name to other_information 

    require_once(APPROOT . "\\classes\\Venue.php");

Class Event {

    private $db;

    public $id;
    public $club_id;
    public $created_date;
    public $title;
    public $date;
    public $time;
    public $location;
    public $meet_at;
    public $contact;
    public $other_information;
    
    public function __construct() {
        $this->db = new Database;
    }

    private function getEvent($club_id, $event_id) {
        
        if (isset($event_id)) {
            $sql = "SELECT `events`.`id`, `events`.`club_id`, `events`.`created_date`, `events`.`title`, `events`.`date`, `events`.`time`, `events`.`location_id`, `venues`.`venue` as `location`, `events`.`meet_at`, `events`.`contact`, `events`.`other_information`
                    FROM `events`
                    LEFT JOIN `venues` ON `events`.`location_id`=`venues`.`id`
                    WHERE `events`.`club_id` = :club_id AND `events`.`id` = :id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':id', $event_id);
            $event = $this->db->result();

            if ($event) {
                $this->id = $event->id;
                $this->club_id = $event->club_id;
                $this->created_date = $event->created_date;
                $this->title = $event->title;
                $this->date = $event->date;
                $this->time = $event->time;
                $this->location_id = $event->location_id;
                $this->location = $event->location;
                $this->meet_at = $event->meet_at;
                $this->contact = $event->contact;
                $this->other_information = $event->other_information;
            } else {
                // Redirect to dashboard instead because the user tried changing the URL to edit a different club.
                create_flash_message("dashboard", "Failed to retrieve the selected event.", "danger");
                redirect('dashboard', $club_id, true);
            }
        } else {
            die('No id passed when creating an event.');
        }
    }

    public static function getEvents($club_id, $n = 0) {
        if (isset($club_id)) {
            $db = new Database;

            $sql = "SELECT `events`.`id`, `events`.`club_id`, `events`.`created_date`, `events`.`title`, `events`.`date`, `events`.`time`, `events`.`location_id`, `venues`.`venue` as `location`, `events`.`meet_at`, `events`.`contact`, `events`.`other_information`
                    FROM `events`
                    LEFT JOIN `venues` ON `events`.`location_id`=`venues`.`id`
                    WHERE `events`.`club_id` = :club_id AND `date` >= DATE(NOW())
                    ORDER BY `events`.`date` DESC";
            
            if ($n > 0) {
                // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
                $sql .= " LIMIT 0, {$n}";
            }
            $db->query($sql);
            $db->bind(':club_id', $club_id);
            return $db->results();
        } else {
            die('Did not supply $club_id with Event::getEvents.');
        }
    }

    private function valid() {
        // Check to see if the event with club_id and id is valid.
        return ($this->club_id != null && $this->id != null) ? true : false;
    }


    public function add($club_id) {
        // First check if form was actually submitted.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'location_id' => $_POST['location'],
                'meet_at' => $_POST['meet_at'],
                'contact' => $_POST['contact'],
                'other_information' => $_POST['other_information'],
                'title_err' => '',
                'date_err' => '',
                'location_err' => '',
                'valid' => true
            ];

            // Validation
            // TODO: More validation.  Date, time etc.
            if (empty($_POST['title'])) {
                $data['title_err'] = "Please enter a title for the notice.";
                $data['valid'] = false;
            }
            
            if ($data['valid']) {
                $sql = "INSERT INTO `events` (club_id, title, date, time, location_id, meet_at, contact, other_information)
                VALUES (:club_id, :title, :date, :time, :location_id, :meet_at, :contact, :other_information)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':title', $data['title']);
                $this->db->bind(':date', $data['date']);
                $this->db->bind(':time', $data['time']);
                $this->db->bind(':location_id', $data['location_id']);
                $this->db->bind(':meet_at', $data['meet_at']);
                $this->db->bind(':contact', $data['contact']);
                $this->db->bind(':other_information', $data['other_information']);

                if($this->db->execute()){
                    create_flash_message(strtolower(__CLASS__), "Successfully added the event <b>{$data['title']}</b>.");
                    redirect('events', $club_id, true);
                } else {
                    create_flash_message(strtolower(__CLASS__), "Failed to add the event <b>{$data['title']}</b>.", "danger");
                }
            } else {
                create_flash_message(strtolower(__CLASS__), "Failed to add event.  Please check all data is valid.", "danger");
            }
           
            return $data;
        }
    }

    public function edit($club_id, $event_id) {
        // First get current event data;
        $event = new Self();
        $event->getEvent($club_id, $event_id);

        // If there is an event with valid club_id and notice_id then get all the data.
        if ($event->valid()) {
            $data = [
                'title' => $event->title,
                'date' => $event->date,
                'time' => $event->time,
                'location_id' => $event->location_id,
                'location' => $event->location,
                'meet_at' => $event->meet_at,
                'contact' => $event->contact,
                'other_information' => $event->other_information,
                'title_err' => '',
                'date_err' => '',
                'location_err' => '',
                'valid' => true
            ];

            // If SERVER REQUEST_METHOD = POST then submit button was clicked so update event in database.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Validation
                // TODO:  Need to validate date, time etc.
                if (empty($_POST['title'])) {
                    $data['title_err'] = "Please enter a title for the event.";
                    $data['valid'] = false;
                }


                if ($data['valid']) {

                    $sql = "UPDATE`events` SET `title` = :title, `date` = :date, `time` = :time, `location_id` = :location_id, `meet_at` = :meet_at, `contact` = :contact, `other_information` = :other_information
                            WHERE `id` = :event_id AND `club_id` = :club_id";
                    $this->db->query($sql);
                    $this->db->bind(':event_id', $event_id);
                    $this->db->bind(':club_id', $club_id);
                    $this->db->bind(':title', $_POST['title']);
                    $this->db->bind(':date', $_POST['date']);
                    $this->db->bind(':time', $_POST['time']);
                    $this->db->bind(':location_id', $_POST['location']);
                    $this->db->bind(':meet_at', $_POST['meet_at']);
                    $this->db->bind(':contact', $_POST['contact']);
                    $this->db->bind(':other_information', $_POST['other_information']);
                    
                    $data = [
                        'title' => $_POST['title'],
                        'date' => $_POST['date'],
                        'time' => $_POST['time'],
                        'location_id' => $_POST['location'],
                        'location' => Venue::getVenue($_POST['location']),
                        'meet_at' => $_POST['meet_at'],
                        'contact' => $_POST['contact'],
                        'other_information' => $_POST['other_information'],
                        'title_err' => '',
                        'date_err' => '',
                        'location_err' => '',
                        'valid' => true
                    ];

                    if($this->db->execute()){
                        create_flash_message(strtolower(__CLASS__), "You have successfully edited the event <b>{$data['title']}</b>.");
                    } else {
                        create_flash_message(strtolower(__CLASS__), "There was an error editing the event <b>{$data['title']}</b>.", "danger");
                    }
                }
            }
        } else {
            // Event doesn't exist within $club_id so redirect with failed_message.
            create_flash_message(strtolower(__CLASS__), "Event doesn't exist.", "warning");
            redirect('events', $club_id, true);
        }
        return $data;
    }


    public function delete($club_id, $event_id) {

        //First get current notice data;
        $event = new Self();
        $event->getEvent($club_id, $event_id);

        // If there is a event with valid club_id and event_id then get all the data.
        if ($event->valid()) {
            $data = [
                'title' => $event->title,
                'data' => $event->date,
                'time' => $event->time,
                'location_id' => $event->location_id,
                'location' => $event->location,
                'meet_at' => $event->meet_at,
                'contact' => $event->contact,
                'other_information' => $event->other_information,
                'title_err' => '',
                'date_err' => '',
                'location_err' => '',
                'delete' => false,
                'valid' => true
            ];

            // If SERVER REQUEST_METHOD is POST then confirm deletion was clicked.  So delete event.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sql = "DELETE FROM `events`
                        WHERE `id` = :event_id AND `club_id` = :club_id";
                $this->db->query($sql);
                $this->db->bind(':event_id', $event_id);
                $this->db->bind(':club_id', $club_id);

                $data['delete'] = true;

                if($this->db->execute()){
                    create_flash_message(strtolower(__CLASS__), "You have successfully deleted the event <b>{$data['title']}</b>.");
                    redirect('events', $club_id, true);
                } else {
                    create_flash_message(strtolower(__CLASS__), "There was an error deleting the event <b>{$data['title']}</b>.", "danger");
                    redirect('events', $club_id, true);
                }
            }
        } else {
            // Event doesn't exist within $club_id so redirect with failed_message.
            create_flash_message(strtolower(__CLASS__), "Event doesn't exist.", "warning");
            redirect('events', $club_id, true);
        }
        return $data;
    }
}