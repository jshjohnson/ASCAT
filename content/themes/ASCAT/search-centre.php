<?php
/*
Template Name: Search Centres
*/
?>
<?php get_header('no-feature'); ?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>	
			<?php endwhile; ?>	
			<?php endif; ?>
<?php get_footer(); ?>