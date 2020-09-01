<?php
get_header();

get_template_part( 'template-parts/header/content', 'shop-header' );
?>
<div class="woo-xs-content">
	<div class="container">
			<div class="row">
				<div id="content" class="col-sm-12">
					<div class="main-content-inner wooshop clearfix">
						<?php if ( have_posts() ) : ?>
							<?php woocommerce_content(); ?>
						<?php endif; ?>
				</div> <!-- close .col-sm-12 -->
			</div><!--/.row -->
		</div><!--/.row -->
	</div><!--/.row -->
</div><!--/.row -->


<?php get_footer(); ?>