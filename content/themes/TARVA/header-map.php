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
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACDnzNTtrrrmVodkeqsgWROfyzc5xrMRA&sensor=true">
	</script>
	<script type="text/javascript">
		function initialize() {

		var styles = [
			{
				featureType: "road",
				elementType: "geometry",
				stylers: [
					{ lightness: 100 },
					{ visibility: "simplified" }
				]
			},{
				featureType: "all",
				elementType: "labels",
				stylers: [
					{ visibility: "off" }
				]
			},{
				featureType: 'water',  
		        elementType: 'geometry.fill',  
		        stylers: [  
		            { color: '#066372' }  
		        ]  
			},{ 
				featureType: "landscape", 
				elementType: "geometry", 
				stylers: [ 
					{ hue: "#066372" }, 
					{ saturation: 85 }, 
					{ lightness: -65 } 
				] 
			} 
		];

		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});

		var myLatLng = new google.maps.LatLng(53.98084, -4.88617);

		var mapOptions = {
			center: myLatLng,
			zoom: 6,
			draggable: true,
		    scrollwheel: false,
		    mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			}
		};

		var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		var image = new google.maps.MarkerImage("../content/themes/TARVA/assets/img/marker.png", null, null, null, new google.maps.Size(25,43.5));

		var beachMarker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: image
		});

		map.mapTypes.set('map_style', styledMap);
 		map.setMapTypeId('map_style');

		
		}

		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<?php wp_head(); ?>
</head>
<body>
	<div class="outer">
		<div id="inner-wrap">
		<?php get_sidebar(); ?> 
		<div class="content">
		<header class="content__header" id="map-canvas">
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