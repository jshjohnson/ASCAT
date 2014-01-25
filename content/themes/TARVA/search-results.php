<?php
/*
Template Name: Search Results
*/
?>
<?php get_header(); ?>
			<div class="content" role="main">
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
<?php get_template_part( 'parts/page-title' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
					<p class="intro query">You searched for &lsquo;<b><?php echo $_REQUEST['for']; ?></b>&rsquo;</p>
					<!-- Place Google CSE code here with query parameter set to "for" -->
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>