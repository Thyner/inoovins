<?php
/**
 * archive.php
 *
 * The template for displaying archive pages. 
 */
?>

<?php get_header();
get_template_part( 'template-parts/header/content', 'archive-header' );
$sidebar = hostinza_option('blog_sidebar');
$column = ($sidebar == 1 ) ? 'col-md-12' : 'col-md-8';
        ?>
        <section id="main-container" class="xs-section-padding posts-list" role="main">
            <div class="container">
                <div class="row">
                    <?php
                    if($sidebar == 2){
                        get_sidebar();
                    }
                    ?>
                    <div class="<?php echo esc_attr($column); ?>">
                        <?php if ( have_posts() ) : ?>

                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                            <?php endwhile; ?>

                            <?php hostinza_paging_nav(); ?>
                        <?php else : ?>
                            <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                        <?php endif; ?>
                    </div> <!-- end main-content -->

                    <?php
                    if($sidebar == 3){
                        get_sidebar();
                    }
                    ?>
                </div>

            </div>
        </section>
<?php get_footer(); ?>