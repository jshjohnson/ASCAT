<?php
/*
Template Name: Trial Oversight
*/
?>
<?php get_header(); ?>
		<div class="content__bg">
			<div class="content__container container">
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<article>
					<?php the_content(); ?>	
				</article>
				<?php endwhile; ?>	
				<?php endif; ?>
				<div class="grid grid--no-gutter">
						<article class="grid__cell bio module module-1-2">
							<img src="assets/img/avatar.png" alt="">
							<h2 class="bio__title"><a href="profile.html">Prof. Amar Rangan</a></h2>
							<h3 class="bio__subtitle">Independent Chair</h3>
							<p>Professor Rangan is a Consultant Orthopaedic Surgeon at South Tees Hospital NHS Foundation Trust, and an expert in Shoulder &amp; Elbow Surgery. He is the Chief Investigator of the ProFHER Trial (PROximal Fractures of The Humerus: Evaluation by Randomisation).  He is a Member of the British Elbow and Shoulder Society; an Honorary Lecturer at the University of Teesside; and a Member of the Court of Examiners, Royal College of Surgeons of England.</p>
							<a class="more-link" href="profile.html">More</a>
						</article>
						<article class="grid__cell  bio module module-1-2">
							<img src="assets/img/avatar.png" alt="">
							<h2 class="bio__title"><a c>Prof. Amar Rangan</a></h2>
							<h3 class="bio__subtitle">Independent Chair</h3>
							<p>Professor Rangan is a Consultant Orthopaedic Surgeon at South Tees Hospital NHS Foundation Trust, and an expert in Shoulder &amp; Elbow Surgery. He is the Chief Investigator of the ProFHER Trial (PROximal Fractures of The Humerus: Evaluation by Randomisation).  He is a Member of the British Elbow and Shoulder Society; an Honorary Lecturer at the University of Teesside; and a Member of the Court of Examiners, Royal College of Surgeons of England.</p>
							<a class="more-link" href="profile.html">More</a>
						</article>
						<article class="grid__cell  bio module module-1-2">
							<img src="assets/img/avatar.png" alt="">
							<h2 class="bio__title"><a href="profile.html">Prof. Amar Rangan</a></h2>
							<h3 class="bio__subtitle">Independent Chair</h3>
							<p>Professor Rangan is a Consultant Orthopaedic Surgeon at South Tees Hospital NHS Foundation Trust, and an expert in Shoulder &amp; Elbow Surgery. He is the Chief Investigator of the ProFHER Trial (PROximal Fractures of The Humerus: Evaluation by Randomisation).  He is a Member of the British Elbow and Shoulder Society; an Honorary Lecturer at the University of Teesside; and a Member of the Court of Examiners, Royal College of Surgeons of England.</p>
							<a class="more-link" href="profile.html">More</a>
						</article>
						<article class="grid__cell bio module module-1-2">
							<img src="assets/img/avatar.png" alt="">
							<h2 class="bio__title"><a href="profile.html">Prof. Amar Rangan</a></h2>
							<h3 class="bio__subtitle">Independent Chair</h3>
							<p>Professor Rangan is a Consultant Orthopaedic Surgeon at South Tees Hospital NHS Foundation Trust, and an expert in Shoulder &amp; Elbow Surgery. He is the Chief Investigator of the ProFHER Trial (PROximal Fractures of The Humerus: Evaluation by Randomisation).  He is a Member of the British Elbow and Shoulder Society; an Honorary Lecturer at the University of Teesside; and a Member of the Court of Examiners, Royal College of Surgeons of England.</p>
							<a class="more-link" href="profile.html">More</a>
						</article>
					</div>
				</div>
<?php get_sidebar(); ?> 
<?php get_footer(); ?>