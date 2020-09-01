<div class="pricing-matrix <?php if($load_more_btn !=''){ echo 'pricing-expand'; } ?> wow fadeIn">
    <div class="row no-gutters"> 
        <div class="col-lg-3">
            <div class="pricing-matrix-item">
                <div class="d-lg-block d-md-none d-none">
                    <div class="pricing-image">
                        <img src="<?php echo esc_url($pricing_image['url']);?>" alt="<?php echo esc_attr__('pricing image','hostinza');?>">
                    </div>
                    <?php foreach($pricing_features as $feature): ?>
                        <?php if($feature['feature_gap'] == 'yes'):?><div class="gap"></div><?php endif;?>
                        <div class="pricing-feature-item">
                            <span class="pricing-feature"><?php echo esc_html($feature['feature_title']);?> </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="pricing-matrix-slider owl-carousel">
                <?php $i = 1; foreach($pricing_items as $pricing_item): 
                    
                    $btn_link = (! empty( $pricing_item['button_url']['url'])) ? $pricing_item['button_url']['url'] : '';
		            $btn_target = ( $pricing_item['button_url']['is_external']) ? '_blank' : '_self';
                    ?>
                    <div class="pricing-matrix-item">
                        <div class="pricing-feature-group">
                            <h4 class="xs-title"><?php echo hostinza_kses($pricing_item['table_title']);?></h4>
                            <div class="pricing-body">
                                <p><?php echo hostinza_kses($pricing_item['table_sub_title']);?></p>
                                <div class="pricing-price">
                                    <h2>
                                        <sup><?php echo esc_html($pricing_item['currency_symbol']);?></sup>
                                        <?php echo esc_html($pricing_item['table_price']);?>
                                        <?php if($pricing_item['validity_period'] != ''):?>
                                            <span><?php echo esc_html($pricing_item['validity_period']);?></span>
                                        <?php endif; ?>
                                    </h2>
                                </div>
                                <a href="<?php echo esc_url($btn_link);?>" target="<?php echo esc_attr($btn_target); ?>" class="btn btn-primary"><?php echo esc_html($pricing_item['button_text']);?></a>
                            </div>
                        </div>
                        <?php foreach($pricing_features as $feature): ?>
                            <?php if($feature['feature_gap'] == 'yes'):?><div class="gap"></div><?php endif;?>
                            <div class="pricing-feature-item">
                                <div class="pricing-feature d-lg-none d-sm-block"><?php echo esc_html($feature['feature_title']);?> </div>
                                <div class="pricing-feature"><?php echo hostinza_kses($feature['feature_'.$i]);?> </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php if($load_more_btn !=''): ?>
    <input type="hidden" name="load_more_text" title="<?php echo esc_html($load_more_btn);?>" id="load_more_text">
<?php endif; ?>