// @codekit-prepend "plugins.js"

(function($, window, document, undefined) {

    'use strict';
    window.App = (function() {
        var app = {};

        var _init = 0;

        app.init = function() {
            if (_init++) {
                return;
            }

            app.sanitiseWP.init();
            app.modernizrSVG.init();
            app.modernizrPlaceholder.init();
            app.smoothScroll.init();

        };

        return app;
    })();
})(jQuery, window, window.document);


// Sanitise WP content
(function($, window, document, app, undefined) {
    app.sanitiseWP = (function() {
        var module = {};

        module.init = function() {
        	$("p:empty").remove();
        	$(".wp-caption").removeAttr("style");
        	$(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");
        };

        return module;
    })();
})(jQuery, window, window.document, window.App);


// Modernizr SVG image polyfill
(function($, window, document, app, undefined) {
    app.modernizrSVG = (function() {
        var module = {};

        var $svgImage = $('img[src*="svg"]');

        module.init = function() {
            if(Modernizr.svg) {
                return;
            } else {
                $svgImage.attr('src', function() {
                    return $(this).attr('src').replace('.svg', '.png');
                });
            }
        };

        return module;
    })();
})(jQuery, window, window.document, window.App);

// Modernizr placeholder polyfill
(function($, window, document, app, undefined) {
	app.modernizrPlaceholder = (function() {
		var module = {};

		var $placeholder = $('[placeholder]');

		module.init = function() {
			if(!Modernizr.input.placeholder){

				$placeholder.focus(function() {
					var input = $(this);
			  		if (input.val() == input.attr('placeholder')) {
						input.val('');
						input.removeClass('placeholder');
					}
				}).blur(function() {
					var input = $(this);
					if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.addClass('placeholder');
						input.val(input.attr('placeholder'));
					}
				}).blur();

				$placeholder.parents('form').submit(function() {
					$(this).find('[placeholder]').each(function() {
						var input = $(this);
						if (input.val() == input.attr('placeholder')) {
							input.val('');
						}
					})
				});
			}
		};

		return module;
	})();
})(jQuery, window, window.document, window.App);

// Smooth scroll
(function($, window, document, app, undefined) {
    app.smoothScroll = (function() {
        var module = {};

        module.init = function() {
            smoothScroll.init({
                speed: 1000,
                easing: 'easeInOutCubic',
                offset: 0,
                updateURL: false,
            });
        };

        return module;
    })();
})(jQuery, window, window.document, window.App);



jQuery(document).ready(function() {
    window.App.init();
});

