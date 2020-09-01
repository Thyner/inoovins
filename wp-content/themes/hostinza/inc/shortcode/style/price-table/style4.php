<div class="slider-group">
    <div class="vps-slider"></div><!-- .vps-slider END -->
    <div class="slider-range clearfix">
        <?php $i=0; foreach($slider_items as $slider_item){ ?>
            <div id="icon-<?php echo esc_attr($i); ?>" class="slider-tigger"><h5><?php echo esc_html($slider_item['name']);?></h5></div>
        <?php $i++; } ?>
    </div><!-- .slider-range END -->
</div><!-- .slider-group END -->
<div class="slider-content-group">
    <div class="row">
        <div class="col-lg-5">
            <div class="slider-container">
                <!-- title -->
                <p class="title xs0"></p>
                <input type="hidden" name="title" class="title xs0">

                <!-- price -->
                <h2 class="price xs1"></h2>
                <input type="hidden" name="price" class="price xs1">

                <!-- description -->
                <p class="desc xs2"></p>
                <input type="hidden" name="desc" class="desc xs2">

                <!-- buttons -->
                <a class="btn btn-primary slider-btns" href="#" target="_blank"><span class="icon icon-checkmark"></span> <?php esc_html_e('Purchase Now','hostinza');?></a>
            </div><!-- .slider-container END -->
        </div>
        <div class="col-lg-7">
            <ul class="vps-pricing-list clearfix">
                <li>
                    <h4><?php esc_html_e('CPU','hostinza');?></h4>
                    <p class="cpu xs3"></p>
                    <input type="hidden" name="cpu" class="cpu xs3">
                </li>
                <li>
                    <h4><?php esc_html_e('Bandwidth','hostinza');?></h4>
                    <p class="brandwidth xs4"></p>
                    <input type="hidden" name="brandwidth" class="brandwidth xs4">
                </li>
                <li>
                    <h4><?php esc_html_e('Bandwidth Two','hostinza');?></h4>
                    <p class="brandwidth2 xs5"></p>
                    <input type="hidden" name="brandwidth2" class="brandwidth2 xs5">
                </li>
            </ul><!-- .vps-pricing-list END -->
            <ul class="vps-pricing-list clearfix">
                <li>
                    <h4><?php esc_html_e('RAM','hostinza');?></h4>
                    <p class="ram xs6"></p>
                    <input type="hidden" name="ram" class="ram xs6">
                </li>
                <li>
                    <h4><?php esc_html_e('Setup','hostinza');?></h4>
                    <p class="setup xs7"></p>
                    <input type="hidden" name="setup" class="setup xs7">
                </li>
                <li>
                    <h4><?php esc_html_e('Setup Two','hostinza');?></h4>
                    <p class="setup2 xs8"></p>
                    <input type="hidden" name="setup2" class="setup2 xs8">
                </li>
            </ul><!-- .vps-pricing-list END -->
            <ul class="vps-pricing-list clearfix">
                <li>
                    <h4><?php esc_html_e('Disk Space','hostinza');?></h4>
                    <p class="diskspace xs9"></p>
                    <input type="hidden" name="diskspace" class="diskspace xs9">
                </li>
                <li>
                    <h4><?php esc_html_e('IP','hostinza');?></h4>
                    <p class="ip_one xs10"></p>
                    <input type="hidden" name="ip_one" class="ip_one xs10">
                </li>
                <li>
                    <h4><?php esc_html_e('IP Two','hostinza');?></h4>
                    <p class="ip_two xs11"></p>
                    <input type="hidden" name="ip_two" class="ip_two xs11">
                </li>
            </ul><!-- .vps-pricing-list END -->
        </div>
    </div><!-- .row END -->
</div>