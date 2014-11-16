$(document).ready(function() { 
    $(".content__body").fitVids();
    $("p:empty").remove();
    $(".wp-caption").removeAttr("style");
    $(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");
    
    // SVG fallback
    if (!Modernizr.svg) {
        $('img[src$=".svg"]').each(function()
        {
            $(this).attr('src', $(this).attr('src').replace('.svg', '.png'));
        });
    }

    $('.fancybox-media').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        helpers : {
            media : {}
        }
    });
    
});

