<?php 

class Venue {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getVenues($club_id) {
        $sql = "SELECT * FROM `venues` WHERE `club_id`=:club_id AND `isDeleted`=0 ORDER BY `venue` ASC";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }

    public function updateVenues($club_id, $venues) {
        foreach ($venues as $venue) {
            if (!empty($venue->id)) {
                if (!empty($venue->venue)) {
                    // If ID and venue are provided then UPDATE.
                    $sql = "UPDATE `venues` SET `venue`=:venue, `location`=:location WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $venue->id);
                    $this->db->bind(':venue', $venue->venue);
                    $this->db->bind(':location', $venue->location);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank venue, so DELETE from database.
                    $sql = "DELETE FROM `venues` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $venue->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `venues` (`club_id`, `venue`, `location`) VALUES (:club_id, :venue, :location)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':venue', $venue->venue);
                $this->db->bind(':location', $venue->location);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    public function deleteVenue($venue_id) {
        if (isset($venue_id)) {
            $sql = "UPDATE `venues` SET `isDeleted`=1 WHERE `id`=:venue_id";
            $this->db->query($sql);
            $this->db->bind(':venue_id', $venue_id);
            return $this->db->execute();
        } else {
            return false;
        }
    }

}