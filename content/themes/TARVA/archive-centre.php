<?php
/*
Template Name: Centre archive
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
			<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
				<label for="s"><?php _e('Find a centre'); ?></label>
				<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Search the site" required>
				<input class="submit" name="submit" type="submit" value='Search'>	
			</form>    
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="content__body">
				<?php the_content(); ?>	
			</article>
			<?php endwhile; ?>	
			<?php endif; ?>
			<?php
				$args = array(
				'post_type' => 'centre',
				'orderby' => 'title',
				'order' => 'ASC'
				);
			query_posts($args); 

			if ( have_posts() ): ?>
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
						<div class="bio hospital island">
							<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
							<h2 class="listing-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('telephone'); ?></h3>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>