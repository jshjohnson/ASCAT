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
	<article class="content__body">
		<iframe width="560" height="315" src="//www.youtube.com/embed/VTzOS5dRhm4?&controls=0&showinfo=0&rel=0&vq=hd1080?modestbranding” " frameborder="0" allowfullscreen></iframe>
	</article>	
<?php else : ?>
	<?php get_template_part( 'parts/not-found' ); ?>		
<?php endif; ?>
<?php get_footer(); ?>