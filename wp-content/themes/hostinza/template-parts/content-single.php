<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ' post-details' ); ?>>

	<?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
		<div class="entry-thumbnail post-media post-image">
			<?php 
			the_post_thumbnail( 'post-thumbnails' );
			?>
		</div>
	<?php endif; ?>
	<div class="post-body clearfix">

		<!-- Article header -->
		<header class="entry-header clearfix">
			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2>
			<?php hostinza_post_meta(); ?>
		</header><!-- header end -->

		<!-- Article content -->
		<div class="entry-content hostinza-main-content clearfix">
			<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				wpautop(the_content( esc_html__( 'Continue reading &rarr;', 'hostinza' ) ));

				hostinza_link_pages();
			}
			?>
		</div> <!-- end entry-content -->
		<?php //hostinza_single_post_footer
		hostinza_single_post_footer();
		?>
    </div> <!-- end post-body -->

</article>