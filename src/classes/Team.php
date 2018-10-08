<?php

class Team {

    private $db;

    private $id;
    private $club_id;
    private $team;
    private $location;

    public function __construct() {
        $this->db = new Database;
    }

    public static function getClubTeams($club_id) {
        if (isset($club_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `teams` WHERE `club_id` = :club_id ORDER BY `team` ASC";
            $db->query($sql);
            $db->bind(':club_id', $club_id);
            return $db->results();
        } else {
            die('Did not supply $club_id with Team::getClubTeams');
        }
    }

    public static function getTeam($team_id) {
        if (isset($team_id)) {
            $db = new Database;
            $sql = "SELECT * FROM `teams` WHERE `id` = :team_id LIMIT 1";
            $db->query($sql);
            $db->bind(':team_id', $team_id);
            $result = $db->result();
            return $result->team;
        } else {
            die('Did not supply $team_id with Team::getTeam');
        }
    }

}