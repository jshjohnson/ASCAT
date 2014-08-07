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
				<article class="grid__cell unit-1-2--bp2 content-block">
					<h2 class="content-block__heading content-block__heading--small"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
						<?php if(get_field('panel_image')) { ?>
						<div class="content-block__img" style="background-image: url('<?php $panel = get_field('panel_image'); echo $panel['sizes']['panel-thumb']; ?>');">
						</div>
						<?php }; ?>
					<div class="content-block__text">
						<?php the_excerpt(); ?>
						<a class="more-link" href="<?php the_permalink(); ?>">More Info</a>
					</div>
				</article>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>

<?php get_footer(); ?>