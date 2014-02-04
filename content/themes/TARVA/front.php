<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
		<div class="header-video"><iframe width="560" height="315" src="//www.youtube.com/embed/qas5lWp7_R0?&controls=0&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div>
			<div class="container">
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_footer(); ?>