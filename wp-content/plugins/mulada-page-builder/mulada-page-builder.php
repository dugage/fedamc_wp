<?php
/**
* Plugin Name: Mulada Theme: Page Builder Elements
* Plugin URI: http://themeforest.net/user/gloriatheme
* Description: Mulada blog & magazine theme page builder elements plugin.
* Version: 1.2
* Author: Gloria Theme
* Author URI: http://gloriatheme.com/
*/

/*------------- COLUMN SHORTCODE START -------------*/
function mulada_shortcode_column( $column_atts , $column_content = null ) {
	extract( shortcode_atts(
		array(
			'size' => '1',
		), $column_atts )
	);	
	$size = strip_tags( esc_attr( $size ) );
	if ( $size == "1" )
	{
		return '<div class="col-sm-1 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "2" )
	{
		return '<div class="col-sm-2 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "3" )
	{
		return '<div class="col-sm-3 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "4" )
	{
		return '<div class="col-sm-4 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "5" )
	{
		return '<div class="col-sm-5 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "6" )
	{
		return '<div class="col-sm-6 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "7" )
	{
		return '<div class="col-sm-7 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "8" )
	{
		return '<div class="col-sm-8 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "9" )
	{
		return '<div class="col-sm-9 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "10" )
	{
		return '<div class="col-sm-10 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	
	elseif ( $size == "11" )
	{
		return '<div class="col-sm-11 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
	elseif ( $size == "12" )
	{
		return '<div class="col-sm-12 col-xs-12">' . do_shortcode( $column_content ) . '</div>';
	}
}
add_shortcode( 'col', 'mulada_shortcode_column' );
/*------------- COLUMN SHORTCODE END -------------*/

/*------------- ROW SHORTCODE START -------------*/
function mulada_shortcode_wide_row( $row_wide_atts , $row_wide_content = null ) {
	extract( shortcode_atts(
		array(
			'class' => 'clearfix',
		), $row_wide_atts )
	);
	$class = strip_tags( esc_attr( $class ) );
	return '<div class="wide_row ' . $class . '">' . do_shortcode( $row_wide_content ) . '</div>';	
}
add_shortcode( 'wide_row', 'mulada_shortcode_wide_row' );
/*------------- ROW SHORTCODE END -------------*/

/*------------- ROW SHORTCODE START -------------*/
function mulada_shortcode_row( $row_atts , $row_content = null ) {
	extract( shortcode_atts(
		array(
			'class' => 'clearfix',
		), $row_atts )
	);
	$class = strip_tags( esc_attr( $class ) );
	return '<div class="row ' . $class . '">' . do_shortcode( $row_content ) . '</div>';	
}
add_shortcode( 'row', 'mulada_shortcode_row' );
/*------------- ROW SHORTCODE END -------------*/

/*------------- TITLE START -------------*/
function widget_title_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => ''
		), $atts
	);
	
	$output = '';
				
	/*------------- Title Start -------------*/
	if( !empty( $atts['title'] ) ) {
		$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
	}
	/*------------- Title End -------------*/

	return $output;
}
add_shortcode("widgettitle", "widget_title_shortcode");

if(function_exists('vc_map')){

	vc_map( array(
		"name" => esc_html__("Custom Widget Title", 'mulada'),
		"base" => "widgettitle",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_widget_title.png',
		"description" =>esc_html__( 'Custom heading widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			)
		)
	) );
}
/*------------- TITLE END -------------*/

/*------------- CHOSEN POST START -------------*/
function mulada_chosen_post_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'postid' => '',
			'style' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';
	
	/*------------- Query Arg Start -------------*/
	$args_chosen_posts = array(
		'posts_per_page' => 1,
		'p' => $atts['postid'],
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'post_type' => 'post'
	); 
	$wp_query_args_chosen_posts = new WP_Query( $args_chosen_posts );
	/*------------- Query Arg End -------------*/
	
	/*------------- Post ID Start -------------*/
	if( !empty( $atts['postid'] ) ) {
		/*------------- Small Style Start -------------*/
		if( $atts['style'] == "small" ) {
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) :
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				endif;
				/*------------- Title End -------------*/
				
				while ( $wp_query_args_chosen_posts->have_posts() ) :
				$wp_query_args_chosen_posts->the_post();
				
					/*------------- Image Start -------------*/
					if ( has_post_format( 'video' )) :
						$video_post_meta_box_text = get_post_meta( get_the_ID(), 'video_post_meta_box_text', true );
						if( !empty( $video_post_meta_box_text ) ) :
							$image = '<div class="post-video">';
								$image .= balanceTags( stripcslashes( $video_post_meta_box_text ) );
							$image .= '</div>';
						endif;
					elseif ( has_post_format( 'audio' )) :
						$audio_post_meta_box_text = get_post_meta( get_the_ID(), 'audio_post_meta_box_text', true );
						if( !empty( $audio_post_meta_box_text ) ) :
							$image = '<div class="post-audio">';
								$image .= balanceTags ( stripcslashes( $audio_post_meta_box_text ) );
							$image .= '</div>';
						endif;
					else:
						if( strstr( $atts['designfeatures'], "image" ) ) :
							if ( has_post_thumbnail( get_the_ID() ) ) :
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-onest-grid-posts-widget' );
								$image = '<div class="post-image">';
									$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
								$image .= '</div>';
							else:
								$image = "";
							endif;
						else:
							$image = "";
						endif;
					endif;
					/*------------- Image End -------------*/
					
					/*------------- Category Start -------------*/
					if( strstr( $atts['designfeatures'], "information" ) ) :
						$categories = get_the_category( get_the_ID() );
						if ( ! empty( $categories ) ) :
							$categories_category = "";
							$categories_category = get_the_category( get_the_ID() );
							$categories_firstCategory = $categories_category[0]->cat_ID;
							$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
						endif;
					else:
						$post_categories = "";
					endif;
					/*------------- Category End -------------*/
					
					/*------------- Information Start -------------*/
					if( strstr( $atts['designfeatures'], "information" ) ) :
						$num_comments = get_comments_number();
						if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
						$post_information = '<ul class="post-information">
							<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
							<li class="seperate"></li>
							<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						</ul>';
					else:
						$post_information = "";
					endif;
					/*------------- Information End -------------*/
					
					$output .= '
						<div class="widget-content">
							<div class="chosen-post-widget chosen-small-post-widget">
								<article class="post">' . $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>
											' . $post_categories . $post_information . '
										</div>
									</div>
								</article>
							</div>
						</div>
					';
				endwhile;
				wp_reset_postdata();
			$output .= '</div>';
		}
		/*------------- Small Style End -------------*/
		/*------------- Big Style Start -------------*/
		else
		{
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/
				
				while ( $wp_query_args_chosen_posts->have_posts() ) :
				$wp_query_args_chosen_posts->the_post();
				
					/*------------- Image Start -------------*/
					if ( has_post_format( 'video' )) :
						$video_post_meta_box_text = get_post_meta( get_the_ID(), 'video_post_meta_box_text', true );
						if( !empty( $video_post_meta_box_text ) ) :
							$image = '<div class="post-video">';
								$image .= balanceTags( stripcslashes( $video_post_meta_box_text ) );
							$image .= '</div>';
						endif;
					elseif ( has_post_format( 'audio' )) :
						$audio_post_meta_box_text = get_post_meta( get_the_ID(), 'audio_post_meta_box_text', true );
						if( !empty( $audio_post_meta_box_text ) ) :
							$image = '<div class="post-audio">';
								$image .= balanceTags ( stripcslashes( $audio_post_meta_box_text ) );
							$image .= '</div>';
						endif;
					else:
						if( strstr( $atts['designfeatures'], "image" ) ) :
							if ( has_post_thumbnail( get_the_ID() ) ) :
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
								$image = '<div class="post-image">';
									$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
								$image .= '</div>';
							else:
								$image = "";
							endif;
						else:
							$image = "";
						endif;
					endif;
					/*------------- Image End -------------*/
					
					/*------------- Information Start -------------*/
					if( strstr( $atts['designfeatures'], "information" ) ) :
						$categories = get_the_category( get_the_ID() );
						if ( ! empty( $categories ) ) :
							$categories_category = "";
							$categories_category = get_the_category( get_the_ID() );
							$categories_firstCategory = $categories_category[0]->cat_ID;
							$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
						endif;
					else:
						$post_categories = "";
					endif;
					/*------------- Information End -------------*/
					
					/*------------- Comments Start -------------*/
					if( strstr( $atts['designfeatures'], "information" ) ) :
						$num_comments = get_comments_number();
						if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
						$post_information = '<ul class="post-information">
							<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
							<li class="seperate"></li>
							<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
							<li class="seperate"></li>
							<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
						</ul>';
					else:
						$post_information = "";
					endif;
					/*------------- Comments End -------------*/
					
					/*------------- Excerpt Start -------------*/
					if( strstr( $atts['designfeatures'], "excerpt" ) ) :
						$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
					else:
						$excerpt = "";
					endif;
					/*------------- Excerpt End -------------*/
					
					/*------------- Read More Start -------------*/
					if( strstr( $atts['designfeatures'], "readmore" ) ) :
						$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
					else:
						$readmore = "";
					endif;
					/*------------- Read More End -------------*/
					
					/*------------- Share Start -------------*/
					if( strstr( $atts['designfeatures'], "socialshare" ) ) :
						$post_share_hide = get_theme_mod( 'post_share_hide' );
						$social_share_facebook = get_theme_mod( 'social_share_facebook' );
						$social_share_twitter = get_theme_mod( 'social_share_twitter' );
						$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
						$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
						$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
						$social_share_reddit = get_theme_mod( 'social_share_reddit' );
						$social_share_delicious = get_theme_mod( 'social_share_delicious' );
						$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
						$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
						$social_share_link_title = esc_html__( 'Share to', 'mulada' );
						$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
						$share_post_id = get_the_ID();
						$share_featured_post_image[0] = "";
						
						if( has_post_thumbnail( get_the_ID() ) ) :
							$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
						endif;
						
						$facebook = "";
						$twitter = "";
						$googleplus = "";
						$linkedin = "";
						$pinterest = "";	
						$reddit = "";
						$delicious = "";
						$stumbleupon = "";
						$tumblr = "";
						
						if( !$hide_general_post_share == '1' ) : 
							if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
							if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
							if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
							if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
							if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
							if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
							if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
							if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
							if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
						endif;
						
						$social_share_before = '<div class="post-share"><ul>';
						$social_share_after = '</ul></div>';
						$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
					else:
						$social_share = "";
					endif;
					/*------------- Share End -------------*/
					
					/*------------- Post Bottom Start -------------*/
					if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
						$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
					else:
					 $post_bottom = "";
					endif;
					/*------------- Post Bottom End -------------*/
					
					$output .= '
						<div class="widget-content">
							<div class="chosen-post-widget">
								<article class="post">' . $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>
											' . $post_categories . $post_information . '
										</div>
										' . $excerpt . $post_bottom . '
									</div>
								</article>
							</div>
						</div>
					';
				endwhile;
				wp_reset_postdata();
			$output .= '</div>';
		}
		/*------------- Big Style End -------------*/
	}
	else {
		if( !empty( $atts['title'] ) ) {
			$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
		}
	}
	/*------------- Post ID End -------------*/
	
	return $output;
}
add_shortcode("muladachosenpost", "mulada_chosen_post_shortcode");

if(function_exists('vc_map')){
	vc_map( array(
		"name" => esc_html__("Chosen Post", 'mulada'),
		"base" => "muladachosenpost",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_blog_layout.png',
		"description" =>esc_html__( 'Chosen post widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post ID",'mulada'),
				"description" => esc_html__("You can enter the post id.",'mulada'),
				"param_name" => "postid",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style",'mulada'),
				"description" => esc_html__("You can select the design style.",'mulada'),
				"param_name" => "style",
				"value" => array(
					esc_html__("Big", 'mulada') => "big",
					esc_html__("Small", 'mulada') => "small"
				)
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Featured Image", 'mulada') => "image",
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Post Excerpt", 'mulada') => "excerpt",
					esc_html__("Read More Button", 'mulada') => "readmore",
					esc_html__("Social Share Icons", 'mulada') => "socialshare"
				)
			)
		)
	) );
}
/*------------- CHOSEN POST END -------------*/

/*------------- AUTHOR POSTS START -------------*/
function mulada_author_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'authorids' => '',
			'excludeauthor' => '',
			'excludeposts' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';
	
	/*------------- Title Start -------------*/
	if( !empty( $atts['title'] ) ) {
		$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
	}
	/*------------- Title End -------------*/
	
	$output .= '<div class="post-author-wrapper">';
	
		/*------------- Author Include Start -------------*/
		if( !empty( $atts['authorids'] ) ) :
			$authorcount = $atts['authorids'];
			$authorcount = explode( ',', $authorcount );
		else:
			$authorcount = " ";
		endif;
		/*------------- Author Include End -------------*/
	
		/*------------- Exclude Start -------------*/
		if( !empty( $atts['excludeposts'] ) ) :
			$excludeposts = $atts['excludeposts'];
			$excludeposts = explode( ',', $excludeposts );
		else:
			$excludeposts = "";
		endif;
		/*-------------  Exclude End -------------*/
	
		$author_list_args = array (
			'include'  => $authorcount,
			'orderby' => 'display_name',
			'order' => 'ASC'
		);

		$user_query = new WP_User_Query( $author_list_args );
		if ( ! empty( $user_query->results ) ) :
		
		$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
			$output .= '<div class="widget-content">';
				$output .= '<div class="mulada-author-lists">';
					$output .= '<div id="author-lists" class="owl-carousel">';
					
						foreach ( $user_query->results as $user ) {
							
						/*------------- Image Start -------------*/
						if( strstr( $atts['designfeatures'], "image" ) ) :
							$user_avatar = get_avatar( $user->ID, 1 );
							if ( !empty( $user_avatar ) ) :
								$image = '<div class="image">';
									$image .= '<a href="' . get_author_posts_url( $user->ID ) . '" title="' . $user->display_name . '">' . get_avatar( $user->ID, 215 ) . '</a>';
								$image .= '</div>';
							else:
								$image = "";
							endif;
						else:
							$image = "";
						endif;
						/*------------- Image End -------------*/
							
							$output .= '<div class="item">
												<div data-target="author-id-' . $user->ID . '" class="item-content">' . $image . '
													<div class="desc">
														<h3>' . $user->display_name . '</h3>
														<a href="' . get_author_posts_url( $user->ID ) . '" class="button">' . esc_html__( 'About', 'mulada' ) . '</a>
														<a href="' . get_author_posts_url( $user->ID ) . '#posts" class="button">' . esc_html__( 'All Posts', 'mulada' ) . '</a>
													</div>
												</div>
											</div>';
						}
						
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="mulada-author-list-posts">';
						
							foreach ( $user_query->results as $user ) {
								$output .= '<div class="author-id-'. $user->ID .' item">';
									$output .= '<div class="row">';
										/*------------- Left Posts Start -------------*/
										$output .= '<div class="col-sm-8 col-xs-12">';
											/*------------- Query Arg Start -------------*/
											$args_author_latest_posts = array(
												'posts_per_page' => 1,
												'author' => $user->ID,
												'post__not_in' => $excludeposts,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true,
												'post_type' => 'post'
											);
											/*------------- Query Arg End -------------*/
											
											$wp_query_author_latest_posts = new WP_Query( $args_author_latest_posts );
											while ( $wp_query_author_latest_posts->have_posts() ) :
											$wp_query_author_latest_posts->the_post();
					
												/*------------- Image Start -------------*/
												$editor_picks_featured_image = "";
												$editor_picks_featured_image[0] = "";
												if( has_post_thumbnail( get_the_ID() ) ) :
													$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
													$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
												else:
													$editor_picks_featured_image_code = "";
												endif;
												/*------------- Image End -------------*/
												
												/*------------- Category Start -------------*/
												if( strstr( $atts['designfeatures'], "information" ) ) :
													$categories = get_the_category( get_the_ID() );
													if ( ! empty( $categories ) ) :
														$categories_category = "";
														$categories_category = get_the_category( get_the_ID() );
														$categories_firstCategory = $categories_category[0]->cat_ID;
														$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
													endif;
												else:
													$post_categories = "";
												endif;
												/*------------- Category End -------------*/
												
												/*------------- Information Start -------------*/
												if( strstr( $atts['designfeatures'], "information" ) ) :
													$num_comments = get_comments_number();
													if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
													$post_information = '<ul class="post-information">
														<li class="author">' . get_the_author() . '</li>
														<li class="seperate"></li>
														<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
														<li class="seperate"></li>
														<li class="comment">' . $comments . '</li>
													</ul>';
												else:
													$post_information = "";
												endif;
												/*------------- Information End -------------*/
												
												/*------------- Read More Start -------------*/
												if( strstr( $atts['designfeatures'], "readmore" ) ) :
													$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
												else:
													$readmore = "";
												endif;
												/*------------- Read More End -------------*/
												$output .= '<div class="editors-pick-widget">';
													$output .= '<article class="post">';
														$output .= '<div class="post-image"' . ' ' . $editor_picks_featured_image_code . '>';
															$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">';
																$output .= $post_categories;
																$output .= '<h2>' . get_the_title() . '</h2>';
																$output .= $post_information . $readmore;
															$output .= '</a>';
														$output .= '</div>';
													$output .= '</article>';
												$output .= '</div>';
											endwhile;
											wp_reset_postdata();
										$output .= '</div>';
										/*------------- Left Posts End -------------*/
										/*------------- Right Posts Start -------------*/
										$output .= '<div class="col-sm-4 col-xs-12">';
											/*------------- Query Arg Start -------------*/
											$args_author_latest_posts_right = array(
												'posts_per_page' => 3,
												'offset' => 1,
												'author' => $user->ID,
												'post__not_in' => $excludeposts,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true,
												'post_type' => 'post'
											);
											/*------------- Query Arg End -------------*/
											
											$output .= '<div class="mulada-latest-posts-widget mulada-post-popular-posts-widget">';
											
												$output .= '<ul>';
											
													$wp_query_author_latest_posts_right = new WP_Query( $args_author_latest_posts_right );
													while ( $wp_query_author_latest_posts_right->have_posts() ) :
													$wp_query_author_latest_posts_right->the_post();
						
														/*------------- Image Start -------------*/
														if( strstr( $atts['designfeatures'], "image" ) ) :
															if ( has_post_thumbnail( get_the_ID() ) ) :
																$image_url_right = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-sidebar-latest-posts' );
																$image_right = '<div class="image">';
																	$image_right .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url_right[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
																$image_right .= '</div>';
															else:
																$image_right = "";
															endif;
														else:
															$image_right = "";
														endif;
														/*------------- Image End -------------*/
														
														/*------------- Category Start -------------*/
														if( strstr( $atts['designfeatures'], "information" ) ) :
															$categories_right = get_the_category( get_the_ID() );
															if ( ! empty( $categories_right ) ) :
																$categories_category_right = "";
																$categories_category_right = get_the_category( get_the_ID() );
																$categories_firstCategory_right = $categories_category_right[0]->cat_ID;
																	$post_categories_right = '<div class="category cat-color-' . $categories_firstCategory_right . '"><a href="' . esc_url( get_category_link( $categories_right[0]->term_id ) ) . '">' . esc_html( $categories_right[0]->name ) . '</a></div>';   
															endif;
														else:
															$post_categories_right = "";
														endif;
														/*------------- Category End -------------*/
														
														/*------------- Information Start -------------*/
														if( strstr( $atts['designfeatures'], "information" ) ) :
															$post_information_right = '<time datetime="' . get_the_time( 'Y' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>';
														else:
															$post_information_right = "";
														endif;
														/*------------- Information End -------------*/
													
														$output .= '<li>'
																			. $image_right . '
																			<div class="desc">' . $post_categories_right . '
																					<h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h3>'
																					. $post_information_right . '
																			</div>
																		</li>';
													endwhile;
													wp_reset_postdata();
											$output .= '</ul>';
											$output .= '</div>';
										$output .= '</div>';
										/*Right Posts End -------------*/
									$output .= '</div>';
								$output .= '</div>';
							}
					$output .= '</div>';
				else:
				endif;

			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode("muladaauthorposts", "mulada_author_posts_shortcode");

if(function_exists('vc_map')){
	vc_map( array(
		"name" => esc_html__("Author Posts", 'mulada'),
		"base" => "muladaauthorposts",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_author_posts.png',
		"description" =>esc_html__( 'Author posts widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Author ID's",'mulada'),
				"description" => esc_html__("You can enter the author ids.",'mulada'),
				"param_name" => "authorids",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Author Posts Area", 'mulada') => "authorpostarea",
					esc_html__("Author Profile Buttons", 'mulada') => "authorprofilebuttons",
					esc_html__("Post Featured Image", 'mulada') => "image",
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Read More Button", 'mulada') => "readmore"
				)
			)
		)
	) );
}
/*------------- AUTHOR POSTS END -------------*/

/*------------- EDITOR PICKS START -------------*/
function mulada_editor_picks_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'querytype' => '',
			'postid' => '',
			'tag' => '',
			'category' => '',
			'excludeposts' => '',
			'postcount' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';
	
	/*------------- Post ID Type Start -------------*/
	if( strstr( $atts['querytype'], "postid" ) ) :
	
		/*------------- Query Arg Start -------------*/
		$args_editor_picks = array(
			'posts_per_page' => 1,
			'p' => $atts['postid'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'post'
		);
		/*------------- Query Arg End -------------*/
		
		$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
		while ( $wp_query_args_editor_picks->have_posts() ) :
		$wp_query_args_editor_picks->the_post();
		
		/*------------- Image Start -------------*/
		$editor_picks_featured_image = "";
		$editor_picks_featured_image[0] = "";
		if( has_post_thumbnail( get_the_ID() ) ) :
			$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-editors-pick' );
			$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
		else:
			$editor_picks_featured_image_code = "";
		endif;
		/*------------- Image End -------------*/
		
		/*------------- Category Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$categories = get_the_category( get_the_ID() );
			if ( ! empty( $categories ) ) :
				$categories_category = "";
				$categories_category = get_the_category( get_the_ID() );
				$categories_firstCategory = $categories_category[0]->cat_ID;
				$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
			endif;
		else:
			$post_categories = "";
		endif;
		/*------------- Category End -------------*/
		
		/*------------- Information Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$num_comments = get_comments_number();
			if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
			$post_information = '<ul class="post-information">
				<li class="author">' . get_the_author() . '</li>
				<li class="seperate"></li>
				<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
				<li class="seperate"></li>
				<li class="comment">' . $comments . '</li>
			</ul>';
		else:
			$post_information = "";
		endif;
		/*------------- Information End -------------*/
		
		/*------------- Read More Start -------------*/
		if( strstr( $atts['designfeatures'], "readmore" ) ) :
			$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
		else:
			$readmore = "";
		endif;
		/*------------- Read More End -------------*/
		
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				$output .= '<div class="editors-pick-widget">';
					$output .= '<article class="post">';
						$output .= '<div class="post-image"' . ' ' . $editor_picks_featured_image_code . '>';
							$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">';
								$output .= $post_categories;
								$output .= '<h2>' . get_the_title() . '</h2>';
								$output .= $post_information . $readmore;
							$output .= '</a>';
						$output .= '</div>';
					$output .= '</article>';
				$output .= '</div>';
			$output .= '</div>';		

		endwhile;
		wp_reset_postdata();
	/*------------- Post ID Type End -------------*/
	/*------------- Tags Type Start -------------*/
	elseif( strstr( $atts['querytype'], "tags" ) ) :
	
		/*------------- Title Start -------------*/
		if( !empty( $atts['title'] ) ) :
			$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
		endif;
		/*------------- Title End -------------*/

		/*------------- Exclude Start -------------*/
		if( !empty( $atts['excludeposts'] ) ) :
			$exclude = $atts['excludeposts'];
			$exclude = explode( ',', $exclude );
		else:
			$exclude = "";
		endif;
		/*------------- Exclude End -------------*/
	
		/*------------- Query Arg Start -------------*/
		$args_editor_picks = array(
			'posts_per_page' => $atts['postcount'],
			'tag' => $atts['tag'],
			'post_status' => 'publish',
			'post__not_in' => $exclude,
			'ignore_sticky_posts' => true,
			'post_type' => 'post'
		);
		/*------------- Query Arg End -------------*/
		
		$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
		while ( $wp_query_args_editor_picks->have_posts() ) :
		$wp_query_args_editor_picks->the_post();
		
		/*------------- Image Start -------------*/
		$editor_picks_featured_image_code = "";
		$editor_picks_featured_image_code[0] = "";
		if( has_post_thumbnail( get_the_ID() ) ) :
			$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-editors-pick' );
			$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
		else:
			$editor_picks_featured_image_code = "";
		endif;
		/*------------- Image End -------------*/
		
		/*------------- Category Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$categories = get_the_category( get_the_ID() );
			if ( ! empty( $categories ) ) :
				$categories_category = "";
				$categories_category = get_the_category( get_the_ID() );
				$categories_firstCategory = $categories_category[0]->cat_ID;
				$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
			endif;
		else:
			$post_categories = "";
		endif;
		/*------------- Category End -------------*/
		
		/*------------- Information Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$num_comments = get_comments_number();
			if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
			$post_information = '<ul class="post-information">
				<li class="author">' . get_the_author() . '</li>
				<li class="seperate"></li>
				<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
				<li class="seperate"></li>
				<li class="comment">' . $comments . '</li>
			</ul>';
		else:
			$post_information = "";
		endif;
		/*------------- Information End -------------*/
		
		/*------------- Read More Start -------------*/
		if( strstr( $atts['designfeatures'], "readmore" ) ) :
			$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
		else:
			$readmore = "";
		endif;
		/*------------- Read More End -------------*/

			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				$output .= '<div class="editors-pick-widget">';
					$output .= '<article class="post">';
						$output .= '<div class="post-image"' . ' ' . $editor_picks_featured_image_code . '>';
							$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">';
								$output .= $post_categories;
								$output .= '<h2>' . get_the_title() . '</h2>';
								$output .= $post_information . $readmore;
							$output .= '</a>';
						$output .= '</div>';
					$output .= '</article>';
				$output .= '</div>';
			$output .= '</div>';		

		endwhile;
		wp_reset_postdata();
	/*------------- Tags Type End -------------*/	
	/*------------- Latest Posts Type Start -------------*/
	else:
	
		/*------------- Title Start -------------*/
		if( !empty( $atts['title'] ) ) {
			$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
		}
		/*------------- Title End -------------*/

		/*------------- Exclude Start -------------*/
		if( !empty( $atts['excludeposts'] ) ) :
			$exclude = $atts['excludeposts'];
			$exclude = explode( ',', $exclude );
		else:
			$exclude = "";
		endif;
		/*------------- Exclude End -------------*/
	
		/*------------- Query Arg Start -------------*/
		$args_editor_picks = array(
			'posts_per_page' => $atts['postcount'],
			'cat' => $atts['category'],
			'post_status' => 'publish',
			'post__not_in' => $exclude,
			'ignore_sticky_posts' => true,
			'post_type' => 'post'
		); 
		/*------------- Query Arg End -------------*/
		
		$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
		while ( $wp_query_args_editor_picks->have_posts() ) :
		$wp_query_args_editor_picks->the_post();
		
		/*------------- Image Start -------------*/
		$editor_picks_featured_image_code = "";
		if( has_post_thumbnail( get_the_ID() ) ) :
			$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-editors-pick' );
			$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
		else:
			$editor_picks_featured_image_code = "";
		endif;
		/*------------- Image End -------------*/
		
		/*------------- Category Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$categories = get_the_category( get_the_ID() );
			if ( ! empty( $categories ) ) :
				$categories_category = "";
				$categories_category = get_the_category( get_the_ID() );
				$categories_firstCategory = $categories_category[0]->cat_ID;
				$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
			endif;
		else:
			$post_categories = "";
		endif;
		/*------------- Category End -------------*/
		
		/*------------- Information Start -------------*/
		if( strstr( $atts['designfeatures'], "information" ) ) :
			$num_comments = get_comments_number();
			if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
			$post_information = '<ul class="post-information">
				<li class="author">' . get_the_author() . '</li>
				<li class="seperate"></li>
				<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
				<li class="seperate"></li>
				<li class="comment">' . $comments . '</li>
			</ul>';
		else:
			$post_information = "";
		endif;
		/*------------- Information End -------------*/
		
		/*------------- Read More Start -------------*/
		if( strstr( $atts['designfeatures'], "readmore" ) ) :
			$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
		else:
			$readmore = "";
		endif;
		/*------------- Read More End -------------*/
		
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				$output .= '<div class="editors-pick-widget">';
					$output .= '<article class="post">';
						$output .= '<div class="post-image"' . ' ' . $editor_picks_featured_image_code . '>';
							$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">';
								$output .= $post_categories;
								$output .= '<h2>' . get_the_title() . '</h2>';
								$output .= $post_information . $readmore;
							$output .= '</a>';
						$output .= '</div>';
					$output .= '</article>';
				$output .= '</div>';
			$output .= '</div>';		

		endwhile;
		wp_reset_postdata();
		
	endif;
	/*------------- Latest Posts Type End -------------*/

	return $output;
}
add_shortcode("editorpicks", "mulada_editor_picks_shortcode");

if(function_exists('vc_map')){

	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	}

	vc_map( array(
		"name" => esc_html__("Editor Picks", 'mulada'),
		"base" => "editorpicks",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_editor_picks.png',
		"description" =>esc_html__( 'Editor pick widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Post ID", 'mulada') => "postid",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the latest posts for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post ID",'mulada'),
				"description" => esc_html__("You can enter the post id. You can select the post id for query type.",'mulada'),
				"param_name" => "postid",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post Count",'mulada'),
				"description" => esc_html__("You can enter the post count.",'mulada'),
				"param_name" => "postcount",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Read More Button", 'mulada') => "readmore"
				)
			)
		)
	) );
}
/*------------- EDITOR PICKS END -------------*/

/*------------- MULADA LATEST POSTS START -------------*/
function mulada_latest_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'querytype' => '',
			'tag' => '',
			'category' => '',
			'excludeposts' => '',
			'postcount' => '',
			'style' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';
	
	/*------------- Long Style Start -------------*/
	if( strstr( $atts['style'], "long" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-post-widget' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					if( strstr( $atts['designfeatures'], "socialshare" ) ) :
						$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
					else:
						$readmore = '<div class="post-read-more post-read-more-middle"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
					endif;
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="widget-content">
									<div class="chosen-post-widget chosen-alternative-post-widget">
										<article class="post">'
											. $image . '
											<div class="post-wrapper">
												<div class="post-header">
													<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
													. $post_categories . $post_information . '
												</div>'
												. $excerpt . $post_bottom . '
											</div>
										</article>
									</div>
								</div>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'post_status' => 'publish',
					'cat' => $atts['category'],
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-post-widget' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					if( strstr( $atts['designfeatures'], "socialshare" ) ) :
						$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
					else:
						$readmore = '<div class="post-read-more post-read-more-middle"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
					endif;
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="widget-content">
									<div class="chosen-post-widget chosen-alternative-post-widget">
										<article class="post">'
											. $image . '
											<div class="post-wrapper">
												<div class="post-header">
													<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
													. $post_categories . $post_information . '
												</div>'
												. $excerpt . $post_bottom . '
											</div>
										</article>
									</div>
								</div>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Long Style End -------------*/
	/*------------- One st. Full Then Grid Style Start -------------*/
	elseif( strstr( $atts['style'], "onestfullthengrid" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- One Post Start -------------*/
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => 1,
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="widget-content">
									<div class="onest-grid-posts-widget">
										<article class="post">'
											. $image . '
											<div class="post-wrapper">
												<div class="post-header">
													<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
													. $post_categories . $post_information . '
												</div>'
												. $excerpt . $post_bottom . '
											</div>
										</article>
									</div>
								</div>';
				endwhile;
				wp_reset_postdata();
				/*------------- One Post End -------------*/
				
				/*------------- Then Post Start -------------*/
				/*------------- Query Arg Start -------------*/
				$arg_then_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'offset' => 1,
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				$wp_query_args_then_latest_posts = new WP_Query( $arg_then_latest_posts );
				if ( $wp_query_args_then_latest_posts->have_posts() ) :
					$output .= '<div class="row">';
					while ( $wp_query_args_then_latest_posts->have_posts() ) :
					$wp_query_args_then_latest_posts->the_post();
							
							/*------------- Image Start -------------*/
							if( strstr( $atts['designfeatures'], "image" ) ) :
								if ( has_post_thumbnail( get_the_ID() ) ) :
									$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-onest-grid-posts-widget' );
									$image = '<div class="post-image">';
										$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
									$image .= '</div>';
								else:
									$image = "";
								endif;
							else:
								$image = "";
							endif;
							/*------------- Image End -------------*/
							
							/*------------- Category Start -------------*/
							if( strstr( $atts['designfeatures'], "information" ) ) :
								$categories = get_the_category( get_the_ID() );
								if ( ! empty( $categories ) ) :
									$categories_category = "";
									$categories_category = get_the_category( get_the_ID() );
									$categories_firstCategory = $categories_category[0]->cat_ID;
									$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
								endif;
							else:
								$post_categories = "";
							endif;
							/*------------- Category End -------------*/
				
							/*------------- Information Start -------------*/
							if( strstr( $atts['designfeatures'], "information" ) ) :
								$num_then_comments = get_comments_number();
								if ( $num_then_comments == 0 ) : $comments_then = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_then_comments > 1 ) : $comments_then = $num_then_comments . esc_html__( ' Comments', 'mulada' );  else: $comments_then = esc_html__( '1 Comment', 'mulada' ); endif;
								$post_information_then = '<ul class="post-information">
									<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
									<li class="seperate"></li>
									<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								</ul>';
							else:
								$post_information_then = "";
							endif;
							/*------------- Information End -------------*/

							$output .= '<div class="col-sm-6 col-xs-12"><div class="widget-content">
												<div class="chosen-post-widget chosen-small-post-widget onest-grid-small-posts-widget">
													<article class="post">'
														. $image . '
														<div class="post-wrapper">
															<div class="post-header">
																<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
																. $post_categories . $post_information_then . '
															</div>
														</div>
													</article>
												</div>
											</div></div>';
					endwhile;
					$output .= '</div>';
				endif;
				wp_reset_postdata();
				/*------------- Then Post End -------------*/
			
			$output .= '</div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/

			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- One Post Start -------------*/
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => 1,
					'post_status' => 'publish',
					'cat' => $atts['category'],
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="widget-content">
									<div class="onest-grid-posts-widget">
										<article class="post">'
											. $image . '
											<div class="post-wrapper">
												<div class="post-header">
													<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
													. $post_categories . $post_information . '
												</div>'
												. $excerpt . $post_bottom . '
											</div>
										</article>
									</div>
								</div>';
				endwhile;
				wp_reset_postdata();
				/*------------- One Post End -------------*/
				
				/*------------- Then Post Start -------------*/
				/*------------- Query Arg Start -------------*/
				$arg_then_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'offset' => 1,
					'post_status' => 'publish',
					'cat' => $atts['category'],
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				$wp_query_args_then_latest_posts = new WP_Query( $arg_then_latest_posts );
				if ( $wp_query_args_then_latest_posts->have_posts() ) :
					$output .= '<div class="row">';
					while ( $wp_query_args_then_latest_posts->have_posts() ) :
					$wp_query_args_then_latest_posts->the_post();
							
							/*------------- Image Start -------------*/
							if( strstr( $atts['designfeatures'], "image" ) ) :
								if ( has_post_thumbnail( get_the_ID() ) ) :
									$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-onest-grid-posts-widget' );
									$image = '<div class="post-image">';
										$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
									$image .= '</div>';
								else:
									$image = "";
								endif;
							else:
								$image = "";
							endif;
							/*------------- Image End -------------*/
							
							/*------------- Category Start -------------*/
							if( strstr( $atts['designfeatures'], "information" ) ) :
								$categories = get_the_category( get_the_ID() );
								if ( ! empty( $categories ) ) :
									$categories_category = "";
									$categories_category = get_the_category( get_the_ID() );
									$categories_firstCategory = $categories_category[0]->cat_ID;
									$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
								endif;
							else:
								$post_categories = "";
							endif;
							/*------------- Category End -------------*/
				
							/*------------- Information Start -------------*/
							if( strstr( $atts['designfeatures'], "information" ) ) :
								$num_then_comments = get_comments_number();
								if ( $num_then_comments == 0 ) : $comments_then = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_then_comments > 1 ) : $comments_then = $num_then_comments . esc_html__( ' Comments', 'mulada' );  else: $comments_then = esc_html__( '1 Comment', 'mulada' ); endif;
								$post_information_then = '<ul class="post-information">
									<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
									<li class="seperate"></li>
									<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								</ul>';
							else:
								$post_information_then = "";
							endif;
							/*------------- Information End -------------*/

							$output .= '<div class="col-sm-6 col-xs-12"><div class="widget-content">
												<div class="chosen-post-widget chosen-small-post-widget onest-grid-small-posts-widget">
													<article class="post">'
														. $image . '
														<div class="post-wrapper">
															<div class="post-header">
																<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
																. $post_categories . $post_information_then . '
															</div>
														</div>
													</article>
												</div>
											</div></div>';
					endwhile;
					$output .= '</div>';
				endif;
				wp_reset_postdata();
				/*------------- Then Post End -------------*/
			
			$output .= '</div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Vertical Style Start -------------*/
	elseif( strstr( $atts['style'], "vertical" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="post-list alternative-home-list">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-alternative-home-list' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/

			$output .= '<div class="post-list alternative-home-list">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-alternative-home-list' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Vertical Style End -------------*/
	/*------------- Standard Style Start -------------*/
	elseif( strstr( $atts['style'], "standard" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="post-list home-list-layout">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/

			$output .= '<div class="post-list home-list-layout">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-home-big-posts' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Standard Style End -------------*/
	/*------------- Sidebar Style Start -------------*/
	elseif( strstr( $atts['style'], "sidebar" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
			
			$output .= '<div class="mulada-latest-posts-widget mulada-post-popular-posts-widget">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				$output .= '<ul>';
				
				$output .= '<div class="widget-content">';
				
				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-sidebar-latest-posts' );
						$image = '<div class="image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$post_information = '<time datetime="' . get_the_time( 'Y' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

				$output .= '<li>'
									. $image . '
									<div class="desc">' . $post_categories . '
											<h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h3>'
											. $post_information . '
									</div>
								</li>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div></ul></div></div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/
			$output .= '<div class="sidebar-home-magazine-wrap widget-box">';
			
			$output .= '<div class="mulada-latest-posts-widget mulada-post-popular-posts-widget">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				$output .= '<ul>';
				
				$output .= '<div class="widget-content">';
				
				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-sidebar-latest-posts' );
						$image = '<div class="image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$post_information = '<time datetime="' . get_the_time( 'Y' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

				$output .= '<li>'
									. $image . '
									<div class="desc">' . $post_categories . '
											<h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h3>'
											. $post_information . '
									</div>
								</li>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div></ul></div></div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Sidebar Style End -------------*/
	/*------------- Grid Style Start -------------*/	
	elseif( strstr( $atts['style'], "gridsystem" ) ) :
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="grid-home-content grid-home-content-nowide"><div class="post-list home-list-layout">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				$output .= '<div class="row">';
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-onest-grid-posts-widget' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="post-grid"><article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article></div>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div></div></div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/

			$output .= '<div class="grid-home-content grid-home-content-nowide"><div class="post-list home-list-layout">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				$output .= '<div class="row">';
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-onest-grid-posts-widget' );
						$image = '<div class="post-image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . esc_html__( "By", "mulada" ) . ' ' . get_the_author_link() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . $comments . '</a></li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/
				
				/*------------- Excerpt Start -------------*/
				if( strstr( $atts['designfeatures'], "excerpt" ) ) :
					$excerpt = '<div class="post-excerpt"><p>' . get_the_excerpt() . '</p></div>';
				else:
					$excerpt = "";
				endif;
				/*------------- Excerpt End -------------*/
				
				/*------------- Read More Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) ) :
					$readmore = '<div class="post-read-more"><a href="' . get_the_permalink() . '#comments" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . esc_html__( 'Read More', 'mulada' ) . '</a></div>';
				else:
					$readmore = "";
				endif;
				/*------------- Read More End -------------*/
				
				/*------------- Social Share Start -------------*/
				if( strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_share_hide = get_theme_mod( 'post_share_hide' );
					$social_share_facebook = get_theme_mod( 'social_share_facebook' );
					$social_share_twitter = get_theme_mod( 'social_share_twitter' );
					$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
					$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
					$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
					$social_share_reddit = get_theme_mod( 'social_share_reddit' );
					$social_share_delicious = get_theme_mod( 'social_share_delicious' );
					$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
					$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
					$social_share_link_title = esc_html__( 'Share to', 'mulada' );
					$hide_general_post_share = get_theme_mod( 'hide_general_post_share' );
					$share_post_id = get_the_ID();
					$share_featured_post_image[0] = "";
					
					if( has_post_thumbnail( get_the_ID() ) ) :
						$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
					endif;
					
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$hide_general_post_share == '1' ) : 
						if( !$social_share_facebook == '1' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; else: endif;
						if( !$social_share_twitter == '1' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; else: endif;
						if( !$social_share_googleplus == '1' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; else: endif;
						if( !$social_share_linkedin == '1' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; else: endif;
						if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $share_featured_post_image[0] ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
						if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
						if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
						if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
						if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
					endif;
					
					$social_share_before = '<div class="post-share"><ul>';
					$social_share_after = '</ul></div>';
					$social_share = $social_share_before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $social_share_after;
				else:
					$social_share = "";
				endif;
				/*------------- Social Share End -------------*/
				
				/*------------- Post Bottom Start -------------*/
				if( strstr( $atts['designfeatures'], "readmore" ) or strstr( $atts['designfeatures'], "socialshare" ) ) :
					$post_bottom = '<div class="post-bottom">' . $readmore . $social_share . '</div>';
				else:
				 $post_bottom = "";
				endif;
				/*------------- Social Share End -------------*/

				$output .= '<div class="post-grid"><article class="post">'
									. $image . '
									<div class="post-wrapper">
										<div class="post-header">
											<h2><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h2>'
											. $post_categories . $post_information . '
										</div>'
										. $excerpt . $post_bottom . '
									</div>
								</article></div>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</div></div></div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- Grid Style End -------------*/
	/*------------- List Style Start -------------*/
	else:
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			$output .= '<div class="chosen-category-posts-widget">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				$output .= '<ul>';
				
				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-category-widget' );
						$image = '<div class="image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$post_information = '<time datetime="' . get_the_time( 'Y' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

				$output .= '<li>'
									. $image . '
									<div class="desc">
											<h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h3>'
											. $post_information . '
									</div>
								</li>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</ul></div>';
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Type Start -------------*/

			$output .= '<div class="chosen-category-posts-widget">';
				
				/*------------- Title Start -------------*/
				if( !empty( $atts['title'] ) ) {
					$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
				}
				/*------------- Title End -------------*/

				$output .= '<ul>';
				
				/*------------- Exclude Start -------------*/
				if( !empty( $atts['excludeposts'] ) ) :
					$exclude = $atts['excludeposts'];
					$exclude = explode( ',', $exclude );
				else:
					$exclude = "";
				endif;
				/*------------- Exclude End -------------*/
				
				/*------------- Query Arg Start -------------*/
				$arg_latest_posts = array(
					'posts_per_page' => $atts['postcount'],
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_latest_posts = new WP_Query( $arg_latest_posts );
				while ( $wp_query_args_latest_posts->have_posts() ) :
				$wp_query_args_latest_posts->the_post();
				
				/*------------- Image Start -------------*/
				if( strstr( $atts['designfeatures'], "image" ) ) :
					if ( has_post_thumbnail( get_the_ID() ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-chosen-category-widget' );
						$image = '<div class="image">';
							$image .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '"><img src="' . esc_url( $image_url[0] ) . '" alt="' . the_title_attribute( array( 'echo' => 0) ) . '" /></a>';
						$image .= '</div>';
					else:
						$image = "";
					endif;
				else:
					$image = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$post_information = '<time datetime="' . get_the_time( 'Y' ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</time>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

				$output .= '<li>'
									. $image . '
									<div class="desc">
											<h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">'. get_the_title() .'</a></h3>'
											. $post_information . '
									</div>
								</li>';
				endwhile;
				wp_reset_postdata();
			
			$output .= '</ul></div>';
		/*------------- Latest Posts Type End -------------*/
		endif;
	/*------------- List Style End -------------*/
	endif;
	
	return $output;
}
add_shortcode("muladalatestposts", "mulada_latest_posts_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("Latest Posts", 'mulada'),
		"base" => "muladalatestposts",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_latest_posts.png',
		"description" =>esc_html__( 'Latest posts widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Tag Posts", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post Count",'mulada'),
				"description" => esc_html__("You can enter the post count.",'mulada'),
				"param_name" => "postcount",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Style",'mulada'),
				"description" => esc_html__("You can select the design style.",'mulada'),
				"param_name" => "style",
				"value" => array(
					esc_html__("List", 'mulada') => "list",
					esc_html__("Long", 'mulada') => "long",
					esc_html__("1st Full Then Grid", 'mulada') => "onestfullthengrid",
					esc_html__("Vertical", 'mulada') => "vertical",
					esc_html__("Standard", 'mulada') => "standard",
					esc_html__("Sidebar", 'mulada') => "sidebar",
					esc_html__("Grid", 'mulada') => "gridsystem"
				)
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Featured Image", 'mulada') => "image",
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Post Excerpt", 'mulada') => "excerpt",
					esc_html__("Read More Button", 'mulada') => "readmore",
					esc_html__("Social Share Icons", 'mulada') => "socialshare"
				)
			)
		)
	) );
}
/*------------- MULADA LATEST POSTS END -------------*/

/*------------- HEADER FEATURED POSTS START -------------*/
function header_featured_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'querytype' => '',
			'tag' => '',
			'category' => '',
			'excludeposts' => '',
			'slider_header_logo' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';

	$output .= '<div class="header-slider-area">';
	
		$output .= '<div class="header-slider-slides">';
		
		$output .= '<div class="header-slider-logo-area">';
		
			if( !empty( $atts['slider_header_logo'] ) ) {
				$slider_header_logo = wp_get_attachment_image_src($atts["slider_header_logo"], "full");
				$output .= '<div class="header-logo">';
					$output .= '<a href="' . get_home_url() . '">';
						$output .= '<img src="' . esc_url( $slider_header_logo[0] ) . '" alt="' . esc_html__( 'Logo','mulada') . '" />';
					$output .= '</a>';
				$output .= '</div>';
			}
			
		$output .= '</div>';

			$output .= '<div class="header-slider-slides-area">';

				/*------------- Tags Type Start -------------*/
				if( strstr( $atts['querytype'], "tags" ) ) :

					/*------------- Exclude Start -------------*/
					if( !empty( $atts['excludeposts'] ) ) :
						$exclude = $atts['excludeposts'];
						$exclude = explode( ',', $exclude );
					else:
						$exclude = "";
					endif;
					/*------------- Exclude End -------------*/
				
					/*------------- LEFT START -------------*/
					$output .= '<div class="left">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 2,
							'tag' => $atts['tag'],
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-small' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- LEFT END -------------*/
				
					/*------------- MIDDLE START -------------*/
					$output .= '<div class="middle">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 1,
							'tag' => $atts['tag'],
							'offset' => 2,
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-big' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-big" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- MIDDLE END -------------*/
				
					/*------------- RIGHT START -------------*/
					$output .= '<div class="right">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 2,
							'tag' => $atts['tag'],
							'offset' => 3,
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-small' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore. '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- RIGHT END -------------*/
				/*------------- Tags Type End -------------*/	
				
				/*------------- Latest Posts Type Start -------------*/
				else:

					/*------------- Exclude Start -------------*/
					if( !empty( $atts['excludeposts'] ) ) :
						$exclude = $atts['excludeposts'];
						$exclude = explode( ',', $exclude );
					else:
						$exclude = "";
					endif;
					/*------------- Exclude End -------------*/
				
					/*------------- LEFT START -------------*/
					$output .= '<div class="left">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 2,
							'cat' => $atts['category'],
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-small' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- LEFT END -------------*/
				
					/*------------- MIDDLE START -------------*/
					$output .= '<div class="middle">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 1,
							'cat' => $atts['category'],
							'offset' => 2,
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-big' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-big" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- MIDDLE END -------------*/
				
					/*------------- RIGHT START -------------*/
					$output .= '<div class="right">';
						
						/*------------- Query Arg Start -------------*/
						$args_editor_picks = array(
							'posts_per_page' => 2,
							'cat' => $atts['category'],
							'offset' => 3,
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'ignore_sticky_posts' => true,
							'post_type' => 'post'
						);
						/*------------- Query Arg End -------------*/
						
						$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
						while ( $wp_query_args_editor_picks->have_posts() ) :
						$wp_query_args_editor_picks->the_post();
						
						/*------------- Image Start -------------*/
						$editor_picks_featured_image_code = "";
						$editor_picks_featured_image_code[0] = "";
						if( has_post_thumbnail( get_the_ID() ) ) :
							$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-featured-posts-small' );
							$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
						else:
							$editor_picks_featured_image_code = "";
						endif;
						/*------------- Image End -------------*/
						
						/*------------- Category Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$categories = get_the_category( get_the_ID() );
							if ( ! empty( $categories ) ) :
								$categories_category = "";
								$categories_category = get_the_category( get_the_ID() );
								$categories_firstCategory = $categories_category[0]->cat_ID;
								$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
							endif;
						else:
							$post_categories = "";
						endif;
						/*------------- Category End -------------*/
						
						/*------------- Information Start -------------*/
						if( strstr( $atts['designfeatures'], "information" ) ) :
							$num_comments = get_comments_number();
							if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
							$post_information = '<ul class="post-information">
								<li class="author">' . get_the_author() . '</li>
								<li class="seperate"></li>
								<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
								<li class="seperate"></li>
								<li class="comment">' . $comments . '</li>
							</ul>';
						else:
							$post_information = "";
						endif;
						/*------------- Information End -------------*/
													
						/*------------- Read More Start -------------*/
						if( strstr( $atts['designfeatures'], "readmore" ) ) :
							$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
						else:
							$readmore = "";
						endif;
						/*------------- Read More End -------------*/

							$output .= '<div class="header-slider-slides-box header-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
												<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
													<div class="color"></div>
													<div class="wrapper">
														<div class="content">
															<div class="content-in">
																<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
															</div>
														</div>
													</div>
												</a>
											</div>';	

						endwhile;
						wp_reset_postdata();
				
					$output .= '</div>';
					/*------------- RIGHT END -------------*/
				endif;
				/*------------- Latest Posts Type End -------------*/
				
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode("headerfeaturedposts", "header_featured_posts_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("Header Featured Posts", 'mulada'),
		"base" => "headerfeaturedposts",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_featured_posts.png',
		"description" =>esc_html__( 'Header featured posts widget','mulada'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => esc_html__("Logo",'mulada'),
				"description" => esc_html__("You can the upload your site logo.",'mulada'),
				"param_name" => "slider_header_logo",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Read More", 'mulada') => "readmore"
				)
			)
		)
	) );
}
/*------------- HEADER FEATURED POSTS END -------------*/

/*------------- WIDE FEATURED POSTS START -------------*/
function wide_featured_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'querytype' => '',
			'tag' => '',
			'category' => '',
			'excludeposts' => '',
			'designfeatures' => ''
		), $atts
	);
	
	$output = '';

	$output .= '<div class="wide-featured-posts-area">';

		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			/*------------- Exclude Start -------------*/
			if( !empty( $atts['excludeposts'] ) ) :
				$exclude = $atts['excludeposts'];
				$exclude = explode( ',', $exclude );
			else:
				$exclude = "";
			endif;
			/*------------- Exclude End -------------*/
		
			/*------------- LEFT START -------------*/
			$output .= '<div class="left">';
				
				/*------------- Query Arg Start -------------*/
				$args_editor_picks = array(
					'posts_per_page' => 1,
					'tag' => $atts['tag'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
				while ( $wp_query_args_editor_picks->have_posts() ) :
				$wp_query_args_editor_picks->the_post();
				
				/*------------- Image Start -------------*/
				$editor_picks_featured_image_code = "";
				$editor_picks_featured_image_code[0] = "";
				if( has_post_thumbnail( get_the_ID() ) ) :
					$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-big' );
					$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
				else:
					$editor_picks_featured_image_code = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . get_the_author() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment">' . $comments . '</li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

					$output .= '<div class="wide-slider-slides-box wide-slider-slides-box-big" ' . $editor_picks_featured_image_code . '>
										<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
											<div class="color"></div>
											<div class="wrapper">
												<div class="content">
													<div class="content-in">
														<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . '
													</div>
												</div>
											</div>
										</a>
									</div>';	

				endwhile;
				wp_reset_postdata();
		
			$output .= '</div>';
			/*------------- LEFT END -------------*/
		
			/*------------- RIGHT START -------------*/
			$output .= '<div class="right">';
				
				/*------------- Query Arg Start -------------*/
				$args_editor_picks = array(
					'posts_per_page' => 2,
					'tag' => $atts['tag'],
					'offset' => 1,
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
				while ( $wp_query_args_editor_picks->have_posts() ) :
				$wp_query_args_editor_picks->the_post();
				
				/*------------- Image Start -------------*/
				$editor_picks_featured_image_code = "";
				$editor_picks_featured_image_code[0] = "";
				if( has_post_thumbnail( get_the_ID() ) ) :
					$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
					$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
				else:
					$editor_picks_featured_image_code = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . get_the_author() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment">' . $comments . '</li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

					$output .= '<div class="wide-slider-slides-box wide-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
										<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
											<div class="color"></div>
											<div class="wrapper">
												<div class="content">
													<div class="content-in">
														<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . '
													</div>
												</div>
											</div>
										</a>
									</div>';	

				endwhile;
				wp_reset_postdata();
		
			$output .= '</div>';
			/*------------- RIGHT END -------------*/
		/*------------- Tags Type End -------------*/	
		
		/*------------- Latest Posts Type Start -------------*/
		else:

			/*------------- Exclude Start -------------*/
			if( !empty( $atts['excludeposts'] ) ) :
				$exclude = $atts['excludeposts'];
				$exclude = explode( ',', $exclude );
			else:
				$exclude = "";
			endif;
			/*------------- Exclude End -------------*/
		
			/*------------- LEFT START -------------*/
			$output .= '<div class="left">';
				
				/*------------- Query Arg Start -------------*/
				$args_editor_picks = array(
					'posts_per_page' => 1,
					'cat' => $atts['category'],
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
				while ( $wp_query_args_editor_picks->have_posts() ) :
				$wp_query_args_editor_picks->the_post();
				
				/*------------- Image Start -------------*/
				$editor_picks_featured_image_code = "";
				$editor_picks_featured_image_code[0] = "";
				if( has_post_thumbnail( get_the_ID() ) ) :
					$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-big' );
					$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
				else:
					$editor_picks_featured_image_code = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . get_the_author() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment">' . $comments . '</li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

					$output .= '<div class="wide-slider-slides-box wide-slider-slides-box-big" ' . $editor_picks_featured_image_code . '>
										<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
											<div class="color"></div>
											<div class="wrapper">
												<div class="content">
													<div class="content-in">
														<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . '
													</div>
												</div>
											</div>
										</a>
									</div>';	

				endwhile;
				wp_reset_postdata();
		
			$output .= '</div>';
			/*------------- LEFT END -------------*/
		
			/*------------- RIGHT START -------------*/
			$output .= '<div class="right">';
				
				/*------------- Query Arg Start -------------*/
				$args_editor_picks = array(
					'posts_per_page' => 2,
					'cat' => $atts['category'],
					'offset' => 1,
					'post_status' => 'publish',
					'post__not_in' => $exclude,
					'ignore_sticky_posts' => true,
					'post_type' => 'post'
				);
				/*------------- Query Arg End -------------*/
				
				$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
				while ( $wp_query_args_editor_picks->have_posts() ) :
				$wp_query_args_editor_picks->the_post();
				
				/*------------- Image Start -------------*/
				$editor_picks_featured_image_code = "";
				$editor_picks_featured_image_code[0] = "";
				if( has_post_thumbnail( get_the_ID() ) ) :
					$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
					$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
				else:
					$editor_picks_featured_image_code = "";
				endif;
				/*------------- Image End -------------*/
				
				/*------------- Category Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$categories = get_the_category( get_the_ID() );
					if ( ! empty( $categories ) ) :
						$categories_category = "";
						$categories_category = get_the_category( get_the_ID() );
						$categories_firstCategory = $categories_category[0]->cat_ID;
						$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
					endif;
				else:
					$post_categories = "";
				endif;
				/*------------- Category End -------------*/
				
				/*------------- Information Start -------------*/
				if( strstr( $atts['designfeatures'], "information" ) ) :
					$num_comments = get_comments_number();
					if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
					$post_information = '<ul class="post-information">
						<li class="author">' . get_the_author() . '</li>
						<li class="seperate"></li>
						<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
						<li class="seperate"></li>
						<li class="comment">' . $comments . '</li>
					</ul>';
				else:
					$post_information = "";
				endif;
				/*------------- Information End -------------*/

					$output .= '<div class="wide-slider-slides-box wide-slider-slides-box-small" ' . $editor_picks_featured_image_code . '>
										<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
											<div class="color"></div>
											<div class="wrapper">
												<div class="content">
													<div class="content-in">
														<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . '
													</div>
												</div>
											</div>
										</a>
									</div>';	

				endwhile;
				wp_reset_postdata();
		
			$output .= '</div>';
			/*------------- RIGHT END -------------*/
		endif;
		/*------------- Latest Posts Type End -------------*/
				
	$output .= '</div>';

	return $output;
}
add_shortcode("widefeaturedposts", "wide_featured_posts_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("Wide Featured Posts", 'mulada'),
		"base" => "widefeaturedposts",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_wide_featured_posts.png',
		"description" =>esc_html__( 'Wide featured posts widget.','mulada'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information"
				)
			)
		)
	) );
}
/*------------- WIDE FEATURED POSTS END -------------*/

/*------------- POPULAR POST START -------------*/
function popular_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'querytype' => '',
			'category' => '',
			'tag' => '',
			'postcount' => '',
			'excludeposts' => '',
			'designfeatures' => ''
		), $atts
	);
	
	/*------------- Exclude Start -------------*/
	if( !empty( $atts['excludeposts'] ) ) :
		$excludeposts = $atts['excludeposts'];
		$excludeposts = explode( ',', $excludeposts );
	else:
		$excludeposts = "";
	endif;
	/*-------------  Exclude End -------------*/
	
	$output = '';
				
	/*------------- Title Start -------------*/
	if( !empty( $atts['title'] ) ) {
		$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
	}
	/*------------- Title End -------------*/

	$output .= '<div class="mulada-popular-posts-widget">';
	
		$output .= '<ul>';
		
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => $atts['postcount'],
				'tag' => $atts['tag'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post',
				'orderby' => 'comment_count'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<li ' . $editor_picks_featured_image_code . '>
									<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
										<div class="color"></div>
										<div class="wrapper">
											<div class="content">
												<div class="content-in">
													<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
												</div>
											</div>
										</div>
									</a>
								</li>';	

			endwhile;
			wp_reset_postdata();
		
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Start -------------*/

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => $atts['postcount'],
				'cat' => $atts['category'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post',
				'orderby' => 'comment_count'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<li ' . $editor_picks_featured_image_code . '>
									<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
										<div class="color"></div>
										<div class="wrapper">
											<div class="content">
												<div class="content-in">
													<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
												</div>
											</div>
										</div>
									</a>
								</li>';	

			endwhile;
			wp_reset_postdata();
		
		endif;
		/*------------- Latest Posts Start -------------*/
			
		$output .= '</ul>';
		
	$output .= '</div>';

	return $output;
}
add_shortcode("popularpostswidget", "popular_posts_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("Popular Posts", 'mulada'),
		"base" => "popularpostswidget",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_popular_posts.png',
		"description" =>esc_html__( 'Popular posts widget. Sort: According to comments.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post Count",'mulada'),
				"description" => esc_html__("You can enter the post count.",'mulada'),
				"param_name" => "postcount",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Read More Button", 'mulada') => "readmore"
				)
			)
		)
	) );
}
/*------------- POPULAR POST END -------------*/

