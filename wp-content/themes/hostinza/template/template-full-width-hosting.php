<?php
/**
 * template-full-width-hosting.php
 *
 * Template Name: Full Width Hosting Page
 * Template Post Type: page, hosting
 */

?>


<?php get_header();
get_template_part( 'template-parts/header/content', 'hosting-header' );
?>
<div class="page" role="main">
    <div class="builder-content">
		<?php while ( have_posts() ) : the_post(); ?>
				<!-- full-width-content -->
				<div id="post-<?php the_ID(); ?>" <?php post_class('full-width-content');?>>
					<?php the_content(); ?>
				</div> <!-- end full-width-content -->
		<?php endwhile; ?>
    </div> <!-- end main-content -->

</div> <!-- end main-content -->
<?php get_footer(); ?>