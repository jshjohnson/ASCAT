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
			<dl class="module__split">
				<dt>Name:</dt>
				<dd><?php the_title(); ?></dd>
				<?php if(get_field('job_title')) : ?>
				<dt>Job title:</dt>
				<dd><?php the_field('job_title'); ?></dd>
				<?php endif; ?>
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
				<?php if(get_field('committee_role')) : ?>
				<dt>Role:</dt>
				<dd><?php the_field('committee_role'); ?></dd>
				<?php endif; ?>
				<?php if(get_field('site')) : ?>
				<dt>Site:</dt>
				<dd><?php the_field('site'); ?></dd>
				<?php endif; ?>
				<?php if(get_field('biography')) : ?>
				<dt>Bio:</dt>
				<dd><?php the_field('biography'); ?></dd>
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