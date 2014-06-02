<?php
/*
Template Name: Single Committee Archive
*/
?>
<?php get_header('alt'); ?>
	<p class="nav nav--page">
	<?php if(function_exists('bcn_display')) {
        bcn_display();
    }?>
    </p>
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="content__body">
				<?php the_content(); ?>	
			</article>
			<?php endwhile; ?>	
			<?php endif; ?>
			<h4>Investigators:</h4>
			<hr>
			<?php if(get_field('committee_select') == 9) : ?>

				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
						'paged' => $paged,
						'posts_per_page' => 10, 
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
					<?php include("parts/user-bio.php"); ?>
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
					'paged' => $paged,
					'posts_per_page' => 10,
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
						<?php include("parts/user-bio.php"); ?>
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
					'paged' => $paged,
					'posts_per_page' => 10,
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
					<?php include("parts/user-bio.php"); ?>
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