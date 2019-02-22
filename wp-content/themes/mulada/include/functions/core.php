<?php
/*------------- THEME SETUP START -------------*/
add_action( 'after_setup_theme', 'mulada_setup' );
function mulada_setup(){
	load_theme_textdomain( 'mulada', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'quote', 'gallery', 'image', 'video', 'audio', 'chat', 'link' ) );
	
	if( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'mulada-featured-posts-small', 470, 405, true );
		add_image_size( 'mulada-featured-posts-big', 630, 810, true );
		add_image_size( 'mulada-one-featured-posts', 1499, 810, true );
		add_image_size( 'mulada-wide-featured-posts-big', 1321, 810, true );
		add_image_size( 'mulada-wide-featured-posts-smal', 562, 401, true );
		add_image_size( 'mulada-home-big-posts', 1190, 781, true );
		add_image_size( 'mulada-sidebar-latest-posts', 138, 128, true );
		add_image_size( 'mulada-chosen-post-posts', 410, 263, true );
		add_image_size( 'mulada-chosen-editors-pick', 1170, 454, true );
		add_image_size( 'mulada-chosen-category-widget', 155, 104, true );
		add_image_size( 'mulada-chosen-post-widget', 814, 339, true );
		add_image_size( 'mulada-latest-products-widget', 100, 94, true );
		add_image_size( 'mulada-onest-grid-posts-widget', 605, 404, true );
		add_image_size( 'mulada-alternative-home-list', 597, 849, true );
		add_image_size( 'mulada-mega-category-menu', 214, 144, true );
		add_image_size( 'mulada-post-nav', 300, 180, true );
		add_image_size( 'mulada-related-posts', 340, 227, true );
		add_image_size( 'mulada-author-posts-author-image', 215, 215, true );
	}
	
	if( ! isset( $content_width ) ) {
		$content_width = 600;
	}
	
	if( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
/*------------- THEME SETUP END -------------*/

/*------------- ENQUE MULADA SCRIPT FILE AND STYLE FILE START -------------*/
function mulada_scripts()
{
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'mulada-fixed-sidebar-script', get_template_directory_uri() . '/assets/js/fixed-sidebar.js', array(), false, true  );
	$header_fixed = get_theme_mod( 'header_fixed' );
	if( $header_fixed == '1' ) :
		wp_enqueue_script( 'mulada-admin-bar-script', get_template_directory_uri() . '/assets/js/admin-bar.js', array(), false, true  );
	endif;
	wp_enqueue_script( 'mulada-script', get_template_directory_uri() . '/assets/js/mulada.js', array(), false, true  );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css'  );
	wp_enqueue_style( 'mulada-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mulada_scripts' );

function mulada_load_custom_wp_admin() {
	wp_enqueue_style( 'mulada-admin-style', get_template_directory_uri() . '/assets/css/admin.css'  );
	wp_enqueue_script( 'mulada-admin-script', get_template_directory_uri() . '/assets/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'mulada_load_custom_wp_admin' );
/*------------- ENQUE MULADA SCRIPT FILE AND STYLE FILE END -------------*/

/*------------- THEME HEAD META TAGS START -------------*/
function mulada_meta_tags() {
    global $post;
 
    if(is_single()) {
        if( has_post_thumbnail( $post->ID ) ):
            $head_img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
		else:
			$head_img_src = "";
			$head_img_src[0] = "";
		endif;
		
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo esc_url( $head_img_src[0] ); ?>"/>
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'mulada_meta_tags', 5);
/*------------- THEME HEAD META TAGS END -------------*/

/*------------- COMMENTS CLASS START -------------*/
function mulada_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) :
		$tag = 'div';
		$add_below = 'comment';
	else:
		$tag = 'li';
		$add_below = 'div-comment';
	endif;
?>
	<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
	<?php if ( 'div' != $args['style'] ) : ?>
	
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		
	<?php endif; ?>
	
	<div class="comment-author vcard">

		<div class="reply">
		
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		
		<?php edit_comment_link( esc_html__( 'Edit', 'mulada' ), '  ', '' ); ?>
		
		</div>
	
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		
		<?php $allowed_html = array ( 'span' => array() ); printf( wp_kses( '<cite class="fn">%s</cite>', 'mulada' ), get_comment_author_link() ); ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		
			<?php printf( esc_html__( '%1$s at %2$s', 'mulada' ), get_comment_date(),  get_comment_time() ); ?></a>
			
		</div>
		
	</div>
	
	<?php if ( $comment->comment_approved == '0' ) : ?>
	
		<em class="comment-awaiting-moderation"><?php echo esc_html_e( 'Your comment is awaiting moderation.', 'mulada' ); ?></em>
		
	<?php endif; ?>

	<?php comment_text(); ?>

	<?php if ( 'div' != $args['style'] ) : ?>
	
		</div>
	
	<?php endif; ?>
<?php
}
/*------------- COMMENTS CLASS END -------------*/

/*------------- BODY CLASS START -------------*/
function mulada_class_names( $classes ) {
	$classes[] = 'mulada-class';
	return $classes;
}
add_filter( 'body_class', 'mulada_class_names' );
/*------------- BODY CLASS END -------------*/

/*------------- EXCERPT START -------------*/
function mulada_new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'mulada_new_excerpt_more' );

function mulada_my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'mulada_my_add_excerpts_to_pages' );
/*------------- EXCERPT END -------------*/

