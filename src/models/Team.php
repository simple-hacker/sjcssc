<?php 

class Team {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getTeams($club_id) {
        $sql = "SELECT * FROM `teams` WHERE `club_id`=:club_id ORDER BY `home_team` DESC, `team` ASC";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }

    public function updateTeams($club_id, $teams) {
        foreach ($teams as $team) {
            if (!empty($team->id)) {
                if (!empty($team->team)) {
                    // If ID and team are provided then UPDATE.
                    $sql = "UPDATE `teams` SET `team`=:team, `location`=:location WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $team->id);
                    $this->db->bind(':team', $team->team);
                    $this->db->bind(':location', $team->location);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank team, so DELETE from database.
                    $sql = "DELETE FROM `teams` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $team->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `teams` (`club_id`, `team`, `location`) VALUES (:club_id, :team, :location)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':team', $team->team);
                $this->db->bind(':location', $team->location);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    public function getTeamName($team_id) {
        $sql = "SELECT `team` FROM `teams` WHERE `id`=:team_id";
        $this->db->query($sql);
        $this->db->bind(':team_id', $team_id);
        return $this->db->result()->team;
    }

}