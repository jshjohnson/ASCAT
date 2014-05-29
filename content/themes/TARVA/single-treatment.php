<?php get_header(alt); ?>
	<?php if(get_next_post_link()) : ?>
	<div class="nav--page"><?php next_post_link('Next treatment: <strong>%link</strong>'); ?> </div>
	<?php endif; ?>
	<?php if(get_previous_post_link()) : ?>
	<div class="nav--page"><?php previous_post_link('Previous treatment: <strong>%link</strong>'); ?></div>
	<?php endif; ?>
	<div class="content__container content__container--less-marg  container">
		<?php if ( have_posts() ) : ?>
		<article class="content__body">
		<?php global $mwm_aal; echo $mwm_aal->output_content_links(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
			<?php $recommendation = get_field('recommendation'); if($recommendation) : ?>
			<div class="message--highlight message--flipped">
				<h2 class="message__title">Recommendation</h2>
				<?php echo $recommendation; ?>
			</div>
			<?php endif;?>
			<?php disqus_embed('tarva'); ?>
		</article>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>