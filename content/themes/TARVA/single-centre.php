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
				<?php if(get_field('email')) : ?>
				<dt><h3 class="as-h5">Name:</h3></dt>
				<dd><?php the_field('centre_name'); ?></dd>
				<?php endif; ?>
				<?php 
				$post_object = get_field('primary_investigator');

				if( $post_object ): 

				// override $post
				$post = $post_object;
				setup_postdata( $post ); 

				?>
				<dt><h3 class="as-h5">Primary Investigator:</h3></dt>
				<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>

				<?php
				$post_objects = get_field('co-investigators');
 
				if( $post_objects ): ?>
				    <dt><h3 class="as-h5">Co-Investigators:</h3></dt>
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
				<dt><h3 class="as-h5">Research Coordinator:</h3></dt>
				<dd><?php the_field('coordinator'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('telephone')) : ?>
				<dt><h3 class="as-h5">Tel:</h3></dt>
				<dd><?php the_field('telephone'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('email')) : ?>
				<dt><h3 class="as-h5">Email:</h3></dt>
				<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
				<?php endif; ?>
				
				<?php if(get_field('website')) : ?>
				<dt><h3 class="as-h5">Website:</h3></dt>
				<dd><a href="<?php the_field('website'); ?>"><?php $url = get_field('website'); $str = preg_replace('#^https?://#', '', $url); echo $str;  ?></a></dd>
				<?php endif; ?>

				<?php if(get_field('address')) : ?>
				<dt><h3 class="as-h5">Address:</h3></dt>
				<dd><?php the_field('address'); ?> <small><a href="/centres/">Find your nearest centre</a></small></dd>
				<?php endif; ?>
			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>