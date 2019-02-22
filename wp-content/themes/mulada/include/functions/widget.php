<?php
/*------------- LATEST EVENTS WIDGET START -------------*/
if( function_exists( 'get_events' ) ) :
	function mulada_latest_events_register_widgets() {
		register_widget( 'mulada_latest_events_Widget' );
	}
	add_action( 'widgets_init', 'mulada_latest_events_register_widgets' );

	class mulada_latest_events_Widget extends WP_Widget {
		function mulada_latest_events_Widget() {
			parent::__construct(
					'mulada_latest_events_Widget',
					esc_html__( 'Mulada Theme: Latest Events', 'mulada' ),
				   array( 'description' => esc_html__( 'Latest events widget.', 'mulada' ), )
			);
		}
		
		function widget( $args, $instance ) {
			
			echo $args['before_widget'];
			$latest_events_widget_title_control = esc_attr( $instance['latest_events_widget_title'] );
			if ( !empty( $instance['latest_events_widget_title'] ) ) {
				echo '<div class="widget-title"><h4>'. esc_attr( $latest_events_widget_title_control ) .'</h4></div>';
			}
			
			if( $instance) {
				$latest_events_widget_title = strip_tags( esc_attr( $instance['latest_events_widget_title'] ) );
				$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
				$readmore = strip_tags( esc_attr( $instance['readmore'] ) );
				$postdate = strip_tags( esc_attr( $instance['postdate'] ) );
				$text = strip_tags( esc_attr( $instance['text'] ) );
				$categorylist = strip_tags( esc_attr( $instance['categorylist'] ) );
			} 
			?>
			<?php mulada_widget_content_before(); ?>
				<div class="latest-events-widget">
					<?php if( !empty( $text ) ) : ?>
					<div class="text"><?php echo balanceTags ( stripslashes( addslashes( $text ) ) ); ?></div>
					<?php endif; ?>
					<ul>
						<?php
							$args_latest_posts_event = array(
								'posts_per_page' => $postcount,
								'ignore_sticky_posts'    => true,
								'post_status' => 'publish',
								'post_type' => 'tribe_events',
								'order' => 'DESC',
								'orderby' => 'date',
								'tribe_events_cat' => $categorylist
							);
							$wp_query = new WP_Query( $args_latest_posts_event );
							while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
							$postid = get_the_ID();
						?>
							<li>
								<?php if( !$postdate == '' ) : ?>
								<div class="date">
									<div class="top">
										<div class="day"><?php $start_date = tribe_get_start_date( null, false, 'd' ); echo esc_attr( $start_date ); ?></div>
										<div class="month"><?php $start_date = tribe_get_start_date( null, false, 'M' ); echo esc_attr( $start_date ); ?></div>
									</div>
									<div class="bottom">
										<?php $start_date = tribe_get_start_date( null, false, 'Y' ); echo esc_attr( $start_date ); ?>
									</div>
								</div>
								<?php endif; ?>
								<div class="desc">
									<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
									<?php if( !$readmore == '' ) : ?>
									<div class="post-read-more">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php printf( esc_html__( 'Read More', 'mulada' ) ); ?></a>
									</div>
									<?php endif; ?>
								</div>
							</li>
						<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					</ul>
				</div>
			<?php mulada_widget_content_after(); ?>
			<?php
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['latest_events_widget_title'] = strip_tags( esc_attr( $new_instance['latest_events_widget_title'] ) );
			$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
			$instance['readmore'] = strip_tags( esc_attr( $new_instance['readmore'] ) );
			$instance['postdate'] = strip_tags( esc_attr( $new_instance['postdate'] ) );
			$instance['text'] = strip_tags( esc_attr( $new_instance['text'] ) );
			$instance['categorylist'] = strip_tags( esc_attr( $new_instance['categorylist'] ) );
			return $instance;
		}

		function form($instance) {
			$latest_events_widget_title = '';
			$postcount = '';
			$readmore = '';
			$postdate = '';
			$text = '';
			$categorylist = '';

			if( $instance) {
				$latest_events_widget_title = strip_tags( esc_attr( $instance['latest_events_widget_title'] ) );
				$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
				$readmore = strip_tags( esc_attr( esc_textarea( $instance['readmore'] ) ) );
				$postdate = strip_tags( esc_attr( esc_attr( $instance['postdate'] ) ) );
				$text = strip_tags( esc_attr( esc_attr( $instance['text'] ) ) );
				$categorylist = strip_tags( esc_attr( esc_attr( $instance['categorylist'] ) ) );
			} ?>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'mulada' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_events_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_events_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_events_widget_title ); ?>" />
			</p>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'mulada' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
			</p>
	 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'categorylist' ) ); ?>"><?php esc_html_e( 'Category:', 'mulada' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name('categorylist') ); ?>" id="<?php echo esc_attr( $this->get_field_id('categorylist') ); ?>" class="widefat"> 
					<option value=""><?php echo esc_html__( 'All Categories', 'mulada' ); ?></option>
					<?php
					 $terms = get_terms("tribe_events_cat");
					 $count = count($terms);

					 if ( $count > 0 ){
						foreach ( $terms as $term ) {
							$category_select_control = '';
							if ( $categorylist == $term->slug )
							{
								$category_select_control = "selected";
							}
							$option = '<option value="' . esc_attr( $term->slug ) . '"' . $category_select_control . '>';
							$option .= $term->name;
							$option .= '</option>';
							echo balanceTags( $option );
						}
					}
					?>
				</select>
			</p>
			 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Event Count:', 'mulada' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
			</p>
			 
			<p>
				<input type="checkbox" class="widefat" <?php checked($readmore, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'readmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'readmore' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'readmore' ) ); ?>"><?php esc_html_e( 'Read More Button', 'mulada' ); ?></label>
			</p>
			 
			<p>
				<input type="checkbox" class="checkbox" <?php checked($postdate, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postdate' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>"><?php esc_html_e( 'Event Date', 'mulada' ); ?></label>
			</p>
			
		<?php }
		
	}
