<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'hostinza_post_nav' ) ) :

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function hostinza_post_nav() {
// Don't print empty markup if there's nowhere to navigate.
		$next_post	 = get_next_post();
		$pre_post	 = get_previous_post();
		if ( !$next_post && !$pre_post ) {
			return;
		}

		echo '<nav class="post-navigation clearfix mrtb-40">';


		echo '<div class="post-previous">';
		if ( !empty( $pre_post ) ):
			?>
			<a href="<?php echo get_the_permalink( $pre_post->ID ); ?>">
				<h3><?php echo get_the_title( $pre_post->ID ) ?></h3>
				<span><i class="fa fa-long-arrow-left"></i><?php esc_html_e( 'Previous Post', 'hostinza' ) ?></span>
			</a>

			<?php
		endif;
		echo '</div>';
		echo '<div class="post-next">';

		if ( !empty( $next_post ) ):
			?>
			<a href="<?php echo get_the_permalink( $next_post->ID ); ?>">
				<h3><?php echo get_the_title( $next_post->ID ) ?></h3>

				<span><?php esc_html_e( 'Next Post', 'hostinza' ) ?> <i class="fa fa-long-arrow-right"></i></span>
			</a>

			<?php
		endif;
		echo '</nav>';
		echo '</nav>';
	}

endif;


