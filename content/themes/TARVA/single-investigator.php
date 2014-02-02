<?php get_header(); ?>
	<div class="content__bg">
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<article class="bio module">
				<?php while ( have_posts() ) : the_post(); ?>
				<img src="<?php the_field('avatar');?>" alt="">
				<dl class="module__split">
					<dt>Name:</dt>
					<dd><?php the_title(); ?></dd>
					<dt>Job title:</dt>
					<dd><?php the_field('job_title'); ?></dd>
					<dt>Role:</dt>
					<dd><?php the_field('job_role'); ?></dd>
					<?php 
					$post_object = get_field('hospital');

					if( $post_object ): 

					// override $post
					$post = $post_object;
					setup_postdata( $post ); 

					?>
					<dt>Hospital:</dt>
					<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
					<dt>Address:</dt>
					<dd><?php the_field('address'); ?></dd>
					<dt>Tel:</dt>
					<dd><?php the_field('telephone'); ?></dd>
					<dt>Email:</dt>
					<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
					<dt>Website:</dt>
					<dd><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></dd>
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; ?>
					<dt>Bio:</dt>
					<dd><?php the_field('bio'); ?></dd>
					<dt>Appointments:</dt>
					<dd><?php the_field('appointments'); ?></dd>
					<dt>Private appointments:</dt>
					<dd><?php the_field('private_appointments'); ?></dd>
				</dl>
				<?php endwhile; ?>
			</article>
		</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>