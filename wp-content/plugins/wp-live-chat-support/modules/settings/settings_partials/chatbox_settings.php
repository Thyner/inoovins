<h3><?= __( "Chat Box Settings", 'wp-live-chat-support' ) ?></h3>
<table class='wp-list-table wplc_list_table widefat fixed striped pages'>
    <tr>
        <td width='300' valign='top'><?= __( "Alignment", 'wp-live-chat-support' ) ?>:</td>
        <td>
            <select id='wplc_settings_align' name='wplc_settings_align'>
                <option value="1" <?= $wplc_settings->wplc_settings_align == 1 ? 'selected' : '' ?> ><?= __( "Bottom left", 'wp-live-chat-support' ); ?></option>
                <option value="2" <?= $wplc_settings->wplc_settings_align == 2 ? 'selected' : '' ?>><?= __( "Bottom right", 'wp-live-chat-support' ); ?></option>
                <option value="3" <?= $wplc_settings->wplc_settings_align == 3 ? 'selected' : '' ?>><?= __( "Left", 'wp-live-chat-support' ); ?></option>
                <option value="4" <?= $wplc_settings->wplc_settings_align == 4 ? 'selected' : '' ?>><?= __( "Right", 'wp-live-chat-support' ); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
			<?= __( 'Chat box height (percent of the page)', 'wp-live-chat-support' ); ?>
        </td>
        <td>
            <select id='wplc_chatbox_height' name='wplc_chatbox_height'>
                <option value="0"><?= __( 'Use absolute height', 'wp-live-chat-support' ); ?></option>
				<?php
				for ( $i = 30; $i < 90; $i = $i + 10 ) {
					echo '<option value="' . $i . '" ' . ( $wplc_settings->wplc_chatbox_height == $i ? 'selected' : '' ) . '>' . $i . '%</option>';
				}
				?>
            </select>
            <span
				<?= ( $wplc_settings->wplc_chatbox_height > 0 ) ? 'style="display:none" ' : '' ?>id="wplc_chatbox_absolute_height_span"><input
                        type="number" id="wplc_chatbox_absolute_height" style="width:70px"
                        name="wplc_chatbox_absolute_height" min="100" max="1000"
                        value="<?= $wplc_settings->wplc_chatbox_absolute_height; ?>"/>px</span>
    </tr>
    <tr>
        <td width='300'>
			<?= __( "Automatic Chatbox Pop-Up", 'wp-live-chat-support' ) ?> <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "Expand the chat box automatically (prompts the user to enter their name and email address).", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td>
            <select id='wplc_auto_pop_up' name='wplc_auto_pop_up'>
                <option value="0" <?= $wplc_settings->wplc_auto_pop_up == 0 ? 'selected' : '' ?>><?= __( "Disabled", 'wp-live-chat-support' ); ?></option>
                <option value="1" <?= $wplc_settings->wplc_auto_pop_up == 1 ? 'selected' : '' ?>><?= __( "Only on desktop", 'wp-live-chat-support' ); ?></option>
                <option value="2" <?= $wplc_settings->wplc_auto_pop_up == 2 ? 'selected' : '' ?>><?= __( "Only on mobile", 'wp-live-chat-support' ); ?></option>
                <option value="3" <?= $wplc_settings->wplc_auto_pop_up == 3 ? 'selected' : '' ?>><?= __( "Both on desktop and mobile", 'wp-live-chat-support' ); ?></option>
            </select>
            <br/>
            <input type="checkbox" class="wplc_check" name="wplc_auto_pop_up_online"
                   value="1"<?= ( $wplc_settings->wplc_auto_pop_up_online ? ' checked' : '' ); ?>/>
            <label><?= __( "Pop-up only when agents are online", 'wp-live-chat-support' ); ?></label>
        </td>
    </tr>

    <tr>
        <td>
			<?= __( "Display for chat message:", 'wp-live-chat-support' ) ?>
        </td>
        <td>
            <input type="checkbox" class="wplc_check" name="wplc_show_name"
                   value="1"<?= ( $wplc_settings->wplc_show_name ? ' checked' : '' ); ?>/>
            <label><?= __( "Name", 'wp-live-chat-support' ); ?></label><br/>
            <input type="checkbox" class="wplc_check" name="wplc_show_avatar"
                   value="1"<?= ( $wplc_settings->wplc_show_avatar ? ' checked' : '' ); ?>/>
            <label><?= __( "Avatar", 'wp-live-chat-support' ); ?></label><br/>
        </td>
    </tr>
    <tr>
        <td>
			<?= __( "Display typing indicator", 'wp-live-chat-support' ); ?> <i
                    class='fa fa-question-circle wplc_light_grey wplc_settings_tooltip'
                    title="<?= __( "Display the 'typing...' animation in the chat window as soon as an agent or visitor is typing.", 'wp-live-chat-support' ); ?>"></i>
        </td>
        <td>
			<?php if ( $wplc_settings->wplc_channel === 'wp' ) { ?>
                <small><em><?= __( "For on premise server chat users this feature is not available due to significant increase in the amount of resources required on your server.", 'wp-live-chat-support' ); ?> </em></small>
			<?php } else { ?>
                <input type="checkbox" class="wplc_check" name="wplc_typing_enabled"
                       value="1"<?= ( $wplc_settings->wplc_typing_enabled ? ' checked' : '' ); ?>/>
			<?php } ?>
        </td>
    </tr>
    <tr>
        <td>
			<?= __( "Chat box for logged in users only:", 'wp-live-chat-support' ) ?> <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "By checking this, only users that are logged in will be able to chat with you.", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td>
            <input type="checkbox" class="wplc_check" name="wplc_display_to_loggedin_only"
                   value="1"<?= ( $wplc_settings->wplc_display_to_loggedin_only ? ' checked' : '' ); ?>/>
        </td>
    </tr>
    <tr>
        <td width='300' valign='top'>
			<?= __( "Use Logged In User Details", 'wp-live-chat-support' ) ?>: <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "A user's Name and Email Address will be used by default if they are logged in.", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td valign='top'>
            <input type="checkbox" class="wplc_check" value="1"
                   name="wplc_loggedin_user_info"<?= ( $wplc_settings->wplc_loggedin_user_info ? ' checked' : '' ); ?> />
        </td>
    </tr>
    <tr>
        <td>
			<?= __( "Display a timestamp in the chat window:", 'wp-live-chat-support' ) ?>
        </td>
        <td>
            <input type="checkbox" class="wplc_check" name="wplc_show_date"
                   value="1"<?= ( $wplc_settings->wplc_show_date ? ' checked' : '' ); ?>/>
            <label><?= __( "Date", 'wp-live-chat-support' ); ?></label><br/>
            <input type="checkbox" class="wplc_check" name="wplc_show_time"
                   value="1"<?= ( $wplc_settings->wplc_show_time ? ' checked' : '' ); ?>/>
            <label><?= __( "Time", 'wp-live-chat-support' ); ?></label>
        </td>
    </tr>
	<?php
	if ( defined( 'WPLC_PLUGIN' ) ) {
		?>
        <tr>
            <td>
				<?php
				_e( 'Disable Emojis', 'wp-live-chat-support' );
				?>
            </td>
            <td>
                <input type="checkbox" class="wplc_check"
                       name="wplc_disable_emojis" <?= $wplc_settings->wplc_disable_emojis ? ' checked="checked"' : '' ?>/>
        </tr>
		<?php
	}
	?>
