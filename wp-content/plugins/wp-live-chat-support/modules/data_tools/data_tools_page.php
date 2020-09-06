<?php

if (!defined('ABSPATH')) {
    exit;
}


add_action('admin_init', 'wplc_export_history' );
add_action('admin_init', 'wplc_export_ratings' );
add_action('admin_init', 'wplc_export_offline_messages' );
add_action('admin_init', 'wplc_export_settings' );
add_action('admin_enqueue_scripts', 'wplc_add_data_tools_page_resources',11);


function wplc_add_data_tools_page_resources($hook)
{
    if($hook != TCXUtilsHelper::wplc_get_page_hook('wplivechat-menu-tools' ))
        {
            return;
        }
    global $wplc_base_file;
    
    wp_register_script("wplc_tools", wplc_plugins_url( '/js/tools.js', __FILE__ ),array(), WPLC_PLUGIN_VERSION,true );
    wp_enqueue_script("wplc_tools" );
}

function wplc_export_history(){
    
    if(!TCXUtilsHelper::check_page_action("wplivechat-menu-tools","export_history"))
    {
        return;
    }
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'toolsNonce')){
        wp_die(__("You do not have permission do perform this action", 'wp-live-chat-support'));
    }

    global $wpdb;

    $results = TCXChatData::get_history($wpdb);// self::get_history();
    $csvdata = array();
    foreach ($results as $chat) {
        $chat_messages = TCXChatData::get_session_details($wpdb,$chat->id);
        $chat_messages_transcript = TCXChatHelper::generate_transcript($chat_messages);
        $csvdata[] = array_merge( TCXUtilsHelper::convertToArray($chat),array("msg"=>$chat_messages_transcript));
    }

    if (!empty($csvdata))
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=wplc_history.csv');
        $csv_stream = TCXUtilsHelper::generate_csv($csvdata);
        @fclose($csv_stream);
        exit;
    }
    else
    {
        wp_die(__('No data available','wp-live-chat-support'));
    }
    
}

function wplc_export_ratings(){
    if(!TCXUtilsHelper::check_page_action("wplivechat-menu-tools","export_ratings"))
    {
        return;
    }
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'toolsNonce')){
        wp_die(__("You do not have permission do perform this action", 'wp-live-chat-support'));
    }

    global $wpdb;
    global $wplc_tblname_chat_ratings;

	$csvdata = $wpdb->get_results(
        "
        SELECT cid as 'Chat ID', timestamp as 'Time', aid as 'Agent ID', rating as 'Rating', comment as 'Comment'
        FROM $wplc_tblname_chat_ratings
        ORDER BY `timestamp` DESC
      	", ARRAY_A
    );

    if (!empty($csvdata))
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=wplc_ratings.csv');
        $csv_stream = TCXUtilsHelper::generate_csv($csvdata);
        @fclose($csv_stream);
        exit;
    }
    else
    {
        wp_die(__('No data available','wp-live-chat-support'));
    }
}

function wplc_export_offline_messages(){
    if(!TCXUtilsHelper::check_page_action("wplivechat-menu-tools","export_offline_msg"))
    {
        return;
    }
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'toolsNonce')){
        wp_die(__("You do not have permission do perform this action", 'wp-live-chat-support'));
    }

    global $wpdb;
    global $wplc_tblname_offline_msgs;

	$csvdata = $wpdb->get_results(
        "
        SELECT id as 'ID', timestamp as 'Time', name as 'Name', email as 'Email', message as 'Message', ip as 'IP'
        FROM $wplc_tblname_offline_msgs
        ORDER BY `timestamp` DESC
      	", ARRAY_A
    );

    if (!empty($csvdata))
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=wplc_offline_messages.csv');
        $csv_stream = TCXUtilsHelper::generate_csv($csvdata);
        @fclose($csv_stream);
        exit;
    }
    else
    {
        wp_die(__('No data available','wp-live-chat-support'));
    }
}

function wplc_export_settings(){
    if(!TCXUtilsHelper::check_page_action("wplivechat-menu-tools","export_settings"))
    {
        return;
    }
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'toolsNonce')){
        wp_die(__("You do not have permission do perform this action", 'wp-live-chat-support'));
    }

    global $wpdb;
    global $wplc_tblname_offline_msgs;

	$wplc_settings_check = array(
        "WPLC_JSON_SETTINGS"=>"JSON",
		"WPLC_SETTINGS"=>"OBJECT",
		"WPLC_GA_SETTINGS"=>"OBJECT",
		"WPLC_BANNED_IP_ADDRESSES"=>"OBJECT",
		"WPLC_POWERED_BY"=>"OBJECT",
		"WPLC_DOC_SUGG_SETTINGS"=>"OBJECT",
		"WPLC_AUTO_RESPONDER_SETTINGS"=>"OBJECT",
		"WPLC_SN_SETTINGS"=>"OBJECT",
		"WPLC_ZENDESK_SETTINGS"=>"OBJECT",
		"WPLC_CCTT_SETTINGS"=>"OBJECT"
	);
    $csvdata=array();
	foreach ($wplc_settings_check as $key =>$value) {
		$current_setting = get_option($key, false);
		if($current_setting !== false){

			$csvdata[] = array(
				"OPTION" => $key,
				"VALUE" => base64_encode($value=="JSON"? $current_setting : TCXUtilsHelper::wplc_json_encode($current_setting))
			);
		}
	}

    if (!empty($csvdata))
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=settings.csv');
        $csv_stream = TCXUtilsHelper::generate_csv($csvdata);
        @fclose($csv_stream);
        exit;
    }
    else
    {
        wp_die(__('No data available','wp-live-chat-support'));
    }
}