<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wplc_version_migration', 'wplc_triggers_activation' );
add_action('admin_enqueue_scripts', 'wplc_add_triggers_page_resources',11);
add_action('admin_menu', 'wplc_admin_triggers_menu', 5);

function wplc_admin_triggers_menu(){
    $triggers_listing_hook = wplc_add_ordered_submenu_page('wplivechat-menu', __('Triggers', 'wp-live-chat-support'), __('Triggers', 'edit_posts'), 'wplc_cap_admin', 'wplivechat-menu-triggers', 'wplc_admin_triggers',150);
    $triggers_manage_hook = add_submenu_page('wplivechat-menu', __('Manage Trigger', 'wp-live-chat-support'), __('Manage Trigger', 'wp-live-chat-support'), 'wplc_cap_admin', 'wplivechat-manage-trigger', 'wplc_admin_manage_trigger');
}

function wplc_add_triggers_page_resources($hook)
{
    if($hook != TCXUtilsHelper::wplc_get_page_hook('wplivechat-manage-trigger')
        && $hook != TCXUtilsHelper::wplc_get_page_hook('wplivechat-menu-triggers' ))
        {
            return;
        }
    global $wplc_base_file;

	wp_register_style("wplc-triggers-style", wplc_plugins_url( '/triggers_style.css', __FILE__ ),array(), WPLC_PLUGIN_VERSION );
	wp_enqueue_style("wplc-triggers-style");
    
    wp_register_script("triggers", wplc_plugins_url( '/js/triggers.js', __FILE__ ),array(), WPLC_PLUGIN_VERSION,true );
    wp_enqueue_script("triggers" );

    wp_register_script("triggers_config", wplc_plugins_url( '/js/triggers_config.js', __FILE__ ),array('triggers'), WPLC_PLUGIN_VERSION,true );
    wp_enqueue_script("triggers_config" );

	TCXUtilsHelper::wplc_add_jquery_validation();
}

function wplc_admin_triggers()
{

    $triggers_controller = new TriggersController("trigger");
    $triggers_controller->run();
    
}

function wplc_admin_manage_trigger()
{
    if(isset($_GET['trid']))
    {  
        $manage_triggers_controller = new ManageTriggerController("manageTrigger",$_GET['trid']);
        $manage_triggers_controller->run();
    }
    else
    {
        wp_die( __("Page not found","wp-live-chat-support"));
    }
}

function wplc_triggers_activation()
{
    TriggersController::module_db_integration();
} 


?>