endif;
/*------------- LATEST EVENTS WIDGET END -------------*/

/*------------- MEGA MENU POST CATEGORIES WIDGET START -------------*/
function mulada_mega_post_categories_register_widgets() {
	register_widget( 'mulada_mega_post_categories_Widget' );
}
add_action( 'widgets_init', 'mulada_mega_post_categories_register_widgets' );

class mulada_mega_post_categories_Widget extends WP_Widget {
	function mulada_mega_post_categories_Widget() {
		parent::__construct(
	            'mulada_mega_post_categories_Widget',
        	    esc_html__( 'Mulada Theme: Mega Menu Categories', 'mulada' ),
 	           array( 'description' => esc_html__( 'Mega category widget.', 'mulada' ), )
		);
	}
	
	function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		$mega_post_categories_widget_title_control = esc_attr( $instance['mega_post_categories_widget_title'] );
		if ( !empty( $instance['mega_post_categories_widget_title'] ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $mega_post_categories_widget_title_control ) .'</h4></div>';
		}
		
		if( $instance) {
			$mega_post_categories_widget_title = strip_tags( esc_attr( $instance['mega_post_categories_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( $instance['postfeaturedimage'] ) );
			$postdate = strip_tags( esc_attr( $instance['postdate'] ) );
			$excludecats = strip_tags( esc_attr( $instance['excludecats'] ) );
		} 
		
		$mega_menu_categories_args = array(
			'orderby'                => 'name',
			'order'                  => 'ASC',
			'hide_empty'             => true,
			'parent'               => 0,
			'childless'              => false,
			'exclude'                => $excludecats
		); 
		$mega_menu_categories_terms = get_terms('category', $mega_menu_categories_args );
		?>
		<?php mulada_widget_content_before(); ?>
			<?php if ( ! empty( $mega_menu_categories_terms ) && ! is_wp_error( $mega_menu_categories_terms ) ) : ?>
				<div class="mulada-mega-menu-content">
					<div class="mega-post-categories-list">
						<ul role="menu">
							<?php foreach ( $mega_menu_categories_terms as $mega_menu_categories_term ) { ?>
								<li><a href="<?php echo get_term_link( $mega_menu_categories_term ) ?>" title="mega-cat-id-<?php echo esc_attr( $mega_menu_categories_term->term_id ); ?>"><?php echo esc_attr( $mega_menu_categories_term->name ); ?></a></li>
							<?php } ?>
						</ul>
					</div>
					<div class="mega-post-categories-latest-posts">
						<?php foreach ( $mega_menu_categories_terms as $mega_menu_categories_term ) { ?>
							<div class="mega-cat-content mega-cat-id-<?php echo esc_attr( $mega_menu_categories_term->term_id ); ?>">
								<ul>
									<?php
											$args_latest_posts = array(
												'posts_per_page' => $postcount,
												'post_status' => 'publish',
												'ignore_sticky_posts'    => true,
												'post_type' => 'post',
												'cat' => $mega_menu_categories_term->term_id
											); 
											$wp_query = new WP_Query($args_latest_posts);
											while ( $wp_query->have_posts() ) :
											$wp_query->the_post();
										?>
										<li>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'mulada-mega-category-menu' );
												}
												?>
											</a>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<?php if( !empty( $postcategory ) ): ?>
												<ul class="post-information">
													<li class="date"><?php the_time( get_option( 'date_format' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></li>
													<li class="seperate"></li>
													<li class="comment"><?php comments_number( esc_html__( '0 Comment', 'mulada' ), esc_html__( '1 Comment', 'mulada' ), esc_html__( '% Comments', 'mulada' ) ); ?></li>
												</ul>
											<?php endif; ?>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php endif; ?>
		<?php mulada_widget_content_after(); ?>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['mega_post_categories_widget_title'] = strip_tags( esc_attr( $new_instance['mega_post_categories_widget_title'] ) );
		$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
		$instance['postfeaturedimage'] = strip_tags( esc_attr( $new_instance['postfeaturedimage'] ) );
		$instance['postdate'] = strip_tags( esc_attr( $new_instance['postdate'] ) );
		$instance['excludecats'] = strip_tags( esc_attr( $new_instance['excludecats'] ) );
		return $instance;
	}

	function form($instance) {
	 	$mega_post_categories_widget_title = '';
	 	$postcount = '';
		$postfeaturedimage = '';
		$postdate = '';
		$excludecats = '';

		if( $instance) {
			$mega_post_categories_widget_title = strip_tags( esc_attr( $instance['mega_post_categories_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( esc_textarea( $instance['postfeaturedimage'] ) ) );
			$postdate = strip_tags( esc_attr( esc_attr( $instance['postdate'] ) ) );
			$excludecats = strip_tags( esc_attr( esc_attr( $instance['excludecats'] ) ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mega_post_categories_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mega_post_categories_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mega_post_categories_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $mega_post_categories_widget_title ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Post Count:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'excludecats' ) ); ?>"><?php esc_html_e( 'Exclude Categories:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'excludecats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excludecats' ) ); ?>" type="text" value="<?php echo esc_attr( $excludecats ); ?>" />
		</p>
		 
		<p>
			<input type="checkbox" class="widefat" <?php checked($postfeaturedimage, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postfeaturedimage' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>"><?php esc_html_e( 'Post Featured Image', 'mulada' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($postdate, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postdate' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>"><?php esc_html_e( 'Post Information', 'mulada' ); ?></label>
		</p>
		
	<?php }
	
}
/*------------- MEGA MENU POST CATEGORIES WIDGET END -------------*/

/*------------- LATEST POST WIDGET START -------------*/
function mulada_latest_posts_register_widgets() {
	register_widget( 'mulada_latest_Latest_Posts_Widget' );
}
add_action( 'widgets_init', 'mulada_latest_posts_register_widgets' );

class mulada_latest_Latest_Posts_Widget extends WP_Widget {
	function mulada_latest_Latest_Posts_Widget() {
		parent::__construct(
	            'mulada_latest_Latest_Posts_Widget',
        	    esc_html__( 'Mulada Theme: Sidebar Latest Posts', 'mulada' ),
 	           array( 'description' => esc_html__( 'Latest posts widget.', 'mulada' ), )
		);
	}
	
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		$latest_posts_widget_title_control = esc_attr( $instance['latest_posts_widget_title'] );
		if ( !empty( $instance['latest_posts_widget_title'] ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $latest_posts_widget_title_control ) .'</h4></div>';
		}
		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( $instance['postfeaturedimage'] ) );
			$postdate = strip_tags( esc_attr( $instance['postdate'] ) );
			$postcategory = strip_tags( esc_attr( $instance['postcategory'] ) );
			$categorylist = strip_tags( esc_attr( $instance['categorylist'] ) );
			$offset = strip_tags( esc_attr( $instance['offset'] ) );
			$exclude = strip_tags( esc_attr( $instance['exclude'] ) );
		}
		
		/*------------- Exclude Start -------------*/
		if( !empty( $exclude ) ) :
			$exclude = $exclude;
			$exclude = explode( ',', $exclude );
		else:
			$exclude = "";
		endif;
		/*------------- Exclude End -------------*/
		?>
		<?php mulada_widget_content_before(); ?>
			<div class="mulada-latest-posts-widget mulada-post-popular-posts-widget">
				<ul>
					<?php
						$args_latest_posts = array(
								'posts_per_page' => $postcount,
								'offset' => $offset,
								'post__not_in' => $exclude,
								'post_status' => 'publish',
								'ignore_sticky_posts'    => true,
								'post_type' => 'post',
								'cat' => $categorylist
						); 
						$wp_query = new WP_Query($args_latest_posts);
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
							$categories_category = "";
							$categories_category = get_the_category( get_the_ID() );
							$categories_firstCategory = $categories_category[0]->cat_ID;
					?>
					<li>
						<?php if( !empty( $postfeaturedimage ) ): ?>
							<div class="image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'mulada-sidebar-latest-posts' );
									}
									?>
								</a>
							</div>
						<?php endif; ?>
						<div class="desc">
							<?php if( !empty( $postcategory ) ): ?>
								<div class="category cat-color-<?php echo esc_attr( $categories_firstCategory ); ?>"><?php the_category( ', ', '' ); ?></div>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php if( !empty( $postdate ) ): ?>
								<time datetime="<?php the_time( 'Y' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
							<?php endif; ?>
						</div>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		<?php mulada_widget_content_after(); ?>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latest_posts_widget_title'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_title'] ) );
		$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
		$instance['postfeaturedimage'] = strip_tags( esc_attr( $new_instance['postfeaturedimage'] ) );
		$instance['postdate'] = strip_tags( esc_attr( $new_instance['postdate'] ) );
		$instance['categorylist'] = strip_tags( esc_attr( $new_instance['categorylist'] ) );
		$instance['postcategory'] = strip_tags( esc_attr( $new_instance['postcategory'] ) );
		$instance['offset'] = strip_tags( esc_attr( $new_instance['offset'] ) );
		$instance['exclude'] = strip_tags( esc_attr( $new_instance['exclude'] ) );
		return $instance;
	}

	function form($instance) {
	 	$latest_posts_widget_title = '';
	 	$postcount = '';
		$postfeaturedimage = '';
		$postdate = '';
		$postcategory = '';
		$categorylist = '';
		$offset = '';
		$exclude = '';

		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( esc_textarea( $instance['postfeaturedimage'] ) ) );
			$postdate = strip_tags( esc_attr( esc_attr( $instance['postdate'] ) ) );
			$postcategory = strip_tags( esc_attr( esc_attr( $instance['postcategory'] ) ) );
			$categorylist = strip_tags( esc_attr( esc_attr( $instance['categorylist'] ) ) );
			$offset = strip_tags( esc_attr( esc_attr( $instance['offset'] ) ) );
			$exclude = strip_tags( esc_attr( esc_attr( $instance['exclude'] ) ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_title ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Post Count:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'categorylist' ) ); ?>"><?php esc_html_e( 'Category:', 'mulada' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('categorylist') ); ?>" id="<?php echo esc_attr( $this->get_field_id('categorylist') ); ?>" class="widefat"> 
				<option value=""><?php echo esc_html__( 'All Categories', 'mulada' ); ?></option>
				<?php
				 $categories =  get_categories('child_of=0'); 
				 foreach ($categories as $category) {
					$category_select_control = '';
					if ( $categorylist == $category->cat_ID )
					{
						$category_select_control = "selected";
					}
					$option = '<option value="' . esc_attr( $category->cat_ID ) . '"' . $category_select_control . '>';
					$option .= $category->cat_name;
					$option .= '</option>';
					echo balanceTags( $option );
				 }
				?>
			</select>
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Posts:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude ); ?>" />
		</p>
		 
