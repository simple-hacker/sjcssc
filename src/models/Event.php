<?php 

class Event {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

}