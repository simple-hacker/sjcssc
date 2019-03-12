<?php

Class Club {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getClubByName($club_name) {
        $sql = "SELECT * FROM `clubs` WHERE `club`= :club_name LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':club_name', $club_name);
        $club = $this->db->result();

        $club->menu_links = $this->getData('menu_links', $club->id);
        $club->addresses = $this->getData('addresses', $club->id);
        $club->emails = $this->getData('emails', $club->id);
        $club->phone_numbers = $this->getData('phone_numbers', $club->id);
        return $club;
    }

    public function getClubByID($club_id) {
        $sql = "SELECT * FROM `clubs` WHERE `id`= :club_id LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $club = $this->db->result();

        $club->menu_links = $this->getData('menu_links', $club->id);
        $club->addresses = $this->getData('addresses', $club->id);
        $club->emails = $this->getData('emails', $club->id);
        $club->phone_numbers = $this->getData('phone_numbers', $club->id);
        return $club;
    }

    public function getData($table, $club_id) {
        // Decided to pass table name and append to $sql rather than have individual functions for each data.
        $sql = "SELECT * FROM `". $table . "` WHERE `club_id`= :club_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->results();
    }
    
    public function getClubName($club_id) {
        $sql = "SELECT `club` FROM `clubs` WHERE `id`= :id";
        $this->db->query($sql);
        $this->db->bind(':id', $club_id);
        $result = $this->db->result();
        return strtolower($result->club);
    }

    public function getClubID($club_name) {
        $sql = "SELECT `id` FROM `clubs` WHERE `club`= :club_name";
        $this->db->query($sql);
        $this->db->bind(':club_name', $club_name);
        $result = $this->db->result();
        return $result->id;
    }

    public function updateClub($data) {
        $sql = "UPDATE `clubs` SET `name`=:name, `message`=:message, `team_id`=:team_id WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['club']->id);
        $this->db->bind(':name', trim($data['club']->name));
        $this->db->bind(':message', trim($data['club']->message));
        $this->db->bind(':team_id', $data['club']->team_id);
        $club = $this->db->execute();

        $this->updateHomeTeam($data['club']->id, $data['club']->team_id);

        $addresses = $this->updateAddresses($data['club']->id, $data['addresses']);
        $emails = $this->updateEmails($data['club']->id, $data['emails']);
        $phone_numbers = $this->updatePhoneNumbers($data['club']->id, $data['phone_numbers']);
        $menu_links = $this->updateMenuLinks($data['club']->id, $data['menu_links']);

        // Returns true if all added successfully, else if one fails return false.
        return ($club && $addresses && $emails && $phone_numbers && $menu_links);
    }

    private function updateHomeTeam($club_id, $team_id) {
        // First remove previous home_team values.
        $sql = "UPDATE `teams` SET `home_team`=0 WHERE `club_id`=:club_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        if (!$this->db->execute()) return false;
        // Next set new home_team = 1 to new team id.
        $sql = "UPDATE `teams` SET `home_team`=1 WHERE `club_id`=:club_id AND `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':id', $team_id);
        return $this->db->execute();
    }

    private function updateAddresses($club_id, $addresses) {
        foreach ($addresses as $address) {
            if (!empty($address->id)) {
                if (!empty($address->address_title) && !empty($address->address)) {
                    // If ID, address_title and address are provided then UPDATE.
                    $sql = "UPDATE `addresses` SET `address_title`=:address_title, `address`=:address WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $address->id);
                    $this->db->bind(':address_title', trim($address->address_title));
                    $this->db->bind(':address', trim($address->address));
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank address_title and address, so DELETE from database.
                    $sql = "DELETE FROM `addresses` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $address->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // NO ID, so insert new row.
                $sql = "INSERT INTO `addresses` (`club_id`, `address_title`, `address`) VALUES (:club_id, :address_title, :address)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':address_title', trim($address->address_title));
                $this->db->bind(':address', trim($address->address));
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    private function updateEmails($club_id, $emails) {
        foreach ($emails as $email) {
            if (!empty($email->id)) {
                if (!empty($email->email_title) && !empty($email->email)) {
                    // If ID, email_title and email are provided then UPDATE.
                    $sql = "UPDATE `emails` SET `email_title`=:email_title, `email`=:email WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $email->id);
                    $this->db->bind(':email_title', trim($email->email_title));
                    $this->db->bind(':email', trim($email->email));
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank email_title and email, so DELETE from database.
                    $sql = "DELETE FROM `emails` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $email->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `emails` (`club_id`, `email_title`, `email`) VALUES (:club_id, :email_title, :email)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':email_title', trim(trim(_title)));
                $this->db->bind(':email', trim($email->email));
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    private function updatePhoneNumbers($club_id, $phone_numbers) {
        foreach ($phone_numbers as $phone_number) {
            if (!empty($phone_number->id)) {
                if (!empty($phone_number->phone_number_title) && !empty($phone_number->phone_number)) {
                    // If ID, phone_number_title and phone_number are provided then UPDATE.
                    $sql = "UPDATE `phone_numbers` SET `phone_number_title`=:phone_number_title, `phone_number`=:phone_number WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $phone_number->id);
                    $this->db->bind(':phone_number_title', trim($phone_number->phone_number_title));
                    $this->db->bind(':phone_number', trim($phone_number->phone_number));
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank phone_number_title and phone_number, so DELETE from database.
                    $sql = "DELETE FROM `phone_numbers` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $phone_number->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `phone_numbers` (`club_id`, `phone_number_title`, `phone_number`) VALUES (:club_id, :phone_number_title, :phone_number)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':phone_number_title', trim($phone_number->phone_number_title));
                $this->db->bind(':phone_number', trim($phone_number->phone_number));
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }

    private function updateMenuLinks($club_id, $menu_links) {
        foreach ($menu_links as $menu_link) {
            if (!empty($menu_link->id)) {
                if (!empty($menu_link->menu_link_title) && !empty($menu_link->menu_link)) {
                    // If ID, menu_link_title and menu_link are provided then UPDATE.
                    $sql = "UPDATE `menu_links` SET `menu_link_title`=:menu_link_title, `menu_link`=:menu_link WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $menu_link->id);
                    $this->db->bind(':menu_link_title', trim($menu_link->menu_link_title));
                    $this->db->bind(':menu_link', trim($menu_link->menu_link));
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                } else {
                    // ID given but blank menu_link_title and menu_link, so DELETE from database.
                    $sql = "DELETE FROM `menu_links` WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $menu_link->id);
                    if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
                }
            } else {
                // Insert new row.
                $sql = "INSERT INTO `menu_links` (`club_id`, `menu_link_title`, `menu_link`) VALUES (:club_id, :menu_link_title, :menu_link)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':menu_link_title', trim($menu_link->menu_link_title));
                $this->db->bind(':menu_link', trim($menu_link->menu_link));
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
    }
}
