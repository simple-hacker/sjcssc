<?php 

class Report extends Controller {

    private $db;

    public function __construct() {
        $this->db = new Database;

        $this->clubModel = $this->model('Club');
    }

    public function getReport($report_id) {
        $sql = "SELECT `outings`.* FROM `outings`
                    WHERE `outings`.id = :id
                    AND `publish_report` = true
                    ORDER BY `date` DESC";
        $this->db->query($sql);
        $this->db->bind(':id', $report_id);
        $report = $this->db->result();

        // Edit report before returning

        return $report;
    }

    public function getReports($club_id, $n = 0, $all_reports = false, $season = 0) {
        $club_name = $this->clubModel->getClubName($club_id);
        $dates = array();

        if (isset(CLUBS[$club_name]['season'])) {
            $season_data = CLUBS[$club_name]['season'];
            $current_year = date("Y");
            if ($season == 0 || $season == $current_year) {
                $create_date = new DateTime($season_data['start_date'] . " " . $current_year);
                $date = date_format($create_date, "Y-m-d H:i:s");
                $now = date("Y-m-d H:i:s");
                if ($date < $now) {
                    $dates = [$date, date("Y-m-d H:i:s", strtotime($date . " +1 year -1 second"))];
                } else {
                    $dates = [date("Y-m-d H:i:s", strtotime($date . " -1 year")), date("Y-m-d H:i:s", strtotime($date . " -1 second"))];
                }
            } else {
                $season = ($season < $season_data['start_year']) ? $season_data['start_year'] : (int) $season;
                $create_date = new DateTime($season_data['start_date'] . " " . $season);
                $date = date_format($create_date, "Y-m-d H:i:s");
                $dates = [$date, date("Y-m-d H:i:s", strtotime($date . " +1 year -1 second"))];
            }
        } else {
            die('<strong>Fatal Error:</strong> Club\'s season configuration is not set.');
        }

        $sql = "SELECT * FROM `outings`
                    WHERE `date` >= :date_from AND `date` <= :date_to AND `date` <= DATE(NOW())";
        if ($all_reports == false) {
            $sql .= " AND publish_report = true";
        }
        $sql .= " ORDER BY `date` DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        $this->db->bind(':date_from', $dates[0]);
        $this->db->bind(':date_to', $dates[1]);
        $reports = $this->db->results();

        // Edit reports before returning.

        return $reports;
    }

    public function updateReport($report) {
        $sql = "UPDATE `outings` SET `report`=:report, `publish_report`=:publish_report WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $report->id);
        $this->db->bind(':report', trim($report->report));
        $this->db->bind(':publish_report', true);
        return $this->db->execute();
    }

    public function getUnpublishedReports($club_name) {
        $sql = "SELECT * FROM `outings`
                    WHERE `date` <= DATE(NOW())
                    AND `publish_report` = false
                    ORDER BY `date` ASC";
        $this->db->query($sql);
        $reports = $this->db->results();

        // Edit reports before returning.

        return $reports;
    }

}