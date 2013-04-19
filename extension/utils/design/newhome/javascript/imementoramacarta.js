/*! jquery.infinitescroll.js | https://github.com/diy/jquery-infinitescroll | Apache License (v2) */
(function(b){b.fn.infiniteScroll=function(){var d=b(this),c=b(window),j=b("body"),e="init",f=!1,i=!0,a={threshold:80,onBottom:function(){},onEnd:null,iScroll:null};arguments.length&&("string"===typeof arguments[0]?(e=arguments[0],1<arguments.length&&"object"===typeof arguments[1]&&(a=b.extend(a,arguments[1]))):"object"===typeof arguments[0]&&(a=b.extend(a,arguments[0])));if("init"===e){var g=function(){if(!f&&i&&(a.iScroll?-a.iScroll.maxScrollY+a.iScroll.y:j.outerHeight()-c.height()-c.scrollTop())<
a.threshold){f=true;a.onBottom(function(b){if(b===false){i=false;if(typeof a.onEnd==="function")a.onEnd()}f=false})}};if(a.iScroll){var h=a.iScroll.options.onScrollMove||null;a.iScroll.options.onScrollMove=function(){h&&h();g()};a.iScroll_scrollMove=h}else c.on("scroll.infinite resize.infinite",g);d.data("infinite-scroll",a);b(g)}"reset"===e&&(a=d.data("infinite-scroll"),a.iScroll&&(a.iScroll_scrollMove&&(a.iScroll.options.onScrollMove=a.iScroll_scrollMove),a.iScroll.scrollTo(0,0,0,!1)),c.off("scroll.infinite resize.infinite"),
d.infiniteScroll(a));return this}})(jQuery);

(function ($) {

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
			

				
			})
		},
		enable:function(value)
		{
			if(value.hasClass("c_on")){
				value.removeClass("c_on").addClass("c_off");
				check = value.find('input[type=checkbox]');
				removetoBasket(check);
				check.attr('checked', false);
			}else{
				value.removeClass("c_off").addClass("c_on");
				check = value.find('input[type=checkbox]');
				check.attr('checked', true);
			}
		}
	}

var imemento = {
	clickControl:function(){
		var obj = $(".tryPromo");
		$(".tryProd").click(function () { 
			$(this).toggleClass("sel"); 
			$("#frm_tryImemento").toggle(); 
			$(".msgError", obj).remove();
			$(".error", obj).removeClass("error")
			return false;
		});
	}
}

/*$('#productlist').infinitescroll({
	 
    navSelector  : "div.pag",            
                   
    nextSelector : "div.pag a",    
                   
    contentSelector : "#table-rows",
    itemSelector : "#productlist > .imementos tbody tr"          
                   
  });*/


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
  

function checkImementoPrice( )
    {
    var n = $("#productlist input:checked").length;
	
		
		if (n == 1){
                $("#modMiImementoInt").text(n + ' ' + literal["mementos"][2]);
        }else{
                $("#modMiImementoInt").text(n + ' ' + literal["mementos"][3]);
        }
				
		var values = new Array();
		$.each($("input[name='mementos[]']:checked"), function() {
		  values.push($(this).val());
		  
		});
			
			$.get( '/basket/imementoramacheckprice',
				{ mementos: n, id : $("#object").val(), products : values.join(',') },
				function(data){
				pintaCesta(data);	
			}, 'json');
			
			
	}
 
function removetoBasket(object)
{
	
		
	if ($(object).is(':checked'))
	{
		product = $("#ProductItemIDList_"+ $(object).val());
		
		$.get('/basket/ajaxremove/'+product.val()+'/1', function(data) 
				{
					$("#infocesta").html( data.output );
                }, 'json');
	}
	
} 
 
function pintaCesta(data)
{
	$("#preload").hide();
	$("#addToBasket").show();
	enableChecks();
	var div = "";
	$.each(data.row, function(index, value) 
		{
			div += '<p>Nombre: '+value.name+'</p><p>Precio: <del><span id="partial">'+value.price+'</span></del></p><p>Precio oferta: <ins><span id="ptotal">'+value.total+'</span></ins></p><p class="discount">Descuento: <span id="dtotal">'+value.discount+'</span></p>';
			div += '<div class="sepBasket"></div>';	
			product = $("#ProductItemIDList_"+ value.id);
			product.attr("value",value.remove);
			texto = (value.items==1) ? value.items + " producto" : value.items + " productos";
			$("#infocesta").html('Tiene <a href="/basket/basket">'+texto+'</a> en la cesta');
		});
		
	$("#basketAdd").html(div);	
} 
  

	$(document).ready( function()
	{

	
		imemento.clickControl();
	
        if($("#preload").length != 0) $("#preload").hide();
		
		
		$("#table-rows > tr > td > label").bind('click', function() {
			return false;
		});
		
		
		$("#table-rows > tr > td.selection").bind('click', function() {
			check = $(this).find('input[type=checkbox]');
			span = $(this).find('span');
			prettyChecks.enable(span);
			$("#addToBasket").hide();
			$("#preload").show();
			disableChecks(check);
			checkImementoPrice( $("#valor").val() );
		});
				
        $("#mementosForm").submit( function() {    
            var n = $("#productlist input:checked").length;            
            if(n == 0){
            	alert( 'Debe seleccionar al menos un Pack' );
               return false;
            }
        });
		
		if($("input.pretty").length){prettyChecks.init();}
		if($(".filter").length){filter.init();}
		
		if($("#productlist > .imementos tbody").length != 0){
			alert(1);
			$("#productlist > .imementos tbody").infiniteScroll({
				threshold: 400,
				onEnd: function() {
					$("#productlist").append('<div class="state"><p>No hay más contenido</p></div>');
				},
				onBottom: function(callback) {
					$("#productlist").append('<div class="state"><p>Cargando...</p></div>');
					// (load results & update views)
					var moreResults = true;
			
					callback(moreResults);
				}
			});
		  }
		
    });
})(jQuery);
