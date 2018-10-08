<?php

Class Notice {

    private $db;

    public $id;
    public $club_id;
    public $event_id;
    public $created_date;
    public $expiry_date;
    public $important;
    public $title;
    public $notice;
    

    public function __construct() {
        $this->db = new Database;
    }

    public function getNotice($club_id, $notice_id) {

        if (isset($notice_id)) {
            $sql = "SELECT * FROM `notices` WHERE `club_id` = :club_id AND `id`= :id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':id', $notice_id);
            $notice  = $this->db->result();

            if ($notice) {
                $this->id = $notice->id;
                $this->club_id = $notice->club_id;
                $this->event_id = $notice->event_id;
                $this->created_date = $notice->created_date;
                $this->expiry_date = $notice->expiry_date;
                $this->expiry_date_option = $notice->expiry_date_option;
                $this->important = $notice->important;
                $this->title = $notice->title;
                $this->notice = $notice->notice;
            } else {
                // Redirect to dashboard instead because the user tried changing the URL to edit a different club.
                create_flash_message("dashboard", "Failed to retrieve the selected notice.", "danger");
                redirect('dashboard', $club_id, true);
            }
        } else {
            die('No id passed when creating a notice');
        }
    }

    public static function getNotices($club_id, $n = 0) {
        if (isset($club_id)) {
            $db = new Database;
            // Only select notices without an expiry date and where the current date is before the expiiry date.
            $sql = "SELECT * FROM `notices` WHERE `club_id`= :club_id AND (DATE(NOW()) <= `expiry_date` OR `expiry_date` IS NULL) ORDER BY  `important` DESC, `created_date` DESC";
            if ($n > 0) {
                // To prevent negative numbers.  If n isn't provided then get unlimited notices, else only return n notices.
                $sql .= " LIMIT 0, {$n}";
            }
            $db->query($sql);
            $db->bind(':club_id', $club_id);
            return $db->results();
        } else {
            die('Did not supply $club_id with Notice::getNotices.');
        }
    }

    private function valid() {
        // Check to see if the notice with club_id and id is valid.
        return ($this->club_id != null && $this->id != null) ? true : false;
    }


    public function add($club_id) {
        // First check if form was actually submitted.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Create expiry_date
            if ($_POST['expiry_date_select'] === "NULL") {
                $expiry_date = NULL;
            } else {
                // Create new date.
                $expiry_date = date('Y-m-d', strtotime($_POST['expiry_date_select']) + 86400); // Have to add another day (86400 seconds) because notice will expire 00:00 on the day, rather than at 23:59 on the day.
            }

            $data = [
                'title' => trim($_POST['title']),
                'notice' => trim($_POST['notice']),
                'event_id' => null,
                'expiry_date' => $expiry_date,
                'expiry_date_option' => $_POST['expiry_date_select'],
                'important' => (isset($_POST['important'])) ? true : false, // True if selected, False if not.
                'title_err' => '',
                'notice_err' => '',
                'valid' => true
            ];

            // Validation
            if (empty($_POST['title'])) {
                $data['title_err'] = "Please enter a title for the notice.";
                $data['valid'] = false;
            }
            if (empty($_POST['notice'])) {
                $data['notice_err'] = "Please enter notice body.";
                $data['valid'] = false;
            }
            
            if ($data['valid']) {
                $sql = "INSERT INTO `notices` (club_id, event_id, expiry_date, expiry_date_option, important, title, notice)
                VALUES (:club_id, :event_id, :expiry_date, :expiry_date_option, :important, :title, :notice)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':event_id', $data['event_id']);
                $this->db->bind(':expiry_date', $data['expiry_date']);
                $this->db->bind(':expiry_date_option', $data['expiry_date_option']);
                $this->db->bind(':important', $data['important']);
                $this->db->bind(':title', $data['title']);
                $this->db->bind(':notice', $data['notice']);

                if($this->db->execute()){
                    create_flash_message(strtolower(__CLASS__), "Successfully added the notice <b>{$data['title']}</b>.");
                    redirect('notices', $club_id, true);
                } else {
                    create_flash_message(strtolower(__CLASS__), "Failed to add the notice <b>{$data['title']}</b>.", "danger");
                }  
            } else {
                create_flash_message(strtolower(__CLASS__), "Failed to add notice.  Please check all data is valid.", "danger");
            }
           
            return $data;
        }
    }

    public function edit($club_id, $notice_id) {
        //First get current notice data;
        $notice = new Self();
        $notice->getNotice($club_id, $notice_id);

        // If there is a notice with valid club_id and notice_id then get all the data.
        if ($notice->valid()) {
            $data = [
                'title' => $notice->title,
                'notice' => $notice->notice,
                'event_id' => $notice->event_id,
                'expiry_date' => $notice->expiry_date,
                'expiry_date_option' => $notice->expiry_date_option,
                'important' => $notice->important,
                'title_err' => '',
                'notice_err' => '',
                'valid' => true
            ];

            //If SERVER REQUEST_METHOD = POST then submit button was clicked so update notice in database.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Validation
                if (empty($_POST['title'])) {
                    $data['title_err'] = "Please enter a title for the notice.";
                    $data['valid'] = false;
                }
                if (empty($_POST['notice'])) {
                    $data['notice_err'] = "Please enter notice body.";
                    $data['valid'] = false;
                }

                if ($data['valid']) {
                    $important = (isset($_POST['important'])) ? true : false;

                    $expiry_date = $notice->expiry_date;
                    $expiry_date_option = $notice->expiry_date_option;
                    // If expiry_date_option is different then calculate new expiry_date.
                    // Else use values above (no actual else statement).
                    if (isset($_POST['expiry_date_select']) && $_POST['expiry_date_select'] != $expiry_date_option) {
                        $expiry_date =  ($_POST['expiry_date_select'] === "NULL") ? NULL : date('Y-m-d', strtotime($_POST['expiry_date_select']) + 86400); //If NULL else, create new date from today.
                        $expiry_date_option = $_POST['expiry_date_select']; //Set new expiry_date_option.
                    }

                    $sql = "UPDATE`notices` SET `important` = :important, `title` = :title, `notice` = :notice, `expiry_date` = :expiry_date, `expiry_date_option` = :expiry_date_option
                            WHERE `id` = :notice_id AND `club_id` = :club_id";
                    $this->db->query($sql);
                    $this->db->bind(':notice_id', $notice_id);
                    $this->db->bind(':club_id', $club_id);
                    //TODO: Need to add event_id and expiry_date in to the $sql statement.
                    // $this->db->bind(':event_id', $_POST['event_id']);
                    $this->db->bind(':expiry_date', $expiry_date);
                    $this->db->bind(':expiry_date_option', $expiry_date_option);
                    $this->db->bind(':important', $important);
                    $this->db->bind(':title', $_POST['title']);
                    $this->db->bind(':notice', $_POST['notice']);

                    $data = [
                        'id' => $club_id,
                        'club_id' => $club_id,
                        'title' => $_POST['title'],
                        'notice' => $_POST['notice'],
                        'event_id' => $_POST['event_id'],
                        'expiry_date' => $_POST['expiry_date'],
                        'expiry_date_option' => $_POST['expiry_date_select'],
                        'important' => $important,
                        'title_err' => '',
                        'notice_err' => '',
                        'valid' => true
                    ];

                    if($this->db->execute()){
                        create_flash_message(strtolower(__CLASS__), "You have successfully edited the notice <b>{$data['title']}</b>.");
                    } else {
                        create_flash_message(strtolower(__CLASS__), "There was an error editing the notice <b>{$data['title']}</b>.", "danger");
                    }
                }
            }
        } else {
            // Notice doesn't exist within $club_id so redirect with failed_message.
            create_flash_message(strtolower(__CLASS__), "Notice doesn't exist.", "warning");
            redirect('notices', $club_id, true);
        }
        return $data;
    }


    public function delete($club_id, $notice_id) {

        //First get current notice data;
        $notice = new Self();
        $notice->getNotice($club_id, $notice_id);

        // If there is a notice with valid club_id and notice_id then get all the data.
        if ($notice->valid()) {
            $data = [
                'title' => $notice->title,
                'notice' => $notice->notice,
                'event_id' => $notice->event_id,
                'expiry_date' => $notice->expiry_date,
                'important' => $notice->important,
                'delete' => false
            ];

            // If SERVER REQUEST_METHOD is POST then confirm deletion was clicked.  So delete notice.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sql = "DELETE FROM `notices`
                        WHERE `id` = :notice_id AND `club_id` = :club_id";
                $this->db->query($sql);
                $this->db->bind(':notice_id', $notice_id);
                $this->db->bind(':club_id', $club_id);

                $data['delete'] = true;

                if($this->db->execute()){
                    create_flash_message(strtolower(__CLASS__), "Successfully deleted the notice <b>{$data['title']}</b>.");
                    redirect('notices', $club_id, true);
                } else {
                    create_flash_message(strtolower(__CLASS__), "Failed to delete the notice <b>{$data['title']}</b>.", "danger");
                    redirect('notices', $club_id, true);
                }
            }

            return $data;
        } else {
            // Notice doesn't exist within $club_id so redirect with failed_message.
            create_flash_message(strtolower(__CLASS__), "Notice doesn't exist.", "warning");
            redirect('notices', $club_id, true);
        }
    }
}