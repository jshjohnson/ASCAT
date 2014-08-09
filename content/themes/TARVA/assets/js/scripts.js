$(document).ready(function() { 
    $(".content__body").fitVids();
    $("p:empty").remove();
    $(".wp-caption").removeAttr("style");
    $(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");

    var $svgImage = $('img[src*="svg"]');

    if(Modernizr.svg) {
        return;
    } else {
        $svgImage.attr('src', function() {
            return $(this).attr('src').replace('.svg', '.png');
        });
    }
});