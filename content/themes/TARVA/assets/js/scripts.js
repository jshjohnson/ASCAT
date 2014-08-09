$(document).ready(function() { 
    $(".content__body").fitVids();
    $("p:empty").remove();
    $(".wp-caption").removeAttr("style");
    $(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");
});

(function($, window, document, undefined) {

    'use strict';
    window.App = (function() {
        var app = {};

        var _init = 0;

        app.init = function() {
            if (_init++) {
                return;
            }

            app.modernizrSVG.init();

        };

        return app;
    })();
})(jQuery, window, window.document);

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

jQuery(document).ready(function() {
    window.App.init();
});