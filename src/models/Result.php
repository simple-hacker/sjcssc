<?php 

class Result extends Controller {

    private $db;

    public function __construct() {
        $this->db = new Database;

        $this->clubModel = $this->model('Club');
    }

    public function getResults($club_id, $n = 0) {
        $club_name = $this->clubModel->getClubName($club_id);
        $table_name = 'fixtures_' . $club_name;
        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.venue_id = venues.id
                    WHERE {$table_name}.date <= DATE(NOW())
                    AND `publish_results` = true
                    ORDER BY {$table_name}.date DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        return $this->db->results();
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
        $sql = "SELECT {$table_name}.*, home_teams.team AS home_team, away_teams.team AS away_team, leagues.league AS league, venues.venue AS venue, venues.location AS location FROM {$table_name}
                    LEFT JOIN leagues ON {$table_name}.league_id = leagues.id
                    LEFT JOIN teams AS home_teams ON {$table_name}.home_team_id = home_teams.id
                    LEFT JOIN teams AS away_teams ON {$table_name}.away_team_id = away_teams.id
                    LEFT JOIN venues ON {$table_name}.venue_id = venues.id
                    WHERE {$table_name}.date <= DATE(NOW())
                    AND `publish_results` = false
                    ORDER BY {$table_name}.date DESC";
        $this->db->query($sql);
        return $this->db->results();
    }
}