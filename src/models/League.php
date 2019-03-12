<?php 

class League {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getLeagues($club_id) {
        $sql = "SELECT * FROM `leagues` WHERE `club_id`=:club_id AND `isDeleted`=0 ORDER BY `league` ASC";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }

    public function updateLeagues($club_id, $leagues) {
        foreach ($leagues as $league) {
            if (!empty($league->id)) {
                if (!empty($league->league)) {
                    // If ID and league are provided then UPDATE.
                    $sql = "UPDATE `leagues` SET `league`=:league, `league_full`=:league_full, `league_website`=:league_website WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $league->id);
                    $this->db->bind(':league', trim($league->league));
                    $this->db->bind(':league_full', trim($league->league_full));
                    $this->db->bind(':league_website', trim($league->league_website));
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank league, so DELETE from database.
                    $sql = "DELETE FROM `leagues` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $league->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `leagues` (`club_id`, `league`, `league_full`, `league_website`) VALUES (:club_id, :league, :league_full, :league_website)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':league', trim($league->league));
                $this->db->bind(':league_full', trim($league->league_full));
                $this->db->bind(':league_website', trim($league->league_website));
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    public function deleteLeague($league_id) {
        if (isset($league_id)) {
            $sql = "UPDATE `leagues` SET `isDeleted`=1 WHERE `id`=:league_id";
            $this->db->query($sql);
            $this->db->bind(':league_id', $league_id);
            return $this->db->execute();
        } else {
            return false;
        }
    }

}