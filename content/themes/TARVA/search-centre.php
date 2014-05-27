<?php
/*
Template Name: Search Centres
*/
?>
<?php get_header(map); ?>
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="content__body">
				<?php the_content(); ?>	
			</article>
			<?php endwhile; ?>	
			<?php endif; ?>
		</div>
<?php get_footer(); ?>