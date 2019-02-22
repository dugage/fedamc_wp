	<?php
	$hide_footer = get_theme_mod( 'hide_footer' );
	if( !$hide_footer == '1' ) :
	?>
		<footer class="footer">
			<?php mulada_top_footer_widget(); ?>
			<?php mulada_footer_social_media_widget(); ?>
			<?php mulada_bottom_footer_widget(); ?>
			<?php mulada_copyright(); ?>
		</footer>
	<?php endif; ?>
				
	<?php mulada_site_content_end(); ?>
	<?php mulada_wrapper_after(); ?>
	<?php wp_footer(); ?>
	</body>
</html>