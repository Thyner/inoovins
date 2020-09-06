<?php
class TCXChatSession
{

    public function __construct()
    {}

    public $id;
    public $name;
    public $email;
    public $status;
    public $timestamp;
    public $end_timestamp;
    public $url;
    public $client_data;
    public $rating;
    public $custom_fields;
	public $seconds_duration;
	public $agent_counter;
	public $client_counter;

    public function getRatingName(){
        switch ($this->rating) {
            case 1:
                return __("Satisfied", 'wp-live-chat-support');
                break;
            case 0:
                return __("Unsatisfied", 'wp-live-chat-support');
                break;
            default:
                return __("No Rating",'wp-live-chat-support');
                break;
        }
    }

    public function getStatusName()
    {
        switch ($this->status) {
            case ChatStatus::OLD_ENDED :
                return __("complete", 'wp-live-chat-support');
                break;
            case ChatStatus::PENDING_AGENT:
                return __("pending", 'wp-live-chat-support');
                break;
            case ChatStatus::ACTIVE:
                return __("active", 'wp-live-chat-support');
                break;
            case ChatStatus::BROWSE:
                return __("browsing", 'wp-live-chat-support');
                break;
            case ChatStatus::MISSED:
                return __("Missed", 'wp-live-chat-support');
                break;
            case ChatStatus::ENDED_BY_AGENT:
                return __("Ended by agent", 'wp-live-chat-support');
                break;
	        case ChatStatus::ENDED_BY_CLIENT:
		        return __("Ended by client", 'wp-live-chat-support');
		        break;
	        case ChatStatus::ENDED_DUE_CLIENT_INACTIVITY:
		        return __("Ended due client inactivity", 'wp-live-chat-support');
		        break;
	        case ChatStatus::ENDED_DUE_AGENT_INACTIVITY:
		        return __("Ended due agent inactivity", 'wp-live-chat-support');
		        break;
            default:
                return __("Unknown",'wp-live-chat-support');
                break;
        }
    }



    public function getSessionHistoryUrl()
    {
        return admin_url('admin.php?page=wplivechat-session-details&cid=' . $this->id . "&nonce=" . wp_create_nonce("sessionDetailsNonce"));
    }

    public function getDownloadSessionHistoryUrl()
    {
        return admin_url('admin.php?page=wplivechat-menu-session&wplc_action=download_session&type=csv&cid=' . $this->id . "&nonce=" . wp_create_nonce("downloadSessionsNonce"));
    }

    public function getRemoveSessionUrl($page, $pageNum = null)
    {
        return admin_url('admin.php?page=' . $page . '&wplc_action=prompt_remove_session&cid=' . $this->id . ($pageNum != null ? "&pagenum=" . $pageNum : ""));
    }

}
?>