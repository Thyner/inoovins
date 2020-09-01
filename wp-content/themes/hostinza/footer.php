<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
$footer_style = hostinza_option('footer_style');
get_template_part('template-parts/footer/footer', $footer_style); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>