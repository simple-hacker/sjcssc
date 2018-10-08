<?php

class League {

    private $db;

    private $id;
    private $club_id;
    private $league;
    private $league_full;

    public function __construct() {
        $this->db = new Database;
    }

    public static function getClubLeagues($club_id) {
        if (isset($club_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `leagues` WHERE `club_id` = :club_id ORDER BY `league` ASC";
            $db->query($sql);
            $db->bind(':club_id', $club_id);
            return $db->results();
        } else {
            die('Did not supply $club_id with League::getClubLeagues');
        }
    }

    public static function getLeague($league_id) {
        if (isset($league_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `leagues` WHERE `id` = :league_id LIMIT 1";
            $db->query($sql);
            $db->bind(':league_id', $league_id);
            return $db->results();
        } else {
            die('Did not supply $league_id with League::getLeague');
        }
    }

}