/*------------- SOCIAL MEDIA LINKS START -------------*/
function social_media_links_shortcode( $atts, $content = null ) {

	$output = '';
	
	$output .='<div class="contact-social-media">';
		$output .='<ul>';
			if( !get_theme_mod( 'mulada_facebook' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_facebook' ) . '" title="' . esc_html__( 'Facebook', 'mulada' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_twitter' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_twitter' ) . '" title="' . esc_html__( 'Twitter', 'mulada' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_googleplus' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_googleplus' ) . '" title="' . esc_html__( 'Google+', 'mulada' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_instagram' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_instagram' ) . '" title="' . esc_html__( 'Instagram', 'mulada' ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_linkedin' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_linkedin' ) . '" title="' . esc_html__( 'Linkedin', 'mulada' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_vine' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_vine' ) . '" title="' . esc_html__( 'Vine', 'mulada' ) . '" target="_blank"><i class="fa fa-vine"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_youtube' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_youtube' ) . '" title="' . esc_html__( 'YouTube', 'mulada' ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_pinterest' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_pinterest' ) . '" title="' . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_behance' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_behance' ) . '" title="' . esc_html__( 'Behance', 'mulada' ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_deviantart' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_deviantart' ) . '" title="' . esc_html__( 'Deviantart', 'mulada' ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_digg' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_digg' ) . '" title="' . esc_html__( 'Digg', 'mulada' ) . '" target="_blank"><i class="fa fa-digg"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_dribbble' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_dribbble' ) . '" title="' . esc_html__( 'Dribbble', 'mulada' ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_flickr' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_flickr' ) . '" title="' . esc_html__( 'Flickr', 'mulada' ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_github' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_github' ) . '" title="' . esc_html__( 'GitHub', 'mulada' ) . '" target="_blank"><i class="fa fa-github"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_lastfm' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_lastfm' ) . '" title="' . esc_html__( 'Last.fm', 'mulada' ) . '" target="_blank"><i class="fa fa-lastfm"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_reddit' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_reddit' ) . '" title="' . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_soundcloud' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_soundcloud' ) . '" title="' . esc_html__( 'SoundCloud', 'mulada' ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_tumblr' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_tumblr' ) . '" title="' . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_vimeo' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_vimeo' ) . '" title="' . esc_html__( 'Vimeo', 'mulada' ) . '" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_vk' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_vk' ) . '" title="' . esc_html__( 'VK', 'mulada' ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_medium' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_medium' ) . '" title="' . esc_html__( 'Medium', 'mulada' ) . '" target="_blank"><i class="fa fa-medium"></i></a></li>';
			endif;

			if( !get_theme_mod( 'mulada_rss' ) == ""  ) :
				$output .='<li><a href="' . get_theme_mod( 'mulada_rss' ) . '" title="' . esc_html__( 'RSS', 'mulada' ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>';
			endif;
		$output .='</ul>';
	$output .='</div>';;

	return $output;
}
add_shortcode("socialmedialinks", "social_media_links_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	vc_map( array(
		"name" => esc_html__("Social Media Links", 'mulada'),
		"base" => "socialmedialinks",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/social-links.png',
		"description" =>esc_html__( 'Social media widget.','mulada')
	) );
}
/*------------- SOCIAL MEDIA LINKS END -------------*/


