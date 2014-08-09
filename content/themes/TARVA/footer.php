				<footer class="footer cf footer--push">
					<div class="container">
						<?php if(!is_front_page()) : ?>
						<hr>
						<div class="center grid">
						<?php else : ?>
						<div class="center grid push-top">
						<?php endif; ?>

						<?php if(get_field('footer_logos', 'option')): ?>
							<div class="grid grid--center push-top">
							<?php while(has_sub_field('footer_logos', 'option')): ?>
								<?php $logo = get_sub_field('footer_logo'); ?>
								<div class="grid__cell unit-1-4--bp4 unit-1-3--bp2 unit-1-2">
									<img src="<?php echo $logo['url']; ?>" alt="<?php echo $alt; ?>" class="footer__img">
								</div>
							<?php endwhile; ?>
							</div>
						<?php endif; ?>
						</div>
					</div>
				</footer>
				<div class="footer--credit credit">
					&copy; <?php echo date( 'Y' ) ?> <?php bloginfo( 'name' ); ?> | <?php wp_nav_menu( array( 'theme_location' => 'tertiary' , 'items_wrap' => '<ul class="nav-tertiary nav--inline">%3$s</ul>' ) ); ?> Website by <a href="http://joshuajohnson.co.uk">Josh Johnson</a>
				</div>
			</div>
		</div>
	</div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACDnzNTtrrrmVodkeqsgWROfyzc5xrMRA&sensor=true"></script>
	<?php wp_footer(); ?>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/scripts.min.js"></script>
</body>
</html>
