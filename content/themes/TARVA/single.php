<?php get_header('blog'); ?>
		<div class="content__container container">		
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<header class="blog-header">
				<h2 class="blog-header__title"><span class="blog-header__date"><?php the_time( 'm/y' ); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<article class="content__body push-top">
				<?php the_content(); ?>
				<?php disqus_embed('tarva'); ?>
			</article>	
			<?php endwhile; ?>
			<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
			<?php endif; ?>
		</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>

