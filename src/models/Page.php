<?php 

class Page {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPageByID($club_id, $page_id) {
        if (isset($club_id) && isset($page_id)) {
            $sql = "SELECT * FROM pages WHERE club_id=:club_id AND page_id=:page_id AND isDeleted=0";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':page_id', $page_id);
            return $this->db->result();
        } else {
            die('Did not supply $club_id or $page_id when retrieving page.');
        }
    }

    public function getPageByURL($club_id, $page_url) {
        if (isset($club_id) && isset($page_url)) {
            $sql = "SELECT * FROM pages WHERE club_id=:club_id AND `page_url`=:page_url AND isDeleted=0";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':page_url', $page_url);
            return $this->db->result();
        } else {
            die('Did not supply $club_id or $page_url when retrieving page.');
        }
    }

    public function getPageByTitle($club_id, $page_title) {
        if (isset($club_id) && isset($page_title)) {
            $sql = "SELECT * FROM pages WHERE club_id=:club_id AND `page`=:page_title AND isDeleted=0";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':page_title', $page_title);
            return $this->db->results();
        } else {
            die('Did not supply $club_id or $page_title when retrieving page.');
        }
    }

    public function getPages($club_id) {
        if (isset($club_id)) {
            $sql = "SELECT * FROM pages WHERE club_id=:club_id AND isDeleted=0 ORDER BY page_id ASC";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            return $this->db->results();
        } else {
            die('Did not supply $club_id when retrieving pages.');
        }
    }

    public function getPagesMenuLinks($club_id) {
        if (isset($club_id)) {
            $sql = "SELECT `page_id`, `page`, `page_url` FROM pages WHERE club_id=:club_id AND `showMenu`=1 AND isDeleted=0 ORDER BY page_id ASC";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            return $this->db->results();
        } else {
            die('Did not supply $club_id when retrieving pages.');
        }
    }

    private function getLastID($club_id) {
        $sql = "SELECT MAX(page_id) as lastID FROM `pages` WHERE `club_id`=:club_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        return $this->db->result()->lastID;
    }

    public function addPage($club_id, $page) {
        $lastID = $this->getLastID($club_id);
        $sql = "INSERT INTO `pages` (club_id, page_id, page, page_url, page_title, html, showMenu) VALUES (:club_id, :page_id, :page, :page_url, :page_title, :html, :showMenu)";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':page_id', $lastID + 1);
        $this->db->bind(':page', trim($page->page));
        $this->db->bind(':page_url', trim($page->page_url));
        $this->db->bind(':page_title', trim($page->page_title));
        $this->db->bind(':html', trim($page->html));
        $this->db->bind(':showMenu', $page->showMenu);
        return $this->db->execute();
    }

    public function updatePage($club_id, $page) {
        $sql = "UPDATE `pages` SET page_url=:page_url, page_title=:page_title, html=:html, showMenu=:showMenu WHERE club_id=:club_id AND page_id=:page_id";
        $this->db->query($sql);
        $this->db->bind(':club_id', $club_id);
        $this->db->bind(':page_id', $page->page_id);
        $this->db->bind(':page_url', trim($page->page_url));
        $this->db->bind(':page_title', trim($page->page_title));
        $this->db->bind(':html', trim($page->html));
        $this->db->bind(':showMenu', $page->showMenu);
        return $this->db->execute();
    }

    public function deletePage($club_id, $page_id) {
        if (isset($club_id) && isset($page_id)) {
            $sql = "UPDATE `pages` SET isDeleted=1 WHERE club_id=:club_id and page_id=:page_id";
            $this->db->query($sql);
            $this->db->bind(':club_id', $club_id);
            $this->db->bind(':page_id', $page_id);
            return $this->db->execute();
        } else {
            die('Did not supply $club_id or $page_idwhen retrieving pages.');
        }
    }
}