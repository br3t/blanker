<?php 
get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
?>
		<article>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">			
				<?php the_content(); ?>
			</div>
			<?php comments_template(); ?>
		</article>
<?php endwhile;
else: ?>
	<h2><?php _e('Nothing Found'); ?></h2>

<?php endif;

get_sidebar();
get_footer();
?>