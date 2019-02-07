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

        public function addNotice($club_id, $notice) {
            $lastID = $this->getLastID($club_id);
            $sql = "INSERT INTO `notices` (club_id, notice_id, expiry_date, expiry_date_option, important, title, notice) VALUES (:club_id, :notice_id, :expiry_date, :expiry_date_option, :important, :title, :notice)";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':notice_id', $lastID + 1);
            $this->db->bind(':expiry_date', $notice->expiry_date);
            $this->db->bind(':expiry_date_option', $notice->expiry_date_option);
            $this->db->bind(':important', $notice->important);
            $this->db->bind(':title', $notice->title);
            $this->db->bind(':notice', $notice->notice);
            return $this->db->execute();
        }

        public function updateNotice($club_id, $notice) {

            $expiry_date = $this->createNewExpiryDate($club_id, $notice->notice_id, $notice->expiry_date_option);

            $sql = "UPDATE `notices` SET `expiry_date`=:expiry_date, `expiry_date_option`=:expiry_date_option, `important`=:important, `title`=:title, `notice`=:notice WHERE `club_id`=:club_id AND `notice_id`=:notice_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':notice_id', $notice->notice_id);
            $this->db->bind(':expiry_date', $expiry_date);
            $this->db->bind(':expiry_date_option', $notice->expiry_date_option);
            $this->db->bind(':important', $notice->important);
            $this->db->bind(':title', $notice->title);
            $this->db->bind(':notice', $notice->notice);
            return $this->db->execute();
        }

        public function deleteNotice($club_id, $notice_id) {
            $sql = "DELETE FROM `notices` WHERE `club_id`=:club_id AND `notice_id`=:notice_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':notice_id', $notice_id);
            return $this->db->execute();
        }

        private function getLastID($club_id) {
            $sql = "SELECT MAX(notice_id) as lastID FROM `notices` WHERE `club_id`=:club_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            return $this->db->result()->lastID;
        }

        private function createNewExpiryDate($club_id, $notice_id, $expiry_date_option) {
            // First get notice's created by date.
            $sql = "SELECT `created_date` FROM `notices` WHERE `club_id`=:club_id AND `notice_id`=:notice_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':notice_id', $notice_id);
            $created_date = $this->db->result()->created_date;
            // Add expiry_date_option on to created_date and return it
            return date("Y-m-d", strtotime($expiry_date_option, strtotime($created_date) + 86400));
        }

        public function toggleImportant($club_id, $notice_id) {
            $sql = "UPDATE `notices` SET `important`= NOT `important` WHERE `club_id`=:club_id AND `notice_id`=:notice_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':notice_id', $notice_id);
            return $this->db->execute();
        }
    }