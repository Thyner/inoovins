<?php
if (!defined('ABSPATH')) {
    exit;
}

class ReportsController extends BaseController
{

    private $pager;
        
    public function __construct($alias)
    {
        parent::__construct( __("Reports", 'wp-live-chat-support'),$alias);
    }

    public function view($return_html = false, $add_wrapper=true)
    {
        $agent_stats = self::get_agent_stats($this->db,14);
        usort($agent_stats,array('ReportsController','push_down_empty_agent_sort'));

        $this->view_data["agent_stats"] =  $agent_stats;

        $this->view_data["sessions_stats"] = self::get_sessions_stats($this->db,14);

        return $this->load_view(plugin_dir_path(__FILE__) . "reports_view.php",$return_html,$add_wrapper);
    }

    private static function push_down_empty_agent_sort($a,$b)
    {
        if($a->aid==null|| $a->aid == 0)
        {
            return 1;
        }
        else if( $b->aid==null || $b->aid == 0)
        {
            return -1;
        }
        else
        {
            return $a->aid-$b->aid;
        }
    }

    //Data access
    public static function get_agent_stats($db,$days_span)
    {
        //We need both all of the agents and ratings without agent reference so we have to use a UNION.
        //Don't like it maybe we can consider some changes on DB!!!
        global $wplc_tblname_chat_ratings;
        $results = array();

        $sql_stats = "                
                select  
                        wp_users.id as user_id,
                        wp_users.user_email,
                        wp_users.display_name,
                        stats.aid,
                        stats.total_ratings,
                        stats.good_count,
                        stats.bad_count,
                        stats.good_count*100/stats.total_ratings as percentage
                        from 
                        (
                            SELECT 
                            aid,
                            count(*) as total_ratings,
                            sum(case when rating=1 then 1 else 0 end) as good_count,
                            sum(case when rating=0 then 1 else 0 end) as bad_count
                            FROM  $wplc_tblname_chat_ratings
                            WHERE timestamp > DATE_SUB(NOW(), INTERVAL %d DAY)
                            group by aid
                        )stats
                left join wp_users  on stats.aid = wp_users.ID 
                union 
                select 
                        wp_users.id as user_id,
                        wp_users.user_email,
                        wp_users.display_name,
                        0 as aid,
                        0 as total_ratings,
                        0 as good_count,
                        0 as bad_count,
                        0 as percentage
                from wp_users
                where not exists (select 1 from  $wplc_tblname_chat_ratings where  $wplc_tblname_chat_ratings.aid = wp_users.ID and  $wplc_tblname_chat_ratings.timestamp > DATE_SUB(NOW(), INTERVAL %d DAY))
                order by  aid asc";

        $db_results = $db->get_results($db->prepare($sql_stats
            , $days_span,$days_span));

        foreach ($db_results as $key => $db_result) {
            $stat = new stdClass();
            $stat->user_id =$db_result->user_id;
            $stat->user_email = $db_result->user_email;
            $stat->user_name = $db_result->display_name;
            $stat->aid = $db_result->aid;
            $stat->total_ratings = $db_result->total_ratings;
            $stat->good_count = $db_result->good_count;
            $stat->bad_count = $db_result->bad_count;
            $stat->percentage = $db_result->percentage;
            $results[$key] = $stat;
        }
        
        return $results;
    }

    public static function get_sessions_stats($db, $days_span){
        global $wplc_tblname_chats;
        $result = new stdClass();
        $sql = "SELECT * FROM `$wplc_tblname_chats` WHERE `agent_id` <> 0 and timestamp > DATE_SUB(NOW(), INTERVAL %d DAY) ORDER BY `timestamp` DESC";
        $db_results = $db->get_results( $db->prepare($sql,$days_span) );
        $popular_user_agent = array();
        $chats_on_days = array();
        $popular_url = array();
        $chat_durations = array();
        $popular_chat_agent = array();
        $agent_data = array();
        foreach( $db_results as $db_result ){
            $ip_data = json_decode( $db_result->ip ,true);
            $popular_chat_agent[] = $db_result->agent_id;
            $popular_user_agent[] = isset($ip_data['user_agent']) ? $ip_data['user_agent'] : __("Unknown", 'wp-live-chat-support');
            $chats_on_days[] = date('Y-m-d', strtotime( $db_result->timestamp ) );
            $popular_url[] = $db_result->url;
        }
        /* Agent Data */
        
        $agent_totals = array_count_values($popular_chat_agent );   
        arsort($agent_totals);
        
        $result->total_agents_counted = count( $agent_totals );
        /* User Agent Data */   
        $result->user_agent_totals = array_count_values( $popular_user_agent );
        arsort($result->user_agent_totals);

        $result->total_user_agent = count( $result->user_agent_totals );
        /* Daily Chat Totals */
        $result->daily_chat_totals = array_count_values( $chats_on_days );
        // arsort($daily_chat_totals);
        $result->total_chats = count( $result->daily_chat_totals );
        /* URL Data */
        $result->individual_urls_counted = array_count_values( $popular_url );
        arsort($result->individual_urls_counted);
        $result->total_urls_counted = count( $result->individual_urls_counted );
        if( $agent_totals ){
            foreach( $agent_totals as $key => $val ){
                $user = get_user_by( 'id', intval( $key ) );
                if( $user ){
                    $display_name = $user->data->display_name;
                } else {
                    $display_name = '';
                }
                $result->agent_data[intval($key)] = $display_name;
            }
        }
        return $result;
    }

}

?>
