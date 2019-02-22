<?php
/**
	* The template for displaying woocommerce page
*/
get_header(); ?>

	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
			<?php mulada_row_before(); ?>
				<?php mulada_content_area_start(); ?>
					<div class="page-content">
						<?php woocommerce_content(); ?>
					</div>
				<?php mulada_content_area_end(); ?>					
				<?php get_sidebar( 'shop' ); ?>				
			<?php mulada_row_after(); ?>
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>
	
<?php get_footer();