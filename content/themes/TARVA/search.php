<?php get_header(); ?>
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>     
			<article class="content__body">
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
				<h1>Sorry, your search found no results</h1>
				<p>This may be because the page has moved, the page no longer exists or there is a typing error in the URL. Try using the a different search term:</p>
				<?php get_template_part( 'parts/search-form' ); ?>			 
			</article>  
			<?php endif; ?>          
        </div>
<?php get_footer(); ?>