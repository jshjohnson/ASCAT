						<article class="grid__cell unit-1-2--bp2">
							<div class="bio island">
								<?php if($url) : ?>
								<img class="bio__avatar" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
								<?php else : ?>
								<img class="bio__avatar" src="<?php echo home_url(); ?>/content/uploads/2014/02/avatar-fallback-256x300.png" alt="Avatar">
								<?php endif; ?>
								<div class="bio__content">
									<h2 class="listing__title listing__title--bio"><a href="<?php the_permalink(); ?>" class="more-link"><?php echo $title; ?></a></h2>
								<?php $jobTitle = get_field('job_title'); if($jobTitle) : ?>
									<h3 class="listing__subtitle listing__subtitle--bio"><?php echo $jobTitle; ?></h3>
								<?php endif; ?>
								<?php $role = get_field('committee_role'); if($role) : ?>
									<h3 class="listing__subtitle listing__subtitle--bio block-title"><?php echo $role; ?></h3>
								<?php endif; ?>
								</div>
							</div>
						</article>