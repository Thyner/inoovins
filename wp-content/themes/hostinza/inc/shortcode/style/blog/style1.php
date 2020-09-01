<div class="col-md-6 col-lg-<?php echo esc_attr($count_col); ?>">
    <div class="xs-blog-post">
        <?php
        if (has_post_thumbnail()):
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($xs_query->ID), 'full');
            $img = $img[0];
            ?>
            <div class="post-image">
                <img src="<?php echo esc_url(hostinza_resize($img, 354, 217, true)); ?>" alt="<?php the_title_attribute($xs_query->ID); ?>">
            </div>
        <?php endif; ?>
        <div class="entry-header">
            <div class="post-meta">
                <?php echo the_category(' '); ?>
            </div>
            <h2 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-meta">
                <span class="meta-date"><?php echo get_the_date(); ?></span>
            </div>
        </div><!-- .entry-header END -->
    </div>
</div> 