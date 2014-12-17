<?php
/*
Template Name: Committees Archive
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
	

			<?php 
			$myterms = get_terms('committee_types', 'orderby=none&hide_empty');  

			if($myterms) : ?>
			<div class="grid"> 
			<?php foreach ($myterms as $term) { ?>
		    <div class="grid__cell unit-1-3--bp2 block-link module-1-3"><h5><a href="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></h5></div>
		    <?php } ?>
		    </div> 
			<?php endif; ?>
	
	
		</div>
<?php get_footer(); ?>