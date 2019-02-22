<?php mulada_sidebar_start(); ?>
	<?php if ( is_active_sidebar( 'general-sidebar' ) ) : ?>
		<div class="sidebar-general sidebar">
			<?php dynamic_sidebar( 'general-sidebar' ); ?>
		</div>
	<?php endif; ?>
<?php mulada_sidebar_end(); ?>