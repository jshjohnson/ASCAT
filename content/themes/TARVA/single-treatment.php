<?php get_header(); ?>
	<?php if(get_next_post()) : ?>
	<div class="credit zero-top right"><?php next_post(); ?></div>
	<?php endif; ?>
	<?php if(get_previous_post()) : ?>
	<div class="credit zero-top left"><?php previous_post(); ?></div>
	<?php endif; ?>
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