/**
 * ----------------------------------------------------------------------------------------
 *  - Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'hostinza_post_meta' ) ) {

	function hostinza_post_meta() {


		echo '<div class="post-meta">';
			
		
		printf(
			'<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>', get_avatar( get_the_author_meta( 'ID' ), 55 ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
		);
		$category_list = get_the_category_list( ', ' );
		if ( $category_list ) {
			echo '<span class="meta-categories post-cat"><i class="icon icon-folder2"> </i>   ' . $category_list . ' </span>';
		}
		if ( get_post_type() === 'post' ) {
			echo '<span class="post-meta-date"><i class="icon icon-calendar-1"></i> '. get_the_date() . '</span>';
		}



		if ( get_post_type() === 'post' ) {

			if ( is_single() ) {
				// Edit link.
				if ( is_user_logged_in() ) {
					edit_post_link( esc_html__( 'Edit', 'hostinza' ), '<span class="meta-edit">', '</span>' );
				}
			}
		}
		echo '</div>';
	}

	if ( !function_exists( 'hostinza_post_meta_left' ) ) {

		function hostinza_post_meta_left() {

			echo '<div class="post-meta-left pull-left text-center"><div class="entry-meta">';
			if ( get_post_type() === 'post' ) {

				// Get the post author.

				// Comments link.
				if ( comments_open() ) :
					echo '<span class="post-comment"><i class="icon icon-comment"></i> ';
					comments_popup_link( esc_html__( '0', 'hostinza' ), esc_html__( '0', 'hostinza' ), esc_html__( '%', 'hostinza' ) );
					echo '</span>';
				endif;

			// Edit link.
				if ( is_user_logged_in() ) {
					echo '<div>';
					edit_post_link( esc_html__( 'Edit', 'hostinza' ), '<span class="meta-edit">', '</span>' );
					echo '</div>';
				}
			}
			echo '</div></div>';
		}

	}
}


if ( !function_exists( 'hostinza_post_meta_date' ) ) {

	function hostinza_post_meta_date() {
		if ( get_post_type() === 'post' ) {

			echo '<span class="post-meta-date meta-date"><span class="day">' . get_the_date( 'm' ) . '</span>' . get_the_date( 'M' ) . '</span>';
		}
	}

}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'hostinza_paging_nav' ) ) {

	function hostinza_paging_nav() {


		if ( is_singular() )
			return;

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if ( $wp_query->max_num_pages <= 1 )
			return;

		$paged	 = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max	 = intval( $wp_query->max_num_pages );

		/** 	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/** 	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<ul class="pagination justify-content-center">' . "\n";

		/** 	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link( '<i class="fa fa-long-arrow-left"></i>' ) );

		/** 	Link to first page, plus ellipses if necessary */
		if ( !in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( !in_array( 2, $links ) )
				echo '<li>…</li>';
		}

		/** 	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** 	Link to last page, plus ellipses if necessary */
		if ( !in_array( $max, $links ) ) {
			if ( !in_array( $max - 1, $links ) )
				echo '<li>…</li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s" class="page-link">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/** 	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li>%s</li>' . "\n", get_next_posts_link( '<i class="fa fa-long-arrow-right"></i>' ) );

		echo '</ul>' . "\n";
	}

}
/**
 * Single post footer.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - footer tags with social share
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'hostinza_single_post_footer' ) ) {

	function hostinza_single_post_footer() {
		$show_social = hostinza_option('show_social');
        $tag_list = get_the_tag_list( '', ' ' );
        if ( $tag_list || $show_social):

		?>

		<?php 
		if(class_exists('Xs_Main') && ($show_social) && ($tag_list)){
			$social_grid = 'col-md-6';
			$tags_grid = 'col-md-6';
		}elseif(!class_exists('Xs_Main')){
			$social_grid = '';
			$tags_grid = 'col-md-12';
		}else{
			$social_grid = 'col-md-12';
			$tags_grid = '';
		}
		

		echo '<div class="post-footer"><div class="row no-gutters">' . "\n";

		if ( $tag_list ) {
			echo '<div class="'.esc_attr($social_grid).'"><div class="tag-lists">';
			echo '<span class="title">' . esc_html__( 'Tags: ', 'hostinza' ) . '</span>';
			echo hostinza_kses( $tag_list );
			echo '</div></div>' . "\n";
		}
		
		if(class_exists('Xs_Main') && ($show_social) ):
			?><div class="<?php echo esc_attr($social_grid);?>"><?php
				$Xs_Main = Xs_Main::xs_get_instance();
				$Xs_Main->get_social_share();
			?></div><?php
        endif;
		
		echo '</div></div>' . "\n";

        endif;
	}

}

function hostinza_xs_comment_style( $comment, $args, $depth ) {
	if ( 'div' === $args[ 'style' ] ) {
		$tag		 = 'div';
		$add_below	 = 'comment';
	} else {
		$tag		 = 'li ';
		$add_below	 = 'div-comment';
	}
	?>
	<?php
	if ( $args[ 'avatar_size' ] != 0 ) {
		echo get_avatar( $comment, $args[ 'avatar_size' ], '', '', array( 'class' => 'comment-avatar pull-left' ) );
	}
	?>
	<<?php
	echo hostinza_kses( $tag );
	comment_class( empty( $args[ 'has_children' ] ) ? '' : 'parent'  );
	?> id="comment-<?php comment_ID() ?>"><?php if ( 'div' != $args[ 'style' ] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php }
	?>	
		<div class="meta-data">

			<div class="pull-right reply"><?php
				comment_reply_link(
				array_merge(
				$args, array(
					'add_below'	 => $add_below,
					'depth'		 => $depth,
					'max_depth'	 => $args[ 'max_depth' ]
				) ) );
				?>
			</div>


			<span class="comment-author vcard"><?php
				printf( hostinza_kses( '<cite class="fn">%s</cite> <span class="says">%s</span>', 'hostinza' ), get_comment_author_link(), esc_html__( 'says:', 'hostinza' ) );
				?>
			</span>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'hostinza' ); ?></em><br/><?php }
			?>

			<div class="comment-meta commentmetadata comment-date">
				<?php
				/* translators: 1: date, 2: time */
				printf(
				esc_html__( '%1$s at %2$s', 'hostinza' ), get_comment_date(), get_comment_time()
				);
				?>
				<?php edit_comment_link( esc_html__( '(Edit)', 'hostinza' ), '  ', '' ); ?>
			</div>
		</div>	
		<div class="comment-content">
			<?php comment_text(); ?>
		</div>
		<?php if ( 'div' != $args[ 'style' ] ) : ?>
		</div><?php
	endif;
}

function hostinza_link_pages() {
	$args = array(
		'before'			 => '<div class="page-links"><span class="page-link-text">' . esc_html__( 'More pages: ', 'hostinza' ) . '</span>',
		'after'				 => '</div>',
		'link_before'		 => '<span class="page-link">',
		'link_after'		 => '</span>',
		'next_or_number'	 => 'number',
		'separator'			 => '  ',
		'nextpagelink'		 => esc_html__( 'Next ', 'hostinza' ) . '<I class="fa fa-angle-right"></i>',
		'previouspagelink'	 => '<I class="fa fa-angle-left"></i>' . esc_html__( ' Previous', 'hostinza' ),
	);
	wp_link_pages( $args );
}
