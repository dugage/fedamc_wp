<?php
/*
	* The template used for displaying none content
*/
?>

<div class="post-list single-list">
	<article class="none-content-list clearfix">
		<div class="post-wrapper">
			<div class="post-header">
				<h2><?php esc_html_e( 'None Content', 'mulada' ); ?></h2>
			</div>
			<div class="post-content">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				
					<?php $get_started_here = esc_html__( 'Get started here.', 'mulada' ); ?>

					<p class="text-center"><?php printf( esc_html__( 'Ready to publish your first post?', 'mulada' ) . ' <a href="%s">' . $get_started_here . '</a>', admin_url( 'post-new.php' ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p class="text-center"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mulada' ); ?></p>
					
					<div class="content-none-search">
						<?php get_search_form(); ?>
					</div>
				
				<?php else : ?>

					<p class="text-center"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mulada' ); ?></p>
					<div class="content-none-search">
						<?php get_search_form(); ?>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</article>
</div>