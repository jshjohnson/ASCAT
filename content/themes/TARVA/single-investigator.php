<?php get_header('alt'); ?>
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
				<dt><h3 class="as-h5">Job title:</h3></dt>
				<dd><?php the_field('job_title'); ?></dd>
				<?php endif; ?>
				
				<?php if(get_field('committee_role')) : ?>
				<dt><h3 class="as-h5">Role:</h3></dt>
				<dd><p class="block-title"><?php the_field('committee_role'); ?></p></dd>
				<?php endif; ?>
				
				<?php if($terms = get_the_terms($post->id, "committee_types")) : ?>
				<dt><h3 class="as-h5">Committee:</h3></dt>
				<dd>
					<ul>
					<?php  
						 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
						     foreach ( $terms as $term ) {
						       echo "<li><a href='/trial-oversight/" . $term->slug . "'>" . $term->name . "</a></li>"; 
						     }
						 }
	                ?>
		            </ul>
		        </dd>
				<?php endif; ?>

				<?php if(get_field('biography')) : ?>
				<dt><h3 class="as-h5">Bio:</h3></dt>
				<dd><?php the_field('biography'); ?></dd>
				<?php endif; ?>

				<?php if(get_field('site')) : ?>
				<dt><h3 class="as-h5">Centre:</h3></dt>
				<dd><?php the_field('site'); ?></dd>
				<?php endif; ?>
				
				<?php if(get_field('email')) : ?>
				<dt><h3 class="as-h5">Email:</h3></dt>
				<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
				<?php endif; ?>
				
				<?php if(get_field('website')) : ?>
				<dt><h3 class="as-h5">Website:</h3></dt>
				<dd><a href="<?php the_field('website'); ?>"><?php $url = get_field('website'); $str = preg_replace('#^https?://#', '', $url); echo $str;  ?></a></dd>
				<?php endif; ?>
				
				<?php if(get_field('appointments')) : ?>
				<dt><h3 class="as-h5">Appointments:</h3></dt>
				<dd><?php the_field('appointments'); ?></dd>
				<?php endif; ?>

			</dl>
			<?php endwhile; ?>
		</article>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>