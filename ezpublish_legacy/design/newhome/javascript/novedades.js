
(function ($) {
	$(document).ready( function()
	{

		$("#bestsell a").attr( 'href' , "stats::bestsell" );
   		$("#bestviewed a").attr( 'href', "stats::bestviewed" );
        var links = new Array( 'stats::news', 'stats::bestsell', 'stats::bestviewed' );
        var itemsTab = $("#tabsNov li");

        $("#tabsNov").on("click",'a',function(event){
            
            var aux = $(this);
            var parentt = aux.parent();
            var url = aux.attr( 'href' );
            var text = aux.text();
            var current = aux.parents("ul").find("h3");
            var textCurrent = current.text();
            var parentCurrent = current.parent();
          
			parentCurrent.html("<a href='" + links[itemsTab.index(parentCurrent)] + "'>" + textCurrent + "</a>");
            
            parentt.html( '<h3>' + text + '</h3>' );
            jQuery('.jcarousel.tops').jcarousel('destroy',{});

            jQuery.ez( url, false, _callBack );
            
            event.preventDefault();
            event.stopPropagation();
            
        });

        function _callBack( data )
        {
            if ( data && data.content !== '' )
            {
                if ( data.content.result )
                {
                    $("#modNovedades").html( data.content.result).promise().done( function(){
                        if($("#home #modNovedades .multim").length != 0) {
                            behaviours.controlHeight("#home #modNovedades .multim");
                        }
                        $('.jcarousel.tops').jcarousel({
                            'wrap':'circular',

                        }).jcarouselAutoscroll({
                            interval: 6000,
                            target: '+=3',
                            autostart: true
                        });


                    });

                       cestaCompra.init();

                }
            }               
            else
            {
                alert( data.content.error_text );
            }
        }
		
	});
})(jQuery);
