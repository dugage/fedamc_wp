<?php
/*
	* The template for displaying single
*/
get_header(); ?>

	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
			<?php mulada_row_before(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php mulada_post_content_area_start(); ?>
						<div class="page-content<?php mulada_content_transparent_bg(); ?>">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php $values_layout_select = get_post_custom( get_the_ID() ); ?>
								<?php
									$hide_page_title = isset( $values_layout_select['page_title_hide'] ) ? strip_tags( esc_attr( $values_layout_select['page_title_hide'][0] ) ) :'';
									if( !$hide_page_title == "on" ) :
								?>
									<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
								<?php endif; ?>
								<div class="page-content-bottom">
									<?php the_content(); ?>
								</div>
								<?php
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mulada' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
									) );
									edit_post_link( esc_html__( 'Edit Page', 'mulada' ), '<span class="edit-link">', '</span>' );
								?>
							</article>
						</div>
						<?php
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						?>
					<?php mulada_content_area_end(); ?>
						<?php mulada_post_sidebar_start(); ?>
							<?php if ( is_active_sidebar( 'general-sidebar' ) ) : ?>
								<div class="sidebar-general sidebar">
									<?php dynamic_sidebar( 'general-sidebar' ); ?>
								</div>
							<?php endif; ?>
						<?php mulada_sidebar_end(); ?>
				<?php endwhile; ?>
			<?php mulada_row_after(); ?>
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>
	
<?php get_footer();