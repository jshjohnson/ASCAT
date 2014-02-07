<?php get_header(); ?>
	<div class="content__container container">
		<?php if ( have_posts() ) : ?>
		<article class="bio module">
			<?php
				while ( have_posts() ) : the_post(); 
				$image = get_field('avatar');
				$url = $image['sizes']['medium'];
			    $alt = $image['alt'];	
			?>
			<img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
			<dl class="module__split">
				<dt>Name:</dt>
				<dd><?php the_title(); ?></dd>
				<?php if(get_field('job_title')) : ?>
				<dt>Job title:</dt>
				<dd><?php the_field('job_title'); ?></dd>
				<?php endif; ?>
				<dt>Role:</dt>
				<dd><?php the_field('job_role'); ?></dd>

				<?php if (has_term('committee_types')) : ?>
				<dt>Committee:</dt>
				<dd>
					<ul class="list-unset">
						<?php $terms = get_the_terms( $post->ID , 'committee_types' ); 
		                    foreach ( $terms as $term ) {
		                        $term_link = get_term_link( $term, 'committee_types' );
		                        if( is_wp_error( $term_link ) )
		                        continue;
		                    echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
		                    } 
		                ?>
		            </ul>
		        </dd>
				<?php endif; ?>
				<?php if(get_field('bio')) : ?>
				<dt>Bio:</dt>
				<dd><?php the_field('bio'); ?></dd>
				<?php endif; ?>
				<?php 
				$post_object = get_field('centre');

				if( $post_object ): 

				// override $post
				$post = $post_object;
				setup_postdata( $post ); 

				?>
				<dt>Centre:</dt>
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
				<?php if(get_field('appointments')) : ?>
				<dt>Appointments:</dt>
				<dd><?php the_field('appointments'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('private_appointments')) : ?>
				<dt>Private appointments:</dt>
				<dd><?php the_field('private_appointments'); ?></dd>
				<?php endif; ?>

			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>