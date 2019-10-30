<?php

//* force show 404
function force_404() {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );exit();
}
// Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
    wp_dequeue_style( 'wp-block-library' ); // Wordpress core
    wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce
    wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}



add_action( 'widgets_init', 'register_aside' );
function register_aside(){
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => "sidebar",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<div class="widgettitle">',
		'after_title'   => "</div>\n",
	) );
}

// comments callback
function comments_callback($comment, $args, $depth){
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div itemscope itemtype="https://schema.org/Comment">
			<div class="comment-author vcard">
				<?php // echo get_avatar( $comment, $size='48', $default='identicon' ); ?>
				<cite class="fn" itemprop="author" itemscope itemtype="https://schema.org/Person">
					<span itemprop="name"><?php echo get_comment_author(); ?></span>
				</cite>
				<div class="comment-meta commentmetadata">
					<span itemprop="datePublished" content="<?php print(get_comment_date()); ?>"></span>
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time()) ?></a>
					<?php edit_comment_link(__('Edit'), '  ', '') ?>
				</div>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is waiting for approvement.'); ?></em>
				<br />
			<?php endif; ?>


			<div itemprop="text"><?php comment_text() ?></div>

			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
<?php
}