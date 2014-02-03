<?php
/*
Template Name: Centre archive
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
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
			<div class="grid grid--no-gutter">
				<?php 
					while ( have_posts() ) : the_post();				
						$title = get_field('alternative_title');
						if($title == ''):
							$title = get_the_title();
						endif;  
				?>
					<article class="grid__cell bio module module-1-2 hospital">
						<img src="<?php the_field('avatar');?>" alt="">
						<h2 class="listing-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
						<h3 class="listing-subtitle"><?php the_field('telephone'); ?></h3>
						<a class="more-link" href="<?php the_permalink(); ?>">More</a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>