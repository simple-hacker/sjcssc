<?php

// TODO: Maybe don't need to require Event?
require_once('Event.php');

Class Outing extends Event {

     public function __construct($id) {

        $this->db = new Database;

        if (isset($id)) {
            $outing = $this->getOuting($id);
            $this->id = $outing->id;
            $this->created_date = $outing->created_date;
            $this->title = $outing->title;
            $this->date = $outing->date;
            $this->time = $outing->time;
            $this->location = $outing->location;
            $this->meet_at = $outing->meet_at;
            $this->contact = $outing->contact;
            $this->information = $outing->information;
        } else {
            die('No id passed when creating an outing.');
        }
    }

    private function getOuting($id) {
        $sql = "SELECT * FROM `outings` WHERE `id`= :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public static function getOutings($club_name, $n = 0) {
        // Need to have argument $club_name even though we don't use it, that's because we need it when calling getFixtures method, but on Fixtures we have
        // $fixtures = $class_name::$method_name($club->club, $num_fixtures);
        // But we don't know if it's a Fixture or an Outing.
        $db = new Database;
        $sql = "SELECT * FROM `outings` WHERE `date` >= DATE(NOW()) ORDER BY `date` DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $db->query($sql);
        return $db->results();
    }
}