/*------------- BOXED LATEST POST START -------------*/
function boxed_latest_posts_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'querytype' => '',
			'category' => '',
			'tag' => '',
			'postcount' => '',
			'excludeposts' => '',
			'designfeatures' => ''
		), $atts
	);
	
	/*------------- Exclude Start -------------*/
	if( !empty( $atts['excludeposts'] ) ) :
		$excludeposts = $atts['excludeposts'];
		$excludeposts = explode( ',', $excludeposts );
	else:
		$excludeposts = "";
	endif;
	/*-------------  Exclude End -------------*/
	
	$output = '';
				
	/*------------- Title Start -------------*/
	if( !empty( $atts['title'] ) ) {
		$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
	}
	/*------------- Title End -------------*/

	$output .= '<div class="mulada-popular-posts-widget">';
	
		$output .= '<ul>';
		
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => $atts['postcount'],
				'tag' => $atts['tag'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<li ' . $editor_picks_featured_image_code . '>
									<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
										<div class="color"></div>
										<div class="wrapper">
											<div class="content">
												<div class="content-in">
													<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
												</div>
											</div>
										</div>
									</a>
								</li>';	

			endwhile;
			wp_reset_postdata();
			
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Start -------------*/		

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => $atts['postcount'],
				'cat' => $atts['category'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-wide-featured-posts-smal' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<li ' . $editor_picks_featured_image_code . '>
									<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
										<div class="color"></div>
										<div class="wrapper">
											<div class="content">
												<div class="content-in">
													<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
												</div>
											</div>
										</div>
									</a>
								</li>';	

			endwhile;
			wp_reset_postdata();
			
		endif;
		/*------------- Latest Posts End -------------*/
			
		$output .= '</ul>';
		
	$output .= '</div>';

	return $output;
}
add_shortcode("boxedlatestposts", "boxed_latest_posts_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("Boxed Latest Posts", 'mulada'),
		"base" => "boxedlatestposts",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_boxed_latest_posts.png',
		"description" =>esc_html__( 'Boxed latest posts widget.','mulada'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title",'mulada'),
				"description" => esc_html__("You can enter the widget title.",'mulada'),
				"param_name" => "title",
				"value" => "",
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post Count",'mulada'),
				"description" => esc_html__("You can enter the post count.",'mulada'),
				"param_name" => "postcount",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information",
					esc_html__("Read More Button", 'mulada') => "readmore"
				)
			)
		)
	) );
}
/*------------- BOXED LATEST POST END -------------*/

