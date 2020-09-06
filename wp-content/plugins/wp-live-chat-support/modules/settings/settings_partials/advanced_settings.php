<h3><?= __( "Chat Server", 'wp-live-chat-support' ) ?></h3>
<table class="wp-list-table wplc_list_table widefat fixed striped pages">
    <tbody>
    <tr>
        <td width="250" valign="top">
            <label for="wplc_channel"><?= __( "Select your chat server", 'wp-live-chat-support' ); ?> <i
                        class="fa fa-question-circle wplc_light_grey wplc_settings_tooltip"
                        title="<?= __( 'Choose between 3CX servers or your Wordpress server for chat delivery', 'wp-live-chat-support' ); ?>"></i></label>
        </td>
        <td valign="top">
			<?php if(in_array( 'wp',  explode(',',WPLC_ENABLE_CHANNELS ))){ ?>
            <input type="radio" name="wplc_channel"
                   value="wp" <?= $wplc_settings->wplc_channel == 'wp' ? "checked" : "" ?>> OnPremise (This host) <br>
            <p></p>
            <?php }?>
			<?php if(in_array('phone',explode(',',WPLC_ENABLE_CHANNELS ))){ ?>
            <input type="radio" name="wplc_channel"
                   value="phone" <?= $wplc_settings->wplc_channel=='phone' ? "checked":"" ?>>3CX PBX Integration <br>
            <p></p>
			<?php }?>
			<?php if(in_array('mcu',explode(',',WPLC_ENABLE_CHANNELS )) && !$disable_chat_server ){ ?>
            <input type="radio" name="wplc_channel"
                   value="mcu" <?= $wplc_settings->wplc_channel=='mcu' ? "checked":"" ?>>3CX Chat Server <br>
            <p></p>
			<?php }?>

            <input type="text" value="<?= $channel_url ?>" id="wplc_channel_url_input"
                   placeholder="<?= __( "3CX Click2Talk URL", 'wp-live-chat-support' ); ?>" name="wplc_channel_url"><br>
            <p></p>

            <select id='wplc_pbx_mode' name='wplc_pbx_mode'>
                    <option value="all" <?= selected( $wplc_pbx_mode, 'all' ) ?>>Phone, Video and Chat</option>
                    <option value="videochat" <?= selected( $wplc_pbx_mode, 'videochat' ) ?>>Video and Chat </option>
                    <option value="phonechat" <?= selected( $wplc_pbx_mode, 'phonechat' ) ?>>Phone and Chat</option>
                    <option value="phone" <?= selected( $wplc_pbx_mode, 'phone' ) ?>>Only Phone</option>
                    <option value="chat" <?= selected( $wplc_pbx_mode, 'chat' ) ?>>Only Chat</option>
            </select>
            <p></p>

        </td>
    </tr>
    </tbody>
</table>