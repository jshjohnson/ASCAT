<?php get_header(); ?>
			<div class="content" role="main">
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
				<section class="loop">
				<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'parts/loop' ); ?>
				<?php endwhile; ?>
				</section>
<?php get_template_part( 'parts/pagination' ); ?>
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_sidebar( 'blog' ); ?> 
<?php get_footer(); ?>