<?php
/*
Template Name: Single committee archive
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

			<?php if(get_field('committee_select') == 9) : ?>

				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
					'post_type' => 'investigator',
					'paged' => $paged,
					'posts_per_page' => 6, 
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'data-monitoring-committee'
					);
					
					$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ): ?>
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
						<article class="grid__cell unit-1-2--bp3">
							<div class="bio island">
								<?php if($url) : ?>
								<img class="bio__avatar" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
								<?php else : ?>
								<img class="bio__avatar" src="http://localhost:8888/TARVA/content/uploads/2014/02/avatar-fallback-256x300.png" alt="Avatar">
								<?php endif; ?>
								<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
								<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
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
						'current' => max( 1, get_query_var('paged') ),
						'prev_text'    => __(''),
						'next_text'    => __(''),
						'total' => $the_query->max_num_pages
					) );
				?>
				</footer>
				<?php endif; ?>

			<?php elseif(get_field('committee_select') == 8) : ?>

				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
					'post_type' => 'investigator',
					'paged' => $paged,
					'posts_per_page' => 6,
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'trial-steering-committee'
					);

					$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ): ?>
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
						<article class="grid__cell unit-1-2--bp3">
							<div class="bio island">
								<?php if($url) : ?>
								<img class="bio__avatar" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
								<?php else : ?>
								<img class="bio__avatar" src="http://localhost:8888/TARVA/content/uploads/2014/02/avatar-fallback-256x300.png" alt="Avatar">
								<?php endif; ?>
								<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
								<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
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
						'current' => max( 1, get_query_var('paged') ),
						'prev_text'    => __(''),
						'next_text'    => __(''),
						'total' => $the_query->max_num_pages
					) );
				?>
				</footer>
				<?php endif; ?>

			<?php elseif(get_field('committee_select') == 7) : ?>

				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
					'post_type' => 'investigator',
					'paged' => $paged,
					'posts_per_page' => 6,
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'trial-management-group'
					);

					$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ): ?>
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
						<article class="grid__cell unit-1-2--bp3">
							<div class="bio island">
								<?php if($url) : ?>
								<img class="bio__avatar" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
								<?php else : ?>
								<img class="bio__avatar" src="http://localhost:8888/TARVA/content/uploads/2014/02/avatar-fallback-256x300.png" alt="Avatar">
								<?php endif; ?>
								<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
								<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
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
						'current' => max( 1, get_query_var('paged') ),
						'prev_text'    => __(''),
						'next_text'    => __(''),
						'total' => $the_query->max_num_pages
					) );
				?>
				</footer>
				<?php endif; endif; ?>
		</div>
<?php get_footer(); ?>