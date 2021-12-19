<?php

class ControllerExtensionDashboardSpanalytics extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('extension/dashboard/spanalytics');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_stats_admin'] = $this->language->get('entry_stats_admin');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_lang_format'] = $this->language->get('entry_lang_format');
        $data['entry_lang_format1'] = $this->language->get('entry_lang_format1');
        $data['entry_lang_format2'] = $this->language->get('entry_lang_format2');
        $data['entry_lang_format3'] = $this->language->get('entry_lang_format3');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('dashboard_spanalytics', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=dashboard', true));
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=dashboard', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/dashboard/spanalytics', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['action'] = $this->url->link('extension/dashboard/spanalytics', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=dashboard', true);

        if (isset($this->request->post['dashboard_spanalytics_width'])) {
            $data['dashboard_spanalytics_width'] = $this->request->post['dashboard_spanalytics_width'];
        } else {
            $data['dashboard_spanalytics_width'] = $this->config->get('dashboard_spanalytics_width');
        }

        $data['columns'] = array();

        for ($i = 3; $i <= 12; $i++) {
            $data['columns'][] = $i;
        }

        if (isset($this->request->post['dashboard_spanalytics_status'])) {
            $data['dashboard_spanalytics_status'] = $this->request->post['dashboard_spanalytics_status'];
        } else {
            $data['dashboard_spanalytics_status'] = $this->config->get('dashboard_spanalytics_status');
        }

        if (isset($this->request->post['dashboard_spanalytics_stats_for_admin'])) {
            $data['dashboard_spanalytics_stats_for_admin'] = $this->request->post['dashboard_spanalytics_stats_for_admin'];
        } else {
            $data['dashboard_spanalytics_stats_for_admin'] = $this->config->get('dashboard_spanalytics_stats_for_admin');
        }

        if (isset($this->request->post['dashboard_spanalytics_lang_format'])) {
            $data['dashboard_spanalytics_lang_format'] = $this->request->post['dashboard_spanalytics_lang_format'];
        } else {
            $data['dashboard_spanalytics_lang_format'] = $this->config->get('dashboard_spanalytics_lang_format');
        }

        if (isset($this->request->post['dashboard_spanalytics_sort_order'])) {
            $data['dashboard_spanalytics_sort_order'] = $this->request->post['dashboard_spanalytics_sort_order'];
        } else {
            $data['dashboard_spanalytics_sort_order'] = $this->config->get('dashboard_spanalytics_sort_order');
        }

        $array_lang_formats = array(
            0 => $this->language->get('entry_lang_format1'),
            1 => $this->language->get('entry_lang_format2'),
            2 => $this->language->get('entry_lang_format3'),
        );

        foreach ($array_lang_formats as $key => $value) {
            $data['lang_formats'][] = array(
                'id' => $key,
                'name' => $value
            );
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/dashboard/spanalytics_form', $data));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/dashboard/spanalytics')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function dashboard() {
        $this->load->language('extension/dashboard/spanalytics');
        $this->load->model('extension/dashboard/spanalytics');

        //Start total
        $this->load->model('sale/order');
        $order_total = $this->model_sale_order->getTotalOrders();
        $data['total'] = $order_total;
        //End total

        //Start total summ
        $this->load->model('customer/customer');
        $customer_total = $this->model_customer_customer->getTotalCustomers();
        $data['total_customer'] = $customer_total;
        //End total summ

        $data['text_settings'] = $this->language->get('text_settings');
        $data['text_orders_total'] = $this->language->get('text_orders_total');
        $data['text_orders_summ'] = $this->language->get('text_orders_summ');
        $data['text_tab_1'] = $this->language->get('text_tab_1');
        $data['text_tab_2'] = $this->language->get('text_tab_2');
        $data['text_tab_3'] = $this->language->get('text_tab_3');
        $data['text_tab_4'] = $this->language->get('text_tab_4');
        $data['text_tab_5'] = $this->language->get('text_tab_5');
        $data['text_tab_6'] = $this->language->get('text_tab_6');
        $data['text_tab_7'] = $this->language->get('text_tab_7');
        $data['text_tab_8'] = $this->language->get('text_tab_8');
        $data['text_tab_9'] = $this->language->get('text_tab_9');
        $data['text_tab_10'] = $this->language->get('text_tab_10');
        $data['text_tab_11'] = $this->language->get('text_tab_11');
        $data['text_tab_1_1'] = $this->language->get('text_tab_1_1');
        $data['text_tab_1_2'] = $this->language->get('text_tab_1_2');
        $data['text_tab_1_3'] = $this->language->get('text_tab_1_3');
        $data['text_tab_1_4'] = $this->language->get('text_tab_1_4');
        $data['text_tab_1_5'] = $this->language->get('text_tab_1_5');
        $data['text_sessions'] = $this->language->get('text_sessions');
        $data['text_pages'] = $this->language->get('text_pages');
        $data['text_pagesall'] = $this->language->get('text_pagesall');
        $data['text_pagespop'] = $this->language->get('text_pagespop');
        $data['text_percentage'] = $this->language->get('text_percentage');
        $data['text_pageview'] = $this->language->get('text_pageview');
        $data['text_country'] = $this->language->get('text_country');
        $data['text_countryall'] = $this->language->get('text_countryall');
        $data['text_countrypop'] = $this->language->get('text_countrypop');
        $data['text_language'] = $this->language->get('text_language');
        $data['text_languageall'] = $this->language->get('text_languageall');
        $data['text_languagepop'] = $this->language->get('text_languagepop');
        $data['text_browser'] = $this->language->get('text_browser');
        $data['text_browserall'] = $this->language->get('text_browserall');
        $data['text_browserpop'] = $this->language->get('text_browserpop');
        $data['text_os'] = $this->language->get('text_os');
        $data['text_osall'] = $this->language->get('text_osall');
        $data['text_ospop'] = $this->language->get('text_ospop');
        $data['text_device'] = $this->language->get('text_device');
        $data['text_deviceall'] = $this->language->get('text_deviceall');
        $data['text_devicepop'] = $this->language->get('text_devicepop');
        $data['text_device_d'] = $this->language->get('text_device_d');
        $data['text_device_t'] = $this->language->get('text_device_t');
        $data['text_device_m'] = $this->language->get('text_device_m');
        $data['text_device_n'] = $this->language->get('text_device_n');
        $data['text_screenres'] = $this->language->get('text_screenres');
        $data['text_screenresall'] = $this->language->get('text_screenresall');
        $data['text_screenrespop'] = $this->language->get('text_screenrespop');
        $data['text_source'] = $this->language->get('text_source');
        $data['text_sourceall'] = $this->language->get('text_sourceall');
        $data['text_sourcepop'] = $this->language->get('text_sourcepop');
        $data['text_country_code'] = $this->language->get('text_country_code');
        $data['text_realtimes_txt_1'] = $this->language->get('text_realtimes_txt_1');
        $data['text_realtimes_txt_2'] = $this->language->get('text_realtimes_txt_2');

        $data['user_token'] = $this->session->data['user_token'];

        $data['activities'] = array();

        $data['link_setting'] = $this->url->link('extension/dashboard/spanalytics', 'user_token=' . $data['user_token'], true);

        //Load result
        $data['results_charts_date'] = $this->model_extension_dashboard_spanalytics->getNumberDate();
        //Line charts
        $data['results_charts_sessions'] = $this->model_extension_dashboard_spanalytics->getNumberSessions();

        //Line charts users
        $data['results_charts_users'] = $this->model_extension_dashboard_spanalytics->getNumberUsers();
        //Line charts page views
        $data['results_charts_pageviews'] = $this->model_extension_dashboard_spanalytics->getNumberViews();

        //Line charts page views
        $data['results_charts_sessiontopage'] = $this->model_extension_dashboard_spanalytics->getNumberSessionToPage();

        //Line charts sred time
        $data['results_charts_session_to_time'] = $this->model_extension_dashboard_spanalytics->getNumberSessionSeredTime();

        //Count elements
        $data['results_charts_all_sessions_count'] = $this->model_extension_dashboard_spanalytics->getNumberAllSession();
        $data['results_charts_all_users_count'] = $this->model_extension_dashboard_spanalytics->getNumberAllUsers();
        $data['results_charts_all_views_count'] = $this->model_extension_dashboard_spanalytics->getNumberAllViews();
        $data['results_charts_all_sessiontopage_count'] = $this->model_extension_dashboard_spanalytics->getNumberSessionToPagePercent();
        $data['results_charts_sessions_seconds'] = $this->model_extension_dashboard_spanalytics->getNumberSessionsSeconds();
        $data['spa_online_users'] = $this->model_extension_dashboard_spanalytics->getOnlineAnalyticsTotal();
        $spa_online_users_pages = $this->model_extension_dashboard_spanalytics->getOnlineAnalyticsPages();
        $data['total_sale_sum'] = $this->model_extension_dashboard_spanalytics->getTotalSaleSumm();

        $this->model_extension_dashboard_spanalytics->DeleteOldStats();

        //Page list
        $results_pages = $this->model_extension_dashboard_spanalytics->getPages();
        $all_views_page = $this->model_extension_dashboard_spanalytics->getViewsPages();
        //Country list
        $results_country = $this->model_extension_dashboard_spanalytics->getSessionsGroup("country");
        $all_count_country = $this->model_extension_dashboard_spanalytics->getAllNum("country");
        //Language list
        $results_language = $this->model_extension_dashboard_spanalytics->getSessionsGroup("lang");
        $all_count_language = $this->model_extension_dashboard_spanalytics->getAllNum("lang");
        //Browser list
        $results_browser = $this->model_extension_dashboard_spanalytics->getSessionsGroup("browser");
        $all_count_browser = $this->model_extension_dashboard_spanalytics->getAllNum("browser");
        //OS list
        $results_os = $this->model_extension_dashboard_spanalytics->getSessionsGroup("os");
        $all_count_os = $this->model_extension_dashboard_spanalytics->getAllNum("os");
        //Device list
        $results_device = $this->model_extension_dashboard_spanalytics->getSessionsGroup("device");
        $all_count_device = $this->model_extension_dashboard_spanalytics->getAllNum("device");
        //Screen list
        $results_screenres = $this->model_extension_dashboard_spanalytics->getSessionsGroup("screenres");
        $all_count_screenres = $this->model_extension_dashboard_spanalytics->getAllNum("screenres");
        //Source list
        $results_source = $this->model_extension_dashboard_spanalytics->getSessionsGroup("source");
        $all_count_source = $this->model_extension_dashboard_spanalytics->getAllNum("source");

        //Page online
        if (is_array($spa_online_users_pages) || is_object($spa_online_users_pages)) {
            foreach ($spa_online_users_pages as $result) {
                $url_page = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $result['realtimepage'];
                $data['pageonlineLists'][] = array(
                    'realtimepage' => $result['realtimepage'],
                    'realtimepageurl' => $url_page
                );
            }
        }

        //Page list
        foreach ($results_pages as $result) {
            if ($result['url'] != "/index.php?route=extension/analytics/spanalytics") {
                $percent_views = $result['views'] / $all_views_page * 100;
                $url_page = mb_strimwidth(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $result['url'], 0, 60, "...");
                $url_a = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $result['url'];
                $title = mb_strimwidth($result['title'], 0, 60, "...");
                $data['pageLists'][] = array(
                    'url' => $url_page,
                    'urla' => $url_a,
                    'title' => $title,
                    'views' => $result['views'],
                    'percent' => round($percent_views, 1)
                );
            }
        }

        //Page list charts
        $pagelistcharts = 0;
        foreach ($results_pages as $result) {
            if ($result['url'] != "/index.php?route=extension/analytics/spanalytics") {
                if ($pagelistcharts <= 9) {
                    $pagelistcharts = $pagelistcharts + 1;
                    $title = mb_strimwidth($result['title'], 0, 30, "...");
                    $data['pagecartsLists'][] = array(
                        'title' => $title,
                        'views' => $result['views']
                    );
                }
            }
        }

        if ($pagelistcharts >= 1) {
            $page_order = array_column($data['pagecartsLists'], 'views');
            array_multisort($page_order, SORT_DESC, $data['pagecartsLists']);
        }

        //Country list
        foreach ($results_country as $result) {
            if ($result['country'] == "AU" or $result['country'] == "AT" or $result['country'] == "AZ" or $result['country'] == "AX" or $result['country'] == "AL" or $result['country'] == "DZ" or $result['country'] == "VI" or $result['country'] == "AS" or $result['country'] == "AI" or $result['country'] == "AO" or $result['country'] == "AD" or $result['country'] == "AQ" or $result['country'] == "AG" or $result['country'] == "AR" or $result['country'] == "AM" or $result['country'] == "AW" or $result['country'] == "AF" or $result['country'] == "BS" or $result['country'] == "BD" or $result['country'] == "BB" or $result['country'] == "BH" or $result['country'] == "BZ" or $result['country'] == "BY" or $result['country'] == "BE" or $result['country'] == "BJ" or $result['country'] == "BM" or $result['country'] == "BG" or $result['country'] == "BO" or $result['country'] == "BQ" or $result['country'] == "BA" or $result['country'] == "BW" or $result['country'] == "BR" or $result['country'] == "IO" or $result['country'] == "VG" or $result['country'] == "BN" or $result['country'] == "BF" or $result['country'] == "BI" or $result['country'] == "BT" or $result['country'] == "VU" or $result['country'] == "VA" or $result['country'] == "GB" or $result['country'] == "HU" or $result['country'] == "VE" or $result['country'] == "UM" or $result['country'] == "TL" or $result['country'] == "VN" or $result['country'] == "GA" or $result['country'] == "HT" or $result['country'] == "GY" or $result['country'] == "GM" or $result['country'] == "GH" or $result['country'] == "GP" or $result['country'] == "GT" or $result['country'] == "GF" or $result['country'] == "GN" or $result['country'] == "GW" or $result['country'] == "DE" or $result['country'] == "GG" or $result['country'] == "GI" or $result['country'] == "HN" or $result['country'] == "HK" or $result['country'] == "GD" or $result['country'] == "GL" or $result['country'] == "GR" or $result['country'] == "GE" or $result['country'] == "GU" or $result['country'] == "DK" or $result['country'] == "JE" or $result['country'] == "DJ" or $result['country'] == "DM" or $result['country'] == "DO" or $result['country'] == "CD" or $result['country'] == "EU" or $result['country'] == "EG" or $result['country'] == "ZM" or $result['country'] == "EH" or $result['country'] == "ZW" or $result['country'] == "IL" or $result['country'] == "IN" or $result['country'] == "ID" or $result['country'] == "JO" or $result['country'] == "IQ" or $result['country'] == "IR" or $result['country'] == "IE" or $result['country'] == "IS" or $result['country'] == "ES" or $result['country'] == "IT" or $result['country'] == "YE" or $result['country'] == "CV" or $result['country'] == "KZ" or $result['country'] == "KY" or $result['country'] == "KH" or $result['country'] == "CM" or $result['country'] == "CA" or $result['country'] == "QA" or $result['country'] == "KE" or $result['country'] == "CY" or $result['country'] == "KG" or $result['country'] == "KI" or $result['country'] == "TW" or $result['country'] == "KP" or $result['country'] == "CN" or $result['country'] == "CC" or $result['country'] == "CO" or $result['country'] == "KM" or $result['country'] == "CR" or $result['country'] == "CI" or $result['country'] == "CU" or $result['country'] == "KW" or $result['country'] == "CW" or $result['country'] == "LA" or $result['country'] == "LV" or $result['country'] == "LS" or $result['country'] == "LR" or $result['country'] == "LB" or $result['country'] == "LY" or $result['country'] == "LT" or $result['country'] == "LI" or $result['country'] == "LU" or $result['country'] == "MU" or $result['country'] == "MR" or $result['country'] == "MG" or $result['country'] == "YT" or $result['country'] == "MO" or $result['country'] == "MK" or $result['country'] == "MW" or $result['country'] == "MY" or $result['country'] == "ML" or $result['country'] == "MV" or $result['country'] == "MT" or $result['country'] == "MA" or $result['country'] == "MQ" or $result['country'] == "MH" or $result['country'] == "MX" or $result['country'] == "FM" or $result['country'] == "MZ" or $result['country'] == "MD" or $result['country'] == "MC" or $result['country'] == "MN" or $result['country'] == "MS" or $result['country'] == "MM" or $result['country'] == "NA" or $result['country'] == "NR" or $result['country'] == "NP" or $result['country'] == "NE" or $result['country'] == "NG" or $result['country'] == "NL" or $result['country'] == "NI" or $result['country'] == "NU" or $result['country'] == "NZ" or $result['country'] == "NC" or $result['country'] == "NO" or $result['country'] == "AE" or $result['country'] == "OM" or $result['country'] == "BV" or $result['country'] == "IM" or $result['country'] == "CK" or $result['country'] == "NF" or $result['country'] == "CX" or $result['country'] == "PN" or $result['country'] == "SH" or $result['country'] == "PK" or $result['country'] == "PW" or $result['country'] == "PS" or $result['country'] == "PA" or $result['country'] == "PG" or $result['country'] == "PY" or $result['country'] == "PE" or $result['country'] == "PL" or $result['country'] == "PT" or $result['country'] == "PR" or $result['country'] == "CG" or $result['country'] == "KR" or $result['country'] == "RE" or $result['country'] == "RU" or $result['country'] == "RW" or $result['country'] == "RO" or $result['country'] == "SV" or $result['country'] == "WS" or $result['country'] == "SM" or $result['country'] == "ST" or $result['country'] == "SA" or $result['country'] == "SZ" or $result['country'] == "MP" or $result['country'] == "SC" or $result['country'] == "BL" or $result['country'] == "MF" or $result['country'] == "PM" or $result['country'] == "SN" or $result['country'] == "VC" or $result['country'] == "KN" or $result['country'] == "LC" or $result['country'] == "RS" or $result['country'] == "SG" or $result['country'] == "SX" or $result['country'] == "SY" or $result['country'] == "SK" or $result['country'] == "SI" or $result['country'] == "SB" or $result['country'] == "SO" or $result['country'] == "SD" or $result['country'] == "SR" or $result['country'] == "US" or $result['country'] == "SL" or $result['country'] == "TJ" or $result['country'] == "TH" or $result['country'] == "TZ" or $result['country'] == "TC" or $result['country'] == "TG" or $result['country'] == "TK" or $result['country'] == "TO" or $result['country'] == "TT" or $result['country'] == "TV" or $result['country'] == "TN" or $result['country'] == "TM" or $result['country'] == "TR" or $result['country'] == "UG" or $result['country'] == "UZ" or $result['country'] == "UA" or $result['country'] == "WF" or $result['country'] == "UY" or $result['country'] == "FO" or $result['country'] == "FJ" or $result['country'] == "PH" or $result['country'] == "FI" or $result['country'] == "FK" or $result['country'] == "FR" or $result['country'] == "PF" or $result['country'] == "HM" or $result['country'] == "HR" or $result['country'] == "CF" or $result['country'] == "TD" or $result['country'] == "ME" or $result['country'] == "CZ" or $result['country'] == "CL" or $result['country'] == "CH" or $result['country'] == "SE" or $result['country'] == "SJ" or $result['country'] == "LK" or $result['country'] == "EC" or $result['country'] == "GQ" or $result['country'] == "ER" or $result['country'] == "EE" or $result['country'] == "ET" or $result['country'] == "ZA" or $result['country'] == "GS" or $result['country'] == "SS" or $result['country'] == "JM" or $result['country'] == "JP") {
                $count = $this->model_extension_dashboard_spanalytics->getNumVariable("country", $result['country']);
                $percent_country = $count / $all_count_country * 100;
                $country_code = "text_country_" . $result['country'];
                $country_name = $this->language->get($country_code);

                if ($result['country'] == "AU" or $result['country'] == "AT" or $result['country'] == "AZ" or $result['country'] == "AX" or $result['country'] == "AL" or $result['country'] == "DZ" or $result['country'] == "VI" or $result['country'] == "AS" or $result['country'] == "AI" or $result['country'] == "AO" or $result['country'] == "AD" or $result['country'] == "AQ" or $result['country'] == "AG" or $result['country'] == "AR" or $result['country'] == "AM" or $result['country'] == "AW" or $result['country'] == "AF" or $result['country'] == "BS" or $result['country'] == "BD" or $result['country'] == "BB" or $result['country'] == "BH" or $result['country'] == "BZ" or $result['country'] == "BY" or $result['country'] == "BE" or $result['country'] == "BJ" or $result['country'] == "BM" or $result['country'] == "BG" or $result['country'] == "BO" or $result['country'] == "BQ" or $result['country'] == "BA" or $result['country'] == "BW" or $result['country'] == "BR" or $result['country'] == "IO" or $result['country'] == "VG" or $result['country'] == "BN" or $result['country'] == "BF" or $result['country'] == "BI" or $result['country'] == "BT" or $result['country'] == "VU" or $result['country'] == "VA" or $result['country'] == "GB" or $result['country'] == "HU" or $result['country'] == "VE" or $result['country'] == "UM" or $result['country'] == "TL" or $result['country'] == "VN" or $result['country'] == "GA" or $result['country'] == "HT" or $result['country'] == "GY" or $result['country'] == "GM" or $result['country'] == "GH" or $result['country'] == "GP" or $result['country'] == "GT" or $result['country'] == "GF" or $result['country'] == "GN" or $result['country'] == "GW" or $result['country'] == "DE" or $result['country'] == "GG" or $result['country'] == "GI" or $result['country'] == "HN" or $result['country'] == "HK" or $result['country'] == "GD" or $result['country'] == "GL" or $result['country'] == "GR" or $result['country'] == "GE" or $result['country'] == "GU" or $result['country'] == "DK" or $result['country'] == "JE" or $result['country'] == "DJ" or $result['country'] == "DM" or $result['country'] == "DO" or $result['country'] == "CD" or $result['country'] == "EU" or $result['country'] == "EG" or $result['country'] == "ZM" or $result['country'] == "EH" or $result['country'] == "ZW" or $result['country'] == "IL" or $result['country'] == "IN" or $result['country'] == "ID" or $result['country'] == "JO" or $result['country'] == "IQ" or $result['country'] == "IR" or $result['country'] == "IE" or $result['country'] == "IS" or $result['country'] == "ES" or $result['country'] == "IT" or $result['country'] == "YE" or $result['country'] == "CV" or $result['country'] == "KZ" or $result['country'] == "KY" or $result['country'] == "KH" or $result['country'] == "CM" or $result['country'] == "CA" or $result['country'] == "QA" or $result['country'] == "KE" or $result['country'] == "CY" or $result['country'] == "KG" or $result['country'] == "KI" or $result['country'] == "TW" or $result['country'] == "KP" or $result['country'] == "CN" or $result['country'] == "CC" or $result['country'] == "CO" or $result['country'] == "KM" or $result['country'] == "CR" or $result['country'] == "CI" or $result['country'] == "CU" or $result['country'] == "KW" or $result['country'] == "CW" or $result['country'] == "LA" or $result['country'] == "LV" or $result['country'] == "LS" or $result['country'] == "LR" or $result['country'] == "LB" or $result['country'] == "LY" or $result['country'] == "LT" or $result['country'] == "LI" or $result['country'] == "LU" or $result['country'] == "MU" or $result['country'] == "MR" or $result['country'] == "MG" or $result['country'] == "YT" or $result['country'] == "MO" or $result['country'] == "MK" or $result['country'] == "MW" or $result['country'] == "MY" or $result['country'] == "ML" or $result['country'] == "MV" or $result['country'] == "MT" or $result['country'] == "MA" or $result['country'] == "MQ" or $result['country'] == "MH" or $result['country'] == "MX" or $result['country'] == "FM" or $result['country'] == "MZ" or $result['country'] == "MD" or $result['country'] == "MC" or $result['country'] == "MN" or $result['country'] == "MS" or $result['country'] == "MM" or $result['country'] == "NA" or $result['country'] == "NR" or $result['country'] == "NP" or $result['country'] == "NE" or $result['country'] == "NG" or $result['country'] == "NL" or $result['country'] == "NI" or $result['country'] == "NU" or $result['country'] == "NZ" or $result['country'] == "NC" or $result['country'] == "NO" or $result['country'] == "AE" or $result['country'] == "OM" or $result['country'] == "BV" or $result['country'] == "IM" or $result['country'] == "CK" or $result['country'] == "NF" or $result['country'] == "CX" or $result['country'] == "PN" or $result['country'] == "SH" or $result['country'] == "PK" or $result['country'] == "PW" or $result['country'] == "PS" or $result['country'] == "PA" or $result['country'] == "PG" or $result['country'] == "PY" or $result['country'] == "PE" or $result['country'] == "PL" or $result['country'] == "PT" or $result['country'] == "PR" or $result['country'] == "CG" or $result['country'] == "KR" or $result['country'] == "RE" or $result['country'] == "RU" or $result['country'] == "RW" or $result['country'] == "RO" or $result['country'] == "SV" or $result['country'] == "WS" or $result['country'] == "SM" or $result['country'] == "ST" or $result['country'] == "SA" or $result['country'] == "SZ" or $result['country'] == "MP" or $result['country'] == "SC" or $result['country'] == "BL" or $result['country'] == "MF" or $result['country'] == "PM" or $result['country'] == "SN" or $result['country'] == "VC" or $result['country'] == "KN" or $result['country'] == "LC" or $result['country'] == "RS" or $result['country'] == "SG" or $result['country'] == "SX" or $result['country'] == "SY" or $result['country'] == "SK" or $result['country'] == "SI" or $result['country'] == "SB" or $result['country'] == "SO" or $result['country'] == "SD" or $result['country'] == "SR" or $result['country'] == "US" or $result['country'] == "SL" or $result['country'] == "TJ" or $result['country'] == "TH" or $result['country'] == "TZ" or $result['country'] == "TC" or $result['country'] == "TG" or $result['country'] == "TK" or $result['country'] == "TO" or $result['country'] == "TT" or $result['country'] == "TV" or $result['country'] == "TN" or $result['country'] == "TM" or $result['country'] == "TR" or $result['country'] == "UG" or $result['country'] == "UZ" or $result['country'] == "UA" or $result['country'] == "WF" or $result['country'] == "UY" or $result['country'] == "FO" or $result['country'] == "FJ" or $result['country'] == "PH" or $result['country'] == "FI" or $result['country'] == "FK" or $result['country'] == "FR" or $result['country'] == "PF" or $result['country'] == "HM" or $result['country'] == "HR" or $result['country'] == "CF" or $result['country'] == "TD" or $result['country'] == "ME" or $result['country'] == "CZ" or $result['country'] == "CL" or $result['country'] == "CH" or $result['country'] == "SE" or $result['country'] == "SJ" or $result['country'] == "LK" or $result['country'] == "EC" or $result['country'] == "GQ" or $result['country'] == "ER" or $result['country'] == "EE" or $result['country'] == "ET" or $result['country'] == "ZA" or $result['country'] == "GS" or $result['country'] == "SS" or $result['country'] == "JM" or $result['country'] == "JP") {
                    $country_name_real = $country_name;
                    $flag_code = mb_strtolower($result['country']);
                } else {
                    $country_name_real = $this->language->get('text_country_code') . $result['country'];
                    $flag_code = 'xx';
                }

                $data['countryLists'][] = array(
                    'flag_code' => $flag_code,
                    'country' => $country_name_real,
                    'sessions' => $count,
                    'percent' => round($percent_country, 1)
                );
            }
        }

        //Country list charts
        $countrylistcharts = 0;
        foreach ($results_country as $result) {
            $countrylistcharts = $countrylistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("country", $result['country']);
            $country_code = "text_country_" . $result['country'];
            $country_name = $this->language->get($country_code);
            if ($result['country'] == "AU" or $result['country'] == "AT" or $result['country'] == "AZ" or $result['country'] == "AX" or $result['country'] == "AL" or $result['country'] == "DZ" or $result['country'] == "VI" or $result['country'] == "AS" or $result['country'] == "AI" or $result['country'] == "AO" or $result['country'] == "AD" or $result['country'] == "AQ" or $result['country'] == "AG" or $result['country'] == "AR" or $result['country'] == "AM" or $result['country'] == "AW" or $result['country'] == "AF" or $result['country'] == "BS" or $result['country'] == "BD" or $result['country'] == "BB" or $result['country'] == "BH" or $result['country'] == "BZ" or $result['country'] == "BY" or $result['country'] == "BE" or $result['country'] == "BJ" or $result['country'] == "BM" or $result['country'] == "BG" or $result['country'] == "BO" or $result['country'] == "BQ" or $result['country'] == "BA" or $result['country'] == "BW" or $result['country'] == "BR" or $result['country'] == "IO" or $result['country'] == "VG" or $result['country'] == "BN" or $result['country'] == "BF" or $result['country'] == "BI" or $result['country'] == "BT" or $result['country'] == "VU" or $result['country'] == "VA" or $result['country'] == "GB" or $result['country'] == "HU" or $result['country'] == "VE" or $result['country'] == "UM" or $result['country'] == "TL" or $result['country'] == "VN" or $result['country'] == "GA" or $result['country'] == "HT" or $result['country'] == "GY" or $result['country'] == "GM" or $result['country'] == "GH" or $result['country'] == "GP" or $result['country'] == "GT" or $result['country'] == "GF" or $result['country'] == "GN" or $result['country'] == "GW" or $result['country'] == "DE" or $result['country'] == "GG" or $result['country'] == "GI" or $result['country'] == "HN" or $result['country'] == "HK" or $result['country'] == "GD" or $result['country'] == "GL" or $result['country'] == "GR" or $result['country'] == "GE" or $result['country'] == "GU" or $result['country'] == "DK" or $result['country'] == "JE" or $result['country'] == "DJ" or $result['country'] == "DM" or $result['country'] == "DO" or $result['country'] == "CD" or $result['country'] == "EU" or $result['country'] == "EG" or $result['country'] == "ZM" or $result['country'] == "EH" or $result['country'] == "ZW" or $result['country'] == "IL" or $result['country'] == "IN" or $result['country'] == "ID" or $result['country'] == "JO" or $result['country'] == "IQ" or $result['country'] == "IR" or $result['country'] == "IE" or $result['country'] == "IS" or $result['country'] == "ES" or $result['country'] == "IT" or $result['country'] == "YE" or $result['country'] == "CV" or $result['country'] == "KZ" or $result['country'] == "KY" or $result['country'] == "KH" or $result['country'] == "CM" or $result['country'] == "CA" or $result['country'] == "QA" or $result['country'] == "KE" or $result['country'] == "CY" or $result['country'] == "KG" or $result['country'] == "KI" or $result['country'] == "TW" or $result['country'] == "KP" or $result['country'] == "CN" or $result['country'] == "CC" or $result['country'] == "CO" or $result['country'] == "KM" or $result['country'] == "CR" or $result['country'] == "CI" or $result['country'] == "CU" or $result['country'] == "KW" or $result['country'] == "CW" or $result['country'] == "LA" or $result['country'] == "LV" or $result['country'] == "LS" or $result['country'] == "LR" or $result['country'] == "LB" or $result['country'] == "LY" or $result['country'] == "LT" or $result['country'] == "LI" or $result['country'] == "LU" or $result['country'] == "MU" or $result['country'] == "MR" or $result['country'] == "MG" or $result['country'] == "YT" or $result['country'] == "MO" or $result['country'] == "MK" or $result['country'] == "MW" or $result['country'] == "MY" or $result['country'] == "ML" or $result['country'] == "MV" or $result['country'] == "MT" or $result['country'] == "MA" or $result['country'] == "MQ" or $result['country'] == "MH" or $result['country'] == "MX" or $result['country'] == "FM" or $result['country'] == "MZ" or $result['country'] == "MD" or $result['country'] == "MC" or $result['country'] == "MN" or $result['country'] == "MS" or $result['country'] == "MM" or $result['country'] == "NA" or $result['country'] == "NR" or $result['country'] == "NP" or $result['country'] == "NE" or $result['country'] == "NG" or $result['country'] == "NL" or $result['country'] == "NI" or $result['country'] == "NU" or $result['country'] == "NZ" or $result['country'] == "NC" or $result['country'] == "NO" or $result['country'] == "AE" or $result['country'] == "OM" or $result['country'] == "BV" or $result['country'] == "IM" or $result['country'] == "CK" or $result['country'] == "NF" or $result['country'] == "CX" or $result['country'] == "PN" or $result['country'] == "SH" or $result['country'] == "PK" or $result['country'] == "PW" or $result['country'] == "PS" or $result['country'] == "PA" or $result['country'] == "PG" or $result['country'] == "PY" or $result['country'] == "PE" or $result['country'] == "PL" or $result['country'] == "PT" or $result['country'] == "PR" or $result['country'] == "CG" or $result['country'] == "KR" or $result['country'] == "RE" or $result['country'] == "RU" or $result['country'] == "RW" or $result['country'] == "RO" or $result['country'] == "SV" or $result['country'] == "WS" or $result['country'] == "SM" or $result['country'] == "ST" or $result['country'] == "SA" or $result['country'] == "SZ" or $result['country'] == "MP" or $result['country'] == "SC" or $result['country'] == "BL" or $result['country'] == "MF" or $result['country'] == "PM" or $result['country'] == "SN" or $result['country'] == "VC" or $result['country'] == "KN" or $result['country'] == "LC" or $result['country'] == "RS" or $result['country'] == "SG" or $result['country'] == "SX" or $result['country'] == "SY" or $result['country'] == "SK" or $result['country'] == "SI" or $result['country'] == "SB" or $result['country'] == "SO" or $result['country'] == "SD" or $result['country'] == "SR" or $result['country'] == "US" or $result['country'] == "SL" or $result['country'] == "TJ" or $result['country'] == "TH" or $result['country'] == "TZ" or $result['country'] == "TC" or $result['country'] == "TG" or $result['country'] == "TK" or $result['country'] == "TO" or $result['country'] == "TT" or $result['country'] == "TV" or $result['country'] == "TN" or $result['country'] == "TM" or $result['country'] == "TR" or $result['country'] == "UG" or $result['country'] == "UZ" or $result['country'] == "UA" or $result['country'] == "WF" or $result['country'] == "UY" or $result['country'] == "FO" or $result['country'] == "FJ" or $result['country'] == "PH" or $result['country'] == "FI" or $result['country'] == "FK" or $result['country'] == "FR" or $result['country'] == "PF" or $result['country'] == "HM" or $result['country'] == "HR" or $result['country'] == "CF" or $result['country'] == "TD" or $result['country'] == "ME" or $result['country'] == "CZ" or $result['country'] == "CL" or $result['country'] == "CH" or $result['country'] == "SE" or $result['country'] == "SJ" or $result['country'] == "LK" or $result['country'] == "EC" or $result['country'] == "GQ" or $result['country'] == "ER" or $result['country'] == "EE" or $result['country'] == "ET" or $result['country'] == "ZA" or $result['country'] == "GS" or $result['country'] == "SS" or $result['country'] == "JM" or $result['country'] == "JP") {
                $country_name_real = $country_name;
            } else {
                $country_name_real = $this->language->get('text_country_code') . $result['country'];
            }
            $data['countrychartLists'][] = array(
                'country' => $country_name_real,
                'sessions' => $count,
            );
        }

        if ($countrylistcharts >= 1) {
            $country_order = array_column($data['countrychartLists'], 'sessions');
            array_multisort($country_order, SORT_DESC, $data['countrychartLists']);
        }

        //Browser list
        foreach ($results_browser as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("browser", $result['browser']);
            $icon_browser = $this->model_extension_dashboard_spanalytics->getNewNameBrowser($result['browser']);
            $percent_browser = $count / $all_count_browser * 100;
            $data['browserLists'][] = array(
                'iconbrowser' => $icon_browser,
                'browser' => $result['browser'],
                'sessions' => $count,
                'percent' => round($percent_browser, 1)
            );
        }

        //Browser list charts
        $browserlistcharts = 0;
        foreach ($results_browser as $result) {
            $browserlistcharts = $browserlistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("browser", $result['browser']);
            $data['browserchartLists'][] = array(
                'browser' => $result['browser'],
                'sessions' => $count,
            );
        }

        if ($browserlistcharts >= 1) {
            $browser_order = array_column($data['browserchartLists'], 'sessions');
            array_multisort($browser_order, SORT_DESC, $data['browserchartLists']);
        }

        //Language list
        foreach ($results_language as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("lang", $result['lang']);
            $percent_language = $count / $all_count_language * 100;
            $data['languageLists'][] = array(
                'language' => $result['lang'],
                'sessions' => $count,
                'percent' => round($percent_language, 1)
            );
        }

        //Language list charts
        $languagelistcharts = 0;
        foreach ($results_language as $result) {
            $languagelistcharts = $languagelistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("lang", $result['lang']);
            $data['languagechartLists'][] = array(
                'language' => $result['lang'],
                'sessions' => $count
            );
        }

        if ($languagelistcharts >= 1) {
            $language_order = array_column($data['languagechartLists'], 'sessions');
            array_multisort($language_order, SORT_DESC, $data['languagechartLists']);
        }

        //OS list
        foreach ($results_os as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("os", $result['os']);
            $icon_platform = $this->model_extension_dashboard_spanalytics->getNewNamePlatform($result['os']);
            $percent_os = $count / $all_count_os * 100;
            $data['osLists'][] = array(
                'os' => $result['os'],
                'icon_os' => $icon_platform,
                'sessions' => $count,
                'percent' => round($percent_os, 1)
            );
        }

        //OS list chart
        $oslistcharts = 0;
        foreach ($results_os as $result) {
            $oslistcharts = $oslistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("os", $result['os']);
            $data['oschartLists'][] = array(
                'os' => $result['os'],
                'sessions' => $count,
            );
        }


        if ($oslistcharts >= 1) {
            $os_order = array_column($data['oschartLists'], 'sessions');
            array_multisort($os_order, SORT_DESC, $data['oschartLists']);
        }

        //Device list
        foreach ($results_device as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("device", $result['device']);
            $percent_device = (($count) * 100) / $all_count_device;
            if ($result['device'] == "desktop")
                $device_name = $data['text_device_d'];
            if ($result['device'] == "tablet")
                $device_name = $data['text_device_t'];
            if ($result['device'] == "mobile")
                $device_name = $data['text_device_m'];
            if ($result['device'] == "none")
                $device_name = $data['text_device_n'];

            if ($result['device'] == "desktop")
                $device_icon = "fa-desktop";
            if ($result['device'] == "tablet")
                $device_icon = "fa-tablet";
            if ($result['device'] == "mobile")
                $device_icon = "fa-mobile";
            if ($result['device'] == "none")
                $device_icon = "fa-question";

            if ($result['device'] == "desktop") {
                $data['deviceLists'][] = array(
                    'image' => $device_icon,
                    'device' => $device_name,
                    'sessions' => $count,
                    'percent' => round($percent_device, 1)
                );
            }
            if ($result['device'] == "tablet") {
                $data['deviceLists'][] = array(
                    'image' => $device_icon,
                    'device' => $device_name,
                    'sessions' => $count,
                    'percent' => round($percent_device, 1)
                );
            }
            if ($result['device'] == "mobile") {
                $data['deviceLists'][] = array(
                    'image' => $device_icon,
                    'device' => $device_name,
                    'sessions' => $count,
                    'percent' => round($percent_device, 1)
                );
            }
            if ($result['device'] == "none") {
                $data['deviceLists'][] = array(
                    'image' => $device_icon,
                    'device' => $device_name,
                    'sessions' => $count,
                    'percent' => round($percent_device, 1)
                );
            }
        }

        //Device list cart
        $devicelistcharts = 0;
        foreach ($results_device as $result) {
            $devicelistcharts = $devicelistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("device", $result['device']);
            if ($result['device'] == "desktop")
                $device_name = $data['text_device_d'];
            if ($result['device'] == "tablet")
                $device_name = $data['text_device_t'];
            if ($result['device'] == "mobile")
                $device_name = $data['text_device_m'];
            if ($result['device'] == "none")
                $device_name = $data['text_device_n'];

            $data['devicechartLists'][] = array(
                'device' => $device_name,
                'sessions' => $count
            );
        }


        if ($devicelistcharts >= 1) {
            $device_order = array_column($data['devicechartLists'], 'sessions');
            array_multisort($device_order, SORT_DESC, $data['devicechartLists']);
        }

        //Screen list
        foreach ($results_screenres as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("screenres", $result['screenres']);
            $percent_screenres = (($count) * 100) / $all_count_screenres;
            if ($result['screenres'] != "none" or $result['screenres'] != null) {
                $data['screenresLists'][] = array(
                    'screenres' => $result['screenres'],
                    'sessions' => $count,
                    'percent' => round($percent_screenres, 1)
                );
            }
        }

        //Screen list chart
        $screenlistcharts = 0;
        foreach ($results_screenres as $result) {
            $screenlistcharts = $screenlistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("screenres", $result['screenres']);
            if ($result['screenres'] != "none" or $result['screenres'] != null) {
                $data['screenreschartLists'][] = array(
                    'screenres' => $result['screenres'],
                    'sessions' => $count
                );
            }
        }

        if ($screenlistcharts >= 1) {
            $screen_order = array_column($data['screenreschartLists'], 'sessions');
            array_multisort($screen_order, SORT_DESC, $data['screenreschartLists']);
        }

        //Source list
        foreach ($results_source as $result) {
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("source", $result['source']);
            $percent_source = (($count) * 100) / $all_count_source;
            $sourcetext = mb_strimwidth($result['source'], 0, 45, "...");
            if ($result['source'] != "none" or $result['source'] != null) {
                $data['sourceLists'][] = array(
                    'source' => $result['source'],
                    'sourcetext' => $sourcetext,
                    'sessions' => $count,
                    'percent' => round($percent_source, 1)
                );
            }
        }

        //Source list chart
        $sourcelistcharts = 0;
        foreach ($results_source as $result) {
            $sourcelistcharts = $sourcelistcharts + 1;
            $count = $this->model_extension_dashboard_spanalytics->getNumVariable("source", $result['source']);
            if ($result['source'] != "none" or $result['source'] != null) {
                $data['sourcechartLists'][] = array(
                    'source' => $result['source'],
                    'sessions' => $count
                );
            }
        }

        if ($sourcelistcharts >= 1) {
            $source_order = array_column($data['sourcechartLists'], 'sessions');
            array_multisort($source_order, SORT_DESC, $data['sourcechartLists']);
        }

        return $this->load->view('extension/dashboard/spanalytics_info', $data);
    }

    public function updateSPAOnlineUserCount() {
        $this->load->model('extension/dashboard/spanalytics');
        $five_minets = 600;
        $current_time = time();
        $stats_visitors = 0;
        $query = $this->db->query("SELECT COUNT(session) as total FROM " . DB_PREFIX . "asp_analytics WHERE `realtime` + " . $five_minets . " > " . $current_time . ";");
        foreach ($query->rows as $result) {
            $stats_visitors = $stats_visitors + $result['total'];
        }
        echo $stats_visitors;
    }

    public function install() {
        $this->load->model('extension/dashboard/spanalytics');

        $this->model_extension_dashboard_spanalytics->install();
    }

    public function uninstall() {
        $this->load->model('extension/dashboard/spanalytics');

        $this->model_extension_dashboard_spanalytics->uninstall();
    }
}