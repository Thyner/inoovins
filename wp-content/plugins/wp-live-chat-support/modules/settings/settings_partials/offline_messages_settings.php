<h3><?=__("Offline Messages", 'wp-live-chat-support') ?></h3> 
<table class='form-table wp-list-table wplc_list_table widefat fixed striped pages' width='100%'>
    <tr>
        <td width='300'>
            <?=__("Disable offline messages", 'wp-live-chat-support') ?> 
            <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__("The chat window will be hidden when it is offline. Users will not be able to send offline messages to you", 'wp-live-chat-support') ?>"></i>
        </td>
        <td>
            <input type="checkbox" class="wplc_check" name="wplc_hide_when_offline" value="1" <?=($wplc_settings->wplc_hide_when_offline ? ' checked' : '');?>/>
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Offline Form Title", 'wp-live-chat-support') ?>:</td>
        <td>
            <input id="wplc_pro_na" name="wplc_pro_na" type="text" size="50" maxlength="50" class="regular-text" value="<?=isset($wplc_settings->wplc_pro_na)?  esc_attr($wplc_settings->wplc_pro_na):""  ?>" /> <br />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Offline form initial message", 'wp-live-chat-support') ?>:</td>
        <td>
            <input id="wplc_offline_initial_message" name="wplc_offline_initial_message" type="text" size="50" maxlength="150" class="regular-text" value="<?=isset($wplc_settings->wplc_offline_initial_message)?  esc_attr($wplc_settings->wplc_offline_initial_message):"" ?>" />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Offline form finish message", 'wp-live-chat-support') ?>:</td>
        <td>
            <input id="wplc_offline_finish_message" name="wplc_offline_finish_message" type="text" size="50" maxlength="150" class="regular-text" value="<?=isset($wplc_settings->wplc_offline_finish_message)?  esc_attr($wplc_settings->wplc_offline_finish_message):"" ?>" />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Offline Send Button Text", 'wp-live-chat-support') ?>:</td>
        <td>
            <input id="wplc_pro_offline_btn_send" name="wplc_pro_offline_btn_send" type="text" size="50" maxlength="50" class="regular-text" value="<?=isset($wplc_settings->wplc_pro_offline_btn_send)?  esc_attr($wplc_settings->wplc_pro_offline_btn_send):"" ?>" /> <br />
        </td>
    </tr>

</table>

<h4><?=__("Email settings", 'wp-live-chat-support') ?></h4> 


<table class='form-table wp-list-table wplc_list_table widefat fixed striped pages'>
    <tr>
        <td width='300' valign='top'>
<?=__("Send to agent(s)", 'wp-live-chat-support') ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__("Email address where offline messages are delivered to. Use comma separated email addresses to send to more than one email address", 'wp-live-chat-support') ?>"></i>
        </td>
        <td>
            <input id="wplc_pro_chat_email_address" name="wplc_pro_chat_email_address" class="regular-text" type="text" value="<?=isset($wplc_settings->wplc_pro_chat_email_address)? esc_attr($wplc_settings->wplc_pro_chat_email_address):'';?>" />
        </td>
    </tr>

        <tr>
        <td width='300' valign='top'>
            <?=__("Subject", 'wp-live-chat-support') ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__("User name will be appended to the end of the subject.", 'wp-live-chat-support') ?>"></i>
        </td>
        <td>
            <input id="wplc_pro_chat_email_offline_subject" name="wplc_pro_chat_email_offline_subject" class="regular-text" type="text" value="<?=isset($wplc_settings->wplc_pro_chat_email_offline_subject) ? esc_attr($wplc_settings->wplc_pro_chat_email_offline_subject) : __("WP Live Chat by 3CX - Offline Message from ", 'wp-live-chat-support'); ?>"/>
        </td>
    </tr>

</table>

<table class='form-table wp-list-table wplc_list_table widefat fixed striped pages'>
    <tr>
        <td width="300" valign="top"><?=__("Auto-respond to visitor", 'wp-live-chat-support') ?>: <i class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip" title="<?=__("Send your visitors an email as soon as they send you an offline message", 'wp-live-chat-support') ?>"></i></td>
        <td>
            <input id="wplc_ar_enable" name="wplc_autorespond_settings[wplc_ar_enable]" type="checkbox" class="wplc_check" value="1" <?= $wplc_settings->wplc_autorespond_settings['wplc_ar_enable'] ? "checked":""  ?> /> <br />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Auto-responder 'From' name", 'wp-live-chat-support') ?>: </td>
        <td>
            <input type="text" name="wplc_autorespond_settings[wplc_ar_from_name]" id="wplc_ar_from_name" class="regular-text" value="<?=isset( $wplc_settings->wplc_autorespond_settings['wplc_ar_from_name'] ) ? esc_attr(stripslashes($wplc_settings->wplc_autorespond_settings['wplc_ar_from_name'])):"" ?>" />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Auto-responder 'From' email", 'wp-live-chat-support') ?>: </td>
        <td>
            <input type="text" name="wplc_autorespond_settings[wplc_ar_from_email]" id="wplc_ar_from_email" class="regular-text" value="<?=isset( $wplc_settings->wplc_autorespond_settings['wplc_ar_from_email'] ) ? esc_attr($wplc_settings->wplc_autorespond_settings['wplc_ar_from_email']):"" ?>" />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Auto-responder subject", 'wp-live-chat-support') ?>: </td>
        <td>
            <input type="text" name="wplc_autorespond_settings[wplc_ar_subject]" id="wplc_ar_subject" class="regular-text" value="<?=isset( $wplc_settings->wplc_autorespond_settings['wplc_ar_subject'] ) ? esc_attr($wplc_settings->wplc_autorespond_settings['wplc_ar_subject']):"" ?>" />
        </td>
    </tr>
    <tr>
        <td width="300" valign="top"><?=__("Auto-responder body", 'wp-live-chat-support') ?>: <br/></td>
        <td>
            <textarea name="wplc_autorespond_settings[wplc_ar_body]" id="wplc_ar_body" rows="6" style="width:50%;">
                <?=isset( $wplc_settings->wplc_autorespond_settings['wplc_ar_body'] ) ? esc_textarea( $wplc_settings->wplc_autorespond_settings['wplc_ar_body'] ):"" ?>
            </textarea>
            <p class="description">
                <small>
                    <?=__("HTML and the following shortcodes can be used", 'wp-live-chat-support'); ?>: <?=__("User's name", 'wp-live-chat-support'); ?>: {wplc-user-name} <?=__("User's email address", 'wp-live-chat-support'); ?>: {wplc-email-address}
                </small>
            </p>
        </td>
    </tr>
</table> 
        