		<p>
			<input type="checkbox" class="widefat" <?php checked($postfeaturedimage, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postfeaturedimage' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>"><?php esc_html_e( 'Post Featured Image', 'mulada' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($postdate, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postdate' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>"><?php esc_html_e( 'Post Date', 'mulada' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($postcategory, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postcategory' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcategory' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcategory' ) ); ?>"><?php esc_html_e( 'Post Category', 'mulada' ); ?></label>
		</p>
		
	<?php }
	
}
/*------------- LATEST POST WIDGET END -------------*/

/*------------- LATEST PRODUCTS WIDGET START -------------*/
function mulada_latest_products_register_widgets() {
	register_widget( 'mulada_latest_latest_products_Widget' );
}
add_action( 'widgets_init', 'mulada_latest_products_register_widgets' );

class mulada_latest_latest_products_Widget extends WP_Widget {
	function mulada_latest_latest_products_Widget() {
		parent::__construct(
	            'mulada_latest_latest_products_Widget',
        	    esc_html__( 'Mulada Theme: Latest Products', 'mulada' ),
 	           array( 'description' => esc_html__( 'Latest products widget.', 'mulada' ), )
		);
	}
	
	function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		$latest_products_widget_title_control = esc_attr( $instance['latest_products_widget_title'] );
		if ( !empty( $instance['latest_products_widget_title'] ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $latest_products_widget_title_control ) .'</h4></div>';
		}
		
