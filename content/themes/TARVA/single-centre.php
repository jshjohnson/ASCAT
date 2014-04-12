<?php get_header(); ?>
	<div class="content__container container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$imageID = get_field('logo');
				$image = wp_get_attachment_image_src($imageID, 'full');
				$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); 
			?>
		<img src="<?php echo $image[0]; ?>" alt="<?php echo $alt_text; ?>" class="content__img">
		<article class="bio module hospital">
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
				    <dd>
				    	<ul class="list-unset">
				    <?php foreach( $post_objects as $post_object): ?>
					        <li>
					            <a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
					        </li>
				    <?php endforeach; ?>
						</ul>
					</dd>
				<?php endif; ?>

				<?php if(get_field('coordinator')) : ?>
				<dt>Research Coordinator:</dt>
				<dd><?php the_field('coordinator'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('telephone')) : ?>
				<dt>Tel:</dt>
				<dd><?php the_field('telephone'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('email')) : ?>
				<dt>Email:</dt>
				<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
				<?php endif; ?>
				
				<?php if(get_field('website')) : ?>
				<dt>Website:</dt>
				<dd><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></dd>
				<?php endif; ?>
			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>