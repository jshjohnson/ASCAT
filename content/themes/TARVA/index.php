<?php get_header(); ?>
		<div class="content__container container">		
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="content__body">
				<?php the_content(); ?>
			</article>	
			<?php endwhile; ?>
			<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
			<?php endif; ?>
		</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>