</table>

<table class='form-table wp-list-table wplc_list_table widefat fixed striped pages' width='700'>
	<?php if ( $wplc_settings->wplc_channel !== 'phone' ) { ?>
        <tr>
            <td width='420' valign='top'>
				<?= __( "Incoming chat ring tone", 'wp-live-chat-support' ) ?>:
            </td>
            <td>
                <select name='wplc_ringtone' id='wplc_ringtone'>
					<?php
					foreach ( $wplc_ringtones->ringtones as $k => $v ) { ?>
                        <option playurl="<?= TCXRingtonesHelper::get_ringtone_url( $k ) ?>"
                                value="<?= $k ?>" <?= ( ( $k == $wplc_ringtones->ringtone_selected ) ? 'selected' : '' ) ?>><?= $v ?></option>
					<?php } ?>
                </select>
                <button type='button' id='wplc_sample_ring_tone'><i class='fa fa-play wplc-fa'></i></button>
            </td>
        </tr>
        <tr>
            <td width='420' valign='top'>
				<?= __( "Incoming message tone", 'wp-live-chat-support' ) ?>:
            </td>
            <td>
                <select name='wplc_messagetone' id='wplc_messagetone'>
					<?php
					foreach ( $wplc_ringtones->messagetones as $k => $v ) { ?>
                        <option playurl="<?= TCXRingtonesHelper::get_messagetone_url( $k ) ?>"
                                value="<?= $k ?>" <?= ( ( $k == $wplc_ringtones->messagetone_selected ) ? 'selected' : '' ) ?>><?= $v ?></option>
					<?php } ?>
                </select>
                <button type='button' id='wplc_sample_message_tone'><i class='fa fa-play'></i></button>
            </td>
        </tr>
	<?php } ?>
    <!-- Chat Icon-->
    <tr class='wplc-icon-area'>
        <td width='300' valign='top'>
			<?= __( "Icon", 'wp-live-chat-support' ) ?>:
        </td>
        <td>
            <div class="wplc_default_chat_icon_selector"
                 style="display:block;max-height:50px;background-color:<?= $wplc_settings->wplc_settings_base_color; ?>"
                 id="wplc_icon_area">
                <img src="<?= trim( urldecode( $wplc_settings->wplc_chat_icon ) ); ?>" width="50px"/>
            </div>
            <input id="wplc_chat_icon" name="wplc_chat_icon" type="hidden" size="35" class="regular-text"
                   maxlength="700"
                   value="<?= base64_encode( trim( urldecode( $wplc_settings->wplc_chat_icon ) ) ); ?>"/>
            <br/>
            <input id="wplc_btn_upload_icon" name="wplc_btn_upload_icon" type="button"
                   class="button button-primary valid" value="<?= __( "Upload Icon", 'wp-live-chat-support' ) ?>"/>
            <input id="wplc_btn_select_default_icon" name="wplc_btn_select_default_icon" type="button"
                   class="button button-default valid"
                   value="<?= __( "Select Default Icon", 'wp-live-chat-support' ) ?>"/>
            <br/>
			<?= __( "Recommended Size 50px x 50px", 'wp-live-chat-support' ) ?>

            <div id="wplc_default_chat_icons" style="display: none">
                <strong><?= __( "Select Default Icon", 'wp-live-chat-support' ); ?></strong>
                <img class="wplc_default_chat_icon_selector"
                     src="<?= wplc_protocol_agnostic_url( WPLC_PLUGIN_URL . 'images/chaticon.png' ); ?>">
                <img class="wplc_default_chat_icon_selector"
                     src="<?= wplc_protocol_agnostic_url( WPLC_PLUGIN_URL . 'images/default_icon_1.png' ); ?>">
                <img class="wplc_default_chat_icon_selector"
                     src="<?= wplc_protocol_agnostic_url( WPLC_PLUGIN_URL . 'images/default_icon_2.png' ); ?>">
                <img class="wplc_default_chat_icon_selector"
                     src="<?= wplc_protocol_agnostic_url( WPLC_PLUGIN_URL . 'images/default_icon_3.png' ); ?>">
            </div>
        </td>
    </tr>

    <tr class='wplc-pic-area'>
        <td width='300' valign='top'>
			<?= __( "Picture", 'wp-live-chat-support' ) ?>:
        </td>
        <td>
            <div style="display:block" id="wplc_pic_area"
                 default="<?= wplc_protocol_agnostic_url( WPLC_PLUGIN_URL . '/images/picture-for-chat-box.jpg' ); ?>">
                <img src="<?= trim( urldecode( $wplc_settings->wplc_chat_pic ) ); ?>" width="60px"/>
            </div>
            <input id="wplc_chat_pic" name="wplc_chat_pic" type="hidden" size="35" class="regular-text"
                   maxlength="700" value="<?= base64_encode( trim( urldecode( $wplc_settings->wplc_chat_pic ) ) ); ?>"/>
            <br/>
            <input id="wplc_btn_upload_pic" name="wplc_btn_upload_pic" type="button" class="button button-primary valid"
                   value="<?= __( "Upload Image", 'wp-live-chat-support' ) ?>"/>
            <input id="wplc_btn_select_default_pic" name="wplc_btn_select_default_pic" type="button"
                   class="button button-default valid"
                   value="<?= __( "Select Default Image", 'wp-live-chat-support' ) ?>"/>
            <input id="wplc_btn_remove_pic" name="wplc_btn_remove_pic" type="button" class="button button-warning valid"
                   value="<?= __( "Remove Image", 'wp-live-chat-support' ) ?>"/><br/>
			<?= __( "Recommended Size 60px x 60px", 'wp-live-chat-support' ) ?>
        </td>
    </tr>

    <!-- Chat Logo-->
    <tr class='wplc-logo-area'>
        <td width='300' valign='top'>
			<?= __( "Logo", 'wp-live-chat-support' ) ?>:
        </td>
        <td>
            <div style="display:block" id="wplc_logo_area">
                <img src="<?= trim( urldecode( $wplc_settings->wplc_chat_logo ) ); ?>" width="100px"/>
            </div>
            <input id="wplc_chat_logo" name="wplc_chat_logo" type="hidden" size="35" class="regular-text"
                   maxlength="700"
                   value="<?= base64_encode( trim( urldecode( $wplc_settings->wplc_chat_logo ) ) ); ?>"/>
            <input id="wplc_btn_upload_logo" name="wplc_btn_upload_logo" type="button"
                   class="button button-primary valid" value="<?= __( "Upload Logo", 'wp-live-chat-support' ) ?>"/>
            <input id="wplc_btn_remove_logo" name="wplc_btn_remove_logo" type="button"
                   class="button button-default valid" value="<?= __( "Remove Logo", 'wp-live-chat-support' ) ?>"/><br/>
			<?= __( "Recommended Size 250px x 40px", 'wp-live-chat-support' ) ?>
        </td>
    </tr>

    <tr>
        <td width='300' valign='top'>
			<?= __( "Chat button delayed startup (seconds)", 'wp-live-chat-support' ) ?>: <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "How long to delay showing the Live Chat button on a page", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td>
            <input id="wplc_chat_delay" name="wplc_chat_delay" type="text" size="6" maxlength="4"
                   value="<?= intval( $wplc_settings->wplc_chat_delay ); ?>"/>
        </td>
    </tr>

