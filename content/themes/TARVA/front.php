<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
		
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
				<div class="header-video">
					<iframe width="560" height="315" src="//www.youtube.com/embed/qas5lWp7_R0?&controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
				</div>
				<section class="intro">
					<div class="container">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
					</div>
				</section>
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
<?php get_footer(); ?>