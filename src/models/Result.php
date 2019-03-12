<?php 

class Result extends Controller {

    private $db;

    public function __construct() {
        $this->db = new Database;

        $this->clubModel = $this->model('Club');
        $this->fixtureModel = $this->model('Fixture');
    }

    public function getResult($club_id, $result_id) {
        $club_name = $this->clubModel->getClubName($club_id);
        $table_name = 'fixtures_' . $club_name;
        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    WHERE {$table_name}.`id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $result_id);
        $result = $this->db->result();
        // If fixture exists then try and get the squad too.
        if ($result) {
            $result->squad = $this->fixtureModel->getSquad($club_id, $result->id);
            if (!empty($result->squad[0])) {
                $result->substitutes = !empty($result->squad[0]) ? implode(", ", $result->squad[0]) : '';
                unset($result->squad[0]); // Remove 0 index which are substitutes.
            }
        }

        // Edit result before returning.
        
        return $result;
    }

    public function getResults($club_id, $n = 0, $all_results = false) {
        $club_name = $this->clubModel->getClubName($club_id);
        $table_name = 'fixtures_' . $club_name;
        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    WHERE {$table_name}.date <= DATE(NOW())";
        if ($all_results == false) {
            $sql .= " AND publish_results = true";
        }
        $sql .= " ORDER BY {$table_name}.date DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        $results = $this->db->results();

        // Edit results before returning.

        return $results;
    }

    public function updateResult($club_name, $result) {
        $table_name = 'fixtures_' . $club_name;
        $arr_length = count(CLUBS[$club_name]['results']['fields']);
        // Loop through CLUBS results fields and create SQL statement.
        $sql = "UPDATE {$table_name} SET ";
        foreach (CLUBS[$club_name]['results']['fields'] as $i => $field) {
            $sql .= "{$field['name']}=:{$field['name']}, ";
        }
        $sql .= "`publish_results`=:publish_results WHERE `id`=:id";

        $this->db->query($sql);
        // Now bind all the elements.
        foreach (CLUBS[$club_name]['results']['fields'] as $field) {
            $this->db->bind(':' . $field['name'], $result->{$field['name']});
        }
        $this->db->bind(':publish_results', true);
        $this->db->bind(':id', $result->id);
        return $this->db->execute();
    }

    public function getUnpublishedResults($club_name) {
        $table_name = 'fixtures_' . $club_name;
        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    WHERE {$table_name}.date <= DATE(NOW())
                    AND `publish_results` = false
                    ORDER BY {$table_name}.date ASC";
        $this->db->query($sql);
        $results = $this->db->results();

        // Edit results before returning.

        return $results;
    }
}