<?php get_header(); ?>
	<div class="content__container container">
		<?php if ( have_posts() ) : ?>
		<article class="bio module">
			<?php while ( have_posts() ) : the_post(); ?>
			<dl class="module__split">
				<dt>Name:</dt>
				<dd><?php the_title(); ?></dd>
				<?php 
				$post_object = get_field('primary_investigator');

				if( $post_object ): 

				// override $post
				$post = $post_object;
				setup_postdata( $post ); 

				?>
				<dt>Primary Investigator:</dt>
				<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>

				<?php
				$post_objects = get_field('co-investigators');
 
				if( $post_objects ): ?>
				    <dt>Co-Investigators:</dt>
				    <?php foreach( $post_objects as $post_object): ?>
				        <dd>
				            <a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
				        </dd>
				    <?php endforeach; ?>
				<?php endif; ?>
				<dt>Research Coordinator:</dt>
				<dd><?php the_field('coordinator'); ?></dd>
				<dt>Tel:</dt>
				<dd><?php the_field('telephone'); ?></dd>
				<dt>Email:</dt>
				<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
				<dt>Website:</dt>
				<dd><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></dd>
			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>