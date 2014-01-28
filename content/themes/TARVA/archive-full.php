<?php
/*
Template Name: Full Archive
*/
?>
<?php get_header(); ?>
		<div class="content__bg">
			<div class="content__container container">		
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>	
				<?php endwhile; ?>
				
					<?php
					// Outut all posts in a basic list
					$all_posts = get_posts( 'numberposts=-1&orderby=date' );
					if($all_posts): ?>
					<section class="archive">
						<?php foreach( $all_posts as $post ) : ?>
						<article class="entry archive-entry">
							<header class="blog-header">
								<h5 class="blog-header__date">06/01/2014</h5>
								<h2 class="blog-header__title"><a href="">News Item</a></h2>
							</header>
							<p><a href="">Ankle osteoarthritis</a> (OA) occurs when the cartilage lining the joints has become worn, causing pain and stiffness and major disability with a similar impact on quality of life as hip OA and congestive heart failure. The majority of ankle OA follows trauma or injury, although inflammation (such as <a href="">rheumatoid arthritis</a>) can also be a cause. Over 29,000 cases of symptomatic ankle OA are referred to specialist foot and ankle surgeons each year in the UK...</p>	
						</article>
						<?php endforeach; ?>
					</section>
					<?php endif; ?>
				
				<?php else : ?>
<?php get_template_part( 'parts/not-found' ); ?>		
				<?php endif; ?>
			</div>
		</div>
<?php get_sidebar('blog'); ?> 
<?php get_footer(); ?>