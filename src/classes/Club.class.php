<?php

Class Club {

    private $db;

    public $id;
    public $club = '';
    public $name = '';
    public $message = '';
    public $menu_links = [];
    public $phone_numbers = [];
    public $emails = [];
    public $addresses = [];

    public function __construct($club) {

        $this->db = new Database;

        if (isset($club)) {
            // Get basic club info before everything else.
            $club_info = $this->getClub($club);
            $this->id = $club_info->id;
            $this->club = $club_info->club;
            $this->name = $club_info->name;
            $this->message = $club_info->message;
            // Get rest of club data using club_id
            $this->menu_links = $this->getData('menu_links', $this->id);
            $this->phone_numbers = $this->getData('phone_numbers', $this->id);
            $this->emails = $this->getData('emails', $this->id);
            $this->addresses = $this->getData('addresses', $this->id);
        } else {
            die ('Fatal error.  Did not supply $club on Club __construct.');
        }
    }

    private function getClub($club) {
        $sql = "SELECT * FROM `clubs` WHERE `club`= :club";
        $this->db->query($sql);
        $this->db->bind(':club', $club);
        return $this->db->result();
    }

    private function getData($table, $club_id) {
        // Decided to pass table name and append to $sql rather than have individual functions for each data.
        $sql = "SELECT * FROM `". $table . "` WHERE `club_id`= :club_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }
    
    public static function getClubName($club_id) {
        $db = new Database;
        $sql = "SELECT `club` FROM `clubs` WHERE `id`= :id";
        $db->query($sql);
        $db->bind(':id', $club_id);
        $result = $db->result();
        return strtolower($result->club);
    }

    public static function getClubID($club_name) {
        $db = new Database;
        $sql = "SELECT `id` FROM `clubs` WHERE `club`= :club_name";
        $db->query($sql);
        $db->bind(':club_name', $club_name);
        $result = $db->result();
        return $result->id;
    } 

}
