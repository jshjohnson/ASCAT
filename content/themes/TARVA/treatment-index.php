<?php
/*
Template Name: Treatment index
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
				<div class="grid">
					<article class="grid__cell unit-1-2--bp2 island module-1-2 treatment">
						<h3 class="listing-title"><a href="treatment.html">Ankle Fusion</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, ipsam non pariatur facere ullam atque fuga deleniti cupiditate vitae eligendi!</p>
						<a href="">Read more</a>
					</article>
					<article class="grid__cell unit-1-2--bp2 island module-1-2 treatment">
						<h3 class="listing-title"><a href="treatment.html">Ankle Replacement</a></h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus earum corporis ipsam natus omnis deserunt alias reiciendis. Iusto, dignissimos, voluptate.</p>
						<a href="">Read more</a>
					</article>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>