<?php 

class Report {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getReports($club_id, $n = 0) {
        $sql = "SELECT `outings`.*, venues.venue AS venue, venues.location AS location FROM `outings`
                    LEFT JOIN venues ON `outings`.venue_id = venues.id
                    WHERE `outings`.date <= DATE(NOW())
                    AND `publish_report` = true
                    ORDER BY `date` DESC";
        if ($n > 0) {
            // To prevent negative numbers.  If n isn't provided then get unlimited events, else only return n events.
            $sql .= " LIMIT 0, {$n}";
        }
        $this->db->query($sql);
        return $this->db->result();
    }

    public function updateReport($report) {
        $sql = "UPDATE `outings` SET `report`=:report, `publish_report`=:publish_report WHERE `id`=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $report->id);
        $this->db->bind(':report', $report->report);
        $this->db->bind(':publish_report', true);
        return $this->db->execute();
    }

}