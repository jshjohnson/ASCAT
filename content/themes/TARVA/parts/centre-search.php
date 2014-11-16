<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array( 
		'post_type' => 'centre', 
		'paged' => $paged,
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => 6, //Limits the amount of posts on each page
		'post_title' => 'LIKE %'.$_POST['s'].'%' 
	);
	$loop = new WP_Query( $args ); 

	get_header(search); ?>
		<div class="content__container container">
			<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
				<label for="s"><?php _e('Find a centre'); ?></label>
				<input type="hidden" name="post_type" value="centre" />
				<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Search the site" required>
				<input class="submit" name="submit" type="submit" value='Search'>	
			</form> 
			<?php if ( $loop->have_posts() ) : ?>    
			<article class="content__body">
				<h2>Search Result for <?php echo "\"$s\"" ?></h2>
			</article> 
			<article>
				<div class="grid">
				<?php 
					while ( $loop->have_posts() ) : $loop->the_post();	

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
				<?php else : ?>
				<h2>Sorry, your search found no results</h2>
				<p>This may be because the page has moved, the page no longer exists or there is a typing error in the URL. Try using the a different search term:</p>	 
			</article>  
			<?php endif; ?>          
        </div>
<?php get_footer(); ?>