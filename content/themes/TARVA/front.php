<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
		<div id="movie-area" class="header-video"></div>
		<div class="content__bg">
			<div class="content__container container">
				<article>
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
				</article>
			</div>
		</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>