</table>
<?php if ( $wplc_settings->wplc_channel !== 'phone' ) { ?>
    <h3><?= __( "User Experience", 'wp-live-chat-support' ) ?></h3>
    <table class='form-table wp-list-table wplc_list_table widefat fixed striped pages' width='100%'>
        <tbody>
        <tr>
            <td width='300' valign='top'><?= __( "Share files", 'wp-live-chat-support' ) ?>: <i
                        class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                        title="<?= __( "Adds file sharing to your chat box!", 'wp-live-chat-support' ) ?>"></i></td>
            <td><input id='wplc_ux_file_share' class="wplc_check" name='wplc_ux_file_share'
                       type='checkbox'<?= ( $wplc_settings->wplc_ux_file_share ? ' checked' : '' ) ?> /></td>
        </tr>
        <tr>
            <td width='300' valign='top'><?= __( "Visitor experience ratings", 'wp-live-chat-support' ) ?>: <i
                        class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                        title="<?= __( "Allows users to rate the chat experience with an agent.", 'wp-live-chat-support' ) ?>"></i>
            </td>
            <td><input id='wplc_ux_exp_rating' name='wplc_ux_exp_rating' class="wplc_check"
                       type='checkbox'<?= ( $wplc_settings->wplc_ux_exp_rating ? ' checked' : '' ) ?> /></td>
        </tr>
        </tbody>
    </table>
<?php } ?>

