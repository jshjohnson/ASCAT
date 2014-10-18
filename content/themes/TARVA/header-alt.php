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
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/libs/modernizr-custom.min.js"></script>
	<script type="text/javascript" src="//use.typekit.net/kwu8vfx.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php wp_head(); ?>
</head>
<body>
	<div class="outer">
		<div id="inner-wrap">
		<?php get_sidebar(); ?> 
		<div class="content footer--push">
	<?php if(!is_front_page()) :?>

		<?php if (has_post_thumbnail( $post->post_parent ) ): ?>
		<?php $parentimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->post_parent ), 'single-post-thumbnail' ); ?>
			<header class="content__header" style="background-image: url('<?php echo $parentimage[0]; ?>');">
		<?php elseif (has_post_thumbnail( $post->ID ) ): ?>
		<?php $pageimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
			<header class="content__header" style="background-image: url('<?php echo $pageimage[0]; ?>');">
		<?php else : ?>
			<header class="content__header" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-fallback.jpg');">
		<?php endif; ?>
				<div class="content__overlay">
					<div class="container">
						<?php 	
							$title = get_field('alternative_title');
							if($title == ''):
								$title = get_the_title();
							endif; 
						?>
						<h1 class="page-heading page-heading--alt"><?php echo $title; ?></h1>
					</div>
				</div>
			</header>
	<?php endif; ?>