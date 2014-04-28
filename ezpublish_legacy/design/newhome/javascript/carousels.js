/**
 * Created by carlos on 28/04/14.
 */

(function( $ ) {
    $.fn.carousel = function( options ) {
        var settings = $.extend({
            // These are the defaults.
            target: 1,
            interval: 6000,
            wrap: null,
            auto: false
        }, options );

        $(this).jcarousel({
            'wrap': settings.wrap
        });

        if (settings.auto){
            $(this).jcarousel().jcarouselAutoscroll({
                interval: settings.interval,
                target: '+=' + settings.target,
                autostart: true
            });
        }

        $(settings.root).find('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=' + settings.target
            });

        $(settings.root).find('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=' + settings.target
            });
    }
})(jQuery);