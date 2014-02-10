<?php
/*
Template Name: Single committee archive
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<?php 
			while ( have_posts() ) : the_post(); ?>

			<article class="content__body">
				<?php the_content(); ?>	
			</article>
			<?php endwhile; ?>	
			<?php endif; ?>

			<?php if(get_field('committee_select') == 9) : ?>

				<?php
					$args = array(
					'post_type' => 'investigator',
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'data-monitoring-committee'
					);
				query_posts($args); 

				if ( have_posts() ): ?>
				<div class="grid">
					<?php 
						while ( have_posts() ) : the_post();	

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
				<?php endif; ?>

			<?php elseif(get_field('committee_select') == 8) : ?>

				<?php
					$args = array(
					'post_type' => 'investigator',
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'trial-steering-committee'
					);
				query_posts($args); 

				if ( have_posts() ): ?>
				<div class="grid">
					<?php 
						while ( have_posts() ) : the_post();				
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
				<?php endif; ?>

			<?php elseif(get_field('committee_select') == 7) : ?>
				<?php
					$args = array(
					'post_type' => 'investigator',
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'trial-management-group'
					);
				query_posts($args); 

				if ( have_posts() ): ?>
				<div class="grid">
					<?php 
						while ( have_posts() ) : the_post();				
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
				<?php endif; ?>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>