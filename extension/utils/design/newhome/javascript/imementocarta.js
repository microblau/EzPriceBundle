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

//$('.modMiImemento').followTo();

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
				check.attr('checked', false);
			}else{
				value.removeClass("c_off").addClass("c_on");
				check = value.find('input[type=checkbox]');
				check.attr('checked', true);
			}
		}
	}

var filter = {
		init:function(){
			
			$(".filter").css({
				"position":"relative",
				"left":208,
				"top":36,
				"width":180
			})
			
			$(".filter-wrap").css({
				"display":"none",
				"box-shadow":"4px 4px 15px 2px rgba(0, 0, 0, 0.4)",
				"position":"absolute",
				"width":265,
				"top":15,
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
				if($("table.imementos #table-rows").hasClass("filtered") === false){
					$("table.imementos tbody tr.hide:lt(4)").css("display", "table-row").removeClass("hide");
				}
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
  

function checkImementoPrice( accesos )
{
	var n = $("#productlist input:checked").length;

	//if (n>0)
	//{
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
	//}
}
  
  

	$(document).ready( function()
	{

	
		imemento.clickControl();
	
        if($("#preload").length != 0) $("#preload").hide();
		
		$('.next').bind('click', function() {
		
			$.ajax({
				type: "GET", // or GET
				url: $('.next').attr('href'),
				success: function(data){
					$('#productlist').html(data); 
					prettyChecks.init();
				}
			  });
			return false;
			
		});
		
		$('.filter-select').bind('click', function() {
		
			$("#table-rows").addClass("filtered");
			
			$('#filterContainer > li > a').each(function() {
					$(this).attr('style','text-decoration: underline;');
			});
			
		
			$(this).attr('style','text-decoration: none;');
			
			$('#table-rows > tr').each(function() {
					
					$(this).hide().addClass("hide");
			});
			if($(this).attr('data-filter') == 0){
				$("#table-rows > tr").css("display", "table-row").removeClass("hide");
			}else{
				className = "."+$(this).attr('data-filter');
				
				$(className).each(function() {
						$(this).css("display", "table-row").removeClass("hide");
					});
			}
			
			return false;
			
		});
		
		
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
            	alert( 'Debe seleccionar al menos un Memento' );
               return false;
            }
        });
		
		if($("input.pretty").length){prettyChecks.init();}
		if($(".filter").length){filter.init();}
		checkImementoPrice();
		
		if($("#modMiImemento").length != 0){fixedBox.init();}
		
		if($(".imementos #table-rows").length != 0){infiniteScroll.init();}
		
    });