/*------------- THEME SIDEBAR - WIDGET START -------------*/
if( !function_exists( 'mulada_sidebars_init' ) ) {
	function mulada_sidebars_init() {
		register_sidebar(array(
			'id' => 'general-sidebar',
			'name' => esc_html__( 'General Sidebar', 'mulada' ),
			'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'shop-sidebar',
			'name' => esc_html__( 'Shop Sidebar', 'mulada' ),
			'before_widget' => '<div id="%1$s" class="shop-sidebar-wrap widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'footer-top-sidebar',
			'name' => esc_html__( 'Footer Top Sidebar', 'mulada' ),
			'before_widget' => '<div class="col-sm-4 col-xs-12"><div id="%1$s" class="footer-sidebar-wrap widget-box %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'footer-bottom-sidebar',
			'name' => esc_html__( 'Footer Bottom Sidebar', 'mulada' ),
			'before_widget' => '<div class="col-sm-4 col-xs-12"><div id="%1$s" class="footer-sidebar-wrap widget-box %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'yawp_wim',
			'name' => esc_html__( 'Menu Sidebar', 'mulada' ),
			'before_widget' => '<div id="%1$s" class=" %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
	}
}

add_action( 'widgets_init', 'mulada_sidebars_init' );
/*------------- THEME SIDEBAR - WIDGET END -------------*/

/*------------- SUB MENU CLASS START -------------*/
class mulada_walker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		//Add class and attribute to LI element that contains a submenu UL.
		if ($args->has_children){
			$classes[] 		= 'dropdown';
			$li_attributes .= ' data-dropdown="dropdown"';
		}
		$classes[] = 'menu-item-' . $item->ID;
		//If we are on the current page, add the active class to that menu item.
		$classes[] = ($item->current) ? 'active' : '';

		//Make sure you still add all of the WordPress classes.
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		//Add attributes to link element.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ''; 

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;
        $id_field = $this->db_fields['id'];
        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
/*------------- SUB MENU CLASS END -------------*/

/*------------- HEADER STYLES START -------------*/
function mulada_header_styles_social_media() {
	global $post;
	
	if ( is_page() or is_single() ) {
		$header_metaboxes = get_post_custom( $post->ID );
		$header_alternative_style_select = isset( $header_metaboxes['header_layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $header_metaboxes['header_layout_select_meta_box_text'][0] ) ) :'';

		if( $header_alternative_style_select == "alternativestyle" ) {
			$header_style = " header-alternative";
		}
		else {
			$header_style = "";
		}
		
	}
	else {
		$header_style = "";
		$header_alternative_style_select = "";
	}
		
	$hide_alternative_header_social = get_theme_mod( 'hide_alternative_header_social' );
	if( !$hide_alternative_header_social == '1' ) {
		if( $header_alternative_style_select == "alternativestyle" ) {
			$output = '';
			$output .='<div class="header-social-media">';
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
			$output .='</div>';
			echo balanceTags ( stripslashes( addslashes( $output ) ) );
		}
	}
}
/*------------- HEADER STYLES END -------------*/

/*------------- HEADER STYLE CLASS START -------------*/
function mulada_header_style_class() {
	global $post;
	
	if ( is_page() or is_single() ) {
		$header_metaboxes = get_post_custom( $post->ID );
		$header_alternative_style_select = isset( $header_metaboxes['header_layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $header_metaboxes['header_layout_select_meta_box_text'][0] ) ) :'';

		if( $header_alternative_style_select == "alternativestyle" ) {
			$header_style = " header-alternative";
		}
		else {
			$header_style = "";
		}
		
	}
	else {
		$header_style = "";
	}
	
	echo esc_attr( $header_style );
}
/*------------- HEADER STYLE CLASS END -------------*/

/*------------- MULADA MENUS START -------------*/
register_nav_menus( 
	array(
		'mainmenu' => esc_html__( 'Main Navigation', 'mulada' )
	)
);
/*------------- MULADA MENUS END -------------*/

/*------------- PAGE LOADING START -------------*/
function mulada_page_loading() {
	$mulada_loader = get_theme_mod( 'mulada_loader' );
	if( !$mulada_loader == 'inactive' or $mulada_loader == 'active' ) :
		echo '<div class="loader-wrapper"> <div class="spinner"> <div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div> <div class="sk-cube sk-cube2"></div> <div class="sk-cube sk-cube3"></div> <div class="sk-cube sk-cube4"></div> <div class="sk-cube sk-cube5"></div> <div class="sk-cube sk-cube6"></div> <div class="sk-cube sk-cube7"></div> <div class="sk-cube sk-cube8"></div> <div class="sk-cube sk-cube9"></div> </div> </div> </div>';
	endif;
}
/*------------- PAGE LOADING END -------------*/

/*------------- RELATED POSTS START -------------*/
function mulada_related_posts() {
	$hide_related_posts = get_theme_mod( 'hide_related_posts' );
	if( !$hide_related_posts == '1' ) :
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$post_related_limit = 4;
		if( !get_theme_mod( 'post_related_limit' ) == "" ) : $post_related_limit = get_theme_mod( 'post_related_limit' ); endif;
		
		if ($tags) {
		?>
			<div class="post-bottom-element">
				<div class="post-related">
					<div class="widget-title">
						<h4><?php echo esc_html_e( 'You May Also Like', 'mulada' ); ?></h4>
					</div>
					<div class="post-related-row">
						<?php
						$tag_ids = array();
						foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
							$args = array(
								'tag__in' => $tag_ids,
								'post__not_in' => array($post->ID),
								'post_status' => 'publish',
								'posts_type' => 'post',
								'ignore_sticky_posts'    => true,
								'posts_per_page' => $post_related_limit
							);
				 
						$my_query = new wp_query( $args );
						while( $my_query->have_posts() ) {
							$my_query->the_post();
							$categories_category = "";
							$categories_category = get_the_category( get_the_ID() );
							$categories_firstCategory = $categories_category[0]->cat_ID;
					?>
							<div class="col-sm-4 col-xs-12">
								<?php if ( has_post_thumbnail() ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<div class="image">
											<?php the_post_thumbnail( 'mulada-related-posts' ); ?>
										</div>
									</a>
								<?php } ?>
								<div class="category cat-color-<?php echo esc_attr( $categories_firstCategory ); ?>"><?php the_category( ', ', '' ); ?></div>
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							</div>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	<?php
	endif;
}
/*------------- RELATED POSTS END -------------*/

/*------------- SIDEBAR START -------------*/
function mulada_post_content_area_start() {
		global $post;
		$values_layout_select = get_post_custom( $post->ID );
		$layout_select = isset( $values_layout_select['layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $values_layout_select['layout_select_meta_box_text'][0] ) ) :'';
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		if( $layout_select == 'fullwidth' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $layout_select == 'leftsidebar' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $layout_select == 'rightsidebar' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-left">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-left">';
		}
		
		else {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-left">';
		}
}

function mulada_post_sidebar_start() {
		global $post;
		$values_layout_select = get_post_custom( $post->ID );
		$layout_select = isset( $values_layout_select['layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $values_layout_select['layout_select_meta_box_text'][0] ) ) :'';
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		if( $layout_select == 'fullwidth' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $layout_select == 'leftsidebar' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $layout_select == 'rightsidebar' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		else {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right fixedrightSidebar"><div class="theiaStickySidebar">';
		}
}

function mulada_content_area_start() {
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-left">';
		}
		
		else {
			echo '<div class="col-lg-8 col-sm-8 col-xs-12 site-content-left">';
		}
}

function mulada_sidebar_start() {
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		else {
			echo '<div class="col-lg-4 col-sm-4 col-xs-12 site-content-right fixedrightSidebar"><div class="theiaStickySidebar">';
		}
}

function mulada_content_area_end() {
	echo '</div>';
}

function mulada_sidebar_end() {
	echo '</div></div>';
}

function mulada_content_transparent_bg() {
	global $post;
	$values_layout_select = get_post_custom( $post->ID );
	$layout_select_meta_box_bg_transparent_check = isset( $values_layout_select['layout_select_meta_box_bg_transparent'] ) ? strip_tags( esc_attr( $values_layout_select['layout_select_meta_box_bg_transparent'][0] ) ) :'';
	if($layout_select_meta_box_bg_transparent_check == "on") : echo " page-content-transparent"; endif;
}
/*------------- SIDEBAR END -------------*/

/*------------- FOOTER WIDGET START -------------*/
function mulada_top_footer_widget() {
	$hide_top_footer_widget = get_theme_mod( 'hide_top_footer_widget' );
	if( !$hide_top_footer_widget == '1' ) :
	?>
		<?php if ( is_active_sidebar( 'footer-top-sidebar' ) ) { ?>
		<div class="footer-widget">
			<div class="container">
				<aside class="sidebar-footer sidebar">
					<div class="row">
						<?php dynamic_sidebar( 'footer-top-sidebar' ); ?>
					</div>
				</aside>
			</div>
		</div>
		<?php } ?>
	<?php
	endif;
}

function mulada_bottom_footer_widget() {
	$hide_bottom_footer_widget = get_theme_mod( 'hide_bottom_footer_widget' );
	if( !$hide_bottom_footer_widget == '1' ) :
	?>
		<?php if ( is_active_sidebar( 'footer-bottom-sidebar' ) ) { ?>
		<div class="footer-widget">
			<div class="container">
				<aside class="sidebar-footer sidebar">
					<div class="row">
						<?php dynamic_sidebar( 'footer-bottom-sidebar' ); ?>
					</div>
				</aside>
			</div>
		</div>
		<?php } ?>
	<?php
	endif;
}
/*------------- FOOTER WIDGET END -------------*/

/*------------- FOOTER SOCIAL MEDIA START -------------*/
function mulada_footer_social_media_widget() {
	$hide_footer_social_media = get_theme_mod( 'hide_footer_social_media' );
	$footer_social_media_bg = get_theme_mod( 'mulada_social_media_bg' );
	if( !empty( $footer_social_media_bg ) ) :
		$footer_logo_output = 'style="background-image:url('. $footer_social_media_bg . ')"';
	else:
		$footer_logo_output = '';
	endif;
	if( !$hide_footer_social_media == '1' ) :
?>
	<div class="footer_social_media_area" <?php echo balanceTags ( stripslashes( addslashes( $footer_logo_output ) ) ); ?>>
		<div class="container">
			<?php
				if( !get_theme_mod( 'mulada_facebook' ) == "" or !get_theme_mod( 'mulada_googleplus' ) == "" or !get_theme_mod( 'mulada_instagram' ) == "" or !get_theme_mod( 'mulada_linkedin' ) == "" or !get_theme_mod( 'mulada_vine' ) == "" or !get_theme_mod( 'mulada_twitter' ) == "" or !get_theme_mod( 'mulada_youtube' ) == "" or !get_theme_mod( 'mulada_pinterest' ) == "" or !get_theme_mod( 'mulada_rss' ) == "" ) { ?>
					<ul>
						<?php if( !get_theme_mod( 'mulada_facebook' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_facebook' ); ?>" class="facebook" title="<?php echo esc_html__( 'Facebook', 'mulada' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_googleplus' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_googleplus' ); ?>" class="googleplus" title="<?php echo esc_html__( 'Google+', 'mulada' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_instagram' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_instagram' ); ?>" class="instagram" title="<?php echo esc_html__( 'Instagram', 'mulada' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_linkedin' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_linkedin' ); ?>" class="linkedin" title="<?php echo esc_html__( 'Linkedin', 'mulada' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_vine' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_vine' ); ?>" class="vine" title="<?php echo esc_html__( 'Vine', 'mulada' ); ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_twitter' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_twitter' ); ?>" class="twitter" title="<?php echo esc_html__( 'Twitter', 'mulada' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_pinterest' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_pinterest' ); ?>" class="pinterest" title="<?php echo esc_html__( 'Pinterest', 'mulada' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_behance' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_behance' ); ?>" class="behance" title="<?php echo esc_html__( 'Behance', 'mulada' ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_deviantart' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_deviantart' ); ?>" class="deviantart" title="<?php echo esc_html__( 'Deviantart', 'mulada' ); ?>" target="_blank"><i class="fa fa-deviantart"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_digg' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_digg' ); ?>" class="digg" title="<?php echo esc_html__( 'Digg', 'mulada' ); ?>" target="_blank"><i class="fa fa-digg"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_dribbble' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_dribbble' ); ?>" class="dribbble" title="<?php echo esc_html__( 'Dribbble', 'mulada' ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_flickr' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_flickr' ); ?>" class="flickr" title="<?php echo esc_html__( 'Flickr', 'mulada' ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_github' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_github' ); ?>" class="github" title="<?php echo esc_html__( 'GitHub', 'mulada' ); ?>" target="_blank"><i class="fa fa-github"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_lastfm' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_lastfm' ); ?>" class="lastfm" title="<?php echo esc_html__( 'Last.fm', 'mulada' ); ?>" target="_blank"><i class="fa fa-lastfm"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_reddit' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_reddit' ); ?>" class="reddit" title="<?php echo esc_html__( 'Reddit', 'mulada' ); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_soundcloud' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_soundcloud' ); ?>" class="soundcloud" title="<?php echo esc_html__( 'SoundCloud', 'mulada' ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_tumblr' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_tumblr' ); ?>" class="tumblr" title="<?php echo esc_html__( 'Tumblr', 'mulada' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_youtube' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_youtube' ); ?>" class="youtube" title="<?php echo esc_html__( 'YouTube', 'mulada' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_vimeo' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_vimeo' ); ?>" class="vimeo" title="<?php echo esc_html__( 'Vimeo', 'mulada' ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_vk' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_vk' ); ?>" class="vk" title="<?php echo esc_html__( 'VK', 'mulada' ); ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_medium' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_medium' ); ?>" class="medium" title="<?php echo esc_html__( 'Medium', 'mulada' ); ?>" target="_blank"><i class="fa fa-medium"></i></a></li>
						<?php } ?>

						<?php if( !get_theme_mod( 'mulada_rss' ) == ""  ) { ?>
						<li><a href="<?php echo get_theme_mod( 'mulada_rss' ); ?>" class="rss" title="<?php echo esc_html__( 'RSS', 'mulada' ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
						<?php } ?>
					</ul>
				<?php } ?>
		</div>
	</div>
<?php
	endif;
}
/*------------- FOOTER SOCIAL MEDIA END -------------*/

/*------------- HEADER SEARCH START -------------*/
function mulada_header_search() {
	$hide_header_search = get_theme_mod( 'hide_header_search' );
	if( !$hide_header_search == '1' ) :
?>
	<div class="header-search">
		<a href="#" data-toggle="modal" data-target="#header_search"><i class="fa fa-search"></i></a>
		<div class="modal fade" id="header_search" tabindex="-1" role="dialog" aria-labelledby="header_searchLabel">
			<div class="modal-dialog search_modal" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="<?php echo esc_html_e( 'Close', 'mulada' ); ?>"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div>
								<input type="text" placeholder="<?php echo esc_html_e( 'Search and hit enter...', 'mulada' ); ?>" name="s" class="search">
								<button type="submit"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	endif;
}
/*------------- HEADER SEARCH END -------------*/

/*------------- HEADER MENU BUTTON START -------------*/
function header_menu_button() {
	$hide_header_menu_button = get_theme_mod( 'hide_header_menu_button' );
	if( !$hide_header_menu_button == '1' ) :
?>
		<div class="header-menu-button">
			<i class="fa fa-times"></i>
			<span><?php echo esc_html_e( 'Menu', 'mulada' ); ?></span>
		</div>
<?php
	endif;
}
/*------------- HEADER MENU BOTTON END -------------*/

/*------------- 404 PAGE CONTENT START -------------*/
function mulada_page404_content() {
	?>
	<article class="page page404">
		<div class="content404">
			<p class="text404"><strong>Error:</strong><br/>Sorry the page you requested could not be found</p>
			<h1><?php echo esc_html_e( '404', 'mulada' ); ?></h1>
			<p class="subtext"><?php echo esc_html_e( 'Please try using our search box', 'mulada' ); ?><br/><?php echo esc_html_e( 'below to look for information on the internet', 'mulada' ); ?></p>
			<div class="search-form-widget clearfix">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" value="" placeholder="<?php echo esc_html_e( 'Search', 'mulada' ); ?>" name="s" id="s" class="searchform-text">
					<button id="searchsubmit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</article>
	<?php
}
/*------------- 404 PAGE CONTENT END -------------*/

/*------------- CATEGORY COLOR START -------------*/
function mulada_category_form_background_color( $taxonomy ) {
?>
<div class="form-field">
    <label for="category_custom_color"><?php echo esc_html__( 'Color', 'mulada' ); ?></label>
    <input name="cat_meta[catBG]" class="colorpicker" type="text" value="" />
    <p class="description"><?php echo esc_html__( 'Pick a Category Color', 'mulada' ); ?></p>
</div>
<?php
}
add_action('category_add_form_fields', 'mulada_category_form_background_color', 10 );

/** Add New Field To Category **/
function mulada_extra_category_fields_background_color( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id" );
?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="meta-color"><?php echo esc_html__( 'Label Background Color', 'mulada' ); ?></label></th>
    <td>
        <div id="colorpicker">
            <input type="text" name="cat_meta[catBG]" class="colorpicker" size="3" style="min-width:75px; width:20%; text-align:left;" value="<?php echo (isset($cat_meta['catBG'])) ? $cat_meta['catBG'] : '#fff'; ?>" />
        </div>
            <br />
				<span class="description"><?php echo esc_html__( 'Select the custom color.', 'mulada' ); ?></span>
            <br />
        </td>
</tr>
<?php
}
add_action('category_edit_form_fields','mulada_extra_category_fields_background_color');

function mulada_save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['cat_meta'][$key])){
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
add_action ('edited_category', 'mulada_save_extra_category_fileds');
add_action('created_category', 'mulada_save_extra_category_fileds', 11, 1);

function mulada_colorpicker_enqueue() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'colorpicker-js', get_stylesheet_directory_uri() . '/assets/js/colorpicker.js', array( 'wp-color-picker' ) );
}
add_action('admin_enqueue_scripts', 'mulada_colorpicker_enqueue' );

function mulada_category_color() {
	$category = get_the_category();
	$firstCategory = $category[0]->cat_name;
	$cat_id = get_cat_ID( $firstCategory );
	$cat_data = get_option("category_$cat_id");
	if( !empty( $cat_data ) ) :
		echo 'style="background:' . $cat_data['catBG'] . ';"';
	endif;
}
/*------------- CATEGORY COLOR END -------------*/

/*------------- CONTACT FORM 7 START -------------*/
function mulada_mycustom_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );
	return $form;
}
add_filter( 'wpcf7_form_elements', 'mulada_mycustom_wpcf7_form_elements' );
/*------------- CONTACT FORM 7 END -------------*/

/*--------------- VISUL COMPOSER ---------------*/
if(function_exists('vc_add_param')){
  vc_add_param('vc_row',array(
          "type" => "textfield",
          "heading" => esc_html__('Section ID', 'mulada'),
          "param_name" => "el_id",
          "value" => "",
          "description" => esc_html__("Set ID section", 'mulada'),   
   ));  
  vc_add_param('vc_row',array(
        "type" => "dropdown",
        "heading" => esc_html__('Fullwidth', 'mulada'),
        "param_name" => "fullwidth",
        "value" => array(   
                esc_html__('No', 'mulada') => 'no',  
                esc_html__('Yes', 'mulada') => 'yes',                                                                                
                ),
        "description" => esc_html__("Select Fullwidth or not.", 'mulada'),      
      ) 
    ); 
}
/*--------------- VISUL COMPOSER END ---------------*/

/*------------- WOOCOMMERCE START -------------*/
function mulada_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mulada_woocommerce_support' );

function mulada_related_products_args( $args ) {
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'mulada_related_products_args' );
/*------------- WOOCOMMERCE END -------------*/

/*------------- HEADER LOGO START -------------*/
function mulada_site_logo() {
	echo '<div class="header-logo">';
		echo '<a href="' . home_url() . '" class="site-logo">';
		$logo = get_theme_mod( 'mulada_logo' );
		$logo_height = get_theme_mod( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . $logo_height . '"'; }
		$logo_width = get_theme_mod( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . $logo_width . '"'; }
		if( !$logo == ""  ) {
			echo '<img alt="' . esc_html__( 'Logo', 'mulada' ) . '" src="' . get_theme_mod( 'mulada_logo' ) . '" ' . $logo_height . $logo_width . ' />';
		} else {
			echo '<img alt="' . esc_html__( 'Logo', 'mulada' ) . '" src="' . get_template_directory_uri() . '/assets/img/logo.png" />';
		}
		echo '</a>';
	echo '</div>';
}
/*------------- HEADER LOGO END -------------*/

/*------------- FOOTER LOGO START -------------*/
function mulada_footer_site_logo() {
	$footer_logo = get_theme_mod( 'mulada_footer_logo' );
	$hide_footer_logo = get_theme_mod( 'hide_footer_logo' );
	if( !$hide_footer_logo == '1' ) :
		echo '<a href="' . home_url() . '">';
		if( !$footer_logo == ""  ) {
			echo '<img alt="' . esc_html__( 'Logo', 'mulada' ) . '" src="' . get_theme_mod( 'mulada_footer_logo' ) . '" />';
		} else {
			echo '<img alt="' . esc_html__( 'Logo', 'mulada' ) . '" src="' . get_template_directory_uri() . '/assets/img/footer-logo.png" />';
		}
		echo '</a>';
	endif;
}
/*------------- FOOTER LOGO END -------------*/

/*------------- COPYRIGHT START -------------*/
function mulada_copyright() {
	$copyright_text = get_theme_mod( 'copyright_text' );
	$hide_copyright = get_theme_mod( 'hide_copyright' );
	if( !$hide_copyright == '1' ) :
	?>
	<div class="copyright">
		<p><?php echo get_theme_mod( 'copyright_text' ); ?></p>
		<?php mulada_footer_site_logo(); ?>
	</div>
	<?php
	endif;
}
/*------------- COPYRIGHT END -------------*/

/*------------- POST BOTTOM AUTHOR INFO START -------------*/
function mulada_post_bottom_author_info() {
	$author = get_the_author();
	$author_description = get_the_author_meta( 'description' );
	$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) );
	$post_author_info_hide = get_theme_mod( 'hide_post_author_info' );
	if( !$post_author_info_hide == '1' ) :
		if ( $author_description ) : ?>
			<div class="post-bottom-element">
				<div class="post-author">
					<aside class="about-author">
						<?php if ( $author_avatar ) : ?>
							<div class="about-widget-image" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/post-about-bg.jpg)">
								<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
									<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="about-content">
							<h2><?php printf( esc_html__( '%s', 'mulada' ), $author ); ?></h2>
							<p><?php echo esc_attr( $author_description ); ?></p>
							<?php mulada_user_profile_social_media_links(); ?>
						</div>
					</aside>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php
}

function mulada_author_page_author_info() {
	$author = get_the_author();
	$author_description = get_the_author_meta( 'description' );
	$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$author_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) );
	$post_author_info_hide = get_theme_mod( 'hide_post_author_info' );
	if( !$post_author_info_hide == '1' ) :
		if ( $author_description ) : ?>
			<div class="post-bottom-element">
				<div class="post-author">
					<aside class="about-author">
						<?php if ( $author_avatar ) : ?>
							<div class="about-widget-image" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/post-about-bg.jpg)">
								<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
									<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 120 ) ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="about-content">
							<h2><?php printf( esc_html__( '%s', 'mulada' ), $author ); ?></h2>
							<p><?php echo esc_attr( $author_description ); ?></p>
							<?php mulada_user_profile_social_media_links(); ?>
						</div>
					</aside>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php
}
/*------------- POST BOTTOM AUTHOR INFO END -------------*/

/*------------- SOCIAL MEDIA TEMPLATE FUNCTION START -------------*/
function mulada_sidebar_social_media_links() {
	$mulada_hide_header_social_media = get_theme_mod( 'mulada_hide_header_social_media' ); 
	if( $mulada_hide_header_social_media == '' ) :
		if( !get_theme_mod( 'mulada_facebook' ) == "" or !get_theme_mod( 'mulada_googleplus' ) == "" or !get_theme_mod( 'mulada_instagram' ) == "" or !get_theme_mod( 'mulada_linkedin' ) == "" or !get_theme_mod( 'mulada_vine' ) == "" or !get_theme_mod( 'mulada_twitter' ) == "" or !get_theme_mod( 'mulada_youtube' ) == "" or !get_theme_mod( 'mulada_pinterest' ) == "" or !get_theme_mod( 'mulada_rss' ) == "" ) { ?>
			<div class="social-media-widget">
				<ul>
					<?php if( !get_theme_mod( 'mulada_facebook' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_facebook' ); ?>" class="facebook" title="<?php echo esc_html__( 'Facebook', 'mulada' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_googleplus' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_googleplus' ); ?>" class="googleplus" title="<?php echo esc_html__( 'Google+', 'mulada' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_instagram' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_instagram' ); ?>" class="instagram" title="<?php echo esc_html__( 'Instagram', 'mulada' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_linkedin' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_linkedin' ); ?>" class="linkedin" title="<?php echo esc_html__( 'Linkedin', 'mulada' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_vine' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_vine' ); ?>" class="vine" title="<?php echo esc_html__( 'Vine', 'mulada' ); ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_twitter' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_twitter' ); ?>" class="twitter" title="<?php echo esc_html__( 'Twitter', 'mulada' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_youtube' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_youtube' ); ?>" class="youtube" title="<?php echo esc_html__( 'YouTube', 'mulada' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_pinterest' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_pinterest' ); ?>" class="pinterest" title="<?php echo esc_html__( 'Pinterest', 'mulada' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_behance' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_behance' ); ?>" class="behance" title="<?php echo esc_html__( 'Behance', 'mulada' ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_deviantart' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_deviantart' ); ?>" class="deviantart" title="<?php echo esc_html__( 'Deviantart', 'mulada' ); ?>" target="_blank"><i class="fa fa-deviantart"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_digg' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_digg' ); ?>" class="digg" title="<?php echo esc_html__( 'Digg', 'mulada' ); ?>" target="_blank"><i class="fa fa-digg"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_dribbble' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_dribbble' ); ?>" class="dribbble" title="<?php echo esc_html__( 'Dribbble', 'mulada' ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_flickr' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_flickr' ); ?>" class="flickr" title="<?php echo esc_html__( 'Flickr', 'mulada' ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_github' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_github' ); ?>" class="github" title="<?php echo esc_html__( 'GitHub', 'mulada' ); ?>" target="_blank"><i class="fa fa-github"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_lastfm' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_lastfm' ); ?>" class="lastfm" title="<?php echo esc_html__( 'Last.fm', 'mulada' ); ?>" target="_blank"><i class="fa fa-lastfm"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_reddit' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_reddit' ); ?>" class="reddit" title="<?php echo esc_html__( 'Reddit', 'mulada' ); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_soundcloud' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_soundcloud' ); ?>" class="soundcloud" title="<?php echo esc_html__( 'SoundCloud', 'mulada' ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_tumblr' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_tumblr' ); ?>" class="tumblr" title="<?php echo esc_html__( 'Tumblr', 'mulada' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_vimeo' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_vimeo' ); ?>" class="vimeo" title="<?php echo esc_html__( 'Vimeo', 'mulada' ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_vk' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_vk' ); ?>" class="vk" title="<?php echo esc_html__( 'VK', 'mulada' ); ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_medium' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_medium' ); ?>" class="medium" title="<?php echo esc_html__( 'Medium', 'mulada' ); ?>" target="_blank"><i class="fa fa-medium"></i></a></li>
					<?php } ?>

					<?php if( !get_theme_mod( 'mulada_rss' ) == ""  ) { ?>
					<li><a href="<?php echo get_theme_mod( 'mulada_rss' ); ?>" class="rss" title="<?php echo esc_html__( 'RSS', 'mulada' ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
					<?php } ?>
				</ul>
			</div>
		<?php }
	endif;
}
/*------------- SOCIAL MEDIA TEMPLATE FUNCTION END -------------*/

/*------------- USER PROFILE SOCIAL MEDIA FUNCTION START -------------*/
function mulada_user_profile_social_media( $user_profile_social_media_contactmethods ) {
	$user_profile_social_media_contactmethods['facebook'] = esc_html__( 'Facebook', 'mulada' );
	$user_profile_social_media_contactmethods['googleplus'] = esc_html__( 'Google+', 'mulada' );
	$user_profile_social_media_contactmethods['instagram'] = esc_html__( 'Instagram', 'mulada' );
	$user_profile_social_media_contactmethods['linkedin'] = esc_html__( 'Linkedin', 'mulada' );
	$user_profile_social_media_contactmethods['vine'] = esc_html__( 'Vine', 'mulada' );
	$user_profile_social_media_contactmethods['twitter'] = esc_html__( 'Twitter', 'mulada' );
	$user_profile_social_media_contactmethods['pinterest'] = esc_html__( 'Pinterest', 'mulada' );
	$user_profile_social_media_contactmethods['youtube'] = esc_html__( 'YouTube', 'mulada' );
	$user_profile_social_media_contactmethods['behance'] = esc_html__( 'Behance', 'mulada' );
	$user_profile_social_media_contactmethods['deviantart'] = esc_html__( 'DeviantArt', 'mulada' );
	$user_profile_social_media_contactmethods['digg'] = esc_html__( 'Digg', 'mulada' );
	$user_profile_social_media_contactmethods['dribbble'] = esc_html__( 'Dribbble', 'mulada' );
	$user_profile_social_media_contactmethods['flickr'] = esc_html__( 'Flickr', 'mulada' );
	$user_profile_social_media_contactmethods['github'] = esc_html__( 'GitHub', 'mulada' );
	$user_profile_social_media_contactmethods['lastfm'] = esc_html__( 'Last.fm', 'mulada' );
	$user_profile_social_media_contactmethods['reddit'] = esc_html__( 'Reddit', 'mulada' );
	$user_profile_social_media_contactmethods['soundcloud'] = esc_html__( 'SoundCloud', 'mulada' );
	$user_profile_social_media_contactmethods['tumblr'] = esc_html__( 'Tumblr', 'mulada' );
	$user_profile_social_media_contactmethods['vimeo'] = esc_html__( 'Vimeo', 'mulada' );
	$user_profile_social_media_contactmethods['vk'] = esc_html__( 'VK', 'mulada' );
	$user_profile_social_media_contactmethods['medium'] = esc_html__( 'Medium', 'mulada' );
	return $user_profile_social_media_contactmethods;
}
add_filter( 'user_contactmethods', 'mulada_user_profile_social_media', 10, 1 );

function mulada_user_profile_social_media_links() {
	$user_profile_social_media_facebook = get_the_author_meta( 'facebook' );
	$user_profile_social_media_googleplus = get_the_author_meta( 'googleplus' );
	$user_profile_social_media_instagram = get_the_author_meta( 'instagram' );
	$user_profile_social_media_linkedin = get_the_author_meta( 'linkedin' );
	$user_profile_social_media_vine = get_the_author_meta( 'vine' );
	$user_profile_social_media_twitter = get_the_author_meta( 'twitter' );
	$user_profile_social_media_pinterest = get_the_author_meta( 'pinterest' );
	$user_profile_social_media_youtube = get_the_author_meta( 'youtube' );
	$user_profile_social_media_behance = get_the_author_meta( 'behance' );
	$user_profile_social_media_deviantart = get_the_author_meta( 'deviantart' );
	$user_profile_social_media_digg = get_the_author_meta( 'digg' );
	$user_profile_social_media_dribbble = get_the_author_meta( 'dribbble' );
	$user_profile_social_media_flickr = get_the_author_meta( 'flickr' );
	$user_profile_social_media_github = get_the_author_meta( 'github' );
	$user_profile_social_media_lastfm = get_the_author_meta( 'lastfm' );
	$user_profile_social_media_reddit = get_the_author_meta( 'reddit' );
	$user_profile_social_media_soundcloud = get_the_author_meta( 'soundcloud' );
	$user_profile_social_media_tumblr = get_the_author_meta( 'tumblr' );
	$user_profile_social_media_vimeo = get_the_author_meta( 'vimeo' );
	$user_profile_social_media_vk = get_the_author_meta( 'vk' );
	$user_profile_social_media_medium = get_the_author_meta( 'medium' );
	$user_profile_social_links_hide = get_theme_mod( 'user_profile_social_links_hide' ); 
	if( $user_profile_social_links_hide == '' ) :
		if( !$user_profile_social_media_medium == "" or !$user_profile_social_media_vk == "" or !$user_profile_social_media_vimeo == "" or !$user_profile_social_media_tumblr == "" or !$user_profile_social_media_soundcloud == "" or !$user_profile_social_media_reddit == "" or !$user_profile_social_media_lastfm == "" or !$user_profile_social_media_github == "" or !$user_profile_social_media_flickr == "" or !$user_profile_social_media_dribbble == "" or !$user_profile_social_media_digg == "" or !$user_profile_social_media_deviantart == "" or !$user_profile_social_media_behance == "" or !$user_profile_social_media_youtube == "" or !$user_profile_social_media_pinterest == "" or !$user_profile_social_media_twitter == "" or !$user_profile_social_media_vine == "" or !$user_profile_social_media_linkedin == "" or !$user_profile_social_media_facebook == "" or !$user_profile_social_media_googleplus == ""  or !$user_profile_social_media_instagram == "" ) { ?>
			<div class="author-social-link">
				<ul>
					<?php if( !$user_profile_social_media_facebook == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_facebook ); ?>" title="<?php echo esc_html__( 'Facebook', 'mulada' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_googleplus == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_googleplus ); ?>" title="<?php echo esc_html__( 'Google+', 'mulada' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_instagram == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_instagram ); ?>" title="<?php echo esc_html__( 'Instagram', 'mulada' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_linkedin == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_linkedin ); ?>" title="<?php echo esc_html__( 'Linkedin', 'mulada' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vine == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vine ); ?>" title="<?php echo esc_html__( 'Vine', 'mulada' ); ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_twitter == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_twitter ); ?>" title="<?php echo esc_html__( 'Twitter', 'mulada' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_pinterest == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_pinterest ); ?>" title="<?php echo esc_html__( 'Pinterest', 'mulada' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_youtube == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_youtube ); ?>" title="<?php echo esc_html__( 'YouTube', 'mulada' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_behance == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_behance ); ?>" title="<?php echo esc_html__( 'Behance', 'mulada' ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_deviantart == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_deviantart ); ?>" title="<?php echo esc_html__( 'DeviantArt', 'mulada' ); ?>" target="_blank"><i class="fa fa-deviantart"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_digg == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_digg ); ?>" title="<?php echo esc_html__( 'Digg', 'mulada' ); ?>" target="_blank"><i class="fa fa-digg"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_dribbble == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_dribbble ); ?>" title="<?php echo esc_html__( 'Dribbble', 'mulada' ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_flickr == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_flickr ); ?>" title="<?php echo esc_html__( 'Flickr', 'mulada' ); ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_github == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_github ); ?>" title="<?php echo esc_html__( 'GitHub', 'mulada' ); ?>" target="_blank"><i class="fa fa-github"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_lastfm == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_lastfm ); ?>" title="<?php echo esc_html__( 'Last.fm', 'mulada' ); ?>" target="_blank"><i class="fa fa-lastfm"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_reddit == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_reddit ); ?>" title="<?php echo esc_html__( 'Reddit', 'mulada' ); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_soundcloud == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_soundcloud ); ?>" title="<?php echo esc_html__( 'SoundCloud', 'mulada' ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_tumblr == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_tumblr ); ?>" title="<?php echo esc_html__( 'Tumblr', 'mulada' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vimeo == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vimeo ); ?>" title="<?php echo esc_html__( 'Vimeo', 'mulada' ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_vk == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_vk ); ?>" title="<?php echo esc_html__( 'VK', 'mulada' ); ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
					<?php endif; ?>
					
					<?php if( !$user_profile_social_media_medium == ""  ) : ?>
						<li><a href="<?php echo esc_url( $user_profile_social_media_medium ); ?>" title="<?php echo esc_html__( 'Medium', 'mulada' ); ?>" target="_blank"><i class="fa fa-medium"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php }
	endif;
}
/*------------- USER PROFILE MEDIA FUNCTION END -------------*/