		if( $instance) {
			$latest_products_widget_title = strip_tags( esc_attr( $instance['latest_products_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( $instance['postfeaturedimage'] ) );
			$productprice = strip_tags( esc_attr( $instance['productprice'] ) );
		} 
		?>
		<?php mulada_widget_content_before(); ?>
			<div class="footer-latest-product-widget">
				<div class="row">
					<?php
						$args_latest_products = array(
								'post_type' =>'product',
								'stock' => 1,
								'posts_per_page' => $postcount,
								'orderby' =>'date',
								'post_status' => 'publish',
								'ignore_sticky_posts'    => true,
								'order' => 'DESC'
						); 
						$args_latest_loop = new WP_Query( $args_latest_products );
						while ( $args_latest_loop->have_posts() ) : $args_latest_loop->the_post(); global $product; 
					?>
						<div class="col-xs-4 col-xs-6 item">
							<?php if( !empty( $postfeaturedimage ) ): ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'mulada-latest-products-widget' );
									}
									?>
								</a>
							<?php endif; ?>
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<?php if( !empty( $productprice ) ): ?>
								<?php echo balanceTags( stripslashes( addslashes( $product->get_price_html() ) ) ); ?>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		<?php mulada_widget_content_after(); ?>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latest_products_widget_title'] = strip_tags( esc_attr( $new_instance['latest_products_widget_title'] ) );
		$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
		$instance['postfeaturedimage'] = strip_tags( esc_attr( $new_instance['postfeaturedimage'] ) );
		$instance['productprice'] = strip_tags( esc_attr( $new_instance['productprice'] ) );
		return $instance;
	}

