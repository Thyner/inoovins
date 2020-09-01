<div class="xs-heading">
    <?php if(!empty($sub_title)): ?>
        <h3 class="heading-sub-title"><?php echo esc_html( $sub_title ); ?></h3>
    <?php endif; ?>
    <?php if(!empty($title)): ?>
        <h2 class="heading-title"><?php echo hostinza_kses(sprintf($title, '<span>', '</span>' ) ); ?></h2>
    <?php endif; ?>
</div>