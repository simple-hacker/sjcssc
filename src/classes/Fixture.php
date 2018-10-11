<?php

Class Fixture {

    public $id;
    public $created_date;

    public $home_team_id;
    public $home_team;
    public $away_team_id;
    public $away_team;
    public $league_id;
    public $league;
    
    public $date;
    public $time;
    public $location_id;
    public $venue;
    public $location;
    public $meet_at;
    public $contact;
    public $information;

    public $squad;


    public function __construct() {
        $this->db = new Database;
    }

    public function getFixture($club_id, $fixture_id) {

        $table_name = 'fixtures_' . Club::getClubName($club_id);

        if (isset($fixture_id)) {

            $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.location_id = venues.id
                    WHERE {$table_name}.id = :id";

            $this->db->query($sql);
            $this->db->bind(':id', $fixture_id);
            $fixture = $this->db->result();

            if ($fixture) {
                $this->id = $fixture->id;
                $this->created_date = $fixture->created_date;

                $this->home_team_id = $fixture->home_team_id;
                $this->home_team = $fixture->home_team;
                $this->away_team_id = $fixture->away_team_id;
                $this->away_team = $fixture->away_team;
                $this->league_id = $fixture->league_id;
                $this->league = $fixture->league;
                
                $this->date = $fixture->date;
                $this->time = $fixture->time;
                $this->location_id = $fixture->location_id;
                $this->venue = $fixture->venue;
                $this->location = $fixture->location;
                $this->meet_at = $fixture->meet_at;
                $this->contact = $fixture->contact;
                $this->other_information = $fixture->other_information;

                $this->squad = $this->getSquad($club_id, $fixture_id);

                
            } else {
                // Redirect to dashboard instead because the user tried changing the URL to edit a different club.
                create_flash_message("dashboard", "Failed to retrieve the selected fixture.", "danger");
                // redirect('dashboard', $club_id, true);
            }
        } else {
            die('No id passed when creating an fixture.');
        }
    }

    private function getSquad($club_id, $fixture_id) {
        if (isset($club_id) && isset($fixture_id)) {
            $sql = "SELECT squad.club_id, squad.fixture_id, squad.position_id, squad.name_id, people.name FROM `squad`
                    INNER JOIN people
                    ON squad.club_id = people.club_id AND squad.name_id = people.id
                    WHERE squad.club_id = :club_id AND squad.fixture_id = :fixture_id
                    ORDER BY squad.position_id ASC, people.name ASC";

            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':fixture_id', $fixture_id);
            
            // return $this->db->results();
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

    public static function getFixtures($club_id, $n = 0) {
        if (isset($club_id)) {
            $db = new Database;

            $table_name = 'fixtures_' . Club::getClubName($club_id);
            
            // $sql = "SELECT * FROM `fixtures_" . $club_name . "` WHERE `date` >= DATE(NOW()) ORDER BY `date` DESC";
            $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.location_id = venues.id
                    WHERE {$table_name}.date >= DATE(NOW())
                    ORDER BY {$table_name}.date DESC";

            if ($n > 0) {
                // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
                $sql .= " LIMIT 0, {$n}";
            }
            $db->query($sql);
            return $db->results();
        } else {
            die('Did not supply $club_id with Fixture::getFixtures.');
        }
    }

    public function valid() {
        return (isset($fixture->id)); 
    }

    public function add($club_id) {
        // First check if form was actually submitted.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $club_name = Club::getClubName($club_id);
            $squad = [];
            // $reserves_name = CLUBS[$club_name]['fixtures']['squad']['reserves'];
            // $position_name = CLUBS[$club_name]['fixtures']['squad']['position'];
            // $position_count = CLUBS[$club_name]['fixtures']['fields'][$position_name]['count'];
            // $squad[0] = $_POST[$reserves_name];


            $data = [
                'home_team_id' => $_POST['home_team'],
                'away_team_id' => $_POST['away_team'],
                'league_id' => $_POST['league'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'location_id' => $_POST['location'],
                'meet_at' => $_POST['meet_at'],
                'contact' => $_POST['contact'],
                'other_information' => $_POST['other_information'],
                'squad' => $squad,
                'team_err' => '',
                'date_err' => '',
                'location_err' => '',
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // TODO: Need to make valid true
                // 'valid' => true,
                'valid' => false,
                'home_team' => Team::getTeam($_POST['home_team']), // Needed for the create_flash_message because we only know the id, not the actual team name.
                'away_team' => Team::getTeam($_POST['away_team'])
            ];

            printVar($data);

            // Validation
            // TODO: More validation.  Date, time etc.
            if (empty($_POST['home_team']) || empty($_POST['away_team'])) {
                $data['team_err'] = "Please makes sure you select both home team and away team.";
                $data['valid'] = false;
            }
            
            if ($data['valid']) {
                if (isset($club_id)) {
                    $table_name = 'fixtures_' . Club::getClubName($club_id);

                    $sql = "INSERT INTO `{$table_name}` (home_team_id, away_team_id, league_id, date, time, location_id, meet_at, contact, other_information)
                    VALUES (:home_team_id, :away_team_id, :league_id, :date, :time, :location_id, :meet_at, :contact, :other_information)";

                    $this->db->query($sql);
                    $this->db->bind(':home_team_id', $data['home_team_id']);
                    $this->db->bind(':away_team_id', $data['away_team_id']);
                    $this->db->bind(':league_id', $data['league_id']);
                    $this->db->bind(':date', $data['date']);
                    $this->db->bind(':time', $data['time']);
                    $this->db->bind(':location_id', $data['location_id']);
                    $this->db->bind(':meet_at', $data['meet_at']);
                    $this->db->bind(':contact', $data['contact']);
                    $this->db->bind(':other_information', $data['other_information']);

                    if($this->db->execute()){
                        create_flash_message(strtolower(__CLASS__), "Successfully added the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.");
                        redirect('fixtures', $club_id, true);
                    } else {
                        create_flash_message(strtolower(__CLASS__), "Failed to add the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.", "danger");
                    }
                } else {
                    die('Did not pass $club_id when adding a fixture.');
                }                
            } else {
                create_flash_message(strtolower(__CLASS__), "Failed to add fixture.  Please check all data is valid.", "danger");
            }
           
            return $data;
        }
    }

    public function edit($club_id, $fixture_id) {
        // First get current fixture data;
        $fixture = new Self();
        $fixture->getFixture($club_id, $fixture_id);

        // This is the current data stored in the database.
        $data = [
            'home_team_id' => $fixture->home_team_id,
            'away_team_id' => $fixture->away_team_id,
            'league_id' => $fixture->league_id,
            'date' => $fixture->date,
            'time' => $fixture->time,
            'location_id' => $fixture->location_id,
            'meet_at' => $fixture->meet_at,
            'squad' => $fixture->squad,
            'contact' => $fixture->contact,
            'other_information' => $fixture->other_information,
            'team_err' => '',
            'date_err' => '',
            'location_err' => '',
            'valid' => true,
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Validation
            // TODO: More validation.  Date, time etc.
            // TODO: Put validation in one function and pass $_POST instead?
            if (empty($_POST['home_team']) || empty($_POST['away_team'])) {
                $data['team_err'] = "Please makes sure you select both home team and away team.";
                $data['valid'] = false;
            }

            if ($data['valid']) {
                if (isset($club_id) && isset($fixture_id)) {

                    $table_name = 'fixtures_' . Club::getClubName($club_id);
                    $sql = "UPDATE `{$table_name}`
                            SET `home_team_id` = :home_team_id, `away_team_id` = :away_team_id, `league_id` = :league_id, `date` = :date, `time` = :time, `location_id` = :location_id, `meet_at` = :meet_at, `contact` = :contact, `other_information` = :other_information
                            WHERE id = :fixture_id";

                    $this->db->query($sql);
                    $this->db->bind(':fixture_id', $fixture_id);
                    $this->db->bind(':home_team_id', $_POST['home_team']);
                    $this->db->bind(':away_team_id', $_POST['away_team']);
                    $this->db->bind(':league_id', $_POST['league']);
                    $this->db->bind(':date', $_POST['date']);
                    $this->db->bind(':time', $_POST['time']);
                    $this->db->bind(':location_id', $_POST['location']);
                    $this->db->bind(':meet_at', $_POST['meet_at']);
                    // TODO:  Squad and Reserves
                    $this->db->bind(':contact', $_POST['contact']);
                    $this->db->bind(':other_information', $_POST['other_information']);

                    // If SERVER REQUEST METHOD is POST then a new form has been submitted,
                    // So need to update $data with new values from the POST form.
                    $data = [
                        'home_team_id' => $_POST['home_team'],
                        'away_team_id' => $_POST['away_team'],
                        'league_id' => $_POST['league'],
                        'date' => $_POST['date'],
                        'time' => $_POST['time'],
                        'location_id' => $_POST['location'],
                        'meet_at' => $_POST['meet_at'],
                        'contact' => $_POST['contact'],
                        'other_information' => $_POST['other_information'],
                        'team_err' => '',
                        'date_err' => '',
                        'location_err' => '',
                        'valid' => true,
                        'home_team' => Team::getTeam($_POST['home_team']), // Needed for the create_flash_message because we only know the id, not the actual team name.
                        'away_team' => Team::getTeam($_POST['away_team'])
                    ];

                    if($this->db->execute()){
                        create_flash_message(strtolower(__CLASS__), "Successfully edited the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.");
                    } else {
                        create_flash_message(strtolower(__CLASS__), "Failed to edit the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.", "danger");
                    }
                } else {
                    die('Did not pass $club_id pr $fixture_id when editing a fixture.');
                }                
            } else {
                create_flash_message(strtolower(__CLASS__), "Failed to add fixture.  Please check all data is valid.", "danger");
            }
        }

        return $data;
    }
    
    public function delete($club_id, $fixture_id) {
        // First get current fixture data;
        $fixture = new Self();
        $fixture->getFixture($club_id, $fixture_id);

        if ($fixture->valid()) {
            // This is the current data stored in the database.
            $data = [
                'home_team_id' => $fixture->home_team_id,
                'away_team_id' => $fixture->away_team_id,
                'home_team' => Team::getTeam($fixture->home_team_id), // Needed for the create_flash_message because we only know the id, not the actual team name.
                'away_team' => Team::getTeam($fixture->away_team_id)
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $table_name = 'fixtures_' . Club::getClubName($club_id);
                $sql = "DELETE FROM `{$table_name}`
                        WHERE id = :fixture_id";

                $this->db->query($sql);
                $this->db->bind(':fixture_id', $fixture_id);

                if($this->db->execute()){
                    create_flash_message(strtolower(__CLASS__), "Successfully deleted the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.");
                    redirect('fixtures', $club_id, true);
                } else {
                    create_flash_message(strtolower(__CLASS__), "Failed to delete the fixture <b>{$data['home_team']} v {$data['away_team']}</b>.", "danger");
                    redirect('fixtures', $club_id, true);
                }            
            }
            return $data;
        } else {
            // Fixture doesn't exist so redirect with failed_message.
            create_flash_message(strtolower(__CLASS__), "Fixture doesn't exist.", "warning");
            redirect('fixtures', $club_id, true);
        }
    }
}