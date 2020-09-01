<?php
/**
 * template-full-width-whmcs.php
 *
 * Template Name: WHMCS Template
 * Template Post Type: page
 */




get_header();
    while ( have_posts() ) : the_post();       
        the_content();
    endwhile;
    wp_reset_query();
get_footer();