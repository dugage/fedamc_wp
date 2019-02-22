<?php mulada_sidebar_start(); ?>
	<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
		<div class="sidebar-general shop-sidebar sidebar">
			<?php dynamic_sidebar( 'shop-sidebar' ); ?>
		</div>
	<?php endif; ?>
<?php mulada_sidebar_end(); ?>