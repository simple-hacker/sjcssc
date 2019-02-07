<?php 

class People {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPeople($club_id) {
        $sql = "SELECT * FROM `people` WHERE `club_id`=:club_id AND `isDeleted`=0 ORDER BY `name` ASC";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }

    public function getPerson($club_id, $name) {
        $sql = "SELECT * FROM `people` WHERE `club_id`=:club_id AND `name`=:name LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':name', $name);
        return $this->db->result();
    }

    public function updatePeople($club_id, $people) {
        foreach ($people as $person) {
            if (!empty($person->id)) {
                if (!empty($person->name)) {
                    // If ID and person are provided then UPDATE.
                    $sql = "UPDATE `people` SET `name`=:name, `email`=:email, `active`=:active WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $person->id);
                    $this->db->bind(':name', $person->name);
                    $this->db->bind(':email', $person->email);
                    $this->db->bind(':active', $person->active);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank person, so DELETE from database.
                    $sql = "DELETE FROM `people` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $person->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `people` (`club_id`, `name`, `email`, `active`) VALUES (:club_id, :name, :email, :active)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':name', $person->name);
                $this->db->bind(':email', $person->email);
                $this->db->bind(':active', $person->active);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    public function deletePeople($person_id) {
        if (isset($person_id)) {
            // Don't want to delete people as it affects historical data.
            $sql = "UPDATE `people` SET `isDeleted`=1 WHERE `id`=:person_id";
            $this->db->query($sql);
            $this->db->bind(':person_id', $person_id);
            return $this->db->execute();
        } else {
            return false;
        }
    }

    public function toggleActive($club_id, $person_id) {
        $sql = "UPDATE `people` SET `active`= NOT `active` WHERE `club_id`=:club_id AND `id`=:person_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':person_id', $person_id);
        return $this->db->execute();
    }

}