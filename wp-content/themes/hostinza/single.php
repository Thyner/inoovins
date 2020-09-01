<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();
 
get_template_part( 'template-parts/header/content', 'blog-header' );
$sidebar = hostinza_option('blog_single_sidebar');
$column = ($sidebar == 1  || !is_active_sidebar( 'sidebar-1' )) ? 'col-md-12' : 'col-md-8';
?>

<section class="xs-section-padding">
    <div class="container">
        <div class="row"> 
            <?php if($sidebar == 2){
                get_sidebar();
            } ?>
            <div class="<?php echo esc_attr($column); ?>">
                <div class="blog-post-group">
                    <div class="xs-blog-list blog-lsit-style-2">
                        <?php 
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', 'single' );

                            hostinza_post_nav();

                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile;
                        ?>
                    </div>
				</div>
            </div>
            <?php if($sidebar == 3){
                get_sidebar();
            } ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>