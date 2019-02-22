<?php
/*------------- PAGINATION START -------------*/
function mulada_pagination() {
	if( is_singular() )
		return;

	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	if( $paged >= 1 )
		$links[] = $paged;

	if( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="post-pagination"><ul>' . "\n";

	if( get_previous_posts_link() )
		printf( '<li>' . get_previous_posts_link( '&laquo;' ) . '</li>' );

	?>
		<li><span><?php echo esc_html__( 'Page', 'mulada' ) . ' ' . $paged . ' ' . esc_html__( 'of', 'mulada' ) . ' ' . $max; ?></span></li>
	<?php
	if( get_next_posts_link() )
		printf( '<li>' . get_next_posts_link( '&raquo;' ) . '</li>' );

	echo '</ul></nav>' . "\n";
}
/*------------- PAGINATION END -------------*/

/*------------- SINGLE NAVIGATION START -------------*/
function mulada_single_nav() {
	$post_navigation_hide = get_theme_mod( 'hide_post_navigation' );
	if( !$post_navigation_hide == '1' ):
	$mulada_single_nav_prev = esc_html__( 'Previous Post', 'mulada' );
	$mulada_single_nav_next = esc_html__( 'Next Post', 'mulada' );
	$prevPost = get_previous_post( false );
	$nextPost = get_next_post( false );
	if( !empty( $prevPost ) ) {
		$prev_post_category = "";
		$prevThumbnail = get_the_post_thumbnail( $prevPost->ID, 'mulada-post-nav', '' );
		$prevPost_category = "";
		$prevPost_category = get_the_category( $prevPost->ID );
		$prevPost_firstCategory = $prevPost_category[0]->cat_ID;
		$prevPost_cat_id = get_cat_ID( $prevPost_firstCategory );
		$prevPost_cat_data = "";
		$prevPost_cat_data = get_option("category_$prevPost_firstCategory");
	}
	if( !empty( $nextPost ) ) {
		$next_post_category = "";
		$nextThumbnail = get_the_post_thumbnail( $nextPost->ID, 'mulada-post-nav', '' );
		$nextPost_category = "";
		$nextPost_category = get_the_category( $nextPost->ID );
		$nextPost_firstCategory = $nextPost_category[0]->cat_ID;
		$nextPost_cat_id = get_cat_ID( $nextPost_firstCategory );
		$nextPost_cat_data = "";
		$nextPost_cat_data = get_option("category_$nextPost_firstCategory");
	}
?>
	<div class="post-bottom-element">
		<div class="post-nav">
			<nav>
				<ul class="pager">
					<li class="previous">
						<h4>&lt; <?php echo esc_attr( $mulada_single_nav_prev ); ?></h4>
						<?php if( !empty( $prevPost ) ) { ?>
							<?php $prev_post_category = "<div class='category' style='background:" . $prevPost_cat_data['catBG'] . "'>" . $prevPost_category[0]->cat_name . "</div>"; ?>
							<?php previous_post_link( '%link', '' . $prevThumbnail . $prev_post_category . ' <h3>%title</h3>' ); ?>
						<?php } ?>
					</li>
					<li class="next">
						<h4><?php echo esc_attr( $mulada_single_nav_next ); ?> &gt;</h4>
						<?php if( !empty( $nextPost ) ) { ?>
							<?php $next_post_category = "<div class='category' style='background:" . $nextPost_cat_data['catBG'] . "'>" . $nextPost_category[0]->cat_name . "</div>"; ?>
							<?php next_post_link( '%link', '' . $nextThumbnail . $next_post_category . ' <h3>%title</h3>' ); ?>
						<?php } ?>
					</li>
				</ul>
			</nav>
		</div>
	</div>
<?php
	endif;
}
/*------------- SINGLE NAVIGATION END -------------*/