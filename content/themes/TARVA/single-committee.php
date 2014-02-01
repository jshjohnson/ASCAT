<?php get_header(); ?>
	<div class="content__bg">
		<div class="content__container container">
			<?php if ( have_posts() ) : ?>
			<article class="grid__cell bio module">
				<?php while ( have_posts() ) : the_post(); ?>
				<img src="assets/img/avatar.png" alt="">
				<dl class="module__split">
					<dt>Name:</dt>
					<dd><?php the_title(); ?></dd>
					<dt>Job title:</dt>
					<dd><?php the_field('job_title'); ?></dd>
					<dt>Role:</dt>
					<dd><?php the_field('job_role'); ?></dd>
					<dt>Hospital:</dt>
					<dd><?php the_field('hospital'); ?></dd>
					<dt>Address:</dt>
					<dd><?php the_field('hospital_address'); ?></dd>
					<dt>Tel:</dt>
					<dd><?php the_field('telephone_no'); ?></dd>
					<dt>Email:</dt>
					<dd><a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></dd>
					<dt>Website:</dt>
					<dd><a href="<?php the_field('website'); ?>"><?php the_field('website'); ?></a></dd>
					<dt>Bio:</dt>
					<dd><?php the_field('bio'); ?></dd>
					<dt>Appointments:</dt>
					<dd><?php the_field('appointments'); ?></dd>
					<dt>Private appointments:</dt>
					<dd><?php the_field('private_appointments'); ?></dd>
				</dl>
			</article>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>