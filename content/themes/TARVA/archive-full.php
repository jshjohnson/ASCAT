<?php
/*
Template Name: Full Archive
*/
?>
<?php get_header(); ?>
		<div class="content__container container">		
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>	
			<?php endwhile; ?>
			
				<?php
				// Outut all posts in a basic list
				$all_posts = get_posts( 'numberposts=-1&orderby=date' );
				if($all_posts): ?>
				<section class="archive">
					<?php foreach( $all_posts as $post ) : ?>
					<?php setup_postdata($post); ?>
					<article class="entry archive-entry">
						<header class="blog-header">
							<h5 class="blog-header__date"><?php the_time( 'jS F Y' ); ?></h5>
							<h2 class="blog-header__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<p class="blog__category"><?php the_category( ', ' ); ?></p>
						<p><?php the_excerpt(); ?></p>
					</article>
					<?php endforeach; ?>
				</section>
				<?php endif; ?>
			
			<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
			<?php endif; ?>
		</div>
<?php get_footer(); ?>