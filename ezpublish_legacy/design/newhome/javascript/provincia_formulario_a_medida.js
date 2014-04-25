
(function ($) {
	$(document).ready( function()
	{
		$("#provinces").change( function() {
				$("#provincia").val( $(this).val() );
		});
		
		
	});
})(jQuery);
