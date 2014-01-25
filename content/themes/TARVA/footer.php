				<footer>
					<div class="container">
						<hr>
						<div class="center grid">
							<div class="grid__cell unit-1-5--bp3 unit-1-3--bp2 unit-1-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/UCL.jpg" alt="" class="footer__img"></div>
							<div class="grid__cell unit-1-5--bp3 unit-1-3--bp2 unit-1-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img//NIHR.jpg" alt="" class="footer__img"></div>
							<div class="grid__cell unit-1-5--bp3 unit-1-3--bp2 unit-1-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ARTHRITIS-CARE.jpg" alt="" class="footer__img"></div>
							<div class="grid__cell unit-1-5--bp3 unit-1-3--bp2 unit-1-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/BOFAS.jpg" alt="" class="footer__img"></div>
							<div class="grid__cell unit-1-5--bp3 unit-1-3--bp2 unit-1-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ISRCTN.gif" alt="" class="footer__img"></div>
						</div>
					</div>
					<div class="credit credit--fixed">
						&copy; <?php echo date( 'Y' ) ?> <?php bloginfo( 'name' ); ?> | <?php wp_nav_menu( array( 'menu' => 'tertiary', 'items_wrap' => '<ul class="nav-tertiary">%3$s</ul>' ) ); ?> | Website by <a href="">Josh Johnson</a>
					</div>
				</footer>
			</main>
		</div>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/scripts.min.js"></script>
	<?php wp_footer(); ?>
</body>
</html>
