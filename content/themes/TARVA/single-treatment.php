<?php get_header(); ?>
	<div class="content__bg">
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<article class="grid__cell">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</article>
			<div class="grid__cell unit-1-1--bp2 unit-2-3--bp3">
				<div class="divider"></div>
				<?php disqus_embed('tarva'); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>