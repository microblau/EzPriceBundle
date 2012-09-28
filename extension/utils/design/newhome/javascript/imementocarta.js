(function ($) {



	$(document).ready( function()
	{

        if($("#accesoMementos input").length != 0){		
      		$("#accesoMementos input").click(function(){
               
	           	checkImementoPrice( $("#valor").val() );
    	})};    	
        $("#mementosForm").submit( function() {    
            var n = $("#accesoMementos input:checked").length;            
            if(n == 0){
            	alert( 'Debe seleccionar al menos un Memento' );
               return false;
            }
        });
    });
    
    function checkImementoPrice( accesos )
    {
    var n = $("#accesoMementos input:checked").length;
        if (n == 1){
                $("#modMiImemento .listMem span").text(n + ' ' + literal["mementos"][0]);
        }else{
                $("#modMiImemento .listMem span").text(n + ' ' + literal["mementos"][1]);
        }
var values = new Array();
$.each($("input[name='mementos[]']:checked"), function() {
  values.push($(this).val());
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});

    $.get( '/basket/imementocheckprice',
        { mementos: n, id : $("#object").val(), products : values.join(',') },
        function(data){
        $("#partial").html( data.price);
        $("#partialfield").val( data.price );
        $("#discount").html( data.discount);
        $("#discountfield").val( parseInt( data.discount ) );
        $("#ptotal").html( data.total);
        $("#totalfield").val( data.total );
    }, 'json');
}

})(jQuery);
