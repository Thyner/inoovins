<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

add_action( 'wp_ajax_wplc_get_chat_info', 'wplc_get_chat_info' );
add_action( 'wp_ajax_wplc_admin_long_poll', 'wplc_long_poll_listing' );
add_action( 'wp_ajax_wplc_admin_long_poll_chat', 'wplc_long_poll_chat' );
add_action( 'wp_ajax_wplc_set_agent_chat', 'wplc_set_agent_chat' );
add_action( 'wp_ajax_wplc_get_chat_messages', 'wplc_get_chat_messages' );
add_action( 'wp_ajax_wplc_admin_send_msg', 'wplc_admin_send_msg' );
add_action( 'wp_ajax_wplc_admin_upload_file', 'wplc_admin_upload_file' );
add_action( 'wp_ajax_wplc_admin_close_chat', 'wplc_admin_close_chat' );
add_action( 'wp_ajax_wplc_choose_accepting', 'wplc_set_agent_accepting' );


function wplc_get_chat_info() {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}

	$current_user_id = wplc_validate_agent_call();
	$chat            = TCXChatData::get_chat( $wpdb, $cid );
	$chat->other     = maybe_unserialize( $chat->other );

	if( array_key_exists('custom_fields',$chat->other) && $chat->other['custom_fields'] != null)
	{
		foreach($chat->other['custom_fields'] as $key=>$custom_field)
		{
			$chat->other['custom_fields'][$key]['name'] = esc_html($custom_field['name']);
			$chat->other['custom_fields'][$key]['value'] = esc_html($custom_field['value']);
		}
	}

	die( TCXChatAjaxResponse::success_ajax_respose( $chat, $chat->status ) );
}

function wplc_set_agent_chat($is_transfer = false) {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}

	$current_user_id = wplc_validate_agent_call();
	$chat            = TCXChatData::get_chat( $wpdb, $cid );
	if ( $chat->agent_id != $current_user_id && ($is_transfer || $chat->agent_id <= 0)  ) {

		if ( TCXChatHelper::set_agent_id( $cid, $current_user_id ) !== false ) {
			if ( TCXChatHelper::set_chat_status( $cid, ChatStatus::ACTIVE ) !== false ) {
				    TCXChatHelper::set_messages_agent_id( $cid, $current_user_id );
					TCXWebhookHelper::send_webhook( WebHookTypes::AGENT_ACCEPT, array( "chat_id" => $cid ) );
					die( TCXChatAjaxResponse::success_ajax_respose( true, ChatStatus::ACTIVE ) );
			}
		}
	} else if( $chat->agent_id > 0 && $chat->agent_id != $current_user_id && !$is_transfer)
	{
		die( TCXChatAjaxResponse::error_ajax_respose( __("Another agent already joined this chat session.") ) );
	}
	else {
		die( TCXChatAjaxResponse::success_ajax_respose( true, ChatStatus::ACTIVE ) );
	}
	die( TCXChatAjaxResponse::error_ajax_respose( false ) );
}

