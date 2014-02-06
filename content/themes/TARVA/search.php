<?php get_header(); ?>
		<div class="content__container container">
			<article class="content__body">		
					<?php if ( have_posts() ) : ?>                
						<h2>You searched for &lsquo;<b><?php echo get_search_query(); ?></b>&rsquo;</h2>
						<?php get_template_part( 'parts/search-form' ); ?>	
						<h2>Results:</h2>
					<?php while ( have_posts() ) : the_post() ?>
						<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); the_field('bio') ?>
					<?php endwhile; ?>
					<?php else : ?>
		 

						<h1>Sorry, that page could not be found</h1>
						<p>This may be because the page has moved, the page no longer exists or there is a typing error in the URL. Try using the a different search term:</p><br>
						<?php get_template_part( 'parts/search-form' ); ?>	
					 
					<?php endif; ?>           
            </article>  
        </div>
<?php get_footer(); ?>