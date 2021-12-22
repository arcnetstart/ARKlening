<?php
class ControllerExtensionAnalyticsSpanalytics extends Controller {
    public function index() {
        $this->load->model('extension/analytics/spanalytics');

        $page_title = str_replace('"','&#34;', $_POST['page_name']);
        $page_title_new = str_replace("'","&#39;", $page_title);
        $page_url = $_POST['page_href'];
        $page_url_new = str_replace("&","&amp;", $page_url);
        $lang_format = $this->config->get('dashboard_spanalytics_lang_format');
        $lang_value = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if ($lang_value == null)
            $lang_value = "en-gb";

        if ($lang_format == 0) {
            $spa_lang = mb_strimwidth($lang_value, 0, 2, "");
        }
        if ($lang_format == 1) {
            $spa_lang = mb_strimwidth($lang_value, 0, 5, "");
        }
        if ($lang_format == 2) {
            $spa_lang = $lang_value;
        }
        if ($lang_format == null) {
            $spa_lang = mb_strimwidth($lang_value, 0, 2, "");
        }

        $spa_country = $_SERVER['HTTP_GEOIP_COUNTRY_CODE'];
        if ($spa_country == null)
            $spa_country = 'XX';
        if ($page_url_new == null)
            $page_url_new = '/';
        if ($_POST['spa_referer'] == null)
            $spa_source = "(direct)";
        if ($_POST['spa_referer'] != null)
            $spa_source = $_POST['spa_referer'];

        $spa_width = $_POST['sr_width'];
        $spa_screansize = $_POST['sr_size'];
        $spa_time = time();
        $spa_date = date('Y-m-d');

        if ($spa_width < 768) {
            $device = "mobile";
        } else if ($spa_width >= 768 and $spa_width < 992) {
            $device = "tablet";
        } else if ($spa_width >= 992) {
            $device = "desktop";
        } else {
            $device = "mobile";
        }

        if ($spa_source != "(direct)") {
            $spa_source_parse = parse_url($spa_source);
            $spa_source = $spa_source_parse['host'];
        }

        if(!isset($_COOKIE['SPASESSIONID'])) {
            $spa_session_id = $this->model_extension_analytics_spanalytics->RandomString(10);;
            setcookie('SPASESSIONID', $spa_session_id, time() + (86400 * 30), "/");
        } else {
            $spa_session_id = $_COOKIE["SPASESSIONID"];
        }

        $check_session = $this->model_extension_analytics_spanalytics->checkSession($spa_session_id, $spa_date);

        if($check_session != 0) {
            $this->model_extension_analytics_spanalytics->updateSession($spa_session_id, $spa_date, $spa_time, $page_url_new);
        } else {
            require_once 'system/library/spanalytics/Browser.php';
            $browser = new Browser();
            $spa_browser = $browser->getBrowser();
            $spa_os = $browser->getPlatform();
            $this->model_extension_analytics_spanalytics->setSession($spa_session_id, $spa_date, $spa_time, $spa_browser, $spa_lang, $spa_screansize, $device, $spa_time, $page_url_new, $spa_country, $spa_os, $spa_source);
        }

        $check_pages = $this->model_extension_analytics_spanalytics->checkPage($page_url_new);

        if($check_pages != 0) {
            $this->model_extension_analytics_spanalytics->updatePage($page_url_new);
        } else {
            $this->model_extension_analytics_spanalytics->setPage($page_title_new, $page_url_new);
        }
    }
}
