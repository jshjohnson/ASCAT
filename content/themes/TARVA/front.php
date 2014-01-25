<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
			<div class="content" role="main">
				<?php if ( have_posts() ) : ?>
<?php get_template_part( 'parts/slideshow'); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
				<!-- -->
				<?php else : ?>
<?php get_template_part( 'parts/page-not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_footer(); ?>