<h3><?= __( "Social", 'wp-live-chat-support' ) ?></h3>
<table class='form-table wp-list-table wplc_list_table widefat fixed striped pages' width='100%'>
    <tbody>
    <tr>
        <td width='300' valign='top'><?= __( "Facebook URL", 'wp-live-chat-support' ) ?>: <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "Link your Facebook page here. Leave blank to hide", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td><input id='wplc_social_fb' class='wplc_check_url' name='wplc_social_fb'
                   placeholder="<?= __( "Facebook URL...", 'wp-live-chat-support' ) ?>" type='text'
                   value="<?= urldecode( $wplc_settings->wplc_social_fb ); ?>"/>

			<?php
			if ( ! empty( $wplc_settings->wplc_social_fb ) && ! filter_var( $wplc_settings->wplc_social_fb, FILTER_VALIDATE_URL ) ) {
				?><br><strong>Note: </strong>This does not appear to be a valid URL<?php
			}
			?>

        </td>
    </tr>
    <tr>
        <td width='300' valign='top'><?= __( "Twitter URL", 'wp-live-chat-support' ) ?>: <i
                    class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                    title="<?= __( "Link your Twitter page here. Leave blank to hide", 'wp-live-chat-support' ) ?>"></i>
        </td>
        <td><input id='wplc_social_tw' class='wplc_check_url' name='wplc_social_tw'
                   placeholder="<?= __( "Twitter URL...", 'wp-live-chat-support' ) ?>" type='text'
                   value="<?= urldecode( $wplc_settings->wplc_social_tw ); ?>"/>

			<?php
			if ( ! empty( $wplc_settings->wplc_social_tw ) && ! filter_var( $wplc_settings->wplc_social_tw, FILTER_VALIDATE_URL ) ) {
				?><br><strong>Note: </strong>This does not appear to be a valid URL<?php
			}
			?>
        </td>

    </tr>
    </tbody>
</table>


<?php do_action( 'wplc_hook_admin_settings_chat_box_settings_after' ); ?>
