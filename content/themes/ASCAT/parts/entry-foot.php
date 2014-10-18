					<footer class="entry-foot">
						<?php echo get_the_tag_list( '<p class="entry-meta entry-tags">Tagged with: ',', ','</p>' ); ?>
					</footer>

					<?php if ( is_singular( 'post' ) ) : ?>
					<?php simple_social_sharing( twitter_username() ); ?>
					<?php comments_template( '', true ); ?>
					<?php endif; ?>