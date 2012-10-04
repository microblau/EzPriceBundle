(function ($) {



	$(document).ready( function()
	{

		if($("#preload").length != 0) $("#preload").hide();
			
        if($("#productlist input").length != 0){		
      		$("#productlist input").click(function(){
               
				$("#addToBasket").hide();
				$("#preload").show();
	           	checkImementoPrice( $("#valor").val() );
				
    	})};    	
        $("#mementosForm").submit( function() {    
            var n = $("#productlist input:checked").length;            
            if(n == 0){
            	alert( 'Debe seleccionar al menos un Memento' );
               return false;
            }
        });
    });
    
    function checkImementoPrice( accesos )
    {
    var n = $("#productlist input:checked").length;
        if (n == 1){
                $("#modMiImemento").text(n + ' ' + literal["mementos"][0]);
        }else{
                $("#modMiImemento").text(n + ' ' + literal["mementos"][1]);
        }
		
		
		var values = new Array();
		$.each($("input[name='mementos[]']:checked"), function() {
		  values.push($(this).val());
		  // or you can do something to the actual checked checkboxes by working directly with  'this'
		  // something like $(this).hide() (only something useful, probably) :P
		});

			$.get( '/basket/qmementixcheckprice',
				{ mementos: n, id : $("#object").val(), products : values.join(',') },
				function(data){
				$("#partial").html( data.pricenorm + "+ IVA");
				$("#ptotal").html( data.total + "+ IVA");
				$("#partialfield").val( data.price );
				$("#discount").html( data.discount);
				$("#discountfield").val( parseInt( data.discount ) );
				$("#totalfield").val( data.total );
				$("#preload").hide();
				$("#addToBasket").show();
			}, 'json');
}

})(jQuery);
