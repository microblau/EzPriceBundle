
(function ($) {
	$(document).ready( function()
	{
		$("#groups").change( function() {
				$("#asociacion_colectivo").val( $(this).val() );
		});
		
		
	});
})(jQuery);
