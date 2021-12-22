<?php
class ModelExtensionDashboardSpanalytics extends Model {
    public function getSessions() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "asp_analytics`;");
        return $query->rows;
    }

    public function getSessionsGroup($group_name) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "asp_analytics` GROUP BY " . $group_name . ";");
        return $query->rows;
    }

    public function getPages() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "asp_pages` ORDER BY views DESC;");
        return $query->rows;
    }

    public function getViewsPages() {
        $count_views = 0;
        $query = $this->db->query("SELECT views FROM " . DB_PREFIX . "asp_pages;");
        foreach ($query->rows as $result) {
            $count_views = $count_views + $result['views'];
        }
        return $count_views;
    }

    public function getAllNum($variable) {
        $count = 0;
        $query = $this->db->query("SELECT " . $variable . " FROM " . DB_PREFIX . "asp_analytics  ORDER BY " . $variable . " DESC;");
        foreach ($query->rows as $result) {
            $count = $count + 1;
        }
        return $count;
    }

    public function getNumVariable($variable, $value) {
        $count_lang = 0;
        $query = $this->db->query("SELECT " . $variable . " FROM " . DB_PREFIX . "asp_analytics WHERE " . $variable . "='" . $value . "';");
        foreach ($query->rows as $result) {
            $count_lang = $count_lang + 1;
        }
        return $count_lang;
    }

    public function getNewNamePlatform($platform) {
        if ($platform == "unknown") {$platform = "unknown";}
        if ($platform == "none") {$platform = "unknown";}
        if ($platform == "Windows") {$platform = "windows";}
        if ($platform == "Windows CE") {$platform = "windowsce";}
        if ($platform == "Apple") {$platform = "apple";}
        if ($platform == "Linux") {$platform = "linux";}
        if ($platform == "OS/2") {$platform = "os2";}
        if ($platform == "BeOS") {$platform = "beos";}
        if ($platform == "iPhone") {$platform = "iphone";}
        if ($platform == "iPod") {$platform = "ipod";}
        if ($platform == "iPad") {$platform = "ipad";}
        if ($platform == "BlackBerry") {$platform = "blackberry";}
        if ($platform == "Nokia") {$platform = "nokia";}
        if ($platform == "FreeBSD") {$platform = "freebsd";}
        if ($platform == "OpenBSD") {$platform = "openbsd";}
        if ($platform == "NetBSD") {$platform = "netbsd";}
        if ($platform == "SunOS") {$platform = "sunos";}
        if ($platform == "OpenSolaris") {$platform = "opensolaris";}
        if ($platform == "Android") {$platform = "android";}
        if ($platform == "Sony PlayStation") {$platform = "sonyplayStation";}
        if ($platform == "Roku") {$platform = "roku";}
        if ($platform == "Apple TV") {$platform = "appletv";}
        if ($platform == "Terminal") {$platform = "terminal";}
        if ($platform == "Fire OS") {$platform = "fireos";}
        if ($platform == "SMART-TV") {$platform = "smarttv";}
        if ($platform == "Chrome OS") {$platform = "chromeos";}
        if ($platform == "Java/Android") {$platform = "javaandroid";}
        if ($platform == "Postman") {$platform = "postman";}
        if ($platform == "Iframely") {$platform = "iframely";}
        return $platform;
    }

    public function getNewNameBrowser($platform) {
        if ($platform == "unknown") {$platform = "unknown";}
        if ($platform == "none") {$platform = "unknown";}
        if ($platform == "Opera") {$platform = "opera";}
        if ($platform == "Opera Mini") {$platform = "opera";}
        if ($platform == "WebTV") {$platform = "webtv";}
        if ($platform == "Edge") {$platform = "edge";}
        if ($platform == "Internet Explorer") {$platform = "internetexplorer";}
        if ($platform == "Pocket Internet Explorer") {$platform = "pocketinternetexplorer";}
        if ($platform == "Konqueror") {$platform = "konqueror";}
        if ($platform == "iCab") {$platform = "icab";}
        if ($platform == "OmniWeb") {$platform = "omniweb";}
        if ($platform == "Firebird") {$platform = "firebird";}
        if ($platform == "Firefox") {$platform = "firefox";}
        if ($platform == "Brave") {$platform = "brave";}
        if ($platform == "Palemoon") {$platform = "palemoon";}
        if ($platform == "Iceweasel") {$platform = "iceweasel";}
        if ($platform == "Shiretoko") {$platform = "unknown";}
        if ($platform == "Mozilla") {$platform = "mozilla";}
        if ($platform == "Amaya") {$platform = "unknown";}
        if ($platform == "Lynx") {$platform = "unknown";}
        if ($platform == "Safari") {$platform = "safari";}
        if ($platform == "iPhone") {$platform = "iphone";}
        if ($platform == "iPod") {$platform = "ipod";}
        if ($platform == "iPad") {$platform = "ipad";}
        if ($platform == "Chrome") {$platform = "chrome";}
        if ($platform == "Android") {$platform = "android";}
        if ($platform == "GoogleBot") {$platform = "googlebot";}
        if ($platform == "cURL") {$platform = "unknown";}
        if ($platform == "Wget") {$platform = "wget";}
        if ($platform == "UCBrowser") {$platform = "ucbrowser";}
        if ($platform == "YandexBot") {$platform = "yandexbot";}
        if ($platform == "YandexImageResizer") {$platform = "yandex";}
        if ($platform == "YandexImages") {$platform = "yandex";}
        if ($platform == "YandexVideo") {$platform = "yandex";}
        if ($platform == "YandexMedia") {$platform = "yandex";}
        if ($platform == "YandexBlogs") {$platform = "yandex";}
        if ($platform == "YandexFavicons") {$platform = "yandex";}
        if ($platform == "YandexWebmaster") {$platform = "yandex";}
        if ($platform == "YandexDirect") {$platform = "yandex";}
        if ($platform == "YandexMetrika") {$platform = "yandex";}
        if ($platform == "YandexNews") {$platform = "yandex";}
        if ($platform == "YandexCatalog") {$platform = "yandex";}
        if ($platform == "Yandex") {$platform = "yandex";}
        if ($platform == "Yahoo! Slurp") {$platform = "yahoo";}
        if ($platform == "W3C Validator") {$platform = "w3cvalidator";}
        if ($platform == "BlackBerry") {$platform = "blackberry";}
        if ($platform == "IceCat") {$platform = "icecat";}
        if ($platform == "Nokia S60 OSS Browser") {$platform = "nokia";}
        if ($platform == "Nokia Browser") {$platform = "nokia";}
        if ($platform == "MSN Browser") {$platform = "msnbrowser";}
        if ($platform == "MSN Bot") {$platform = "msnbot";}
        if ($platform == "Bing Bot") {$platform = "bingbot";}
        if ($platform == "Vivaldi") {$platform = "vivaldi";}
        if ($platform == "Netscape Navigator") {$platform = "netscapenavigator";}
        if ($platform == "Galeon") {$platform = "galeon";}
        if ($platform == "NetPositive") {$platform = "netpositive";}
        if ($platform == "PlayStation") {$platform = "playstation";}
        if ($platform == "SamsungBrowser") {$platform = "samsungbrowser";}
        if ($platform == "Phoenix") {$platform = "firefox";}
        if ($platform == "Silk") {$platform = "silk";}
        if ($platform == "Iframely") {$platform = "iframely";}
        if ($platform == "CocoaRestClient") {$platform = "unknown";}
        return $platform;
    }

    public function getNumberSessions() {
        $stats_views = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC");
        foreach ($query->rows as $result) {
            $this_num_date = 0;
            $query = $this->db->query("SELECT count(session) as session FROM " . DB_PREFIX . "asp_analytics WHERE date = '" . $result['date'] . "';");
            foreach ($query->rows as $result_num) {
                $this_num_date = $this_num_date + $result_num['session'];
            }
            $element = $this_num_date . ",";
            $stats_views = $stats_views . "" . $element;
        }
        return $stats_views;
    }

    public function getNumberDate() {
        $stats_date = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC");
        foreach ($query->rows as $result) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "asp_analytics WHERE date = '" . $result['date'] . "';");
            foreach ($query->rows as $result_num) {
                $date = $result_num['date'];
            }
            $stats_date = $stats_date . "&#34;" . date("d-m-Y", strtotime($date)) . "&#34;, ";
        }
        $stats_date_replace = str_replace('&#34;', '"', $stats_date);
        $stats_date_sub_str = substr($stats_date_replace,0,-2);
        return $stats_date_sub_str;
    }

    public function getNumberUsers() {
        $stats_views = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC");
        foreach ($query->rows as $result) {
            $this_num_date = 0;
            $query = $this->db->query("SELECT count(session) as session FROM " . DB_PREFIX . "asp_analytics WHERE views >= 2 AND date = '" . $result['date'] . "';");
            foreach ($query->rows as $result_num) {
                $this_num_date = $this_num_date + $result_num['session'];
            }
            $element = $this_num_date . ",";
            $stats_views = $stats_views . "" . $element;
        }
        return $stats_views;
    }

    public function getNumberSessionToPage() {
        $stats_views = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC");
        foreach ($query->rows as $result) {
            $view = 0;
            $sessions = 0;
            $query = $this->db->query("SELECT views FROM " . DB_PREFIX . "asp_analytics WHERE date = '" . $result['date'] . "';");
            foreach ($query->rows as $result_num) {
                $view = $view + $result_num['views'];
                $sessions = $sessions + 1;
            }
            $result_r = $view / $sessions;
            $stats_views = $stats_views.''.$result_r.',';
        }
        return $stats_views;
    }

    public function getNumberSessionSeredTime() {
        $string_date_seconds = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC;");
        foreach ($query->rows as $result_num) {
            $count = 0;
            $all_seconds = 0;
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "asp_analytics WHERE date = '" . $result_num['date'] . "';");
            foreach ($query->rows as $result_numss) {
                $session_seconds = $result_numss['realtime'] - $result_numss['datedel'];
                $all_seconds = $all_seconds + $session_seconds;
                $count = $count + 1;
            }
            $seconds = $all_seconds/$count;
            $string_date_seconds = $string_date_seconds.''.round($seconds, 0).', ';
        }
        return $string_date_seconds;
    }

    public function getNumberAllUsers() {
        $this_num = 0;
        $query = $this->db->query("SELECT count(session) as session FROM " . DB_PREFIX . "asp_analytics WHERE views >= 2;");
        foreach ($query->rows as $result_num) {
            $this_num = $this_num + $result_num['session'];
        }
        return $this_num;
    }

    public function getNumberViews() {
        $stats_views = '';
        $query = $this->db->query("SELECT DISTINCT date FROM " . DB_PREFIX . "asp_analytics ORDER BY date ASC");
        foreach ($query->rows as $result) {
            $this_num_date = 0;
            $query = $this->db->query("SELECT views FROM " . DB_PREFIX . "asp_analytics WHERE date = '" . $result['date'] . "';");
            foreach ($query->rows as $result_num) {
                $this_num_date = $this_num_date + $result_num['views'];
            }
            $element = $this_num_date . ",";
            $stats_views = $stats_views . "" . $element;
        }
        return $stats_views;
    }

    public function getNumberAllSession() {
        $this_num = 0;
        $query = $this->db->query("SELECT count(session) as session FROM " . DB_PREFIX . "asp_analytics;");
        foreach ($query->rows as $result_num) {
            $this_num = $this_num + $result_num['session'];
        }
        return $this_num;
    }

    public function getNumberAllViews() {
        $this_num = 0;
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "asp_analytics;");
        foreach ($query->rows as $result_num) {
            $this_num = $this_num + $result_num['views'];
        }
        return $this_num;
    }

    public function getNumberSessionToPagePercent() {
        $stats_views = '';
        $page = 0;
        $sessions = 0;
        $query = $this->db->query("SELECT count(session) as session FROM " . DB_PREFIX . "asp_analytics;");
        foreach ($query->rows as $result_num) {
            $sessions = $sessions + $result_num['session'];
        }
        $query = $this->db->query("SELECT views FROM " . DB_PREFIX . "asp_analytics;");
        foreach ($query->rows as $result_num) {
            $page = $page + $result_num['views'];
        }
        if ($page == 0) {
            $result_r = 0;
        } else {
            $result_r = round(($sessions/$page)*100, 1);
        }
        $element = $result_r;
        $stats_views = $stats_views . "" . $element;
        return $stats_views;
    }

    public function getNumberSessionsSeconds() {
        function secToArray($secs) {
            $res = array();
            $res['d'] = floor($secs / 86400);
            $secs = $secs % 86400;
            $res['h'] = floor($secs / 3600);
            $secs = $secs % 3600;
            $res['m'] = floor($secs / 60);
            $res['s'] = $secs % 60;
            return $res;
        }
        $count_session = 0;
        $count_seconds = 0;
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "asp_analytics;");
        foreach ($query->rows as $result_num) {
            $session_seconds = $result_num['realtime'] - $result_num['datedel'];
            $count_session = $count_session + 1;
            $count_seconds = $count_seconds + $session_seconds;
        }
        if ($count_seconds == 0) {
            $time = 0;
        } else {
            $time = $count_seconds / $count_session;
        }
        $array = secToArray($time);
        $new_h = str_pad($array['h'], 2, 0, STR_PAD_LEFT);
        $new_m = str_pad($array['m'], 2, 0, STR_PAD_LEFT);
        $new_s = str_pad($array['s'], 2, 0, STR_PAD_LEFT);
        $time_format = $new_h.':'.$new_m.':'.$new_s;
        return $time_format;
    }

    public function getOnlineAnalyticsTotal() {
        $five_minets = 600;
        $current_time = time();
        $online_count = 0;
        $query = $this->db->query("SELECT COUNT(session) as total_users FROM " . DB_PREFIX . "asp_analytics WHERE `realtime` + " . $five_minets . " > " . $current_time . ";");
        foreach ($query->rows as $result) {
            $online_count = $online_count + $result['total_users'];
        }
        return $online_count;
    }

    public function getOnlineAnalyticsPages() {
        $five_minets = 600;
        $current_time = time();
        $query = $this->db->query("SELECT DISTINCT realtimepage FROM " . DB_PREFIX . "asp_analytics WHERE realtime + " . $five_minets . " > " . $current_time . ";");
        return $query->rows;
    }

    public function getTotalSaleSumm() {
        $sql = "SELECT SUM(total) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '0'";
        $query = $this->db->query($sql);

        $symbol_left_str = "";
        $symbol_right_str = "";

        $querys = $this->db->query("SELECT code, symbol_left, symbol_right FROM " . DB_PREFIX . "currency WHERE code = '" . $this->config->get('config_currency') . "';");
        foreach ($querys->rows as $result) {
            $symbol_left_str = $result['symbol_left'];
            $symbol_right_str = $result['symbol_right'];
        }

        $total_sum = round($query->row['total']);

        return $symbol_left_str . " " . strval($total_sum) . " " . $symbol_right_str;
    }

    public function DeleteOldStats() {
        $date_del = 2505600;
        $current_time = time();
        $this->db->query("DELETE FROM `" . DB_PREFIX . "asp_analytics` WHERE `datedel` + " . $date_del . " < " . $current_time . ";");
    }

    public function install() {
        $this->db->query("CREATE TABLE `" . DB_PREFIX . "asp_analytics` (`id` int(11) NOT NULL, `session` int(25) NOT NULL, `date` date NOT NULL, `datedel` int(50) NOT NULL, `views` int(15) NOT NULL DEFAULT '0', `browser` text NOT NULL, `lang` varchar(50) NOT NULL, `screenres` varchar(50) NOT NULL, `device` varchar(255) NOT NULL DEFAULT 'none', `realtime` int(20) NOT NULL, `realtimepage` varchar(255) NOT NULL DEFAULT 'none', `country` varchar(255) NOT NULL, `os` varchar(255) NOT NULL DEFAULT 'none', `source` varchar(255) NOT NULL DEFAULT 'none') ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        $this->db->query("CREATE TABLE `" . DB_PREFIX . "asp_pages` (`id` int(11) NOT NULL,`title` text NOT NULL,`url` text NOT NULL,`views` int(11) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "asp_analytics` ADD PRIMARY KEY (`id`);");
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "asp_pages` ADD PRIMARY KEY (`id`);");
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "asp_analytics` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "asp_pages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "asp_analytics`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "asp_pages`");
    }
}