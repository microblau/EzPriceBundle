(function ($) {

$.fn.followTo = function () {
	var $this = this,
        $window = $(window),
        pos = 0;

    var offset = $this.offset();
	pos = offset.top;
    $window.scroll(function(e){
        if ($window.scrollTop() > pos) {
      
            $this.css({
                position: 'fixed',
                top: 0
            });
         
        } else {
            $this.css({
                position: 'relative',
                top: 0
            });
        }
    });
};

//$('.myIMemento').followTo();

var prettyChecks = {
		init:function(){
			
			$("input[type='checkbox'].pretty").each(function(){
				var $that = $(this),
					$parent = $that.parent(),
					clase;
					
					$that.addClass("off");

					if($that.is(":checked")){
						clase="c_on";
					}else{
						clase="c_off";
					}

					$parent.addClass(clase)
			

				
			}).click(function(){
				var $that = $(this),
					$parent = $that.parent(),
					clase;

				if($parent.hasClass("c_on")){
					$that.removeAttr("checked");
					$parent.removeClass("c_on").addClass("c_off");
				}else{
					$that.attr("checked","checked");
					$parent.removeClass("c_off").addClass("c_on");
				}
			})

		}

	}

var filter = {
		init:function(){
			
			$(".filter").css({
				"position":"absolute",
				"left":420,
				"top":605
			})
			$(".filter-wrap").css({
				"display":"none",
				"box-shadow":"4px 4px 15px 2px rgba(0, 0, 0, 0.4)",
				"position":"absolute",
				"width":265,
				"top":-115,
				"z-index":2
			})
			$(".filter-link").on("click",function(e){
				e.preventDefault();
				$(".filter-wrap").show();
			})
			$(".filter-close").on("click",function(e){
				e.preventDefault();
				$(".filter-wrap").hide();
			})

		}


}

$('#productlist').infinitescroll({
	 
    navSelector  : "div.pag",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "div.pag a",    
                   // selector for the NEXT link (to page 2)
    contentSelector : "#table-rows",
    itemSelector : "#productlist > .imementos tbody tr"          
                   // selector for all items you'll retrieve
  });



 function disableChecks(valor)
	{
		
		$('input[type=checkbox]').each(function () {
				$(this).attr("disabled", true);
			});
	}
	
	function enableChecks(valor)
	{
		
		$('input[type=checkbox]').each(function () {
				$(this).attr("disabled", false);
			});
	} 
  

function checkImementoPrice( accesos )
    {
    var n = $("#productlist input:checked").length;
	
		
		if (n == 1){
                $("#modMiImementoInt").text(n + ' ' + literal["mementos"][0]);
        }else{
                $("#modMiImementoInt").text(n + ' ' + literal["mementos"][1]);
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
				$("#dtotal").html( data.discount);
				$("#discountfield").val( parseInt( data.discount ) );
				$("#ptotal").html( data.total);
				$("#totalfield").val( data.total );
				$("#preload").hide();
				$("#addToBasket").show();
				enableChecks();
			}, 'json');
		
	}
  
  

	$(document).ready( function()
	{

        if($("#preload").length != 0) $("#preload").hide();
		
		
		if($("#productlist input").length != 0){		
      		$("#productlist input").click(function(){
               
				$("#addToBasket").hide();
				$("#preload").show();
				disableChecks(this);
				checkImementoPrice( $("#valor").val() );
				
    	})};    	
        $("#mementosForm").submit( function() {    
            var n = $("#productlist input:checked").length;            
            if(n == 0){
            	alert( 'Debe seleccionar al menos un Memento' );
               return false;
            }
        });
		
		if($("input.pretty").length){prettyChecks.init();}
		if($(".filter").length){filter.init();}
		
    });
})(jQuery);
