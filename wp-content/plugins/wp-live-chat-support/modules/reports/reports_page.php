<?php
if (!defined('ABSPATH')) {
    exit;
}

//add_action('admin_menu', 'wplc_admin_report_menu', 5);
add_action('admin_enqueue_scripts', 'wplc_add_reports_page_resources',11);

function wplc_admin_report_menu(){
    $report_page_hook = wplc_add_ordered_submenu_page('wplivechat-menu', __('Reports', 'wp-live-chat-support'), __('Reports', 'wp-live-chat-support'), 'wplc_cap_admin', 'wplivechat-menu-reports-page', 'wplc_admin_reports',70);
}


function wplc_add_reports_page_resources($hook)
{
    if($hook != TCXUtilsHelper::wplc_get_page_hook('wplivechat-menu-reports-page'))
        {
            return;
        }
    global $wpdb;
    global $wplc_base_file;

    wp_register_style('wplc-jquery-ui', wplc_plugins_url('/css/vendor/jquery-ui/jquery-ui.css', $wplc_base_file), array(), WPLC_PLUGIN_VERSION);
    wp_enqueue_style('wplc-jquery-ui');

	wp_register_style('wplc-tabs', wplc_plugins_url('/css/wplc_tabs.css', $wplc_base_file), array('wplc-jquery-ui'), WPLC_PLUGIN_VERSION);
	wp_enqueue_style('wplc-tabs');

	wp_register_style("wplc-admin-styles", wplc_plugins_url( '/css/admin_styles.css', $wplc_base_file ),array(), WPLC_PLUGIN_VERSION );
	wp_enqueue_style("wplc-admin-styles" );

    wp_register_style("wplc-reports-style", wplc_plugins_url( '/reports_style.css', __FILE__ ),array(), WPLC_PLUGIN_VERSION );
    wp_enqueue_style("wplc-reports-style" );

    wp_register_script('wplc-google-charts', wplc_plugins_url('/js/vendor/charts/loader.js', $wplc_base_file), array('jquery'), WPLC_PLUGIN_VERSION, true);
    wp_enqueue_script('wplc-google-charts');
    
    wp_register_script('wplc-statistics', wplc_plugins_url('/js/reporting.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'), WPLC_PLUGIN_VERSION, true);
    $statistics = json_encode(ReportsController::get_sessions_stats($wpdb,14) );
    if (empty($statistics)) { $statistics = ''; }
    wp_localize_script('wplc-statistics', 'wplc_reporting_statistics', $statistics);
    wp_enqueue_script('wplc-statistics');

   
    
}


function wplc_admin_reports()
{
    $report_controller = new ReportsController("report");
    $report_controller->run();
}
?>