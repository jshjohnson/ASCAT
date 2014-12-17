					<?php
					global $excluded_pages_string;
					$args = array(
						'order' => 'ASC',
						'orderby' => 'menu_order',
						'exclude' => excluded_pages_string(),
						'numberposts' => 3,
						'post_type' => 'slide'
					);	
					$slides = get_posts( $args );
					if ( $slides ) : ?>
					<article class="slideshow">
						<div class="flexslider">
							<ul class="slides">
								<?php foreach ( $slides as $slide ) : setup_postdata( $slide ); ?>
								<li>
									<?php echo get_the_post_thumbnail( $slide->ID, 'slideshow', array( 'alt' => get_the_title(), 'title' => '' ) ); ?>
									<?php my_the_excerpt( $slide, 'flex-caption' ); ?>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<ul class="slide-controls">
							<?php foreach ( $slides as $slide ) : ?>
							<li>
								<a href="#"><?php echo get_the_title( $slide->ID ); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</article>
					<?php endif; ?>