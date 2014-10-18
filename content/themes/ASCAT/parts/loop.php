				<article class="entry<?php echo is_sticky() ? ' sticky"' : '' ?>">
<?php get_template_part( 'parts/entry-head' ); ?>
					<div class="entry-body media cf">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="media-img">
							<?php my_the_post_thumbnail( $post->ID, 'index-thumb' ); ?>
						</div>
						<?php endif; ?>
						<div class="media-body">
							<?php my_the_excerpt( $post, 'entry-excerpt' ); ?>
						</div>
					</div>
<?php get_template_part( 'parts/entry-foot' ); ?>
				</article>