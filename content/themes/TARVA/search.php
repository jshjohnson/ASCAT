<?php get_header(); ?>
		<div class="content__container container">
			<article class="content__body">		
					<?php if ( have_posts() ) : ?>                
						<h2>You searched for &lsquo;<b><?php echo get_search_query(); ?></b>&rsquo;</h2>
						<?php get_template_part( 'parts/search-form' ); ?>	
						<h2>Results:</h2>
			</article> 
			<article>
				<div class="grid">
				<?php 
					while ( have_posts() ) : the_post();	

						$image = get_field('avatar');
						$url = $image['sizes']['medium'];
					    $alt = $image['alt'];			
						$title = get_field('alternative_title');
						if($title == ''):
							$title = get_the_title();
						endif;  
				?>
					<article class="grid__cell unit-1-2--bp2">
						<div class="bio island">
							<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
							<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
							<p><?php the_field('bio'); ?></p>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
						</div>
					</article>
				<?php endwhile; ?>
				</div>
				<?php else : ?>
					<h1>Sorry, that page could not be found</h1>
					<p>This may be because the page has moved, the page no longer exists or there is a typing error in the URL. Try using the a different search term:</p><br>
					<?php get_template_part( 'parts/search-form' ); ?>			 
				<?php endif; ?> 
			</article>           
        </div>
<?php get_footer(); ?>