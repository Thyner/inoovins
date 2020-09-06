<?php
if (!defined('ABSPATH')) {
    exit;
}

class ManageTriggerController extends BaseController
{

    private $trid;
    
    
    public function __construct($alias,$trid=-1)
    {
        parent::__construct( __("Manage Trigger", 'wp-live-chat-support'),$alias);
        $this->trid = $trid;
        $this->init_actions();
        $this->parse_action($this->available_actions);
    }

    //Actions
    public function view($return_html = false, $add_wrapper=true)
    {
        if($this->trid>0)
        {
            $this->view_data["trigger"] = $this->load_trigger_data();    
        }
        else
        {
            $this->view_data["trigger"] = new TCXTrigger(); 
            $this->view_data["trigger"]->id=-1;
        }
        $this->view_data["save_action_url"] = $this->view_data["trigger"]->getSaveUrl();
	    return $this->load_view(plugin_dir_path(__FILE__) . "manage_trigger_view.php",$return_html,$add_wrapper);
    }

    public function load_trigger_data()
    {
        global $wplc_tblname_triggers;
        $trigger = new TCXTrigger();
        $db_result = self::get_trigger_data($this->db, $this->trid);

        if($db_result)
        {
            $db_trigger = reset($db_result);
            $trigger->id = $db_result->id;
            $trigger->name = $db_result->name;
            $trigger->type = $db_result->type;
            $trigger->status = $db_result->status;
            $trigger->show_content = $db_result->show_content;
            $trigger->content = $db_result->content;
        }
        else
        {
            //TODO:create box on view for this error
            die(__("Trigger Not Found", 'wp-live-chat-support'));
        }
        return  $trigger;
    }

    public function save_trigger($data)
    {
        $error = $this->validation($data);
        if($error->ErrorFound)
        {
            $this->view_data["error"] = $error;
            return; 
        }
        
        $trigger_to_save = new TCXTrigger();
        $trigger_to_save->id = intval(isset($data['wplc_trigger_id']) ? sanitize_text_field($data['wplc_trigger_id']): '-1');
        $trigger_to_save->name = sanitize_text_field( $data['wplc_trigger_name'] );
        $trigger_to_save->type = intval(sanitize_text_field($data['wplc_trigger_type']));
        $trigger_to_save->status = isset($data['wplc_trigger_enable'])? intval(sanitize_text_field($data['wplc_trigger_enable'])==="on"):0;
        $trigger_to_save->show_content = isset($data['wplc_trigger_replace_content'])? intval(sanitize_text_field($data['wplc_trigger_replace_content'])==="on"):0;
        $trigger_to_save->setContent($data['wplc_trigger_pages'],$data['wplc_trigger_secs'],$data['wplc_trigger_perc'],$data['wplc_trigger_content']);

        if($trigger_to_save->id<0)
        {
            self::add_trigger($this->db,$trigger_to_save);
        }
        else
        {
            self::update_trigger($this->db,$trigger_to_save);
        }

        if ($this->db->last_error) {
            $error = new TCXError();
            $error->ErrorFound = true;
            $error->ErrorHandleType = "Show";  
            $error->ErrorData->message= __("Error: Could not save trigger", 'wp-live-chat-support');
            $this->view_data["error"] = $error;
        }
    }

    //private functions
    private function init_actions()
    {
        $saveParams = [];
        $saveParams[] = isset($_POST) && !empty($_POST) ? $_POST : null;
        
        $this->available_actions[] = new TCXPageAction("save_trigger", 9, "SaveTrigger", 'save_trigger', $saveParams);
        $viewAction = array_filter(
            $this->available_actions,
            function ($action) {
                return $action->name == 'view';
            }
        );   

        if(count($viewAction)==1)
        {
            reset($viewAction)->required_nonce_key = 'edit_trigger';
        }
    }

    private function validation($data){
        $result = new TCXError();
        if($data==null)
        {
            $result->ErrorFound = true;
            $result->ErrorHandleType = "Redirect";
            $result->ErrorData->url = admin_url("admin.php?page=wplivechat-manage-trigger&nonce=".wp_create_nonce('edit_trigger')."&trid=".$this->trid);
        }
        else if(strlen($data["wplc_trigger_name"])==0)
        {
            $result->ErrorFound = true;
            $result->ErrorHandleType = "Show";  
            $result->ErrorData->message = sprintf(__( "Field '%s' can't be empty.", 'wp-live-chat-support' ), __( 'Name', 'wp-live-chat-support'));
        }
        else if(!is_numeric($data["wplc_trigger_type"]))
        {
            $result->ErrorFound = true;
            $result->ErrorHandleType = "Show";  
            $result->ErrorData->message = sprintf(__( "Field '%s' can't be empty.", 'wp-live-chat-support' ), __( 'Type', 'wp-live-chat-support'));
        }
        return $result;
    }

    //db access
    public static function add_trigger($db,$trigger)
    {
        global $wplc_tblname_triggers;
        return $db->insert(
                $wplc_tblname_triggers,
                array(
                    'name' 	=> $trigger->name,
                    'type' 	=> $trigger->type,
                    'content'	=> $trigger->content,
                    'show_content'	=> $trigger->show_content,
                    'status'		=> $trigger->status,
                ),
                array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                )
            );
    }

    public static function update_trigger($db,$trigger)
    {
        global $wplc_tblname_triggers;
        return $db->update(
                    $wplc_tblname_triggers,
                    array(
                        'name' 	=> $trigger->name,
                        'type' 	=> $trigger->type,
                        'content'	=> $trigger->content,
                        'show_content'	=> $trigger->show_content,
                        'status'		=> $trigger->status,
                    ),
                    array( 'id' => $trigger->id ),
                    array(
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                    ),
                    array( '%d' )
                );
    }

    public static function get_trigger_data($db,$trid)
    {
        global $wplc_tblname_triggers;
        $db_result = $db->get_row($db->prepare("SELECT * FROM $wplc_tblname_triggers where `id`= %d",$trid ));
        return  $db_result;
    }

}
?>