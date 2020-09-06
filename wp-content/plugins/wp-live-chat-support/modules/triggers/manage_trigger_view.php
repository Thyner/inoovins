<div class='wrap wplc_wrap'>
    <h2><?= $trigger->id > 0 ? __( "Edit a Trigger", 'wp-live-chat-support' ) : __( "Add new Trigger", 'wp-live-chat-support' ) ?></h2>
    <div id="wplc_container">
		<?php if ( is_object( $error ) && $error->ErrorFound ) { ?>
            <div style="display:none;"
                 id="PageError"
                 data-error_handle_type="<?= $error->ErrorHandleType ?>"
                 data-error_data="<?= esc_html( json_encode( $error->ErrorData ) ) ?>"
            >
            </div>
		<?php } ?>

		<?php if ( $selected_action->name == "save_trigger" && isset( $error ) && ! $error->ErrorFound ) { ?>
            <div class='update-nag' style='margin-top: 0px;margin-bottom: 5px;border-color:#67d552;'>
				<?= __( "Trigger saved succesfully", 'wp-live-chat-support' ) ?><br>
            </div>
		<?php } ?>

        <form id="tr_form" class='wplc_trigger_form' method='POST' action="<?= $save_action_url ?>"
              novalidate="novalidate">
            <table class="wp-list-table wplc_list_table widefat fixed form-table" cellspacing="0">

                <tr>
                    <td style="width:150px"><?= __( "Trigger Name", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='text' id='wplc_trigger_name' name='wplc_trigger_name'
                               value='<?= esc_attr( $trigger->name ) ?>'></td>
                </tr>

                <tr>
                    <td style="width:150px"><?= __( "Trigger Type", 'wp-live-chat-support' ) ?>:</td>
                    <td>

                        <select name='wplc_trigger_type' id="wplc_trigger_type">
                            <option value='0' <?= ( $trigger->type == 0 ? "selected" : "" ) ?>><?= __( "Page Trigger", 'wp-live-chat-support' ) ?></option>
                            <option value='1' <?= ( $trigger->type == 1 ? "selected" : "" ) ?>><?= __( "Time Trigger", 'wp-live-chat-support' ) ?></option>
                            <option value='2' <?= ( $trigger->type == 2 ? "selected" : "" ) ?>><?= __( "Scroll Trigger", 'wp-live-chat-support' ) ?></option>
                            <option value='3' <?= ( $trigger->type == 3 ? "selected" : "" ) ?>><?= __( "Page Leave Trigger", 'wp-live-chat-support' ) ?></option>
                        </select> <i class='fa fa-question-circle'
                                     title='<?= __( "Note: When using page trigger with a the basic theme, no hovercard is shown by default. We suggest using the time trigger for this instead.", 'wp-live-chat-support' ) ?>'></i>

                    </td>
                </tr>

                <tr id='wplc_trigger_page_row'>
                    <td style="width:150px"><?= __( "Page ID", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='text' name='wplc_trigger_pages' id='wplc_trigger_pages'
                               value='<?= $trigger->getPage() == __( "All", 'wp-live-chat-support' ) ? "" : $trigger->getPage() ?>'>
                        <i><?= __( "Note: Leave empty for 'all' pages", 'wp-live-chat-support' ) ?></i></td>
                </tr>

                <tr id='wplc_trigger_secs_row'>
                    <td style="width:150px"><?= __( "Show After", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='text' name='wplc_trigger_secs' id='wplc_trigger_secs'
                               value='<?= $trigger->getSecondsDelay() ?>'>
                        <i><?= __( "Seconds", 'wp-live-chat-support' ) ?></i></td>
                </tr>

                <tr id='wplc_trigger_scroll_row'>
                    <td style="width:150px"><?= __( "Show After Scrolled", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='text' name='wplc_trigger_perc' id='wplc_trigger_perc'
                               value='<?= $trigger->getScrollPercentage() ?>'>
                        <i><?= __( "(%) Percent of page height", 'wp-live-chat-support' ) ?></i></td>
                </tr>

                <tr>
                    <td style='vertical-align: top !important; width:150px'><?= __( "Content Replacement", 'wp-live-chat-support' ) ?>
                        :
                    </td>
                    <td>
						<?php wp_editor( $trigger->getContent(), "wplc_trigger_content", array( "teeny"         => false,
						                                                                        "media_buttons" => true,
						                                                                        "textarea_name" => "wplc_trigger_content",
						                                                                        "textarea_rows" => 5
						) ); ?>
                    </td>
                </tr>

                <tr>
                    <td style="width:150px"><?= __( "Replace Content", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='checkbox' class="wplc_check"
                               name='wplc_trigger_replace_content' <?= $trigger->show_content == 1 ? "checked" : "" ?>>
                    </td>
                </tr>

                <tr>
                    <td style="width:150px"><?= __( "Enable Trigger", 'wp-live-chat-support' ) ?>:</td>
                    <td><input type='checkbox' class="wplc_check" name='wplc_trigger_enable' <?= $trigger->status == 1 ? "checked" : "" ?>>
                    </td>
                </tr>

                <tr>
                    <td style="width:150px"></td>
                    <td>
                        <input id='tr_submit' type='submit' class='button button-primary'
                               value='<?= $trigger->id > 0 ? __( 'Update Trigger', 'wp-live-chat-support' ) : __( "Add Trigger", 'wp-live-chat-support' ) ?>'/>
                        <a href='<?= admin_url( "admin.php?page=wplivechat-menu-triggers" ) ?>' type='button'
                           class='button button-primary'
                           value='<?= __( 'Cancel', 'wp-live-chat-support' ) ?>'><?= __( 'Cancel', 'wp-live-chat-support' ) ?></a>
                    </td>
                </tr>

            </table>

            <input name='wplc_trigger_id' type='hidden' value='<?= $trigger->id ?>'>
        </form>
    </div>
</div>