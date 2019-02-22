<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>

	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
			<div class="page-content">
				<?php mulada_page404_content(); ?>
			</div>
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>
	
<?php get_footer();