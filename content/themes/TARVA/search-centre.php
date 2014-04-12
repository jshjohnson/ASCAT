<?php
/*
Template Name: Search Centres
*/
?>
<?php get_header(map); ?>
		<div class="content__container container">
			<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
				<label for="s"><?php _e('Find a centre'); ?></label>
				<input type="hidden" name="post_type" value="centre" />
				<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Find a centre" required>
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
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

				$args = array(
					'post_type' => 'centre',
					'orderby' => 'title',
					'order' => 'ASC',
					'paged' => $paged, //Pulls the paged function into the query
					'posts_per_page' => 10, //Limits the amount of posts on each page
				);

			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ): ?>
			<h3>Centre archive</h3>
			<div class="grid">
				<?php 
					while ( $the_query->have_posts() ) : $the_query->the_post();
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
							<h2 class="listing-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('location'); ?></h3>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<footer class="pagination">
			<?php
				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'prev_text'    => __(''),
					'next_text'    => __(''),
					'current' => max( 1, get_query_var('paged') ),
					'total' => $the_query->max_num_pages
				) );
			?>
			<?php endif; ?>
			</footer>
		</div>
<?php get_footer(); ?>