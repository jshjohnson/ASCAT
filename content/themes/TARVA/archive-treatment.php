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
				<article class="grid__cell unit-1-2--bp3 content-block">
					<h2 class="content-block__heading content-block__heading--small"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
						<?php if(has_post_thumbnail()) { ?>
						<div class="img-wrapper" style="background-image: url('<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'panel-thumb', false, ''); echo $src[0]; ?>');">
						</div>
						<?php } else { ?>
						<div class="img-wrapper">
						</div>
						<?php }; ?>
					<div class="content-block__text">
						<?php the_excerpt(); ?>
						<a href="<?php echo get_permalink(); ?>">More info</a>
					</div>
				</article>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>

<?php get_footer(); ?>