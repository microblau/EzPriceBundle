$.fn.endlessScroll = function(options) {

    var defaults = {
      bottomPixels: 50,
      fireOnce: true,
      fireDelay: 150,
      loader: "<br />Loading...<br />",
      data: "",
      insertAfter: "div:last",
      resetCounter: function() { return false; },
      callback: function() { return true; },
      ceaseFire: function() { return false; }
    };

    var options = $.extend({}, defaults, options);

    var firing       = true;
    var fired        = false;
    var fireSequence = 0;

    if (options.ceaseFire.apply(this) === true) {
      firing = false;
    }

    if (firing === true) {
      $(this).scroll(function() {
        if (options.ceaseFire.apply(this) === true) {
          firing = false;
          return; // Scroll will still get called, but nothing will happen
        }

        if (this == document || this == window) {
          var is_scrollable = $(document).height() - $(window).height() <= $(window).scrollTop() + options.bottomPixels;
        } else {
          // calculates the actual height of the scrolling container
          var inner_wrap = $(".endless_scroll_inner_wrap", this);
          if (inner_wrap.length == 0) {
            inner_wrap = $(this).wrapInner("<div class=\"endless_scroll_inner_wrap\" />").find(".endless_scroll_inner_wrap");
          }
          var is_scrollable = inner_wrap.length > 0 &&
            (inner_wrap.height() - $(this).height() <= $(this).scrollTop() + options.bottomPixels);
        }

        if (is_scrollable && (options.fireOnce == false || (options.fireOnce == true && fired != true))) {
          if (options.resetCounter.apply(this) === true) fireSequence = 0;

          fired = true;
          fireSequence++;

          $(options.insertAfter).after("<div id=\"endless_scroll_loader\">" + options.loader + "</div>");

          data = typeof options.data == 'function' ? options.data.apply(this, [fireSequence]) : options.data;

          if (data !== false) {
            $(options.insertAfter).after("<div id=\"endless_scroll_data\">" + data + "</div>");
            $("div#endless_scroll_data").hide().fadeIn();
            $("div#endless_scroll_data").removeAttr("id");

            options.callback.apply(this, [fireSequence]);

            if (options.fireDelay !== false || options.fireDelay !== 0) {
              $("body").after("<div id=\"endless_scroll_marker\"></div>");
              // slight delay for preventing event firing twice
              $("div#endless_scroll_marker").fadeTo(options.fireDelay, 1, function() {
                $(this).remove();
                fired = false;
              });
            }
            else {
              fired = false;
            }
          }

          $("div#endless_scroll_loader").remove();
        }
      });
    }
  };

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

var fixedBox = {
	init:function(){
		var top = $('#modMiImemento').offset().top - parseFloat($('#modMiImemento').css('marginTop').replace(/auto/, 0));
		$(window).scroll(function (event) {
			// what the y position of the scroll is
			var y = $(this).scrollTop();
			// whether that's below the form
			if (y >= top) {
				// if so, ad the fixed class
				$('#modMiImemento').addClass('fixed');
			}else{
				// otherwise remove it
				$('#modMiImemento').removeClass('fixed');
			}
		});
		  
		
	}
}

var infiniteScroll = {
	init:function(){
		$("table.imementos tbody tr").addClass("hide").hide();
		$("table.imementos tbody tr:lt(10)").css("display", "table-row").removeClass("hide");
		
		$(window).endlessScroll({
			bottomPixels: 400,
			fireDelay: 10,
			loader: '<div class="loading"><div>',
			callback: function(i) {
				//alert("test");
				$("table.imementos tbody tr.hide:lt(4)").show().removeClass("hide");
			}
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
			
			if($("#modMiImemento").length != 0){
				if (n > 2){
					alert(1);
					//$("#modMiImemento").removeClass("fixed");
				}else{
					alert(2);
					//$("#modMiImemento").addClass("fixed");
				}
			}
			
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
		
		if($("#modMiImemento").length != 0){fixedBox.init();}
		
		if($(".imementos #table-rows").length != 0){infiniteScroll.init();}
		
		
		
    });
})(jQuery);
