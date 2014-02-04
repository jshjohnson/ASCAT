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
					$args = array(
					'post_type' => 'investigator',
					'orderby' => 'title',
					'order' => 'ASC',
					'committee_types' => 'data-monitoring-committee'
					);
				query_posts($args); 

				if ( have_posts() ): ?>
				<div class="grid grid--no-gutter">
					<?php 
						while ( have_posts() ) : the_post();				
							$title = get_field('alternative_title');
							if($title == ''):
								$title = get_the_title();
							endif;  
					?>
						<article class="grid__cell bio module module-1-2">
							<img src="<?php the_field('avatar');?>" alt="">
							<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
							<p><?php the_field('bio'); ?></p>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
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
				<div class="grid grid--no-gutter">
					<?php 
						while ( have_posts() ) : the_post();				
							$title = get_field('alternative_title');
							if($title == ''):
								$title = get_the_title();
							endif;  
					?>
						<article class="grid__cell bio module module-1-2">
							<img src="<?php the_field('avatar');?>" alt="">
							<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
							<p><?php the_field('bio'); ?></p>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
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
				<div class="grid grid--no-gutter">
					<?php 
						while ( have_posts() ) : the_post();				
							$title = get_field('alternative_title');
							if($title == ''):
								$title = get_the_title();
							endif;  
					?>
						<article class="grid__cell bio module module-1-2">
							<img src="<?php the_field('avatar');?>" alt="">
							<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="listing-subtitle"><?php the_field('job_role'); ?></h3>
							<p><?php the_field('bio'); ?></p>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
						</article>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>