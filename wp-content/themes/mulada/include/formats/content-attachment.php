<?php
/*
	* The template used for displaying single standart content
*/
?>

<div class="post-list single-list">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
		<div class="post-wrapper">
			<div class="post-header">
				<h2><?php the_title(); ?></h2>
			</div>
			<div class="post-content">
				<p><?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?></p>
				<?php the_content(); ?>
			</div>
			<?php
				$hide_post_share = get_theme_mod( 'hide_post_share' );
				if( !$hide_post_share == '1' ) : ?>
				<div class="post-bottom">
					<?php if( !$hide_post_share == '1' ) : ?>
						<?php mulada_post_content_social_share(); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</article>
</div>
			
<?php mulada_post_bottom_author_info(); ?>