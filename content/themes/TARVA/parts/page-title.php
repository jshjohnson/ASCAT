			<?php global $post; ?>
			
			<?php if ( is_home() ) : ?>
				<?php echo function_exists( 'get_field' ) && get_field( 'page_title', page_id_home() ) != '' ? get_field( 'page_title', page_id_home()) : get_the_title( page_id_home() ) ?>
			<?php
				$blog_home = get_post( page_id_home() );
				echo apply_filters( 'the_content', $blog_home->post_content );
				wp_reset_query();
			?>
			
			<?php elseif ( is_singular( 'post' ) ): ?>
<?php get_template_part('parts/entry-head'); ?>

			<?php elseif ( is_category() ) : ?>
				<?php echo single_cat_title(); ?>
			<?php
			$category_description = strip_tags( category_description() );
			if ( $category_description ) : ?>
			<p class="intro">
				<?php echo $category_description; ?>
			</p>
			<?php endif; ?>
			
			<?php elseif ( is_archive() ): ?>
				<?php if ( is_month() ):?>
				Archive &ndash; <em></em><?php the_time( 'F, Y' ); ?></em>
				<?php elseif ( is_year() ): ?>
				Archive &ndash; <em><?php the_time( 'Y' ); ?></em>
				<?php elseif( is_tag() ): ?>
				Tagged <em><?php single_tag_title(); ?></em>
				<?php endif; ?>
			
			<?php elseif ( is_search() ): ?>
				Search results <?php echo get_search_query() ? '&mdash; ' . get_search_query() .'' : '' ?>
			
			<?php else: ?>
				<?php echo function_exists( 'get_field' ) && get_field( 'page_title' )!='' ? get_field( 'page_title' ) : $post->post_title ?>
			<?php endif; ?>