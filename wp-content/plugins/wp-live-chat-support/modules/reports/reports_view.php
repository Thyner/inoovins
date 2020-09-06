<div class="wrap wplc_wrap">
    <h2> <?= $page_title ?></h2>
    <div id="wplc_container">
        <div id="reporting_tabs">
            <ul>
                <li><a href='#overview'>Overview</a></li>
                <li><a href='#popular_pages'>Popular Pages</a></li>
                <li><a href='#ux_ratings'>User Experience Ratings</a></li>
                <!-- <li><a href='#rio_reports'>ROI Reports</a></li>-->
            </ul>
            <div id='overview'>
                <div style='width: 33%; display: inline-block; vertical-align: top; text-align: center;'>
                    <h2><?= __( 'Total Agents', 'wp-livechat' ) ?></h2>
                    <p>
						<?= $sessions_stats->total_agents_counted ?>
                    </p>
                    <small><?= __( 'Total number of agents that used the live chat', 'wp-livechat' ) ?></small>
                </div>
                <div style='width: 33%; display: inline-block; vertical-align: top; text-align: center;'>
                    <h2><?= __( 'Total Chats', 'wp-livechat' ) ?></h2>
                    <p>
						<?= $sessions_stats->total_chats ?>
                    </p>
                    <small><?= __( 'Total number of chats received', 'wp-livechat' ) ?></small>
                </div>
                <div style='width: 33%; display: inline-block; vertical-align: top; text-align: center;'>
                    <h2><?= __( 'Total URLs', 'wp-livechat' ) ?></h2>
                    <p>
						<?= $sessions_stats->total_urls_counted ?>
                    </p>
                    <small><?= __( 'Total number of URLs a chat was initiated on', 'wp-livechat' ) ?></small>
                </div>
                <h2><?= __( 'Chats per day', 'wp-livechat' ) ?></h2>
                <div id="columnchart_material" style="width: 100%; height: 350px;">
                </div>
            </div>

            <div id='popular_pages'>
                <h2><?= __( 'Popular pages a chat was initiated on', 'wp-livechat' ) ?></h2>
                <div style='width: 50%; display: inline-block; vertical-align: top;'>
                    <div id='popular_pages_graph' style='width: 100%; height: 300px;'>
                    </div>
                </div>
                <div style='width: 50%; display: inline-block; vertical-align: top;'>
                    <ul>
						<?php foreach ( $sessions_stats->individual_urls_counted as $key => $url ) { ?>
                            <li><?= $key ?> (<?= $url ?>)</li>
						<?php } ?>
                    </ul>
                </div>
            </div>

            <div id='ux_ratings'>
                <h3><? __( "Agent Statistics", 'wp-live-chat-support' ) ?></h3>
				<?php foreach ( $agent_stats as $stat ) { ?>
                    <div class='wplc_agent_container'>
                        <div class='wplc_agent_card'>
							<?php if ( $stat->user_id > 0 ) { ?>
                                <img class='wplc_agent_grav_report'
                                     src="//www.gravatar.com/avatar/<?= md5( $stat->user_email ) ?>?s=48&d=<?=( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] ) ? 'https' : 'http'?>://ui-avatars.com/api//<?=$result->name?>>/32/<?=TCXUtilsHelper::wplc_color_by_string($result->name)?>/fff"/>
							<?php } ?>
                            <div class='wplc_agent_card_details'>
                                <strong><?= $stat->user_id > 0 != null ? $stat->user_name : __( "No Agent", 'wp-live-chat-support' ) ?></strong>
                                <br>
                                <small><?= $stat->user_id > 0 ? $stat->user_email : __( "Reviewed before agent joined, or with multiple agents", 'wp-live-chat-support' ) ?></small>
                                <br>
                                <hr>
                                <small><strong><?= __( "Satisfaction Rating", 'wp-live-chat-support' ) ?>
                                        :</strong> <?= $stat->aid == null ? "--" : $stat->percentage ?>%</small>
                                <br>
								<?php if ( $stat->aid == null ) { ?>
                                    <small><strong><?= __( "Rating Count", 'wp-live-chat-support' ) ?>:</strong>0
                                        (<?= __( "Good", 'wp-live-chat-support' ) ?>:0
                                        || <?= __( "Bad", 'wp-live-chat-support' ) ?>: 0 )</small>
								<?php } else { ?>
                                    <small><strong><?= __( "Rating Count", 'wp-live-chat-support' ) ?>
                                            :</strong> <?= $stat->total_ratings ?>
                                        (<?= __( "Good", 'wp-live-chat-support' ) ?>: <?= $stat->good_count ?>
                                        || <?= __( "Bad", 'wp-live-chat-support' ) ?>: <?= $stat->bad_count ?>)</small>
								<?php } ?>
                            </div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
</div>