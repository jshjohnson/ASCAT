<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array( 
		'post_type' => 'investigator', 
		'paged' => $paged,
		'posts_per_page' => 6, //Limits the amount of posts on each page
		'post_title' => 'LIKE %'.$_POST['s'].'%',
		'meta_query' => array(
				array(
					'key' => 'specialist',
					'value' => true,
				),
			),
		);
	$loop = new WP_Query( $args ); 
	get_header(search); ?>
		<div class="content__container container">
			<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
				<label for="s"><?php _e('Find a specialist'); ?></label>
				<input type="hidden" name="post_type" value="investigator" />
				<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Search the site" required>
				<input class="submit" name="submit" type="submit" value='Search'>	
			</form>  
			<?php if ( $loop->have_posts() ) : ?>   
			<article class="content__body">
				<h2>
					Search Result for <?php echo "\"$s\"" ?>
				</h2>
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
					<article class="grid__cell unit-1-2--bp2">
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
				<?php else : ?>
				<h2>Sorry, your search "<?php _e($s); ?>" found no results</h2>
				<p>This may be because the page has moved, the page no longer exists or there is a typing error in the URL. Try using the a different search term:</p>	 
			</article>  
			<?php endif; ?>          
        </div>
<?php get_footer(); ?>