function wplc_long_poll_listing() {
	global $wpdb;
	$agent_id         = wplc_validate_agent_call();
	$agent_department = get_user_meta( $agent_id, 'wplc_user_department', true );
	$agent_department = empty( $agent_department ) ? - 1 : $agent_department;
	$old_chat_data    = array();
	if ( ! empty( $_POST['wplc_update_admin_chat_table'] ) ) {
		$old_chat_data = $_POST['wplc_update_admin_chat_table'];
		if ( ! is_array( $old_chat_data ) ) {
			$old_chat_data = array();
		} else {
			$old_chat_data = $_POST['wplc_update_admin_chat_table'];
		}
	}

	$wplc_settings = TCXSettings::getSettings();
	$iterations    = TCXUtilsHelper::setup_polling( $wplc_settings );

	$i = 1;

	while ( $i <= $iterations ) {
		$chats = TCXChatData::get_incomplete_chats( $wpdb, $agent_department );
		if ( $i % round( $iterations / 2 ) == 0 || $i == 1 ) {
			$chats = TCXChatHelper::update_chat_statuses( $chats );
		}

		$to_update = array();
		$to_delete = array();
		$to_add    = array();

		$old_chat_ids = array_map( function ( $old_chat ) {
			return $old_chat['id'];
		}, $old_chat_data );

		foreach ( $chats as $key => $chat ) {
			$new_hash     =  wplc_generate_chat_hash($chat);
			$old_chat_key = array_search( $chat->id, $old_chat_ids );
			if ( $old_chat_ids != null && $old_chat_key !== false ) {
				if ( $old_chat_data[ $old_chat_key ]['hash'] != $new_hash ) {
					$chat->hash             = $new_hash;
					$to_update[ $chat->id ] = $chat;
				}
			} else {
				$chat->hash          = $new_hash;
				$to_add[ $chat->id ] = $chat;
			}
		}

		$pending = count( array_filter( $to_add, function ( $chat ) {
				return $chat->status == ChatStatus::PENDING_AGENT;
			} ) ) > 0;

		foreach ( $old_chat_data as $chat_hash ) {
			if ( ! in_array( $chat_hash['id'], array_map( function ( $chat ) {
				return $chat->id;
			}, $chats ) ) ) {
				$to_delete[ $chat_hash['id'] ] = 1;
			}
		}

		if ( ! empty( $to_add ) || ! empty( $to_delete ) || ! empty( $to_update ) ) {
			$result['data']    = array(
				"add"    => wplc_list_chats( $to_add ),
				"delete" => $to_delete,
				"update" => wplc_list_chats( $to_update )
			);
			$result['pending'] = $pending;
			$result['action']  = "wplc_update_chat_list";
			break;
		}

		if ( defined( 'WPLC_DELAY_BETWEEN_LOOPS' ) ) {
			usleep( WPLC_DELAY_BETWEEN_LOOPS );
		} else {
			usleep( 500000 );
		}
		$i ++;
	}
	if ( ! empty( $result ) ) {
		die( TCXChatAjaxResponse::success_ajax_respose( $result ) );
	} else {
		$result['action'] = "donothing";
		die( TCXChatAjaxResponse::success_ajax_respose( $result ) );
	}
}

function wplc_generate_chat_hash($chat)
{
	$result = new stdClass();
	$result->id = $chat->id;
	$result->timestamp = $chat->timestamp;
	$result->name = $chat->name;
	$result->email = $chat->email;
	$result->status = $chat->status;
	$result->state = $chat->state;
	$result->completed = $chat->completed;
	$result->session = $chat->session;
	$result->url = $chat->url;
	$result->agent_id = $chat->agent_id;

	return md5( json_encode( $result ) );
}

