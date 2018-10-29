<?php 

class Fixture extends Controller {

    private $db;

    public function __construct() {
        $this->db = new Database;

        $this->peopleModel = $this->model('People');
    }

    public function getFixtures($club_name, $n = 0) {
        // Need to get table name.
        $table_name = 'fixtures_' . $club_name;

        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.venue_id = venues.id
                    WHERE {$table_name}.date >= DATE(NOW())
                    ORDER BY {$table_name}.date DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        return $this->db->results();
    }

    public function getFixture($club_id, $club_name, $fixture_id) {
        // Need to get table name.
        $table_name = 'fixtures_' . $club_name;

        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.venue_id = venues.id
                    WHERE {$table_name}.id = :fixture_id";
        $this->db->query($sql);
        $this->db->bind(':fixture_id', $fixture_id);
        $fixture = $this->db->result();
        // If fixture exists then try and get the squad too.
        if ($fixture) {
            $fixture->squad = $this->getSquad($club_id, $fixture->id);
            $fixture->substitutes = !empty($fixture->squad[0]) ? implode(", ", $fixture->squad[0]) : '';
        }
        return $fixture;
    }

    private function getSquad($club_id, $fixture_id) {
        if (isset($club_id) && isset($fixture_id)) {
            $sql = "SELECT squads.club_id, squads.fixture_id, squads.position_id, squads.name_id, people.name FROM `squads`
                    INNER JOIN people
                    ON squads.club_id = people.club_id AND squads.name_id = people.id
                    WHERE squads.club_id = :club_id AND squads.fixture_id = :fixture_id
                    ORDER BY squads.position_id ASC, people.name ASC";

            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':fixture_id', $fixture_id);
            $squad_data = $this->db->results();
            $squad = array();
            foreach ($squad_data as $name_data) {
                // As we loop through, if we've got a new position, we need to create an array for
                // name_data to push the names in to.
                if (!isset($squad[$name_data->position_id])) {
                    $squad[$name_data->position_id] = array();
                }
                // Push the name in to the name_data array at the position index of the squad array.
                array_push($squad[$name_data->position_id], $name_data->name);
            }
            return $squad;
        } else {
            die('No club_id or fixture_id when retreiving squad.');
        }
    }

    public function addFixture($club_id, $club_name, $fixture) {
        $table_name = 'fixtures_' . $club_name;
        $sql = "INSERT INTO {$table_name} (home_team_id, away_team_id, league_id, date, time, venue_id, meet_at, contact, other_information) VALUES (:home_team_id, :away_team_id, :league_id, :date, :time, :venue_id, :meet_at, :contact, :other_information)";
        $this->db->query($sql);
        $this->db->bind(':home_team_id', $fixture->home_team_id);
        $this->db->bind(':away_team_id', $fixture->away_team_id);
        $this->db->bind(':league_id', $fixture->league_id);
        $this->db->bind(':date', $fixture->date);
        $this->db->bind(':time', $fixture->time);
        $this->db->bind(':venue_id', $fixture->venue_id);
        $this->db->bind(':meet_at', $fixture->meet_at);
        $this->db->bind(':contact', $fixture->contact);
        $this->db->bind(':other_information', $fixture->other_information);
        $fixture_exec = $this->db->execute();
        $fixture_id = $this->db->lastInsertId();

        return ($fixture_exec && $this->saveSquad($club_id, $fixture_id, $fixture->squad));
    }

    public function saveSquad($club_id, $fixture_id, $squad) {
        // Loop through all Squads input boxes.
        foreach ($squad as $position_id => $position) {
            // Each position of squads will have names like Michael Perks, Philip Perks, Jackie Chan etc. for Bowls as you can have multiple names in each Rink.
            // Sports like Rugby and Football will only have one name per position.
            // Explode each $position in to names, this works with even one name anyway.
            $names = (empty($position)) ? [] : explode(',', $position);  // If position is left blank, don't explode otherwise loop still runs once.

            foreach ($names as $name) {
                // Check if name exists first.
                // If it does return the id of name
                // Else add the name and set name_id to the lastInsertId.
                $name = trim($name);
                $person = $this->peopleModel->getPerson($club_id, $name);

                if ($person) {
                    $name_id = $person->id;
                } else {
                    $sql = "INSERT INTO `people` (club_id, name) VALUES (:club_id, :name)";
                    $this->db->query($sql);
                    $this->db->bind(':club_id', $club_id);
                    $this->db->bind(':name', $name);
                    if ($this->db->execute()) {
                        $name_id = $this->db->lastInsertId();
                    } else {
                        return false; // There was an error adding a name, so reutnr false and break adding new fixture.
                    }
                }
                // Now need to add row to squads.
                // Pass club_id, fixture_id, $position_id and $name_id we've just received.
                $sql = "INSERT INTO `squads` (club_id, fixture_id, position_id, name_id) VALUES (:club_id, :fixture_id, :position_id, :name_id)";
                $this->db->query($sql);
                $this->db->bind(':club_id', $club_id);
                $this->db->bind(':fixture_id', $fixture_id);
                $this->db->bind(':position_id', $position_id);
                $this->db->bind(':name_id', $name_id);
                if (!$this->db->execute()) return false; // If sql fails for some reason return false otherwise continue with loop.
            }
        }
        return true; // Else no errors adding to db so return success.
    }

    public function updateFixture($club_id, $club_name, $fixture) {
        $table_name = 'fixtures_' . $club_name;
        $sql = "UPDATE {$table_name} SET `home_team_id`=:home_team_id, `away_team_id`=:away_team_id, `league_id`=:league_id, `date`=:date, `time`=:time, `venue_id`=:venue_id, `meet_at`=:meet_at, `contact`=:contact, `other_information`=:other_information WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $fixture->id);
        $this->db->bind(':home_team_id', $fixture->home_team_id);
        $this->db->bind(':away_team_id', $fixture->away_team_id);
        $this->db->bind(':league_id', $fixture->league_id);
        $this->db->bind(':date', $fixture->date);
        $this->db->bind(':time', $fixture->time);
        $this->db->bind(':venue_id', $fixture->venue_id);
        $this->db->bind(':meet_at', $fixture->meet_at);
        $this->db->bind(':contact', $fixture->contact);
        $this->db->bind(':other_information', $fixture->other_information);
        $fixture_exec = $this->db->execute();
        // Update Squad too
        // Easiest way is to just delete the squad in db first, then use the same saveSquad function.
        $sql = "DELETE FROM `squads` WHERE `club_id`=:club_id AND `fixture_id`=:fixture_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':fixture_id', $fixture->id);
        if (!$this->db->execute()) return false;
        // Save new squad.
        return ($fixture_exec && $this->saveSquad($club_id, $fixture->id, $fixture->squad));
    }

    public function deleteFixture($club_id, $club_name, $fixture_id) {
        $squad = $this->deleteSquad($club_id, $fixture_id);
        $table_name = 'fixtures_' . $club_name;
        $sql = "DELETE FROM `{$table_name}` WHERE `id`=:fixture_id";
        $this->db->query($sql);
        $this->db->bind(':fixture_id', $fixture_id);
        return ($this->db->execute() && $squad);
    }

    public function deleteSquad($club_id, $fixture_id) {
        $sql = "DELETE FROM `squads` WHERE `club_id`=:club_id AND `fixture_id`=:fixture_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':fixture_id', $fixture_id);
        return $this->db->execute();
    }
}