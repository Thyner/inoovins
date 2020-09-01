<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>

<aside id="sidebar" class="sidebar sidebar-right col-md-4" role="complementary">
	<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		}
	?>
</aside> <!-- end sidebar -->