function wplc_long_poll_chat() {
	global $wpdb;
	$agent_id = wplc_validate_agent_call();

	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}

	if ( $cid > 0 ) {
		$wplc_settings = TCXSettings::getSettings();
		$iterations    = TCXUtilsHelper::setup_polling( $wplc_settings );

		$client_status = - 1;
		if ( ! empty( $_POST['status'] ) ) {
			$client_status = intval( sanitize_text_field( $_POST['status'] ) );
		}

		$last_code_delivered = "NONE";
		if ( ! empty( $_POST['last_informed'] ) ) {
			$last_code_delivered = sanitize_text_field( $_POST['last_informed'] );
		}

		$i        = 1;
		$result   = array();
		$messages = array();
		$codes    = array();
		$stop     = false;

		$last_status = $client_status;
		$chat        = TCXChatData::get_chat( $wpdb, $cid );

		while ( $i <= $iterations ) {
			$clean_previous = $i % 10 == 0;
			$changeSet      = TCXChatHelper::get_queued_actions( $cid, $agent_id, $last_code_delivered, $clean_previous );
			foreach ( $changeSet as $change ) {
				$data               = json_decode( $change->data, true );
				$message_properties = json_decode( $change->message_properties );
				switch ( $change->action_type ) {
					case ActionTypes::START_QUEUE:
						$codes[] = array( "code" => $change->code, "added_at" => $change->timestamp_added_at );
						$stop    = true;
						break;
					case ActionTypes::NEW_MESSAGE:
						$messages[] = array(
							"id"         => $change->message_id,
							"msg"        => TCXChatHelper::decrypt_msg( $data ),
							"added_at"   => $change->timestamp_added_at,
							"originates" => $change->sender,
							"is_file"    => is_object( $message_properties ) && isset( $message_properties->isFile ) ? $message_properties->isFile : false
						);
						$codes[]    = array( "code" => $change->code, "added_at" => $change->timestamp_added_at );
						$stop       = true;
						break;
					case ActionTypes::CHANGE_STATUS:
						$last_status = $data['new_status'];
						switch ( $data['new_status'] ) {
							case ChatStatus::ACTIVE:
								$agent                     = TCXAgentsHelper::get_agent( $chat->agent_id );
								$messages[0]['id']         = - 1;
								$messages[0]['msg']        = stripslashes( __( "Agent" ." ". $agent->display_name . " joined the chat", 'wp-live-chat-support' ) );
								$messages[0]['added_at']   = $change->timestamp_added_at;
								$messages[0]['originates'] = UserTypes::SYSTEM;
								$messages[0]['is_file']    = false;
								$codes[]                   = array(
									"code"     => $change->code,
									"added_at" => $change->timestamp_added_at
								);
								$stop                      = true;
								break;
							case ChatStatus::MISSED:
							case ChatStatus::ENDED_DUE_AGENT_INACTIVITY:
							case ChatStatus::ENDED_DUE_CLIENT_INACTIVITY:
								$messages[0]['id']         = - 2;
								$messages[0]['msg']        = __( "Chat session ended due to long period of inactivity.", 'wp-live-chat-support' );
								$messages[0]['added_at']   = $change->timestamp_added_at;
								$messages[0]['originates'] = UserTypes::SYSTEM;
								$messages[0]['is_file']    = false;
								$codes[]                   = array(
									"code"     => $change->code,
									"added_at" => $change->timestamp_added_at
								);
								$stop                      = true;
								break;
							case ChatStatus::ENDED_BY_AGENT:
								$messages[0]['id']         = - 3;
								$messages[0]['msg']        = __( "Admin has closed and ended the chat", 'wp-live-chat-support' );
								$messages[0]['added_at']   = $change->timestamp_added_at;
								$messages[0]['originates'] = UserTypes::SYSTEM;
								$messages[0]['is_file']    = false;
								$codes[]                   = array(
									"code"     => $change->code,
									"added_at" => $change->timestamp_added_at
								);
								$stop                      = true;
								break;
							case ChatStatus::ENDED_BY_CLIENT:
								$messages[0]['id']         = - 4;
								$messages[0]['msg']        = __( "Client has closed and ended the chat", 'wp-live-chat-support' );
								$messages[0]['added_at']   = $change->timestamp_added_at;
								$messages[0]['originates'] = UserTypes::SYSTEM;
								$messages[0]['is_file']    = false;
								$codes[]                   = array(
									"code"     => $change->code,
									"added_at" => $change->timestamp_added_at
								);
								$stop                      = true;
								break;
							default:
								break;
						}
						break;
				}
			}

			if ( $stop ) {
				break;
			}

			$i ++;
			if ( defined( 'WPLC_DELAY_BETWEEN_LOOPS' ) ) {
				usleep( WPLC_DELAY_BETWEEN_LOOPS );
			} else {
				usleep( 500000 );
			}
		}
		$result["Messages"]    = $messages;
		$result["ActionCodes"] = $codes;
		die( TCXChatAjaxResponse::success_ajax_respose( $result, $last_status ) );
	}
}

function wplc_get_chat_messages() {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}

	$chat     = TCXChatData::get_chat( $wpdb, $cid );
	$agent_id = wplc_validate_agent_call( $chat->agent_id );
	$messages = wplc_load_all_messages( $chat );
	die( TCXChatAjaxResponse::success_ajax_respose( $messages, $chat->status ) );
}

