<?php 

class Outing {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getOuting($outing_id) {
        $sql = "SELECT `outings`.*, venues.venue AS venue, venues.location AS location FROM `outings`
                    LEFT JOIN venues ON `outings`.venue_id = venues.id
                    WHERE `outings`.id = :outing_id";
        $this->db->query($sql);
        $this->db->bind(':outing_id', $outing_id);
        return $this->db->result();
    }

    public function getOutings($n = 0) {
        $sql = "SELECT `outings`.*, venues.venue AS venue, venues.location AS location FROM `outings`
                    LEFT JOIN venues ON `outings`.venue_id = venues.id
                    ORDER BY `outings`.date DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        return $this->db->results();
    }

    public function addOuting($outing) {
        $sql = "INSERT INTO `outings` (title, date, time, venue_id, meet_at, contact, other_information) VALUES (:title, :date, :time, :venue_id, :meet_at, :contact, :other_information)";
        $this->db->query($sql);
        $this->db->bind(':title', $outing->title);
        $this->db->bind(':date', $outing->date);
        $this->db->bind(':time', $outing->time);
        $this->db->bind(':venue_id', $outing->venue_id);
        $this->db->bind(':meet_at', $outing->meet_at);
        $this->db->bind(':contact', $outing->contact);
        $this->db->bind(':other_information', $outing->other_information);
        return $this->db->execute();
    }

    public function updateOuting($outing) {
        $sql = "UPDATE `outings` SET `title`=:title, `date`=:date, `time`=:time, `venue_id`=:venue_id, `meet_at`=:meet_at, `contact`=:contact, `other_information`=:other_information WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $outing->id);
        $this->db->bind(':title', $outing->title);
        $this->db->bind(':date', $outing->date);
        $this->db->bind(':time', $outing->time);
        $this->db->bind(':venue_id', $outing->venue_id);
        $this->db->bind(':meet_at', $outing->meet_at);
        $this->db->bind(':contact', $outing->contact);
        $this->db->bind(':other_information', $outing->other_information);
        return $this->db->execute();
    }

    public function deleteOuting($outing_id) {
        $sql = "DELETE FROM `outings` WHERE `id`=:outing_id";
        $this->db->query($sql);
        $this->db->bind(':outing_id', $outing_id);
        return $this->db->execute();
    }

}