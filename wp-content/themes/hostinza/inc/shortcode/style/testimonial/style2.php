
<div class="xs-testimonial-slider-2 testimonial-slider owl-carousel">
    <?php if (!empty($testimonials)):

        foreach ($testimonials as $testimonial):

            if ($testimonial['image'] != '') {
                $img = $testimonial['image']['url'];
            }
            ?>
            <div class="xs-testimonial-item">
                <div class="testimonial-content">
                    <?php if (!empty($testimonial['designation'])) : ?>
                        <p><?php echo esc_html($testimonial['review']); ?></p>
                    <?php endif; ?>
                    <div class="commentor-bio media">
                        <?php if (!empty($img)): ?>
                            <div class="d-flex round-avatar">
                                <img src="<?php echo esc_url(hostinza_resize($img, 55, 55, true)); ?>"
                                     alt="<?php echo hostinza_get_alt_name($testimonial['image']['id']); ?>"
                                     class="img-fluid">
                            </div>
                        <?php endif; ?>
                        <div class="media-body align-self-center">
                            <h4 class="commentor-title"><?php echo esc_html($testimonial['client_name']); ?></h4>
                            <p class="commentor-info"><?php echo esc_html($testimonial['designation']); ?></p>
                            <i class="icon icon-quote"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial Content End -->
        <?php endforeach;
    endif; ?>

</div>