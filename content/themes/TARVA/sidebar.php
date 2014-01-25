			<aside class="sidebar cf">
				<a href="index.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-new.svg" alt="" class="logo"></a>
				<a href="#nav" class="nav-toggle nav-toggle--open icon--menu" id="nav-open-btn"></a>
				<nav class="nav-container" id="nav" role="navigation">
					<a href="#nav" class="nav-toggle nav-toggle--close icon--close" id="nav-close-btn">Close</a>
					<?php wp_nav_menu( array( 'menu' => 'primary', 'items_wrap' => '<ul class="nav nav--primary">%3$s</ul>' ) ); ?>
				</nav>
			</aside>