/*------------- POST SOCIAL SHARE START -------------*/
function mulada_general_post_social_share() {
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
		if( !$social_share_pinterest == '1' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'mulada' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; else: endif;
		if( !$social_share_reddit == '1' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'mulada' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; else: endif;
		if( !$social_share_delicious == '1' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'mulada' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; else: endif;
		if( !$social_share_stumbleupon == '1' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'mulada' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; else: endif;
		if( !$social_share_tumblr == '1' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'mulada' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; else: endif;
	endif;
	
	$before = '<div class="post-share"><ul>';
	$after = '</ul></div>';
	
	$output = $before . $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr . $after;
	echo balanceTags ( stripslashes( addslashes( $output ) ) );
}

function mulada_post_content_social_share() {
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
	if( !$hide_general_post_share == '1' ) : ?>
		<div class="post-share">
			<ul>
				<li class="title"><?php echo esc_html__( 'Share:', 'mulada' ); ?></li>
				<?php if( !$social_share_facebook == '1' ) : ?><li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>&t=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Facebook', 'mulada' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
				<?php if( !$social_share_twitter == '1' ) : ?><li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Twitter', 'mulada' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
				<?php if( !$social_share_googleplus == '1' ) : ?><li><a class="share-googleplus"  href="https://plus.google.com/share?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Google+', 'mulada' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
				<?php if( !$social_share_linkedin == '1' ) : ?><li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Linkedin', 'mulada' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
				<?php if( !$social_share_pinterest == '1' ) : ?><li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=<?php echo the_permalink(); ?>&description=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Pinterest', 'mulada' ); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li><?php endif; ?>
				<?php if( !$social_share_reddit == '1' ) : ?><li><a class="share-reddit"  href="http://reddit.com/submit?url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Reddit', 'mulada' ); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li><?php endif; ?>
				<?php if( !$social_share_delicious == '1' ) : ?><li><a class="share-delicious"  href="http://del.icio.us/post?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Delicious', 'mulada' ); ?>" target="_blank"><i class="fa fa-delicious"></i></a></li><?php endif; ?>
				<?php if( !$social_share_stumbleupon == '1' ) : ?><li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Stumbleupon', 'mulada' ); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li><?php endif; ?>
				<?php if( !$social_share_tumblr == '1' ) : ?><li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo esc_html__( 'Tumblr', 'mulada' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li><?php endif; ?>
			</ul>
		</div>
		<?php
	endif;
}
/*------------- POST SOCIAL SHARE END -------------*/

/*------------- WRAPPER BEFORE START -------------*/
function mulada_wrapper_before() {
	$layout_style = get_theme_mod( 'layout_style' );
	?>
		<div class="mulada-wrapper<?php if( $layout_style == "boxed"  ) : ?> wrapper-boxed<?php endif; ?>" id="general-wrapper">
	<?php
}
/*------------- WRAPPER BEFORE END -------------*/

/*------------- WRAPPER AFTER START -------------*/
function mulada_wrapper_after() {
	?>
		</div>
	<?php
}
/*------------- WRAPPER AFTER END -------------*/

/*------------- SITE CONTENT START -------------*/
function mulada_site_content_start() {
	?>
		<div class="site-content">
	<?php
}

function mulada_site_content_end() {
	?>			
		</div>
	<?php
}
/*------------- SITE CONTENT END -------------*/

/*------------- SITE SUB CONTENT START -------------*/
function mulada_site_sub_content_start() {
	?>
		<div class="site-sub-content">
	<?php
}

function mulada_site_sub_content_end() {
	?>			
		</div>
	<?php
}
/*------------- SITE SUB CONTENT END -------------*/

/*------------- WIDGET CONTENT BEFORE START -------------*/
function mulada_widget_content_before() {
	?>
		<div class="widget-content">
	<?php
}
/*------------- WIDGET CONTENT BEFORE END -------------*/

/*------------- WIDGET CONTENT AFTER START -------------*/
function mulada_widget_content_after() {
	?>
		</div>
	<?php
}
/*------------- WIDGET CONTENT AFTER END -------------*/

/*------------- SITE PAGE CONTENT BEFORE START -------------*/
function mulada_site_page_content_before() {
	?>
		<div class="site-page-content">
	<?php
}
/*------------- SITE PAGE CONTENT BEFORE END -------------*/

/*------------- SITE PAGE CONTENT AFTER START -------------*/
function mulada_site_page_content_after() {
	?>
		</div>
	<?php
}
/*------------- SITE PAGE CONTENT AFTER END -------------*/

/*------------- CONTAINER BEFORE START -------------*/
function mulada_container_before() {
	?>
		<div class="container">
	<?php
}
/*------------- CONTAINER BEFORE END -------------*/

/*------------- CONTAINER AFTER START -------------*/
function mulada_container_after() {
	?>
		</div>
	<?php
}
/*------------- CONTAINER AFTER END -------------*/

/*------------- ROW BEFORE START -------------*/
function mulada_row_before() {
	?>
		<div class="row">
	<?php
}
/*------------- ROW BEFORE END -------------*/

/*------------- ROW AFTER START -------------*/
function mulada_row_after() {
	?>
		</div>
	<?php
}
/*------------- ROW AFTER END -------------*/