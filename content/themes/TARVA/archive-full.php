<?php
/*
Template Name: Full Archive
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
				
					<?php
					// Outut all posts in a basic list
					$all_posts = get_posts( 'numberposts=-1&orderby=date' );
					if($all_posts): ?>
					<section class="archive">
						<?php foreach( $all_posts as $post ) : ?>
						<article class="entry archive-entry">
<?php get_template_part( 'parts/entry-head' ); ?>		
						</article>
						<?php endforeach; ?>
					</section>
					<?php endif; ?>
				
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_sidebar('blog'); ?> 
<?php get_footer(); ?>