// @codekit-prepend "plugins.js"

var docHeight = $(document).height();

// Document Ready
$(document).ready(function() {
	// HTML5 placeholder support
	$("input, textarea").placeholder();
	// Target radios / checkboxes
	$("input[type=radio]").parents('li').addClass('radio');
	$("input[type=checkbox]").parents('li').addClass('checkbox');
	// FitVids
	$(".container").fitVids();
	// Tweak required labels (Gravity Forms)
	$(".gform_wrapper .gfield_required").html("(required)");
	// Sanitise WP content
	$("p:empty").remove();
	$(".wp-caption").removeAttr("style");
	$(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");


	if ($('.nav--page').length > 0) { 
    	$('.page-heading').addClass('page-heading--alt');
	}

});

// SVG fallback
if (!Modernizr.svg) {
    $('img[src$=".svg"]').each(function()
    {
        $(this).attr('src', $(this).attr('src').replace('.svg', '.png'));
    });
}

// Window Load
$(window).bind("load", function() {
	// Fade container on load to combat FOUT
	$(".fade-in").animate({ opacity: 1 }, 'slow');
});

// Google Map
function initialize() {

		var styles = [
			{ 
				featureType: "road", 
				stylers: [ 
					{ visibility: "off" } 
				] 
			},
			{
				featureType: "poi",
				stylers: [
					{ visibility: "off" }
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

	    var locations = [
	   		['Wrightington', 53.60821, -2.70196, 14],
	   		['Torbay (Devon)', 50.46192, -3.52531, 13],
	    	['Leeds', 53.80128, -1.54857, 12],
	    	['Aintree (Liverpool)', 53.47932, -2.93728, 11],
			['Norwich', 52.63089, 1.29736, 10],
			['Nottingham', 52.95478, -1.15811, 9],
			['Sheffield', 53.38113, -1.47009, 8],
			['Bristol', 51.45451, -2.58791, 7],
			['Oswestry', 52.85715, -3.05641, 6],
			['Stanmore (London)', 51.61642, -0.31969, 5],
			['Cambridge', 52.20534, 0.12182, 4],
			['Oxford', 51.75202, -1.25773, 3],
			['Cardiff', 51.48158, -3.17909, 2],
			['Glasgow', 55.86419, -4.25266, 1]
	    ];

		var mapOptions = {
			center: new google.maps.LatLng(53.44688, -3.43575),
			zoom: 6,
			draggable: true,
		    scrollwheel: false,
		    panControl: false,
		    zoomControl: true,
		    scaleControl: false,
		    streetViewControl: false,
		    mapTypeControl: false,
		    mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			}
		};


		var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		var image = new google.maps.MarkerImage(""+templateUrl+"/assets/img/marker.png", null, null, null, new google.maps.Size(16,17));

		map.mapTypes.set('map_style', styledMap);
 		map.setMapTypeId('map_style');

	    var infowindow = new google.maps.InfoWindow();

	    var marker, i;

	    for (i = 0; i < locations.length; i++) {  
	      marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	        map: map,
	        icon: image
	      });

	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          infowindow.setContent(locations[i][0]);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	    }
	
	}

	google.maps.event.addDomListener(window, 'load', initialize);