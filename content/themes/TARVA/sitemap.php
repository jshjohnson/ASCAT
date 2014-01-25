<?php
/*
Template Name: Sitemap
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
					// Output each sections from the 'Sitemap' nav menu
					$sitemap_sections = wp_get_nav_menu_items('sitemap');
					if ( $sitemap_sections ) : ?>
					<section class="sitemap">
						<?php foreach ( $sitemap_sections as $page ) : $page_id = $page->object_id ?>
						<article class="sitemap-section">
							<h2 class="sitemap-section-title">
								<?php link_by_id( $page_id ); ?>
							</h2>
							<?php if ( $page_id == page_id_home() ): ?>
							
								<?php $categories = get_categories(); ?>
								<ul class="sitemap-level-1">
									<?php foreach ( $categories as $category ):
									$args = array(
									    'numberposts'     => -1,
									    'category'        => $category->cat_ID,
									    'orderby'         => 'post_date',
									    'order'           => 'DESC'
									); 
									$category_posts = get_posts( $args ); ?>
									<li>
										<a href="/news/category/<?php echo $category->slug; ?>">
											<?php echo $category->name; ?>
										</a>
										<?php if ( $category_posts ) : ?>
										<ul class="sitemap-level-2">
											<?php foreach ( $category_posts as $post) : ?>
											<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
									</li>
									<?php endforeach; ?>
								</ul>
								
							<?php else: ?>
							
								<?php $children = wp_list_pages( 'title_li=&child_of=' . $page_id . '&exclude=' . excluded_pages_string(). '&echo=0');
								if ( $children ): ?>
								<ul class="sitemap-level-1">
								<?php echo $children; ?>
								</ul>
								<?php endif; ?>
								
							<?php endif; ?>
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