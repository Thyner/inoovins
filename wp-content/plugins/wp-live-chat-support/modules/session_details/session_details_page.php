<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_enqueue_scripts', 'wplc_add_session_details_page_style',11);
add_action('admin_menu', 'wplc_admin_session_details_menu', 5);

function wplc_admin_session_details_menu(){
    $session_details_hook = add_submenu_page('wplivechat-menu', __('Session Details', 'wp-live-chat-support'), __('Session Details', 'wp-live-chat-support'), 'wplc_cap_admin', 'wplivechat-session-details', 'wplc_admin_session_details');
}

function wplc_add_session_details_page_style($hook)
{
    global $wplc_base_file;
    if($hook != TCXUtilsHelper::wplc_get_page_hook('wplivechat-session-details'))
    {
        return;
    }



    wp_register_style( 'wplc-admin-styles', wplc_plugins_url( '/css/admin_styles.css', $wplc_base_file ), array(), WPLC_PLUGIN_VERSION);
    wp_enqueue_style( 'wplc-admin-styles' );

	wp_register_style("style_session_details", wplc_plugins_url( '/session_details_style.css', __FILE__ ),array(), WPLC_PLUGIN_VERSION );
	wp_enqueue_style("style_session_details" );


	wp_register_style( "wplc-emojis-css", wplc_plugins_url( '/js/vendor/emoji_js/emoji.css', $wplc_base_file  ), array(), WPLC_PLUGIN_VERSION );
	wp_enqueue_style( "wplc-emojis-css" );

	wp_register_script( 'wplc-emoji-js', wplc_plugins_url( '/js/vendor/emoji_js/emoji.js', $wplc_base_file ), array(), WPLC_PLUGIN_VERSION, true );
	wp_enqueue_script( 'wplc-emoji-js' );

	wp_register_script( 'wplc-session-details-js', wplc_plugins_url( '/js/session_details.js', __FILE__ ), array( 'wplc-emoji-js' ), WPLC_PLUGIN_VERSION, true );
	wp_enqueue_script( 'wplc-session-details-js' );

}


function wplc_admin_session_details()
{
    $alias = "sessionDetails";
    if(isset($_GET['cid']))
    {
        $history_controller = new SessionDetailsController($alias,$_GET['cid']);
        $history_controller->run();
    }
    else
    {
        wp_die("Page not found");
    }
}
?>