function wplc_admin_send_msg() {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}
	$message = '';
	if ( strlen($_POST['msg'])>0 ) {
		$message = stripslashes($_POST['msg']) ;
	}

	$chat     = TCXChatData::get_chat( $wpdb, $cid );
	$agent_id = wplc_validate_agent_call( $chat->agent_id );

	$new_msg_id = TCXChatHelper::add_chat_message( UserTypes::AGENT, $cid, $message, null, $agent_id );
	$result     = new stdClass();
	$result->id = - 1;
	if ( $new_msg_id >= 0 ) {
		$added_message      = TCXChatData::get_chat_message( $wpdb, $new_msg_id );
		$result->id         = $added_message->id;
		$result->added_at   = $added_message->timestamp;
		$result->msg        = TCXChatHelper::decrypt_msg( $added_message->msg );
		$result->originates = $added_message->originates;
	}
	die( TCXChatAjaxResponse::success_ajax_respose( $result, $chat->status ) );
}

function wplc_admin_upload_file() {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}

	$chat     = TCXChatData::get_chat( $wpdb, $cid );
	$agent_id = wplc_validate_agent_call( $chat->agent_id );

	$response = new stdClass();
	add_filter( 'upload_dir', 'wplc_set_wplc_upload_dir_filter' );
	foreach ( $_FILES as $file ) {
		$upload_overrides = array( 'test_form' => false );
		$file_info        = wp_handle_upload( $file, $upload_overrides );
		$chat_msg         = $file_info['url'];

		$fileData           = new stdClass();
		$fileData->FileName = $file['name'];
		$fileData->FileLink = $file_info['url'];
		$fileData->FileSize = $file['size'];

		$wplc_rec_msg = TCXChatHelper::add_chat_message( UserTypes::AGENT, $cid, $chat_msg, $fileData, $agent_id );

		$added_message        = TCXChatData::get_chat_message( $wpdb, $wplc_rec_msg );
		$response->fileLink        = $fileData->FileLink;
		$response->fileName        = $fileData->FileName;
		$response->fileSize        = $fileData->FileSize;
		$response->id         = $wplc_rec_msg;
		$response->added_at   = $added_message->timestamp;
		$response->originates = $added_message->originates;
	}
	remove_filter( 'upload_dir', 'wplc_set_wplc_upload_dir_filter' );
	die( TCXChatAjaxResponse::success_ajax_respose( $response ) );
}

function wplc_load_non_read_messages( $chat, $agent_id ) {
	$result   = array();
	$messages = TCXChatHelper::get_chat_messages( $chat->id, "NON_READ", $agent_id );
	if ( $messages && is_array( $messages ) ) {
		$result = wplc_convert_to_client_messages( $messages );
		TCXChatHelper::mark_messages_as_read( array_map( function ( $message ) {
			return $message->id;
		}, $messages ) );
	}

	return $result;
}

function wplc_load_all_messages( $chat ) {
	$result   = array();
	$messages = TCXChatHelper::get_chat_messages( $chat->id );
	if ( $messages && is_array( $messages ) ) {
		$result = wplc_convert_to_client_messages( $messages );
	}

	return $result;
}