/*------------- ONE FEATURED POST START -------------*/
function one_featured_post_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'querytype' => '',
			'category' => '',
			'tag' => '',
			'excludeposts' => '',
			'designfeatures' => ''
		), $atts
	);
	
	/*------------- Exclude Start -------------*/
	if( !empty( $atts['excludeposts'] ) ) :
		$excludeposts = $atts['excludeposts'];
		$excludeposts = explode( ',', $excludeposts );
	else:
		$excludeposts = "";
	endif;
	/*-------------  Exclude End -------------*/
	
	$output = '';
				
	/*------------- Title Start -------------*/
	if( !empty( $atts['title'] ) ) {
		$output .= '<div class="widget-title"><h4>' . $atts['title'] . '</h4></div>';
	}
	/*------------- Title End -------------*/

	$output .= '<div class="one-featured-post-area">';
		
		/*------------- Tags Type Start -------------*/
		if( strstr( $atts['querytype'], "tags" ) ) :

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => 1,
				'tag' => $atts['tag'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-one-featured-posts' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">' . '<div class="color"></div>' . 
									'<div class="one-featured-post" ' . $editor_picks_featured_image_code . '>
										<div class="one-featured-post-container">
											<div class="wrapper">
												<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
											</div>
										</div>
									</div>
								</a>';	

			endwhile;
			wp_reset_postdata();
			
		/*------------- Tags Type End -------------*/
		else:
		/*------------- Latest Posts Start -------------*/		

			/*------------- Query Arg Start -------------*/
			$args_editor_picks = array(
				'posts_per_page' => 1,
				'cat' => $atts['category'],
				'post_status' => 'publish',
				'post__not_in' => $excludeposts,
				'ignore_sticky_posts' => true,
				'post_type' => 'post'
			);
			/*------------- Query Arg End -------------*/
			
			$wp_query_args_editor_picks = new WP_Query( $args_editor_picks );
			while ( $wp_query_args_editor_picks->have_posts() ) :
			$wp_query_args_editor_picks->the_post();
			
			/*------------- Image Start -------------*/
			$editor_picks_featured_image_code = "";
			$editor_picks_featured_image_code[0] = "";
			if( has_post_thumbnail( get_the_ID() ) ) :
				$editor_picks_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mulada-one-featured-posts' );
				$editor_picks_featured_image_code = 'style="background-image:url(' . $editor_picks_featured_image[0] . ');"';
			else:
				$editor_picks_featured_image_code = "";
			endif;
			/*------------- Image End -------------*/
			
			/*------------- Category Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$categories = get_the_category( get_the_ID() );
				if ( ! empty( $categories ) ) :
					$categories_category = "";
					$categories_category = get_the_category( get_the_ID() );
					$categories_firstCategory = $categories_category[0]->cat_ID;
					$post_categories = '<div class="category cat-color-' . $categories_firstCategory . '">' . esc_html( $categories[0]->name ) . '</div>';   
				endif;
			else:
				$post_categories = "";
			endif;
			/*------------- Category End -------------*/
			
			/*------------- Information Start -------------*/
			if( strstr( $atts['designfeatures'], "information" ) ) :
				$num_comments = get_comments_number();
				if ( $num_comments == 0 ) : $comments = esc_html__( '0 Comment', 'mulada' ); elseif ( $num_comments > 1 ) : $comments = $num_comments . esc_html__( ' Comments', 'mulada' );  else: $comments = esc_html__( '1 Comment', 'mulada' ); endif;
				$post_information = '<ul class="post-information">
					<li class="author">' . get_the_author() . '</li>
					<li class="seperate"></li>
					<li class="date">' . get_the_time( get_option( 'date_format' ) ) . '</li>
					<li class="seperate"></li>
					<li class="comment">' . $comments . '</li>
				</ul>';
			else:
				$post_information = "";
			endif;
			/*------------- Information End -------------*/
													
			/*------------- Read More Start -------------*/
			if( strstr( $atts['designfeatures'], "readmore" ) ) :
				$readmore = '<div class="post-read-more"><span>' . esc_html__( 'Read More', 'mulada' ) . '</span></div>';
			else:
				$readmore = "";
			endif;
			/*------------- Read More End -------------*/

				$output .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array( 'echo' => 0) ) . '">
									<div class="one-featured-post" ' . $editor_picks_featured_image_code . '>
										<div class="one-featured-post-container">
											<div class="wrapper">
												<h3>' . get_the_title() . '</h3>' . $post_categories . $post_information . $readmore . '
											</div>
										</div>
									</div>
								</a>';	

			endwhile;
			wp_reset_postdata();
			
		endif;
		/*------------- Latest Posts End -------------*/
		
	$output .= '</div>';

	return $output;
}
add_shortcode("onefeaturedpost", "one_featured_post_shortcode");

