<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
			<?php mulada_row_before(); ?>
				<?php mulada_content_area_start(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'include/formats/content-attachment' ); ?>
					<?php endwhile; ?>
				<?php mulada_content_area_end(); ?>
				<?php get_sidebar(); ?>
			<?php mulada_row_after(); ?>
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>

<?php get_footer();