	function form($instance) {
	 	$latest_products_widget_title = '';
	 	$postcount = '';
		$postfeaturedimage = '';
		$productprice = '';

		if( $instance) {
			$latest_products_widget_title = strip_tags( esc_attr( $instance['latest_products_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( esc_textarea( $instance['postfeaturedimage'] ) ) );
			$productprice = strip_tags( esc_attr( esc_attr( $instance['productprice'] ) ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_products_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_products_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_products_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_products_widget_title ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Product Count:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
		</p>
		 
		<p>
			<input type="checkbox" class="widefat" <?php checked($postfeaturedimage, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postfeaturedimage' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>"><?php esc_html_e( 'Product Image', 'mulada' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($productprice, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'productprice:' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'productprice' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'productprice' ) ); ?>"><?php esc_html_e( 'Product Price', 'mulada' ); ?></label>
		</p>
		
	<?php }
}
/*------------- LATEST PRODUCTS WIDGET END -------------*/

/*------------- SOCIAL MEDIA WIDGET START -------------*/
function mulada_social_media_widget_register_widgets() {
	register_widget( 'mulada_social_media_Widget' );
}
add_action( 'widgets_init', 'mulada_social_media_widget_register_widgets' );

class mulada_social_media_Widget extends WP_Widget {
	function mulada_social_media_Widget() {
		parent::__construct(
	            'mulada_social_media_Widget',
        	    esc_html__('Mulada Theme: Social Media', 'mulada'),
 	           array( 'description' => esc_html__( 'Social media widget.', 'mulada' ), )
		);
	}
	
	function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		$social_media_widget_title_control = esc_attr( $instance['social_media_widget_title'] );
		if ( !empty( $social_media_widget_title_control ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $instance['social_media_widget_title'] ) .'</h4></div>';
		}
		
		mulada_widget_content_before();
			mulada_sidebar_social_media_links();
		mulada_widget_content_after();
		
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['social_media_widget_title'] = strip_tags( esc_attr( $new_instance['social_media_widget_title'] ) );
		return $instance;
	}

	function form($instance) {
	 	$social_media_widget_title = '';

		if( $instance) {
			$social_media_widget_title = strip_tags( esc_attr( $instance['social_media_widget_title'] ) );
		}
		?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_media_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'mulada' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social_media_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_media_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $social_media_widget_title ); ?>" />
			<p><?php echo esc_html__( 'Go to "Appearance> Customize (Theme Options)". You can edit "Social Media" with panel.', 'mulada' ); ?></p>
		</p>
		 
		
	<?php }
}
/*------------- SOCIAL MEDIA WIDGET END -------------*/