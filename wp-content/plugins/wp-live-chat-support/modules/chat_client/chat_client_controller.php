<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ChatClientController extends BaseController {

	public function __construct( $alias, $custom_view = null ) {
		parent::__construct( __( "Chat Client", 'wp-live-chat-support' ), $alias, $custom_view );
	}

	private function enable_auto_popup() {
		global $wplc_base_file;
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			require_once( plugin_dir_path( $wplc_base_file ) . 'includes/Mobile_Detect.php' );
		}
		$wplc_detect_device = new Mobile_Detect;
		$is_mobile          = $wplc_detect_device->isMobile();
		$do_popup_by_agents = ( $this->wplc_settings->wplc_auto_pop_up_online && TCXAgentsHelper::exist_available_agent() ) || ! $this->wplc_settings->wplc_auto_pop_up_online;
		switch ( $this->wplc_settings->wplc_auto_pop_up ) {
			case 1:
				$do_popup = ! $is_mobile && $do_popup_by_agents;
				break;
			case 2:
				$do_popup = $is_mobile && $do_popup_by_agents;
				break;
			case 3:
				$do_popup = $do_popup_by_agents;
				break;
			default:
				$do_popup = false;
				break;
		}

		return $do_popup;
	}

	private function get_chat_animation() {
		$result = "none";
		switch ( $this->wplc_settings->wplc_animation ) {
			case "animation-1":
				$result = "slideUp";
				break;
			case "animation-2":
				$result = "slideLeft";
				break;
			case "animation-3":
				$result = "fadeIn";
				break;
			default:
				$result = "none";
				break;
		}

		return $result;

	}

	private function generate_position_style() {
		$result = "";
		switch ( $this->wplc_settings->wplc_settings_align ) {
			case "1":
				$result = "left: 20px; bottom: 20px;";
				break;
			case "2":
				$result = "right: 20px; bottom: 20px;";
				break;
			case "3":
				$result = "left: 20px; bottom: 200px;";
				break;
			case "4":
				$result = "right: 20px; bottom: 200px;";
				break;
			default:
				$result = "bottom: 0; right: 6px;";
				break;
		}

		return $result;
	}

	private function get_integration_links() {
		return (object) array(
			"facebook" => esc_attr( $this->wplc_settings->wplc_social_fb ),
			"twitter"  => esc_attr( $this->wplc_settings->wplc_social_tw )
		);
	}

	public function view( $return_html = false, $add_wrapper = true ) {
		if ( $this->wplc_settings->wplc_display_to_loggedin_only && ! is_user_logged_in() ) {
			return;
		}
		$this->view_data["chat_icon"]         = esc_url_raw( $this->wplc_settings->wplc_chat_icon );
		$this->view_data["chat_logo"]         = esc_url_raw( $this->wplc_settings->wplc_chat_logo );
		$this->view_data["agent_name"]        = __( "Support", 'wp-live-chat-support' );
		$this->view_data["auth_type"]         = sanitize_text_field( $this->wplc_settings->wplc_require_user_info );
		$this->view_data["position_style"]    = $this->generate_position_style();
		$this->view_data["animation"]         = $this->get_chat_animation();
		$this->view_data["integrations"]      = $this->get_integration_links();
		$this->view_data["minimized"]         = ! $this->enable_auto_popup() ? "true" : "false";
		$this->view_data["enable_typing"]     = $this->wplc_settings->wplc_typing_enabled ? "true" : "false";
		$this->view_data["is_enable"]         = $this->wplc_settings->wplc_settings_enabled == "1" ? "true" : "false";
		$this->view_data["enable_mobile"]     = $this->wplc_settings->wplc_enabled_on_mobile ? "true" : "false";
		$this->view_data["enable_poweredby"]  = $this->wplc_settings->wplc_powered_by ? "true" : "false";
		$this->view_data["enable_msg_sounds"] = $this->wplc_settings->wplc_enable_msg_sound ? "true" : "false";
		$this->view_data["channel"]           = $this->wplc_settings->wplc_channel;

		$this->view_data["message_sound"] = isset( $this->wplc_settings->wplc_messagetone ) ? TCXRingtonesHelper::get_messagetone_url( $this->wplc_settings->wplc_messagetone ) : '';

		$this->view_data["wp_url"] = admin_url( 'admin-ajax.php' );
		switch ( $this->wplc_settings->wplc_channel ) {
			case 'phone':
				$c2c_url                        = parse_url( esc_url_raw( $this->wplc_settings->wplc_channel_url ) );
				$this->view_data["channel_url"] = ( array_key_exists( 'scheme', $c2c_url ) ? $c2c_url['scheme'] : '' ) . "://" . $c2c_url['host'] . ( array_key_exists( 'port', $c2c_url ) ? ":" . $c2c_url['port'] : '' );
				break;
			case 'wp':
				$this->view_data["channel_url"] = esc_url_raw( $this->wplc_settings->wplc_channel_url );
				break;
			case 'mcu':
				$wplc_chat_server_data                  = TCXUtilsHelper::get_mcu_data( $this->wplc_settings->wplc_socket_url, $this->wplc_settings->wplc_chat_server_session );
				$this->view_data["channel_url"]         = esc_url_raw( $wplc_chat_server_data["socket_url"], [ "wss" ] );
				$this->view_data["chat_server_session"] = $wplc_chat_server_data["chat_server_session"];
				break;
		}


		$this->view_data["files_url"] = esc_url_raw( $this->wplc_settings->wplc_files_url );

		$this->view_data["secret"] = wp_create_nonce( "wplc" );

		$this->view_data["chatParty"] = $this->wplc_settings->wplc_chat_party;

		$this->view_data["agentColor"] = $this->wplc_settings->wplc_settings_agent_color;

		$this->view_data["clientColor"] = $this->wplc_settings->wplc_settings_client_color;

		$this->view_data["baseColor"]        = $this->wplc_settings->wplc_settings_base_color;
		$this->view_data["gradientEndColor"] = $this->get_secondary_gradient_color( $this->wplc_settings->wplc_settings_base_color );

		$this->view_data["shadowColor"] = $this->get_shadow_color( $this->wplc_settings->wplc_settings_base_color );


		$this->view_data["emoji_enabled"]       = $this->wplc_settings->wplc_disable_emojis == '1' ? "false" : "true";
		$this->view_data["gdpr_enabled"]        = $this->wplc_settings->wplc_gdpr_enabled == '1' ? "true" : "false";
		$this->view_data["gdpr_message"]        = $this->wplc_settings->wplc_gdpr_custom == '1' ? $this->wplc_settings->wplc_gdpr_notice_text : wplc_gdpr_generate_retention_agreement_notice( $this->wplc_settings );
		$this->view_data["files_enabled"]       = $this->wplc_settings->wplc_channel != "phone" && $this->wplc_settings->wplc_ux_file_share == '1' ? "true" : "false";
		$this->view_data["rating_enabled"]      = $this->wplc_settings->wplc_channel != "phone" && $this->wplc_settings->wplc_ux_exp_rating == '1' ? "true" : "false";
		$this->view_data["departments_enabled"] = $this->wplc_settings->wplc_allow_department_selection == '1' ? "true" : "false";

		$this->view_data["chat_height"]    = $this->wplc_settings->wplc_chatbox_height == 0 ? $this->wplc_settings->wplc_chatbox_absolute_height . 'px'
			: $this->wplc_settings->wplc_chatbox_height * 95 / 100 . 'vh';
		$this->view_data["minimizedStyle"] = $this->wplc_settings->wplc_settings_minimized_style;

		$this->view_data["showAgentsName"] = $this->wplc_settings->wplc_loggedin_user_info == '1' ? "true" : "false";

		$this->view_data["onlyPhone"]           = $this->wplc_settings->wplc_channel == "phone" && $this->wplc_settings->wplc_allow_chat == '0';
		$this->view_data["allowCalls"]          = $this->wplc_settings->wplc_channel == "phone" && $this->wplc_settings->wplc_allow_call == '1' ? "true" : "false";
		$this->view_data["allowVideo"]          = $this->wplc_settings->wplc_channel == "phone" && $this->wplc_settings->wplc_allow_video == '1' ? "true" : "false";
		$this->view_data["acknowledgeReceived"] = $this->wplc_settings->wplc_channel == "phone" ? "true" : "false";

		$this->view_data["messageDateFormat"]     = $this->get_date_format();
		$this->view_data["messageUserinfoFormat"] = $this->get_user_info_format();

		return $this->load_view( plugin_dir_path( __FILE__ ) . "chat_client_view.php", $return_html, $add_wrapper );
	}

	public function preview_view() {
		$default_settings                    = TCXSettings::getDefaultSettings();
		$this->view_data["channel_url"]      = esc_url_raw( $default_settings->wplc_channel_url );
		$this->view_data["agentColor"]       = $default_settings->wplc_settings_agent_color;
		$this->view_data["clientColor"]      = $default_settings->wplc_settings_client_color;
		$this->view_data["baseColor"]        = $default_settings->wplc_settings_base_color;
		$this->view_data["gradientEndColor"] = $this->get_secondary_gradient_color( $this->wplc_settings->wplc_settings_base_color );
		$this->view_data["onlyPhone"]        = false;
		$this->view_data["allowCalls"]       = false;
		$this->view_data["allowVideo"]       = false;

		return $this->load_view( plugin_dir_path( __FILE__ ) . "chat_client_preview.php" );
	}

	private function get_date_format() {
		$result = "none";
		if ( $this->wplc_settings->wplc_show_date && $this->wplc_settings->wplc_show_time ) {
			$result = "both";
		} else if ( $this->wplc_settings->wplc_show_date ) {
			$result = "date";
		} else if ( $this->wplc_settings->wplc_show_time ) {
			$result = "time";
		}

		return $result;
	}

	private function get_user_info_format() {
		$result = "none";
		if ( $this->wplc_settings->wplc_show_name && $this->wplc_settings->wplc_show_avatar ) {
			$result = "both";
		} else if ( $this->wplc_settings->wplc_show_avatar ) {
			$result = "avatar";
		} else if ( $this->wplc_settings->wplc_show_name ) {
			$result = "name";
		}

		return $result;
	}

	private function get_shadow_color( $hexColor ) {
		$hexColor = str_replace( '#', '', $hexColor );
		// Convert string to 3 decimal values (0-255)
		$rgb = array_map( 'hexdec', str_split( $hexColor, 2 ) );

		$rgb[0] += 34;
		$rgb[1] += 34;
		$rgb[2] += 17;

		$result = implode( '', array_map( 'dechex', $rgb ) );

		return '#' . $result;
	}

	private function get_secondary_gradient_color( $rgb, $darker = 1.5 ) {
		$hash = ( strpos( $rgb, '#' ) !== false ) ? '#' : '';
		$rgb  = ( strlen( $rgb ) == 7 ) ? str_replace( '#', '', $rgb ) : ( ( strlen( $rgb ) == 6 ) ? $rgb : false );
		if ( strlen( $rgb ) != 6 ) {
			return $hash . '000000';
		}
		$darker = ( $darker > 1 ) ? $darker : 1;

		list( $R16, $G16, $B16 ) = str_split( $rgb, 2 );

		$R = sprintf( "%02X", floor( hexdec( $R16 ) / $darker ) );
		$G = sprintf( "%02X", floor( hexdec( $G16 ) / $darker ) );
		$B = sprintf( "%02X", floor( hexdec( $B16 ) / $darker ) );

		return $hash . $R . $G . $B;
	}


}


?>