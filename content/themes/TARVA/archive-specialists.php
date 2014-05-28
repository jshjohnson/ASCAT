<?php
/*
Template Name: Search Specialists
*/
?>
<?php get_header(); ?>
		<div class="content__container container">
			<?php
			    $args = array(
			        'post_type' => 'investigator',
			        'orderby' => 'title',
			        'order' => 'ASC',
					'paged' => $paged,
					'posts_per_page' => -1, //Limits the amount of posts on each page
					'meta_query' => array(
								array(
									'key' => 'specialist',
									'value' => true,
								),
							),
					'tax_query' => array(
							array(
								'taxonomy' => 'letters',
								'field' => 'name',
								'terms' => $firstLetter,
							)
					),
			    );

			    $query = new WP_Query($args);

				if(isset($_GET['letter'])) {
					$firstLetter = $_GET['letter'];			
				}else{
					$firstLetter = "A";
				}

			    $dl = '';
			    $glossary_letter = '';
			    $active_letters = array();

			    while ( $query->have_posts() ) {
			        $query->next_post();
			        $term_letter = strtoupper( substr( $query->post->post_title, 0, 1 ) );
			        if ( $glossary_letter != $term_letter ) {
			            $dl .= (count( $active_letters ) ? '</dl>' : '') . '<li id="' . $term_letter . '"><span class="subheading">' . $term_letter . '</span><dl>';
			            $glossary_letter = $term_letter;
			            $active_letters[] = $term_letter;
			        }
			        $dl .= '<dt><a href="' . get_permalink($query->post->ID) . '">' . $query->post->post_title . '</a></dt>';
			        $dl .= '<dd>' . $query->post->post_content . '</dd>';
			    }
			    $dl .= '</dl></li>';

			    $ul = '<ul class="block-letters">';
			    foreach ( array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ) as $letter ) {
			    	if($letter == $firstLetter) {
			    		$ul .= '<li><a class="is-active" href="?letter=' . $letter . '">' . $letter . '</a></li>';
			    	}else {
			    		$ul .= '<li><a href="?letter=' . $letter . '">' . $letter . '</a></li>';
			    	}  
			    }
			    $ul .= '</ul>';

			    // echo '<div id="glossary">' . $ul . '<ul class="definitions">' . $dl . '</ul></div>';
			    echo '<div id="glossary">' . $ul . '</div>';
			    wp_reset_query();
			?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="content__body">
				<?php the_content(); ?>
			</article>	
			<?php endwhile; ?>
			<?php endif; ?>
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					'post_type' => 'investigator',
					'orderby' => 'title',
					'order' => 'ASC',
					'paged' => $paged,
					'posts_per_page' => -1, //Limits the amount of posts on each page
					'meta_query' => array(
								array(
									'key' => 'specialist',
									'value' => true,
								),
							),
					'tax_query' => array(
							array(
								'taxonomy' => 'letters',
								'field' => 'name',
								'terms' => $firstLetter,
							)
					),
				);
				
				$query = new WP_Query($args);
			?>
				<div class="heading-divide">
					<h1 class="heading-divide__title"><?php echo $firstLetter; ?></h1>
				</div>
				<?php if ( $query->have_posts() ): ?>
				<div class="grid">
					<?php 
						while ( $query->have_posts() ) : $query->the_post();	

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
								<img class="bio__avatar" src="<?php echo home_url(); ?>/content/uploads/2014/02/avatar-fallback-256x300.png" alt="Avatar">
								<?php endif; ?>
								<h2 class="listing-title listing-title--bio"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h2>
								<h3 class="listing-subtitle"><?php the_field('job_title'); ?></h3>
								<a class="more-link" href="<?php the_permalink(); ?>">More</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
		</div>
<?php get_footer(); ?>