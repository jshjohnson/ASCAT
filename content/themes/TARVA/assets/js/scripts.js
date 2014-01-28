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
});

// Window Load
$(window).bind("load", function() {
	// Fade container on load to combat FOUT
	$(".fade-in").animate({ opacity: 1 }, 'slow');
});