(function ($) {



	$(document).ready( function()
	{
        if($(".slider").length != 0){
		    sliders.accesos.init();
	    }
        if($("#accesoMementos input").length != 0){					
      		$("#accesoMementos input").click(function(){
	           	checkMementixPrice( $("#valor").val() );
    	})};    	
        $("#mementosForm").submit( function() {
            var n = $("#accesoMementos input:checked").length;            
            if(n == 0){
            	alert( 'Debe seleccionar al menos un Memento' );
               return false;
            }
        });
    });
})(jQuery);
