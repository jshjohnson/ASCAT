<?php get_header(); ?>
		<div class="content__container container">		
			<?php if ( have_posts() ) : ?>			
				<?php
				// Outut all posts in a basic list
				$all_posts = get_posts( 'numberposts=-1&orderby=date' );
				if($all_posts): ?>
				<section class="archive">
					<?php foreach( $all_posts as $post ) : ?>
					<?php setup_postdata($post); ?>
					<article class="entry archive-entry">
						<header class="blog-header">
							<h2 class="blog-header__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<h5 class="blog-header__date blog-header__date--desktop"><?php the_time( 'jS F Y' ); ?></h5>
							<h5 class="blog-header__date blog-header__date--mobile"><?php the_time( 'd/m/Y' ); ?></h5>
						</header>
						<p class="blog__category"><?php the_category( ', ' ); ?></p>
						<p><?php the_excerpt(); ?></p>
						<a class="more-link" href="<?php the_permalink(); ?>">Read more</a>
					</article>
					<?php endforeach; ?>
				</section>
				<?php endif; ?>
			
			<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
			<?php endif; ?>
		</div>
<?php get_footer(); ?>