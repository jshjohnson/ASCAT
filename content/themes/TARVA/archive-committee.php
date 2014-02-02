<?php
/*
Template Name: Trial Oversight
*/
?>
<?php get_header(); ?>
		<div class="content__bg">
			<div class="content__container container">
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<article>
					<?php the_content(); ?>	
				</article>
				<?php endwhile; ?>	
				<?php endif; ?>
				<?php
					$args = array(
					'post_type' => 'committee',
					'orderby' => 'title',
					'order' => 'ASC'
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
							<h2 class="bio__title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
							<h3 class="bio__subtitle">Independent Chair</h3>
							<p>Professor Rangan is a Consultant Orthopaedic Surgeon at South Tees Hospital NHS Foundation Trust, and an expert in Shoulder &amp; Elbow Surgery. He is the Chief Investigator of the ProFHER Trial (PROximal Fractures of The Humerus: Evaluation by Randomisation).  He is a Member of the British Elbow and Shoulder Society; an Honorary Lecturer at the University of Teesside; and a Member of the Court of Examiners, Royal College of Surgeons of England.</p>
							<a class="more-link" href="<?php the_permalink(); ?>">More</a>
						</article>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</div>
<?php get_footer(); ?>