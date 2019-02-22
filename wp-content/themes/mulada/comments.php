<?php
/*
 * The template for displaying comments part
*/
$post_comment_hide = get_theme_mod( 'hide_post_comment' );
if( !$post_comment_hide == '1' ):
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">
	
		<?php if ( have_comments() ) : ?>
			<div class="post-bottom-element">
				<div class="comment-reply-title"><h2><?php
						printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'mulada' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
					?></h2>
				</div>
				<ol class="comment-list">
				
					<?php
						wp_list_comments( array(
							'style'       => 'ol',
							'short_ping'  => true,
							'avatar_size' => 90,
							'callback' => 'mulada_comment',
						) );
					?>
				
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					
						<nav class="navigation comment-navigation" role="navigation">
							<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment Navigation', 'mulada' ); ?></h1>
							<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'mulada' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'mulada' ) ); ?></div>
						</nav>
						
					<?php endif; ?>

					<?php if ( ! comments_open() && get_comments_number() ) : ?>
					
						<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'mulada' ); ?></p>
					
					<?php endif; ?>
					
				</ol>
			</div>
		<?php endif; ?>

		<div class="post-bottom-element">
		<?php
			$comments_args = array(
				'id_form'           => 'commentform',
				'id_submit'         => 'submit',
				'class_submit'		=> 'btn btn-danger',
				'title_reply_before'    => '<div class="comment-reply-title"><h2>',
				'title_reply_after'    => '</div></h2>',
				'title_reply_to'    => '<div class="comment-title">' . esc_html__('Leave a Reply to', 'mulada') . ' %s' . '</div>',
				'cancel_reply_link' => esc_html__( 'Cancel Reply', 'mulada'),
				'label_submit'      => esc_html__( 'POST COMMENT', 'mulada'),
				'comment_field' =>  '<div class="form-group comments-area-textarea"><textarea class="form-control" placeholder="' . esc_html__('COMMENT', 'mulada') . '' . esc_html__('*', 'mulada') .  '" name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea></div>',

				'comment_notes_before' => '',

				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' =>
						'<div class="row comments-area-row"><div class="col-sm-4 col-xs-12 comments-area-col"><div class="form-group name clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('NAME', 'mulada') . '' . ( $req ?  '' . esc_html__('*', 'mulada') . '' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div></div>',

					'email' =>
						'<div class="col-sm-4 col-xs-12 comments-area-col"><div class="form-group email clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('EMAIL', 'mulada') . '' . ( $req ? '' . esc_html__('*', 'mulada') . '' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div></div>',

					'url' =>
						'<div class="col-sm-4 col-xs-12 comments-area-col"><div class="form-group website clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('WEBSITE URL', 'mulada') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" /></div></div></div>'
					)
				),

			);
			comment_form( $comments_args );
		?>
		</div>
		
	</div>
	
<?php endif; ?>