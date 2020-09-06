<?php
if (!defined('ABSPATH')) {
    exit;
}

class TriggersController extends BaseController
{

    private $pager;
        
    public function __construct($alias)
    {
        parent::__construct( __("Triggers", 'wp-live-chat-support'),$alias);
        $this->init_actions();
        $this->parse_action($this->available_actions);
    }

    public function load_triggers()
    {
        global $wplc_tblname_triggers;
        $results = array();
        $db_results = self::get_triggers($this->db,$this->pager->rows_per_page, $this->pager->offset);

        foreach ($db_results as $key => $db_result) {
            $trigger = new TCXTrigger();
            $trigger->id = $db_result->id;
            $trigger->name = $db_result->name;
            $trigger->type = $db_result->type;
            $trigger->status = $db_result->status;
            $trigger->content = $db_result->content; 
            $trigger->show_content = $db_result->show_content; 
            $results[$key] = $trigger;
        }

        return $results;
    }

    public function delete_trigger($trid)
    {
        global $wplc_tblname_triggers;
        if ($trid > 0) {
                self::remove_trigger($this->db,$trid);
                if ($this->db->last_error) {
                  $this->view_data["delete_success"] = false;
                } else {
                  $this->view_data["delete_success"] = true;
                }
        }
    }

    public function change_trigger_status($trid,$new_status)
    {
        if ($trid > 0) {
            self::update_trigger_status($this->db,$trid,$new_status);
        }
    }
    

    public function view($return_html = false, $add_wrapper=true)
    {
	    $this->pager = TCXUtilsHelper::wplc_get_pager(self::generate_triggers_query());
        $this->view_data["triggers"] = $this->load_triggers();
        $this->view_data["delete_trigger_nonce"] = wp_create_nonce('DeleteTrigger');
        
        $this->view_data["current_page"] = $this->pager->current_page;
        
        $this->view_data["page_links"] = paginate_links(array(
            'base' => add_query_arg('pagenum', '%#%'),
            'format' => '',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'total' => $this->pager->pages_counter,
            'current' => $this->pager->current_page,
        ));


	    return $this->load_view(plugin_dir_path(__FILE__) . "triggers_view.php",$return_html,$add_wrapper);
    }

    private function init_actions()
    {
        $this->available_actions = [];
        $this->available_actions[] = new TCXPageAction("prompt_remove_trigger");

        $params = [];
        $params[] = isset($_GET['trid']) ? intval(sanitize_text_field($_GET['trid'])) : -1;
        
        $this->available_actions[] = new TCXPageAction("execute_remove_trigger", 9, "DeleteTrigger", 'delete_trigger', $params);

        $params[] = isset($_GET['trstatus']) ? intval(sanitize_text_field($_GET['trstatus'])) : 0;
        $this->available_actions[] = new TCXPageAction("change_trigger_status", 9, "ChangeTriggerStatus", 'change_trigger_status', $params);

    }

    public static function module_db_integration()
    {
        global $wplc_tblname_triggers;
        $sql = "
        CREATE TABLE `" . $wplc_tblname_triggers . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(700) NOT NULL,
            `type` int(11) NOT NULL,
            `content` longtext NOT NULL,
            `show_content` tinyint(1) NOT NULL,
            `status` tinyint(1) NOT NULL,
            PRIMARY KEY  (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        ";
    
        dbDelta($sql);
    }

    //db access

	public static function generate_triggers_query(){
		global $wplc_tblname_triggers;
		return "SELECT * FROM $wplc_tblname_triggers ";
	}

    public static function get_triggers($db,$limit=100000,$offset=0)
    {
        global $wplc_tblname_triggers;
        $db_results = $db->get_results($db->prepare(self::generate_triggers_query()." ORDER BY `status` desc, `name` ASC LIMIT %d OFFSET %d", $limit,$offset));
        return $db_results;
    }

    public static function remove_trigger($db , $trid)
    {
        global $wplc_tblname_triggers;
      
        $delete_sql = "DELETE FROM $wplc_tblname_triggers WHERE `id` = '%d' LIMIT 1";
        $delete_sql = $db->prepare($delete_sql, $trid);
        $db->query($delete_sql);
    }

    public static function update_trigger_status($db , $trid,$status)
    {
        global $wplc_tblname_triggers;
      
        $update_sql = "UPDATE $wplc_tblname_triggers SET `status` = %d WHERE `id` = '%d' LIMIT 1";
        $update_sql = $db->prepare($update_sql, $status, $trid);
        $db->query($update_sql);
    }

}

?>