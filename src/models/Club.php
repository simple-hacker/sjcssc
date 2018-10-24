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
        return $this->db->result();
    }

    public function getClubByID($club_id) {
        $sql = "SELECT * FROM `clubs` WHERE `id`= :club_id LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->result();
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
        $sql = "UPDATE `clubs` SET `name`=:name, `message`=:message WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['club']->id);
        $this->db->bind(':name', $data['club']->name);
        $this->db->bind(':message', $data['club']->message);
        $club = $this->db->execute();

        $addresses = $this->updateAddresses($data['club']->id, $data['addresses']);
        $emails = $this->updateEmails($data['club']->id, $data['emails']);
        $phone_numbers = $this->updatePhoneNumbers($data['club']->id, $data['phone_numbers']);
        $menu_links = $this->updateMenuLinks($data['club']->id, $data['menu_links']);
        $teams = $this->updateTeams($data['club']->id, $data['teams']);
        $leagues = $this->updateLeagues($data['club']->id, $data['leagues']);
        $venues = $this->updateVenues($data['club']->id, $data['venues']);

        // Returns true if all added successfully, else if one fails return false.
        return ($club && $addresses && $emails && $phone_numbers && $menu_links && $teams && $leagues && $venues);
    }

    private function updateAddresses($club_id, $addresses) {
        foreach ($addresses as $address) {
            if (!empty($address->id)) {
                if (!empty($address->address_title) && !empty($address->address)) {
                    // If ID, address_title and address are provided then UPDATE.
                    $sql = "UPDATE `addresses` SET `address_title`=:address_title, `address`=:address WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $address->id);
                    $this->db->bind(':address_title', $address->address_title);
                    $this->db->bind(':address', $address->address);
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
                $this->db->bind(':address_title', $address->address_title);
                $this->db->bind(':address', $address->address);
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
                    $this->db->bind(':email_title', $email->email_title);
                    $this->db->bind(':email', $email->email);
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
                $this->db->bind(':email_title', $email->email_title);
                $this->db->bind(':email', $email->email);
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
                    $this->db->bind(':phone_number_title', $phone_number->phone_number_title);
                    $this->db->bind(':phone_number', $phone_number->phone_number);
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
                $this->db->bind(':phone_number_title', $phone_number->phone_number_title);
                $this->db->bind(':phone_number', $phone_number->phone_number);
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
                    $this->db->bind(':menu_link_title', $menu_link->menu_link_title);
                    $this->db->bind(':menu_link', $menu_link->menu_link);
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
                $this->db->bind(':menu_link_title', $menu_link->menu_link_title);
                $this->db->bind(':menu_link', $menu_link->menu_link);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
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

    public function updateLeagues($club_id, $leagues) {
        foreach ($leagues as $league) {
            if (!empty($league->id)) {
                if (!empty($league->league)) {
                    // If ID and league are provided then UPDATE.
                    $sql = "UPDATE `leagues` SET `league`=:league, `league_full`=:league_full, `league_website`=:league_website WHERE `id`=:id";
                    $this->db->query($sql);
                    $this->db->bind(':id', $league->id);
                    $this->db->bind(':league', $league->league);
                    $this->db->bind(':league_full', $league->league_full);
                    $this->db->bind(':league_website', $league->league_website);
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
                $this->db->bind(':league', $league->league);
                $this->db->bind(':league_full', $league->league_full);
                $this->db->bind(':league_website', $league->league_website);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
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
                $this->db->bind(':venue', $venue->title);
                $this->db->bind(':location', $venue->location);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors with db, return true
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
                print_var($person);
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

}
