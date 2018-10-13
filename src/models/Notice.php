<?php

    class Notice {

        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getNotices($club_id, $n = 0) {
            if (isset($club_id)) {
                // Only select notices without an expiry date and where the current date is before the expiiry date.
                $sql = "SELECT * FROM `notices` WHERE `club_id`= :club_id AND (DATE(NOW()) <= `expiry_date` OR `expiry_date` IS NULL) ORDER BY  `important` DESC, `created_date` DESC";
                if ($n > 0) {
                    // To prevent negative numbers.  If n isn't provided then get unlimited notices, else only return n notices.
                    $sql .= " LIMIT 0, {$n}";
                }
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                return $this->db->results();
            } else {
                die('Did not supply $club_id when retrieving all notices.');
            }
        }

        public function getNotice($club_id, $notice_id) {
            if (isset($club_id) && isset($notice_id)) {
                $sql = "SELECT * FROM `notices` WHERE `club_id` = :club_id AND `notice_id`= :notice_id";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':notice_id', $notice_id);
                return $this->db->result();
            } else {
                die('No club_id or notice_id passed when retrieving a notice');
            }
        }


        // TODO: ADD NOTICE TO DATABASE, NEW COLUMN NOTICE_ID
        // Need to find last notice_id for the CLUB and +1
    }