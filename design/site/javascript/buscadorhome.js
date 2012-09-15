(function ($) {
	$(document).ready( function()
	{
		$("#formhome").submit(function(){
			var url = $(this).attr( 'action' );			
			$.post( url,
					{ 'quienEres': $("#quienEres").val(),
					  'area': $("#area").val(),
					  'formato': $("#formato").val()
					},
					
					function(data){
						$("#modNovedades").html( data.result );
								if($("#home #modNovedades .multim").length != 0) {
									behaviours.controlHeight("#home #modNovedades .multim");
								}
                       cestaCompra.init();
					}, 'json'							
			);
			return false;
		} )
	});
})(jQuery);
