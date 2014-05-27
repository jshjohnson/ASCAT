<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js <?php if(is_front_page()) : ?>home<?php endif; ?>" lang="en"><!--<![endif]-->
<head>
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	<meta charset="utf-8">
	<title><?php wp_title( '', true, 'right' ); ?><?php if ( ! is_front_page() ): ?>| <?php bloginfo( 'name' ); ?><?php endif; ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<!--[if lte IE 8]>
	    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/ie.css" media="screen">
	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/libs/selectivizr-min.js"></script>
	<![endif]-->
	<!--[if gt IE 8]><!-->
	    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/screen.css">
	<!--<![endif]-->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/libs/modernizr-2.5.3.min.js"></script>
	<script type="text/javascript" src="//use.typekit.net/kwu8vfx.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<script>var templateUrl = '<?= get_stylesheet_directory_uri(); ?>';</script>
	<?php wp_head(); ?>
</head>
<body>
	<div class="outer">
		<div id="inner-wrap">
		<?php get_sidebar(); ?> 
		<div class="content">
		<header class="content__header content__header--tall">
			<div id="map-canvas" class="map"></div>
			<div class="container">
				<?php 	
					$title = get_field('alternative_title');
					if($title == ''):
						$title = get_the_title();
					endif; 
				?>
				<h1 class="page-heading"><?php echo $title; ?></h1>
			</div>
		</header>