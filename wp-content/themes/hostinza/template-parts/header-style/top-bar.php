<?php
$show_top_header = hostinza_option('show_top_header');
$phn_no = hostinza_option('top_header_phn');
$phn_icon = hostinza_option('top_header_phn_icon');
$email_address = hostinza_option('top_header_email');
$email_icon = hostinza_option('top_header_email_icon');
$top_header_nav = hostinza_option('top_header_nav');
?>
<?php if ($show_top_header): ?>
    <div class="xs-top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="xs-top-bar-info">
                        <?php if (!empty($phn_no)): ?>
                            <li class="top-phone">
                                <p><i class="<?php echo esc_attr($phn_icon); ?>"></i><?php echo esc_html($phn_no); ?></p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($email_address)): ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr($email_address); ?>"><i
                                            class="<?php echo esc_attr($email_icon); ?>"></i><?php echo esc_html($email_address); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if (is_array($top_header_nav) && !empty($top_header_nav)): ?>
                    <div class="col-md-6">
                        <ul class="top-menu">
                            <?php foreach ($top_header_nav as $index => $item): ?>
                                <li><a href="<?php echo esc_url($item['link']) ?>"><i
                                                class="<?php echo esc_attr($item['icon']) ?>"></i> <?php echo esc_html($item['label']); ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>