function wplc_list_chats( $chats ) {
	$results = array();
	if ( $chats ) {
		foreach ( $chats as $chat ) {
			$other_data = maybe_unserialize( $chat->other );
			$user_data  = json_decode( $chat->ip ,true);

			$result            = new stdClass();
			$result->id        = $chat->id;
			$result->agent_id        = $chat->agent_id;
			$result->timestamp = $chat->timestamp;// TCXUtilsHelper::generate_date_diff_string( $chat->timestamp );
			$result->name      = esc_html($chat->name);
			$result->email     = esc_html($chat->email);
			$result->status    = $chat->status;
			$result->state     = $chat->state;
			$result->url       = parse_url( $chat->url, PHP_URL_PATH );;
			$result->session     = $chat->session;
			$result->actions_enabled = TCXAgentsHelper::is_agent();
			if ( ( current_time( 'timestamp' ) - strtotime( $chat->timestamp ) ) < 3600 ) {
				$result->type = __( "New", 'wp-live-chat-support' );
			} else {
				$result->type = __( "Returning", 'wp-live-chat-support' );
			}
			$result->user_is_mobile = array_key_exists( "user_is_mobile", $other_data ) ? $other_data["user_is_mobile"] : false;
			$result->country        = array_key_exists('country',$user_data) ? $user_data['country']:"{}" ;
			$result->browser        = @TCXUtilsHelper::get_browser_string( $user_data['user_agent'] );
			$result->browser_image  = TCXUtilsHelper::get_browser_image( $result->browser, "16" );
			$result->is_in_progress = ( intval( $chat->status ) == 3 || intval( $chat->status ) == 10 ) && ! ( ! isset( $chat->agent_id ) || intval( $chat->agent_id ) === 0 || get_current_user_id() == $chat->agent_id );
			$result->hash           = $chat->hash;
			$results[ $chat->id ]   = $result;
		}
	}

	return $results;
}

function wplc_convert_to_client_messages( $messages ) {
	$result = array_map( function ( $message ) {
		return wplc_convert_to_client_message( $message );
	}, $messages );

	return $result;
}

function wplc_convert_to_client_message( $message ) {
	$message_properties = json_decode( $message->other );
	$message_response   = array(
		"id"         => $message->id,
		"msg"        => TCXChatHelper::decrypt_msg( $message->msg ),
		"code"       => "NONE",
		"added_at"   => $message->timestamp,
		"originates" => $message->originates,
		"is_file"    => is_object( $message_properties ) && isset( $message_properties->isFile ) ? $message_properties->isFile : false
	);

	return $message_response;
}

function wplc_admin_close_chat() {
	global $wpdb;
	$cid = 0;
	if ( ! empty( $_POST['cid'] ) ) {
		$cid = sanitize_text_field( $_POST['cid'] );
	}
	$chat     = TCXChatData::get_chat( $wpdb, $cid );
	$agent_id = wplc_validate_agent_call( $chat->agent_id );

	if ( TCXChatHelper::end_chat( $cid, ChatStatus::ENDED_BY_AGENT ) ) {
		die( TCXChatAjaxResponse::success_ajax_respose( "CHAT ENDED", ChatStatus::ENDED_BY_AGENT ) );
	} else {
		die( TCXChatAjaxResponse::error_ajax_respose( "Unable to end Chat" ) );
	}

}

function wplc_validate_agent_call( $chat_agent_id = - 1 ) {
	if ( ! TCXAgentsHelper::is_agent() ) {
		die( TCXChatAjaxResponse::error_ajax_respose( "Not an agent." ) );
	}

	if ( ! check_ajax_referer( 'wplc', 'security' ,false) ) {
		die( TCXChatAjaxResponse::error_ajax_respose( "Invalid nonce." ) );
	}

	$agent_id = get_current_user_id();
	if ( $chat_agent_id > 0 && $agent_id != $chat_agent_id ) {
		die( TCXChatAjaxResponse::error_ajax_respose( "Current agent doesn't match with the agent who is responsible for that chat" ) );
	}

	return $agent_id;
}

function wplc_set_agent_accepting() {
	$is_online = false;
	if ( ! empty( $_POST['is_online'] ) ) {
		$is_online = $_POST['is_online'] == "true";
	}
	$current_user_id = wplc_validate_agent_call();
	if ( TCXAgentsHelper::is_agent( $current_user_id ) ) {
		TCXAgentsHelper::set_agent_accepting( $current_user_id, $is_online );
		if ( ! $is_online ) {
			delete_user_meta( $current_user_id, "wplc_chat_agent_online" );
		}
	}

	$online_agents = TCXAgentsHelper::get_online_agent_users();

	$result = array_map( function ( $value ) {
		return $value->data->user_login;
	}, $online_agents );

	die( TCXChatAjaxResponse::success_ajax_respose( $result ) );
}

