<?php 
get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
?>
		<h1><?php single_cat_title(); ?></h1>
		<article>
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
		</article>
<?php endwhile;
else: ?>
	<h2><?php _e('Nothing Found'); ?></h2>

<?php endif;

get_sidebar();
get_footer();
?>