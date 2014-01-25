<?php
/*
Template Name: Section Index
*/
?>
<?php get_header(); ?>
			<div class="content" role="main">
<?php get_template_part( 'parts/breadcrumb' ); ?>		
				<?php if ( have_posts() ) : ?>
<?php get_template_part( 'parts/page-title' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				
					<?php
					// Output sub pages of current page
					$sub_pages = get_sub_pages($post->ID);
					if ( $sub_pages ): ?>
					<section class="index">
						<?php foreach ( $sub_pages as $page ) : ?>
						<article class="entry">
							<div class="entry-body media cf">
								<?php if( has_post_thumbnail( $page->ID ) ) : ?>
								<div class="media-img">
									<?php my_the_post_thumbnail( $page->ID, 'index-thumb' ); ?>
								</div>
								<?php endif; ?>
								<div class="media-body">
									<h2 class="entry-title">
										<a href="<?php echo get_permalink( $page->ID ); ?>"><?php echo $page->post_title; ?></a>
									</h2>
									<?php my_the_excerpt( $page, 'entry-excerpt' ); ?>
								</div>
							</div>
						</article>
						<?php endforeach; ?>
					</section>
					<?php endif; ?>
				
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>