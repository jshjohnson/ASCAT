<?php
/*
Template Name: Resources
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
			<article>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>	
			<?php endwhile; ?>	
			<?php endif; ?>
			</article>
			<div class="grid">
				<article class="grid__cell unit-1-2--bp3">
					<h3>Core Trial Materials</h3>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Investigators Brochure</a><div class="ribbon"><h5>New</h5></div></div>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Protocol</a></div>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Ethics Approval</a></div>
				</article>
				<article class="grid__cell unit-1-2--bp3">
					<h3>Additional Materials</h3>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Image</a> </div>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Image</a> </div>
					<div class="download"><a href="/wp-content/wp-uploads/pdf.pdf">Image</a> </div>
				</article>
			</div>
		</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>