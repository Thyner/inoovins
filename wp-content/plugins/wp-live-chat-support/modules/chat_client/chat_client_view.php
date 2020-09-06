<div id="wplc-chat-container" style="display: none">
	<?php if ( $onlyPhone ) { ?>
        <call-us-phone
                style="position: fixed; <?= $position_style ?> justify-content: flex-end;
                        flex-direction: column; display: flex; z-index: 99999;
                        --call-us-form-header-background:<?= $baseColor ?>;
                        --call-us-form-secondary-header-background:<?=$gradientEndColor?>;
                        --call-us-form-height:40vh;
                        --call-us-main-button-color:<?= $baseColor ?>;"
                id="wp-live-chat-by-3CX-phone"
                channel-url="<?= $channel_url ?>"
                wp-url="<?= $wp_url ?>"
                party="<?= $chatParty ?>"
                animation-style="<?= $animation ?>"
        >
        </call-us-phone>
	<?php } else { ?>
        <call-us
                style="position: fixed; <?= $position_style ?> justify-content: flex-end;
                        font-family: 'Noto Sans JP';
                        flex-direction: column; display: flex; z-index: 99999;
                        --call-us-form-width:350px;
                        --call-us-form-header-background:<?= $baseColor ?>;
                        --call-us-form-secondary-header-background:<?=$gradientEndColor?>;
                        --call-us-client-text-color:<?= $clientColor ?>;
                        --call-us-agent-text-color:<?= $agentColor ?>;
                        --call-us-form-height:<?= $chat_height ?>;
                        --call-us-form-shadow:<?=$shadowColor?>;"
                id="wp-live-chat-by-3CX"
                channel-url="<?= wplc_protocol_agnostic_url($channel_url) ?>"
                files-url="<?= wplc_protocol_agnostic_url( $files_url ) ?>"
                wp-url="<?= wplc_protocol_agnostic_url($wp_url) ?>"
                minimized="<?= $minimized ?>"
                animation-style="<?= $animation ?>"
                party="<?= $chatParty ?>"
                minimized-style="<?= $minimizedStyle ?>"
                allow-call="<?= $allowCalls ?>"
                allow-video="<?= $allowVideo ?>"
                allow-soundnotifications="<?= $enable_msg_sounds ?>"
                enable-onmobile="<?= $enable_mobile ?>"
                allow-emojis="<?= $emoji_enabled ?>"
                enable="<?= $is_enable ?>"
                soundnotification-url="<?=$message_sound?>"
                popout="false"
                facebook-integration-url="<?= $integrations->facebook ?>"
                twitter-integration-url="<?= $integrations->twitter ?>"
                email-integration-url="<?= property_exists( $integrations, 'mail' ) ? $integrations->mail : '' ?>"
                ignore-queueownership="true"
                enable-poweredby="<?= $enable_poweredby ?>"
                authentication="<?= $auth_type ?>"
                show-typing-indicator="<?= $enable_typing ?>"
                operator-name="<?= $agent_name ?>"
                show-operator-actual-name="<?= $showAgentsName ?>"
                window-icon="<?= wplc_protocol_agnostic_url( $chat_logo ) ?>"
                button-icon="<?= wplc_protocol_agnostic_url( $chat_icon ) ?>"
                channel="<?= $channel ?>"
                channel-secret="<?= $secret ?>"
                aknowledge-received="<?= $acknowledgeReceived ?>"
                gdpr-enabled="<?= $gdpr_enabled ?>"
                gdpr-message="<?= esc_attr($gdpr_message) ?>"
                files-enabled="<?= $files_enabled ?>"
                rating-enabled="<?= $rating_enabled ?>"
                departments-enabled="<?= $departments_enabled ?>"
                message-userinfo-format="<?= $messageUserinfoFormat ?>"
                message-dateformat="<?= $messageDateFormat ?>"
        >
        </call-us>
	<?php } ?>
</div>