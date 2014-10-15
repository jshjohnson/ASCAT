$(document).ready(function() { 
    $(".content__body").fitVids();
    $("p:empty").remove();
    $('.fancybox-media')
        .attr('rel', 'media-gallery')
        .fancybox({
            openEffect : 'none',
            closeEffect : 'none',
            prevEffect : 'none',
            nextEffect : 'none',

            arrows : false,
            helpers : {
                media : {},
                buttons : {}
            }
        });
    $(".wp-caption").removeAttr("style");
    $(".wp-content img, .wp-post-image, .wp-post-thumb").removeAttr("width").removeAttr("height");
    
    // SVG fallback
    if (!Modernizr.svg) {
        $('img[src$=".svg"]').each(function()
        {
            $(this).attr('src', $(this).attr('src').replace('.svg', '.png'));
        });
    }
});

