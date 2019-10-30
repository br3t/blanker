<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die (__('Please do not load this page directly. Thanks!'));
}
if (post_password_required()) {
	echo '<p class="alert">'. __('This post is password protected. Enter the password to view comments.') .'</p>';
	return;
}
if (have_comments()) { ?>
<div class="entry-comments">
	<h2 id="comments"><?php comments_number('No comments', '1 comment', '% comments');?></h2>
	
	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>
	
	<ol class="commentlist">
		<?php wp_list_comments(array(
			'callback' => 'comments_callback'
		)); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link(); ?></div>
		<div class="prev-posts"><?php next_comments_link(); ?></div>
	</div>
	
 <?php 
	} else { // this is displayed if there are no comments so far
		if (comments_open()) {
			print('<!-- Comments are open, but there are no comments. -->');
		} else {
			// comments are closed
			print('<p>'.__('Comments are closed').'.</p>');
		}
	}
	if (comments_open()) { ?>
	
	<div id="respond">
		<?php comment_form(); ?>
	</div>

</div>
<?php } ?>