<?php 

class Event {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getEvents($club_id, $n = 0) {
        if (isset($club_id)) {
            $sql = "SELECT `events`.`id`, `events`.`club_id`, `events`.`event_id`, `events`.`created_date`, `events`.`title`, `events`.`date`, `events`.`time`, `events`.`location_id`, `venues`.`venue` as `venue`, `venues`.`location` as `location`, `events`.`meet_at`, `events`.`contact`, `events`.`other_information`
                    FROM `events`
                    LEFT JOIN `venues` ON `events`.`location_id`=`venues`.`id`
                    WHERE `events`.`club_id` = :club_id AND `date` >= DATE(NOW())
                    ORDER BY `events`.`date` ASC";
            
            if ($n > 0) {
                // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
                $sql .= " LIMIT 0, {$n}";
            }
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            return $this->db->results();
        } else {
            die('Did not supply $club_id when retrieving all events.');
        }
    }

    public function getEvent($club_id, $event_id) {
        if (isset($club_id) && isset($event_id)) {
            $sql = "SELECT `events`.`id`, `events`.`club_id`, `events`.`event_id`, `events`.`created_date`, `events`.`title`, `events`.`date`, `events`.`time`, `events`.`location_id`, `venues`.`venue` as `venue`, `venues`.`location` as `location`, `events`.`meet_at`, `events`.`contact`, `events`.`other_information`
                    FROM `events`
                    LEFT JOIN `venues` ON `events`.`location_id`=`venues`.`id`
                    WHERE `events`.`club_id` = :club_id AND `events`.`event_id` = :event_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':event_id', $event_id);
            return $this->db->result();
        } else {
            die('No club_id or event_id passed when retrieving an event');
        }
    }

    public function addEvent($club_id, $event) {
        $lastID = $this->getLastID($club_id);
        $sql = "INSERT INTO `events` (club_id, event_id, title, date, time, location_id, meet_at, contact, other_information) VALUES (:club_id, :event_id, :title, :date, :time, :location_id, :meet_at, :contact, :other_information)";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':event_id', $lastID + 1); // Get the lastest event ID of club and add 1.
        $this->db->bind(':title', $event->title);
        $this->db->bind(':date', $event->date);
        $this->db->bind(':time', $event->time);
        $this->db->bind(':location_id', $event->location_id);
        $this->db->bind(':meet_at', $event->meet_at);
        $this->db->bind(':contact', $event->contact);
        $this->db->bind(':other_information', $event->other_information);
        return $this->db->execute();
    }

    public function updateEvent($club_id, $event) {
        $sql = "UPDATE `events` SET `title`=:title, `date`=:date, `time`=:time, `location_id`=:location_id, `meet_at`=:meet_at, `contact`=:contact, `other_information`=:other_information WHERE `club_id`=:club_id AND `event_id`=:event_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':event_id', $event->event_id);
        $this->db->bind(':title', $event->title);
        $this->db->bind(':date', $event->date);
        $this->db->bind(':time', $event->time);
        $this->db->bind(':location_id', $event->location_id);
        $this->db->bind(':meet_at', $event->meet_at);
        $this->db->bind(':contact', $event->contact);
        $this->db->bind(':other_information', $event->other_information);
        return $this->db->execute();
    }

    public function deleteEvent($club_id, $event_id) {
        $sql = "DELETE FROM `events` WHERE `club_id`=:club_id AND `event_id`=:event_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':event_id', $event_id);
        return $this->db->execute();
    }

    private function getLastID($club_id) {
        $sql = "SELECT MAX(event_id) as lastID FROM `events` WHERE `club_id`=:club_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->result()->lastID;
    }

}