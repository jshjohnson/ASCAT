<?php get_header(); ?>
		<header class="content__header header--home">
			<div class="container">
				<h1 class="page-heading"><?php get_template_part( 'parts/page-title' ); ?></h1>
			</div>
		</header>
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