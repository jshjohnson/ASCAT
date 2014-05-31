<?php get_header(alt); ?>
	<p class="nav nav--page">
	<?php if(function_exists('bcn_display')) {
        bcn_display();
    }?>
    </p>
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
				<?php if(get_field('job_title')) : ?>
				<dt>Job title:</dt>
				<dd><?php the_field('job_title'); ?></dd>
				<?php endif; ?>

				
				<?php if(get_field('committee_role')) : ?>
				<dt>Role:</dt>
				<dd><?php the_field('committee_role'); ?></dd>
				<?php endif; ?>
				
				<?php if($terms = get_the_terms($post->id, "committee_types")) : ?>
				<dt>Committee:</dt>
				<dd>
					<ul>
					<?php  
						 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
						     foreach ( $terms as $term ) {
						       echo "<li>" . $term->name . "</li>";
						        
						     }
						 }
	                ?>
		            </ul>
		        </dd>
				<?php endif; ?>
				<?php if(get_field('biography')) : ?>
				<dt>Bio:</dt>
				<dd><?php the_field('biography'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('site')) : ?>
				<dt>Site:</dt>
				<dd><?php the_field('site'); ?></dd>
				<?php endif; ?>
				

				<?php if(get_field('email')) : ?>
				<dt>Email:</dt>
				<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
				<?php endif; ?>
				
				<?php if(get_field('website')) : ?>
				<dt>Website:</dt>
				<dd><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></dd>
				<?php endif; ?>
	
				
				<?php if(get_field('appointments')) : ?>
				<dt>Appointments:</dt>
				<dd><?php the_field('appointments'); ?></dd>
				<?php endif; ?>

			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>