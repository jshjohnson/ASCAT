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
					'posts_per_page' => -1,
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
			    		$ul .= '<li class="block-letters__single"><a class="is-active" href="?letter=' . $letter . '">' . $letter . '</a></li>';
			    	}else {
			    		$ul .= '<li class="block-letters__single"><a href="?letter=' . $letter . '">' . $letter . '</a></li>';
			    	}  
			    }
			    $ul .= '</ul>';

			    echo '<div id="glossary">' . $ul . '</div>';
			?>

			<div class="heading-divide">
				<h1 class="heading-divide__title"><?php echo $firstLetter; ?></h1>
			</div>

			<?php
			    $args = array(
			        'post_type' => 'investigator',
			        'orderby' => 'title',
			        'order' => 'ASC',
					'paged' => $paged,
					'posts_per_page' => -1,
					'tax_query' => array(
							array(
								'taxonomy' => 'letters',
								'field' => 'name',
								'terms' => $firstLetter,
							)
					),
			    );

			    $query = new WP_Query($args);
				
				if ( $query->have_posts() ): ?>
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
				<?php include("parts/user-bio.php"); ?>
			<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
<?php get_footer(); ?>