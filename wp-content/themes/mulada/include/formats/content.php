<?php
/*
	* The template used for displaying single content
*/
?>

<div class="post-list single-list">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-header">
				<h2><?php the_title(); ?></h2>
				<?php
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
				?>
				<div class="category cat-color-<?php echo esc_attr( $categories_firstCategory ); ?>"><?php the_category( ', ', '' ); ?></div>
				<?php $hide_post_information = get_theme_mod( 'hide_post_information' ); ?>
				<?php if ( !$hide_post_information == '1' ) : ?>
					<ul class="post-information">
						<li class="author"><?php printf( esc_html__( 'By', 'mulada' ) ); ?> <?php the_author_posts_link(); ?></li>
						<li class="seperate"></li>
						<li class="date"><?php the_time( get_option( 'date_format' ) ); ?></li>
						<li class="seperate"></li>
						<li class="comment"><a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?>"><?php comments_number( esc_html__( '0 Comment', 'mulada' ), esc_html__( '1 Comment', 'mulada' ), esc_html__( '% Comments', 'mulada' ) ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>
			<?php if ( has_post_format( 'video' )) : ?>
				<?php 
					$video_post_meta_box_text = get_post_meta( get_the_ID(), 'video_post_meta_box_text', true );
					if( !empty( $video_post_meta_box_text ) ) :
				?>
					<div class="post-video content_row">
						<?php
						$video_post_meta_box_text_new = balanceTags( stripcslashes( $video_post_meta_box_text ) ); // Embed code
						echo balanceTags( stripslashes( addslashes( $video_post_meta_box_text_new ) ) ); // Embed code
						?>
					</div>
				<?php endif; ?>
			<?php elseif ( has_post_format( 'audio' )) : ?>
				<?php 
				$audio_post_meta_box_text = get_post_meta( get_the_ID(), 'audio_post_meta_box_text', true );
				if( !empty( $audio_post_meta_box_text ) ) :
				?>
					<div class="post-audio content_row">
						<?php
							$audio_post_meta_box_text_new = balanceTags ( stripcslashes( $audio_post_meta_box_text ) );
							echo balanceTags ( stripslashes( addslashes( $audio_post_meta_box_text_new ) ) );
						?>
					</div>
				<?php endif; ?>
			<?php elseif ( has_post_format( 'gallery' )) : ?>
				<?php $post_gallery_images = get_post_meta( get_the_ID(), 'vdw_gallery_id', true ); ?>
				<?php if( !empty( $post_gallery_images ) ): ?>
					<div class="post-gallery content_row">
						<ul class="bxslider">
							<?php
							foreach ($post_gallery_images as $image) {
							?>
								<li><?php echo wp_get_attachment_image( $image, 'mulada-home-big-posts', true, true ); ?></li>
							<?php
							}
							?>
						</ul>
					</div>
				<?php endif; ?>
			<?php elseif ( has_post_format( 'link' )) : ?>		
				<?php
				$image = "";
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-editors-pick' );
				$link_post_meta_box_text = get_post_meta( get_the_ID(), 'link_post_meta_box_text', true );
				if( !empty( $link_post_meta_box_text ) ) {
				?>
					<div class="post-link content_row">
						<div class="post-link-area" style="background-image:url(<?php echo esc_url( $image[0] ); ?>);">
							<a href="<?php
								$link_post_meta_box_text_new = balanceTags( stripcslashes( $link_post_meta_box_text ) ); // Embed code
								echo esc_url( stripslashes( addslashes( $link_post_meta_box_text_new ) ) ); // Embed code
								?>" target="_blank">
									<i class="fa fa-link fa-rotate-270"></i>
							</a>
						</div>
						<h3><a href="<?php
								$link_post_meta_box_text_new = balanceTags( stripcslashes( $link_post_meta_box_text ) ); // Embed code
								echo esc_url( stripslashes( addslashes( $link_post_meta_box_text_new ) ) ); // Embed code
								?>" target="_blank"><?php
						$link_post_meta_box_text_new = balanceTags( stripcslashes( $link_post_meta_box_text ) ); // Embed code
						echo balanceTags( stripslashes( addslashes( $link_post_meta_box_text_new ) ) ); // Embed code
						?></a></h3>
					</div>
				<?php
				}
				?>
			<?php else: ?>
				<?php 
				$hide_post_featured_image = get_theme_mod( 'hide_post_featured_image' );
				if( !$hide_post_featured_image == '1' ) :
				?>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-image content_row">
							<?php the_post_thumbnail( 'mulada-home-big-posts' ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mulada' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				$hide_post_tags = get_theme_mod( 'hide_post_tags' );
				$hide_post_share = get_theme_mod( 'hide_post_share' );
				if( !$hide_post_tags == '1' or !$hide_post_share == '1' ) : ?>
				<div class="post-bottom">
					<?php if ( !$hide_post_tags == '1' ) : ?>
						<?php $tags_title = esc_html__( 'Tags:', 'mulada' ); ?>
						<?php the_tags( '<div class="single-tag-list"><span class="single-tag-list-title">' . $tags_title . '</span><span>', ',</span> <span>', '</span></div>' ); ?>
					<?php endif; ?>
					<?php if( !$hide_post_share == '1' ) : ?>
						<?php mulada_post_content_social_share(); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</article>
</div>

<?php mulada_single_nav(); ?>

<?php mulada_related_posts(); ?>
			
<?php mulada_post_bottom_author_info(); ?>