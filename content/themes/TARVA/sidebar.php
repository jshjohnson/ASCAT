			<aside class="sidebar cf">
				<a href="#nav" class="nav-toggle nav-toggle--open icon--menu" id="nav-open-btn"></a>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-new.png" alt="" class="logo"></a>
				<nav class="nav-container" id="nav" role="navigation">
					<a href="#nav" class="nav-toggle nav-toggle--close icon--close" id="nav-close-btn">Close</a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="nav nav--primary">%3$s</ul>' ) ); ?>
				</nav>
			</aside>