if(function_exists('vc_map')){
	
	$posts_list = get_posts(array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));

	$posts_array = array();
	$posts_array[__("All Categories", 'mulada')] = "-";
	foreach($posts_list as $post) {
		$posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
	}

	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All Categories", 'mulada')] = "-";
	foreach($post_categories as $post_category) {
		$post_categories_array[$post_category->name] =  $post_category->term_id;
	 }

	vc_map( array(
		"name" => esc_html__("One Featured Post", 'mulada'),
		"base" => "onefeaturedpost",
		"class" => "",
		"category" => esc_html__("Mulada Theme", 'mulada'),
		"icon" => get_template_directory_uri().'/assets/img/icons/mulada_one_featured_post.png',
		"description" =>esc_html__( 'One featured post widget.','mulada'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Query Type",'mulada'),
				"description" => esc_html__("You can select the query type.",'mulada'),
				"param_name" => "querytype",
				"value" => array(
					esc_html__("Latest Posts", 'mulada') => "latestposts",
					esc_html__("Posts By Tag", 'mulada') => "tags"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__("Category",'mulada'),
				"description" => esc_html__("You can select the category. You can select the posts by tag for query type.",'mulada'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Tag",'mulada'),
				"description" => esc_html__("You can enter the tag. You can select the latest posts for query type.",'mulada'),
				"param_name" => "tag",
				"value" => "",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Exclude Posts",'mulada'),
				"description" => esc_html__("You can enter the post ids. Separate with commas 1,2,3 etc.",'mulada'),
				"param_name" => "excludeposts",
				"value" => "",
			),
			array(
				"type" => "checkbox",
				"admin_label" => false,
				"class" => "",
				"heading" => esc_html__("Design Features",'mulada'),
				"param_name" => "designfeatures",
				"description" => esc_html__("You can select the design features.",'mulada'),
				"value" => array(
					esc_html__("Post Information", 'mulada') => "information"
				)
			)
		)
	) );
}
/*------------- ONE FEATURED POST END -------------*/