<?php
/*
	* The template for displaying archive
*/
get_header(); ?>
	<?php mulada_site_sub_content_start(); ?>
		<?php mulada_container_before(); ?>
		
			<?php 
			$hide_categoryarchive_title = get_theme_mod( 'hide_categoryarchive_title' );
			if( !$hide_categoryarchive_title == '1' ) :
			?>
				<section class="category-archive-title">
					<h1><?php
					$allowed_html = array ( 'span' => array() );
					if ( is_day() ) :
						wp_kses (printf( __( 'Daily Archives: <span>%s</span>', 'mulada' ), get_the_date() ) , $allowed_html );
					elseif ( is_month() ) :
						wp_kses (printf( __( 'Monthly Archives: <span>%s</span>', 'mulada' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'mulada' ) ) ) , $allowed_html );
					elseif ( is_year() ) :
						wp_kses (printf( __( 'Yearly Archives: <span>%s</span>', 'mulada' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'mulada' ) ) ) , $allowed_html );
					else :
						esc_html_e( 'Archives', 'mulada' );
					endif;
					?></h1>
				</section>
			<?php endif; ?>
			<?php mulada_row_before(); ?>
				<?php mulada_content_area_start(); ?>
					<?php if ( have_posts() ) : ?>
						<div class="category-post-list post-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<?php if ( has_post_format( 'video' )) : ?>
										<?php 
											$video_post_meta_box_text = get_post_meta( get_the_ID(), 'video_post_meta_box_text', true );
											if( !empty( $video_post_meta_box_text ) ) :
										?>
											<div class="post-video">
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
											<div class="post-audio">
												<?php
													$audio_post_meta_box_text_new = balanceTags ( stripcslashes( $audio_post_meta_box_text ) );
													echo balanceTags ( stripslashes( addslashes( $audio_post_meta_box_text_new ) ) );
												?>
											</div>
										<?php endif; ?>
									<?php elseif ( has_post_format( 'gallery' )) : ?>
										<?php $post_gallery_images = get_post_meta( get_the_ID(), 'vdw_gallery_id', true ); ?>
										<?php if( !empty( $post_gallery_images ) ): ?>
											<div class="post-gallery">
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
											<div class="post-link">
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
										$hide_categoryarchive_featured_image = get_theme_mod( 'hide_categoryarchive_featured_image' );
										if( !$hide_categoryarchive_featured_image == '1' ) :
										?>
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="post-image">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail( 'mulada-home-big-posts' ); ?>
													</a>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
											<?php
											$hide_categoryarchive_name = get_theme_mod( 'hide_categoryarchive_name' );
											$categories_category = "";
											$categories_category = get_the_category( get_the_ID() );
											$categories_firstCategory = $categories_category[0]->cat_ID;
											if( !$hide_categoryarchive_name == '1' ) : ?>
												<div class="category cat-color-<?php echo esc_attr( $categories_firstCategory ); ?>"><?php the_category( ', ', '' ); ?></div>
											<?php endif;
											$hide_categoryarchive_post_information = get_theme_mod( 'hide_categoryarchive_post_information' );
											if( !$hide_categoryarchive_post_information == '1' ) : ?>
												<ul class="post-information">
													<li class="author"><?php printf( esc_html__( 'By', 'mulada' ) ); ?> <?php the_author_posts_link(); ?></li>
													<li class="seperate"></li>
													<li class="date"><?php the_time( get_option( 'date_format' ) ); ?></li>
													<li class="seperate"></li>
													<li class="comment"><a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?>"><?php comments_number( esc_html__( '0 Comment', 'mulada' ), esc_html__( '1 Comment', 'mulada' ), esc_html__( '% Comments', 'mulada' ) ); ?></a></li>
												</ul>
											<?php endif; ?>
										</div>
										<?php
										$hide_categoryarchive_excerpt = get_theme_mod( 'hide_categoryarchive_excerpt' );
										if( !$hide_categoryarchive_excerpt == '1' ) : ?>
											<div class="post-excerpt">
												<?php the_excerpt(); ?>
											</div>
										<?php endif;
										$hide_categoryarchive_post_read_more = get_theme_mod( 'hide_categoryarchive_post_read_more' );
										$hide_categoryarchive_post_share = get_theme_mod( 'hide_categoryarchive_post_share' );
										if( !$hide_categoryarchive_post_read_more == '1' or !$hide_categoryarchive_post_share == '1' ) :
										?>
											<div class="post-bottom">
												<?php if( !$hide_categoryarchive_post_read_more == '1' ) : ?>
													<div class="post-read-more">
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php printf( esc_html__( 'Read More', 'mulada' ) ); ?></a>
													</div>
												<?php endif; ?>
												<?php if( !$hide_categoryarchive_post_share == '1' ) : ?>
													<?php mulada_general_post_social_share(); ?>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
								</article>
							<?php endwhile; ?>
						</div>
						<?php mulada_pagination(); ?>
					<?php else : ?>
						<?php get_template_part( 'include/formats/content', 'none' ); ?>
					<?php endif; ?>
				<?php mulada_content_area_end(); ?>
				
				<?php get_sidebar(); ?> 
			<?php mulada_row_after(); ?>
			
		<?php mulada_container_after(); ?>
	<?php mulada_site_sub_content_end(); ?>
	
<?php get_footer();