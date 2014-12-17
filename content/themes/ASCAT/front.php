<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>	
<?php if ( have_posts() ) : ?>
	<section class="intro">
		<header class="intro__header cf">
			<a href="#nav" class="nav-toggle nav-toggle--open icon--menu" id="nav-open-btn"></a>
			<a href="<?php echo home_url(); ?>" class="intro__logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ascat-inverse.svg" alt="" class="logo"></a>
			<nav class="nav-container nav-container--home intro__nav" id="nav" role="navigation">
				<a href="#nav" class="nav-toggle nav-toggle--close icon--cancel icon--push-right" id="nav-close-btn">Close</a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="nav nav--home">%3$s</ul>' ) ); ?>
			</nav>
		</header>
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="grid intro__body">
				<article class="grid__cell unit-2-3--bp3">
					<?php the_content(); ?>
					<a href="https://www.youtube.com/watch?v=VTzOS5dRhm4&vq=hd720" class="btn btn--inverse fancybox-media">See the video</a>
					<a href="https://twitter.com/TARVA_Trial" class="btn btn--inverse fancybox-media"> <span class="icon icon--twitter icon--push-right"></span>Find us on Twitter</a>
				</article>
			</div>
			<?php endwhile; ?>
		</div>
	</section>
<?php else : ?>
	<?php get_template_part( 'parts/not-found' ); ?>		
<?php endif; ?>
<?php get_footer(); ?>