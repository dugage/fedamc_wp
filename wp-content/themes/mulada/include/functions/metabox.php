<?php
/*------------- METABOXS START -------------*/
/*------------- VIDEO POST META BOX -------------*/
function mulada_video_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_video_post', esc_html__( 'Video Post Embed', 'mulada' ), 'mulada_video_post_meta_box_video_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'mulada_video_post_meta_box_add' );

function mulada_video_post_meta_box_video_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_video = get_post_custom( $post->ID );
	$text_video = isset( $values_video['video_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_video['video_post_meta_box_text'][0] ) ) :'';
    if( $text_video == "" ) {
		$text_video = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'video_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <textarea name="video_post_meta_box_text" id="form-input-tip-video" rows="3" style="width:100%;"><?php echo esc_html( stripcslashes( $text_video ) ); ?></textarea>
    </p>
	
	<p class="howto"><?php echo esc_html__('Example: <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/OYbXaqQ3uuo" frameborder="0" allowfullscreen></iframe>', 'mulada'); ?></p>
    <?php    
}

function mulada_video_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_video = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['video_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'video_post_meta_box_text', addslashes( $_POST['video_post_meta_box_text'] ) );
         
    if( isset( $_POST['video_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'video_post_meta_box_select', addslashes( $_POST['video_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_video = isset( $_POST['video_post_meta_box_check'] ) && $_POST['video_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'video_post_meta_box_check', $chk_video );

}
add_action( 'save_post', 'mulada_video_post_meta_box_save' );
/*------------- VIDEO POST META BOX END -------------*/

/*------------- PAGE LAYOUT META BOX -------------*/
function mulada_layout_select_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_layout_select', esc_html__( 'Layout Settings', 'mulada' ), 'mulada_layout_select_meta_box_layout_select', 'page', 'side', 'low' );
	add_meta_box( 'my-meta-box-id_layout_select', esc_html__( 'Layout Settings', 'mulada' ), 'mulada_layout_select_meta_box_layout_select', 'post', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'mulada_layout_select_meta_box_add' );

function mulada_layout_select_meta_box_layout_select()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_layout_select = get_post_custom( $post->ID );
	$layout_select = isset( $values_layout_select['layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $values_layout_select['layout_select_meta_box_text'][0] ) ) :'';
	$header_select = isset( $values_layout_select['header_layout_select_meta_box_text'] ) ? strip_tags( esc_attr( $values_layout_select['header_layout_select_meta_box_text'][0] ) ) :'';
	$layout_select_meta_box_bg_transparent_check = isset( $values_layout_select['layout_select_meta_box_bg_transparent'] ) ? strip_tags( esc_attr( $values_layout_select['layout_select_meta_box_bg_transparent'][0] ) ) :'';
	$page_title_hide_check = isset( $values_layout_select['page_title_hide'] ) ? strip_tags( esc_attr( $values_layout_select['page_title_hide'][0] ) ) :'';
    if( $layout_select == "" ) {
		$layout_select = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'layout_select_meta_box_nonce', 'meta_box_nonce' );
	
	if($layout_select_meta_box_bg_transparent_check == "on") : $layout_select_meta_box_bg_transparent_check_checked = 'checked="checked"'; else: $layout_select_meta_box_bg_transparent_check_checked = ''; endif;
	if($page_title_hide_check == "on") : $page_title_hide_checked = 'checked="checked"'; else: $page_title_hide_checked = ''; endif;
	?>
	<div class="metabox-group-title"><?php echo esc_html__( 'Layout', 'mulada' ); ?></div>
	<div class="mulada-metabox-group">
		<div class="metabox-group-content">
			<div class="metabox-group-sub-title"><?php echo esc_html__( 'Layout Style', 'mulada' ); ?></div>
			<p>
				<select name='layout_select_meta_box_text'>
					<option value="" <?php if ( $layout_select == "" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Layout Select', 'mulada' ); ?></option>
					<option value="fullwidth" <?php if ( $layout_select == "fullwidth" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Sidebar None', 'mulada' ); ?></option>
					<option value="leftsidebar" <?php if ( $layout_select == "leftsidebar" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Left Sidebar', 'mulada' ); ?></option>
					<option value="rightsidebar" <?php if ( $layout_select == "rightsidebar" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Right Sidebar', 'mulada' ); ?></option>
				</select>
			</p>

			<p class="is-page">
				<input type="checkbox" class="checkbox" <?php echo esc_attr( $layout_select_meta_box_bg_transparent_check_checked ); ?> id="layout_select_meta_box_bg_transparent" name="layout_select_meta_box_bg_transparent" />
				<label for="layout_select_meta_box_bg_transparent"><?php echo esc_html__( 'Content Transparent Background', 'mulada' ); ?></label>
			</p>
		</div>
	</div>
	
	<div class="metabox-group-title"><?php echo esc_html__( 'Header', 'mulada' ); ?></div>
	<div class="mulada-metabox-group">
		<div class="metabox-group-content">
			<div class="metabox-group-sub-title"><?php echo esc_html__( 'Header Style', 'mulada' ); ?></div>
			<p>
				<select name='header_layout_select_meta_box_text'>
					<option value="" <?php if ( $header_select == "" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Header Style', 'mulada' ); ?></option>
					<option value="default" <?php if ( $header_select == "default" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Default Style', 'mulada' ); ?></option>
					<option value="alternativestyle" <?php if ( $header_select == "alternativestyle" ) : echo "selected"; endif; ?>><?php echo esc_html__( 'Alternative Style', 'mulada' ); ?></option>
				</select>
			</p>
			
			<p class="is-page">
				<input type="checkbox" class="checkbox" <?php echo esc_attr( $page_title_hide_checked ); ?> id="page_title_hide" name="page_title_hide" />
				<label for="page_title_hide"><?php echo esc_html__( 'Hide Page Title', 'mulada' ); ?></label>
			</p>
		</div>
	</div>
		
    <?php    
}

function mulada_layout_select_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_video = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['layout_select_meta_box_text'] ) )
        update_post_meta( $post_id, 'layout_select_meta_box_text', addslashes( $_POST['layout_select_meta_box_text'] ) );
	
    if( isset( $_POST['header_layout_select_meta_box_text'] ) )
        update_post_meta( $post_id, 'header_layout_select_meta_box_text', addslashes( $_POST['header_layout_select_meta_box_text'] ) );
	
	if ( isset($_POST['layout_select_meta_box_bg_transparent']) ) {
        update_post_meta( $post_id, 'layout_select_meta_box_bg_transparent', addslashes( $_POST['layout_select_meta_box_bg_transparent'] ) );
	} else {
		delete_post_meta($post_id, 'layout_select_meta_box_bg_transparent');
	}
	
	if ( isset($_POST['page_title_hide']) ) {
        update_post_meta( $post_id, 'page_title_hide', addslashes( $_POST['page_title_hide'] ) );
	} else {
		delete_post_meta($post_id, 'page_title_hide');
	}

}
add_action( 'save_post', 'mulada_layout_select_meta_box_save' );
/*------------- PAGE LAYOUT META BOX END -------------*/

/*------------- AUDIO POST META BOX START -------------*/
function mulada_audio_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_audio_post', esc_html__( 'Audio Post Embed', 'mulada' ), 'mulada_audio_post_meta_box_audio_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'mulada_audio_post_meta_box_add' );

function mulada_audio_post_meta_box_audio_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_audio = get_post_custom( $post->ID );
	$text_audio = isset( $values_audio['audio_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_audio['audio_post_meta_box_text'][0] ) ) :'';
    if( $text_audio == "" ) {
		$text_audio = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'audio_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <textarea name="audio_post_meta_box_text" id="form-input-tip-audio" rows="3" style="width:100%;"><?php echo esc_html( stripcslashes( $text_audio ) ); ?></textarea>
    </p>
	
	<p class="howto"><?php echo esc_html__('Example: <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/90909412&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>', 'mulada'); ?></p>
    <?php    
}

function mulada_audio_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_audio = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['audio_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'audio_post_meta_box_text', addslashes( $_POST['audio_post_meta_box_text'] ) );
         
    if( isset( $_POST['audio_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'audio_post_meta_box_select', addslashes( $_POST['audio_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_audio = isset( $_POST['audio_post_meta_box_check'] ) && $_POST['audio_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'audio_post_meta_box_check', $chk_audio );

}
add_action( 'save_post', 'mulada_audio_post_meta_box_save' );
/*------------- AUDIO POST META BOX END -------------*/

/*------------- LINK POST META BOX START -------------*/
function mulada_link_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_link_post', esc_html__( 'Link Post URL', 'mulada' ), 'mulada_link_post_meta_box_link_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'mulada_link_post_meta_box_add' );

function mulada_link_post_meta_box_link_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_link = get_post_custom( $post->ID );
	$text_link = isset( $values_link['link_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_link['link_post_meta_box_text'][0] ) ) :'';
    if( $text_link == "" ) {
		$text_link = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'link_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input name="link_post_meta_box_text" type="text" class="form-input-tip" id="form-input-tip-link" rows="3" style="width:100%;" value="<?php echo esc_html( stripcslashes( $text_link ) ); ?>">
    </p>
	
	<p class="howto"><?php echo esc_html__('Example: http://gloriatheme.com/', 'mulada'); ?></p>
    <?php    
}

function mulada_link_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_link = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['link_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'link_post_meta_box_text', addslashes( $_POST['link_post_meta_box_text'] ) );
         
    if( isset( $_POST['link_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'link_post_meta_box_select', addslashes( $_POST['link_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_link = isset( $_POST['link_post_meta_box_check'] ) && $_POST['link_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'link_post_meta_box_check', $chk_link );

}
add_action( 'save_post', 'mulada_link_post_meta_box_save' );
/*------------- LINK POST META BOX END -------------*/

/*------------- POST GALLERY START -------------*/
  function mulada_add_gallery_metabox($post_type) {
    $types = array('post', 'page', 'custom-post-type');
    if (in_array($post_type, $types)) {
      add_meta_box(
        'gallery-metabox',
        esc_html__( 'Post Gallery', 'mulada' ),
        'mulada_gallery_meta_callback',
        $post_type,
        'normal',
        'high'
      );
    }
  }
  add_action('add_meta_boxes', 'mulada_add_gallery_metabox');
  function mulada_gallery_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
    ?>
	<table class="form-table">
	  <tr>
		  <td>
			<a class="gallery-add button" href="#" data-uploader-title="<?php echo esc_html__( 'Add image(s) to gallery', 'mulada' ); ?>" data-uploader-button-text="<?php echo esc_html__( 'Add image(s)', 'mulada' ); ?>"><?php echo esc_html__( 'Add image(s)', 'mulada' ); ?></a>
			<ul id="gallery-metabox-list">
			<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
				<li>
					<input type="hidden" name="vdw_gallery_id[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>">
					<img class="image-preview" src="<?php echo esc_attr( $image[0] ); ?>">
					<a class="change-image button button-small" href="#" data-uploader-title="<?php echo esc_html__( 'Change image', 'mulada' ); ?>" data-uploader-button-text="<?php echo esc_html__( 'Change image', 'mulada' ); ?>"><?php echo esc_html__( 'Change image', 'mulada' ); ?></a><br>
					<small><a class="remove-image" href="#"><?php echo esc_html__( 'Remove image', 'mulada' ); ?></a></small>
				</li>
			<?php endforeach; endif; ?>
			</ul>
		  </td>
	  </tr>
	</table>
  <?php }
  function mulada_gallery_meta_save($post_id) {
    if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(isset($_POST['vdw_gallery_id'])) {
      update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
    } else {
      delete_post_meta($post_id, 'vdw_gallery_id');
    }
  }
  add_action('save_post', 'mulada_gallery_meta_save');
  /*------------- POST GALLERY END -------------*/
/*------------- METABOXS END -------------*/