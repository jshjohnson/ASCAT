<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>	
<?php if ( have_posts() ) : ?>
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