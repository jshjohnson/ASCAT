					<header class="entry-head">
						<?php if ( is_singular( 'post' ) ) : ?>
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1>
						<?php else: ?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						<?php endif; ?>
						<p class="entry-meta entry-data">Posted on <time datetime="<?php echo the_time( 'c' ); ?>" pubdate><?php the_time( 'jS F Y' ); ?></time> in <?php the_category( ', ' ); ?></p>
					</header>
