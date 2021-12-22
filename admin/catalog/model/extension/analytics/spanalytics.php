<?php
class ModelExtensionAnalyticsSpanalytics extends Model {
    public function RandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }

    //Session function
    public function checkSession($session, $date) {
        $sql = $this->db->query("SELECT * FROM " . DB_PREFIX . "asp_analytics WHERE session= '" . $session . "' AND date= '" . $date . "';");
        $num_row =  $sql->num_rows;
        return $num_row;
    }

    public function setSession($session, $date, $datedel, $browser, $lang, $screanres, $device, $realtime, $realtimepage, $country, $os, $source) {
        $this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "asp_analytics` SET session='" . $session . "', date='" . $date . "', datedel='" . $datedel . "', views=1, browser='" . $browser . "', lang = '" . $lang . "', screenres = '" . $screanres . "', device = '" . $device . "', realtime = '" . $realtime . "', realtimepage = '" . $realtimepage . "', country = '" . $country . "', os = '" . $os . "', source = '" . $source . "';");
    }

    public function updateSession($session, $date, $realtime, $realtimepage) {
        $this->db->query("UPDATE " . DB_PREFIX . "asp_analytics SET `views` = `views` + 1, realtime= '" . $realtime . "', realtimepage= '" . $realtimepage . "' WHERE session= '" . $session . "' AND date= '" . $date . "'");
    }

    //Pages function
    public function checkPage($url) {
        $sql = $this->db->query("SELECT COUNT(url) as url FROM " . DB_PREFIX . "asp_pages WHERE url='" . $url . "';");
        $num_row =  $sql->row['url'];
        return $num_row;
    }

    public function setPage($title, $url) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "asp_pages SET title='" . $title . "', url='" . $url . "', views= 1;");
    }

    public function updatePage($url) {
        $this->db->query("UPDATE `" . DB_PREFIX . "asp_pages` SET `views` = `views` + 1 WHERE `url`= '" . $url . "';");
    }
}