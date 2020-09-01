<div class="zoom-anim-dialog mfp-hide modal-language" id="modal-popup-wpml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="language-content">
                <p><?php esc_html_e( 'Switch The Language', 'hostinza' ); ?></p>      
				<?php if ( class_exists( 'SitePress' ) ):  
					languages_list_popup(); 
				else: ?>
					<ul class="flag-lists">
						<li><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flags/006-united-states.svg" alt="<?php esc_attr_e( 'English', 'hostinza' ); ?>"><span><?php esc_html_e( 'English', 'hostinza' ); ?></span></a></li>
						<li><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flags/002-canada.svg" alt="<?php esc_attr_e( 'English', 'hostinza' ); ?>"><span><?php esc_html_e( 'English', 'hostinza' ); ?></span></a></li>
						<li><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flags/003-vietnam.svg" alt="<?php esc_attr_e( 'Vietnamese', 'hostinza' ); ?>"><span><?php esc_html_e( 'Vietnamese', 'hostinza' ); ?></span></a></li>
						<li><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flags/004-france.svg" alt="<?php esc_attr_e( 'French', 'hostinza' ); ?>"><span><?php esc_html_e( 'French', 'hostinza' ); ?></span></a></li>
						<li><a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flags/005-germany.svg" alt="<?php esc_attr_e( 'German', 'hostinza' ); ?>"><span><?php esc_html_e( 'German', 'hostinza' ); ?></span></a></li>
					</ul>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>