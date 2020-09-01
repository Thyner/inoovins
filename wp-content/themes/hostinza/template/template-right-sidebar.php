<?php
/**
 * template-blank.php
 *
 * Template Name:  Blog Right sidebar
 */
get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
?>


<section id="main-container" class="xs-section-padding blog main-container" role="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<!-- 1st post start -->
				<?php
				global $paged, $wp_query, $wp;

				if ( empty( $paged ) ) {
					if ( !empty( $_GET[ 'paged' ] ) ) {
						$paged = $_GET[ 'paged' ];
					} elseif ( !empty( $wp->matched_query ) && $args = wp_parse_args( $wp->matched_query ) ) {

						if ( !empty( $args[ 'paged' ] ) ) {
							$paged = $args[ 'paged' ];
						}
					}
					if ( !empty( $paged ) )
						$wp_query->set( 'paged', $paged );
				}
				$temp		 = $wp_query;
				$wp_query	 = null;

				$wp_query = new WP_Query();
				$wp_query->query( "post_type=post&paged=" . $paged );

				if ( have_posts() ) :
					?>
					<div class="blog-lsit-group">
                    	<div class="xs-blog-list blog-lsit-style-2">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/post/content', get_post_format() );
							endwhile;
					?></div></div><?php
					hostinza_paging_nav();
				else :
					get_template_part( 'template-parts/post/content', 'none' );
				endif;
				?>

			</div><!-- Content Col end -->

			<?php get_sidebar(); ?>
		</div><!-- Main row end -->

	</div><!-- Container end -->
</section><!-- Main container end -->

<?php get_footer(); ?>

