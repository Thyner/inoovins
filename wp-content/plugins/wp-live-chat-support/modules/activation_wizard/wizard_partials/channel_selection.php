<h2 class="wplc_wizard_title"><?= __( "Channel Selection", 'wp-live-chat-support' ) ?></h2>
<div class="row">
    <div class="col-lg-<?= 12 - ( ( 12 - ( 4 * $active_channels ) ) / 2 ) ?>
                col-md-<?= 12 - ( ( 12 - ( 6 * $active_channels ) ) / 2 ) ?>
                col-sm-<?= 12 - ( ( 12 - ( 12 * $active_channels ) ) / 2 ) ?>
                col-xs-<?= 12 - ( ( 12 - ( 12 * $active_channels ) ) / 2 ) ?>
                offset-lg-<?= ( 12 - ( 4 * $active_channels ) ) / 2 ?>
                offset-md-<?= ( 12 - ( 6 * $active_channels ) ) / 2 ?>
                offset-sm-<?= ( 12 - ( 12 * $active_channels ) ) / 2 ?>
                offset-xs-<?= ( 12 - ( 12 * $active_channels ) ) / 2 ?>">
        <div class="row">
			<?php if ( in_array( 'mcu', explode( ',', WPLC_ENABLE_CHANNELS ) ) ) { ?>
                <div class="channel-card col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-part text-center" data-channel="mcu"><i class="fas fa-cloud" aria-hidden="true"></i>
                        <div class="ribbon ribbon-top-right">
                            <span><?= __( "selected", 'wp-live-chat-support' ) ?></span></div>
                        <div class="title">
                            <h3>Hosted Chat</h3>
                        </div>
                        <div class="text">
                            <span>
                                <ul>
                                    <li><i class="fa fa-check"></i><?= __( "3CX Servers are your chat servers.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Lighter on your site. Minimal resources.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Fast chat delivery and reception.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Data is stored on-premise.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Agents must login to respond to chats.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "No reports or apps", "wp-live-chat-support" ) ?></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
			<?php } ?>
			<?php if ( in_array( 'phone', explode( ',', WPLC_ENABLE_CHANNELS ) ) ) { ?>
                <div class="channel-card col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="box-part text-center" data-channel="phone"><i class="fas fa-cloud"
                                                                              aria-hidden="true"></i>
                        <div class="ribbon ribbon-top-right">
                            <span><?= __( "selected", 'wp-live-chat-support' ) ?></span></div>
                        <div class="title">
                            <h3><?= __( "3CX Integration", 'wp-live-chat-support' ) ?></h3>
                        </div>
                        <div class="text">
                            <span>
                                  <ul>
                                    <li><i class="fa fa-check"></i><?= __( "Your 3CX instance is your chat server.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Fastest chat delivery and reception.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Enterprise-level chat reports.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Elevate chat to Video or Audio call.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Apps for iOS & Android, desktop and web.", "wp-live-chat-support" ) ?></li>
                                    <li><i class="fa fa-check"></i><?= __( "Minimal resources. Suitable for any website", "wp-live-chat-support" ) ?></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
    <input type="hidden" name="channel" id="wplc_input_channel"/>
</div>