(function( $ )
{
    $(document).ready( function()
    {
        $( ".autocomplete" ).autocomplete({
            minLength: 2,
            source: function( request, response ) {
                jQuery.ez( 'wsproduct::get::' + $(".autocomplete").val(), {}, function( data ) {
                    response( $.map( data.content, function( item ) {
                        return {
                            label: item.name,
                            value: item.name,
                            code: item.cod
                        }
                    }));
                });
            },
            select: function( event, ui ) {
                $(this).parent().find('.product-id').val(ui.item.code)
            }
        }).keypress( function(){
            $(this).parent().find('.product-id').val('');
        });
    });
})(jQuery);