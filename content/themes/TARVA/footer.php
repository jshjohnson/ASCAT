				<footer class="footer cf footer--push <?php if(is_front_page()) :?>footer--arrow footer--no-border<?php endif; ?>">
					<div class="container">
						<div class="center grid">
						<?php if(get_field('footer_logos', 'option')): ?>
							<div class="grid grid--center">
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
	<?php wp_footer(); ?>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/scripts.min.js"></script>
</body>
</html>
