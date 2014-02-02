<?php
/*
Template Name: Resources index
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<?php the_content(); ?>	
			</article>
			<?php endwhile; ?>	
			<?php endif; ?>
			<?php 
				$args = array(
					'post_type' => 'resource',
					'orderby' => 'title',
					'order' => 'ASC',
				);
				query_posts($args);

				if ( have_posts() ): ?>
			<div class="grid">
				<article class="grid__cell unit-1-2--bp3">
					<h3>Core Trial Materials</h3>
					<?php
						$args = array(
							'post_type' => 'resource',
							'tax_query' => array(
								array(
									'taxonomy' => 'resource_type',
									'field' => 'slug',
									'terms' => 'core-trial-materials'
								)
							)
						);
						query_posts($args);

					 	while ( have_posts() ) : the_post(); ?>
					<div class="download"><a href="<?php the_field('resource_upload'); ?>"><?php the_title(); ?></a></div>
					<?php endwhile; ?>
				</article>
				<article class="grid__cell unit-1-2--bp3">
					<h3>Additional Materials</h3>
					<?php 
						$args = array(
							'post_type' => 'resource',
							'tax_query' => array(
								array(
									'taxonomy' => 'resource_type',
									'field' => 'slug',
									'terms' => 'additional-materials'
								)
							)
						);
						query_posts($args);

						while ( have_posts() ) : the_post(); ?>
					<div class="download"><a href="<?php the_field('resource_upload'); ?>"><?php the_title(); ?></a></div>
					<?php endwhile; ?>
				</article>
			</div>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>