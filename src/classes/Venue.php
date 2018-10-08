<?php

class Venue {

    private $db;

    private $id;
    private $club_id;
    private $venue;
    private $location;

    public function __construct() {
        $this->db = new Database;
    }

    public static function getClubVenues($club_id) {
        if (isset($club_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `venues` WHERE `club_id` = :club_id ORDER BY `venue` ASC";
            $db->query($sql);
            $db->bind(':club_id', $club_id);
            return $db->results();
        } else {
            die('Did not supply $club_id with Venue::getClubVenues');
        }
    }

    public static function getVenue($venue_id) {
        if (isset($venue_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `venues` WHERE `id` = :venue_id LIMIT 1";
            $db->query($sql);
            $db->bind(':venue_id', $venue_id);
            return $db->results();
        } else {
            die('Did not supply $venue_id with Venue::getVenue');
        }
    }

}