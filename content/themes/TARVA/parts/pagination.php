			<?php if ( show_posts_nav() ) : ?>
				<nav class="pagination">
				<?php if ( function_exists( 'wp_page_numbers' ) ) : ?>
				<?php wp_page_numbers(); ?>
				<?php else: ?>
					<?php next_posts_link( '<span class="older">&laquo; Older posts</span>' ) ?>
					<?php previous_posts_link( '<span class="newer">Newer posts &raquo;</span>' ) ?>
				<?php endif; ?>
				</nav>
			<?php endif; ?>
