<ul class="nav nav-tabs main-nav-tab-2 tab-swipe" role=" tablist">
<?php
if (is_array($tabs_item) && !empty($tabs_item)):
    $id_int = 'xs-tabs-id-' . substr($this->get_id_int(), 0, 3);
    foreach ($tabs_item as $key => $item) :
        $active = ($key == 0) ? 'active show' : '';
        ?>
        <li>
            <a class="<?php echo esc_attr($active) ?>" data-toggle="tab"
               href="#<?php echo esc_attr($id_int . '-' . $key); ?>" role="tab">
                <?php if (!empty($item['title_image']['url'])): ?>
                    <p><img src="<?php echo esc_url($item['title_image']['url']) ?>"
                            alt="<?php echo esc_attr(hostinza_get_alt_name($item['title_image']['id'])) ?>"></p>
                <?php endif; ?>
                <?php echo esc_html($item['tab_title']) ?>
            </a>
        </li>
        <?php
    endforeach;
endif;
?>
</ul>

<div class="tab-content">
    <?php
    if (is_array($tabs_item) && !empty($tabs_item)):
        foreach ($tabs_item as $key => $item) :
            $active = ($key == 0) ? 'active show' : '';
            ?>
            <div class="tab-pane fadeIn animated <?php echo esc_attr($active) ?>" id="<?php echo esc_attr($id_int . '-' . $key); ?>"
                 role="tabpanel">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="feature-image-content">
                            <img src="<?php echo esc_url($item['content_image']['url']) ?>" alt="<?php echo esc_attr(hostinza_get_alt_name($item['title_image']['id'])) ?>">
                        </div><!-- .feature-image-content END -->
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="feature-text-content">
                            <?php echo wp_kses_post($item['tab_content']); ?>
                        </div><!-- .feature-text-content END -->
                    </div>
                </div><!-- .row END -->
            </div><!-- #webTransfer END -->
            <?php
        endforeach;
    endif;
    ?>
</div>
