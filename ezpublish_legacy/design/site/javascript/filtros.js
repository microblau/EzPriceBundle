(function ($) {
	$(document).ready( function()
	{
		$("#ordenar").change( function() {
				$("#ordenar_field").val( $(this).val() );
				$("#filtrosform").submit();
		});
		$("#mostrar").change( function() {
			$("#mostrar_field").val( $(this).val() );
			$("#filtrosform").submit();
		});
		
	});
})(jQuery);