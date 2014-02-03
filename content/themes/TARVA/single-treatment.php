<?php get_header(); ?>
	<?php if(get_next_post_link()) : ?>
	<div class="nav--page right"><?php next_post_link('Next treatment: <strong>%link</strong>'); ?> </div>
	<?php endif; ?>
	<?php if(get_previous_post_link()) : ?>
	<div class="nav--page left"><?php previous_post_link('Previous treatment: <strong>%link</strong>'); ?></div>
	<?php endif; ?>
	<div class="content__container content__container--less-marg container">
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