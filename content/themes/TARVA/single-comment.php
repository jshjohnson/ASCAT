<?php
/*
Template Name: Comments
*/
?>
<?php get_header(); ?>
	<div class="content__container container">
		<?php if ( have_posts() ) : ?>
		<article class="content__body">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			<?php disqus_embed('tarva'); ?>
		</article>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>