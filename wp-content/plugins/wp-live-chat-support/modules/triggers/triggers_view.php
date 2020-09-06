<div class="wrap wplc_wrap">
    <h2>
		<?= $page_title ?>
        <a href='?page=wplivechat-manage-trigger&nonce=<?= wp_create_nonce( "edit_trigger" ) ?>&trid=-1'
           class='wplc_add_new_btn'><?= __( "Add New", 'wp-livechat' ) ?></a>
    </h2>
    <div id="wplc_container">
		<?php if ( $selected_action->name == "prompt_remove_trigger" ) { ?>
            <div class='update-nag'
                 style='margin-top: 0px;margin-bottom: 5px;'><?= __( "Are you sure you want to delete this trigger?", 'wp-live-chat-support' ) ?>
                <br>
                <a class='button'
                   href='?page=wplivechat-menu-triggers&wplc_action=execute_remove_trigger&trid=<?= $trid ?>&nonce=<?= $delete_trigger_nonce ?>'><?= __( "Yes", 'wp-live-chat-support' ) ?></a>
                <a class='button' href='?page=wplivechat-menu-triggers'><?= __( "No", 'wp-live-chat-support' ) ?></a>
            </div>
		<?php } ?>

		<?php if ( $selected_action->name == "execute_remove_trigger" && ! ! ! $delete_success ) { ?>
            <div class='update-nag'
                 style='margin-top: 0px;margin-bottom: 5px;'><?= __( "Error: Could not delete trigger", 'wp-live-chat-support' ) ?>
                <br></div>
		<?php } ?>

		<?php if ( $selected_action->name == "execute_remove_trigger" && ! ! $delete_success ) { ?>
            <div class='update-nag'
                 style='margin-top: 0px;margin-bottom: 5px;border-color:#67d552;'><?= __( "Trigger Deleted", 'wp-live-chat-support' ) ?>
                <br></div>
		<?php } ?>

        <!--ID	Name	Type	Page	Content	Status	Action-->
        <table class="wp-list-table wplc_list_table widefat fixed " cellspacing="0">
            <thead>
            <tr>
                <th scope='col' id='wplc_id_colum' class='manage-column column-id'>
                    <span><?= __( "ID", 'wp-live-chat-support' ) ?></span></th>
                <th scope='col' id='wplc_name_colum'
                    class='manage-column'><?= __( "Name", 'wp-live-chat-support' ) ?></th>
                <th scope='col' id='wplc_type_colum'
                    class='manage-column'><?= __( "Type", 'wp-live-chat-support' ) ?></th>
                <th scope='col' id='wplc_page_colum'
                    class='manage-column'><?= __( "Page", 'wp-live-chat-support' ) ?></th>
                <th scope='col' id='wplc_content_colum'
                    class='manage-column'><?= __( "Content", 'wp-live-chat-support' ) ?></th>
                <th scope='col' id='wplc_status_colum'
                    class='manage-column'><?= __( "Status", 'wp-live-chat-support' ) ?></th>
                <th scope='col' id='wplc_action_colum'
                    class='manage-column'><?= __( "Actions", 'wp-live-chat-support' ) ?></th>
            </tr>
            </thead>
            <tbody id="the-list" class='list:wp_list_text_link'>
			<?php
			if ( ! $triggers ) {
				?>
                <tr>
                    <td colspan='7'><?php __( "Create your first trigger", 'wp-live-chat-support' ) ?></td>
                </tr>
				<?php
			} else {
				foreach ( $triggers as $result ) {
					?>
                    <tr id="record_<?= intval( $result->id ) ?>" style="height:30px;" \>
                        <td class='trigger_id' id='trigger_id_<?= intval( $result->id ) ?>'><?= $result->id ?></td>
                        <td class='trigger_name'
                            id='trigger_name_<?= intval( $result->id ) ?>'><?= esc_html( $result->name ) ?></td>
                        <td class='trigger_type'
                            id='trigger_type_<?= intval( $result->id ) ?>'><?= $result->getTypeName() ?></td>
                        <td class='trigger_page'
                            id='trigger_page_<?= intval( $result->id ) ?>'><?= esc_html( $result->getPage() ) ?></td>
                        <td class='trigger_content'
                            id='trigger_content_<?= intval( $result->id ) ?>'><?= esc_html( $result->getContent() ) ?></td>
                        <td class='trigger_status ' id='trigger_status_<?= intval( $result->id ) ?>'>
                            <div class='wplc_trigger_status <?= ( $result->status == 1 ? "wplc_trigger_enabled" : "wplc_trigger_disabled" ) ?>'>
                                <a href='<?= $result->getChangeStatusURL() ?>'
                                   title='<?= __( "Click to change trigger status", 'wp-live-chat-support' ) ?>'>
									<?= $result->getStatusName() ?>
                                </a>
                            </div>
                        </td>
                        <td class='trigger_actions' id='trigger_actions_<?= intval( $result->id ) ?>'>
                            <a href='<?= $result->getEditUrl() ?>'
                               class='button'><?= __( "Edit", 'wp-live-chat-support' ) ?></a>
                            <a href='<?= $result->getRemoveUrl() ?>'
                               class='button'><?= __( "Delete", 'wp-live-chat-support' ) ?></a>
                        </td>
                    </tr>
					<?php
				}
			}
			?>
            </tbody>
        </table>

		<?php
		if ( $page_links ) {
			?>
            <div class="tablenav">
                <div class="tablenav-pages" style="margin: 1em 0;float:none;text-align:center;"><?= $page_links ?></div>
            </div>
			<?php
		}
		?>
    </div>
</div>