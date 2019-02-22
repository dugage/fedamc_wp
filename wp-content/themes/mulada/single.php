<?php
/**
	* The template for displaying single
*/
get_header(); ?>

	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
			<?php mulada_row_before(); ?>
				<?php mulada_post_content_area_start(); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'include/formats/content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php while ( have_posts() ) : the_post(); 
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile; ?>
				<?php mulada_content_area_end(); ?>
				<?php mulada_post_sidebar_start(); ?>
					<?php if ( is_active_sidebar( 'general-sidebar' ) ) : ?>
						<div class="sidebar-general sidebar">
							<?php dynamic_sidebar( 'general-sidebar' ); ?>
						</div>
					<?php endif; ?>
				<?php mulada_sidebar_end(); ?>
			<?php mulada_row_after(); ?>
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>

<?php get_footer();