<?php
/*
Template Name: Treatment Archive
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
					'post_type' => 'treatment',
					'orderby' => 'title',
					'order' => 'ASC'
					);
				query_posts($args); 

				if ( have_posts() ): ?>
			<div class="grid">
				<?php while ( have_posts() ) : the_post();	 ?>
				<article class="grid__cell unit-1-2--bp2">
					<div class="island info">
						<h3 class="listing-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php the_excerpt(); ?></p>
						<a class="more-link" href="<?php the_permalink(); ?>">Read more</a>
					</div>
				</article>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>