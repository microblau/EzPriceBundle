literal["modTryiMemento"] = [];	
	literal["modTryiMemento"][0] = "El campo 'Su nombre' es obligatorio|";	
	literal["modTryiMemento"][1] = "El campo 'Sus apellidos' es obligatorio|";	
	literal["modTryiMemento"][2] = "El campo 'Su teléfono' es obligatorio|";	
	literal["modTryiMemento"][3] = "El formato del campo 'Su teléfono' no es correcto|";	
	literal["modTryiMemento"][4] = "Debe aceptar las condiciones legales|";
	literal["modTryiMemento"][5] = "El campo 'Su email' es obligatorio|";
	literal["modTryiMemento"][6] = "El formato del campo 'Su email' no es correcto|";
	literal["modTryiMemento"][7] = "El campo 'Su código postal' es obligatorio|";
	


		

/* validaciones de formularios */
var formsValidationsHome = {
	setMsgError:function(txt, form){
		var parentForm = form.parent();
		var msgError = parentForm.find(".msgError");
		var divElement = (msgError.length != 0) ? msgError.eq(0) : document.createElement("div");		
		var ulElement = document.createElement("ul");
		var liElement = null;		
		var errors = txt.split("|");				
		jQuery(divElement).attr("class", "msgError");		
		if(jQuery(divElement).find("ul").length != 0) jQuery(divElement).empty();
		for(var i = 0; i < errors.length - 1; i++){
			liElement = document.createElement("li");
			liElement.appendChild(document.createTextNode(errors[i]));
			ulElement.appendChild(liElement);
		}
		jQuery(divElement).append($("<span>"+literal["msgError"]+"</span>"));
		jQuery(divElement).append(ulElement);		
		if(msgError.length == 0) form.before(jQuery(divElement));		
	},		
	validaTryMementoForm:function(obj){
		var errorTxt = "";
		var f = $(obj);
		
		var aux = f.find("input#nombre");
		var parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modTryiMemento"][0];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		aux = f.find("input#apellidos");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modTryiMemento"][1];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		aux = f.find("input#telefono");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modTryiMemento"][2];			
			parent.addClass("error");
		}else{
			parent.removeClass("error");
			if(!regularExpressions.esTelefono(aux.val())){
				errorTxt += literal["modTryiMemento"][3];
				parent.addClass("error");
			}else parent.removeClass("error");
			
		} 

		aux = f.find("input#email");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modTryiMemento"][5];			
			parent.addClass("error");
		}else{
			parent.removeClass("error");
			if(!regularExpressions.isValidEmail(aux.val())){
				errorTxt += literal["modTryiMemento"][6];
				parent.addClass("error");
			}else parent.removeClass("error");
			
		} 
		
		aux = f.find("input#cp");
		parent = aux.parent();
		if(!aux.val()){		
			errorTxt += literal["modTryiMemento"][7];			
			parent.addClass("error");
		}else parent.removeClass("error");

						
		parent = f.find(".check");	
		if(!f.find(":checkbox").is(":checked")){
			errorTxt += literal["modTryiMemento"][4];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		if(errorTxt != ""){				
			formsValidationsHome.setMsgError(errorTxt, f);			
			return false;
		}else return true;
	}
	
}


var imemento = {
	clickControl:function(){
		var obj = $(".tryPromo");
		$(".tryProd").click(function () { 
			$(this).toggleClass("sel"); 
			$(this).parent().toggleClass("sel"); 
			$("#frm_tryImemento").toggle(); 
			$(".msgError", obj).remove();
			$(".error", obj).removeClass("error")
			return false;
		});
	}
}


function mycarousel_initCallback(carousel) {
    jQuery(".jcarousel-control a").bind("click", function() {
		$(".jcarousel-control a").removeClass("sel")
		$(this).addClass("sel")
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

    jQuery(".jcarousel-scroll select").bind("change", function() {
        carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
        return false;
    });

    jQuery("#mycarousel-next").bind("click", function() {
        carousel.next();
        return false;
    });

    jQuery("#mycarousel-prev").bind("click", function() {
        carousel.prev();
        return false;
    });
};

jQuery(document).ready(function() {
	if($("#frm_tryImemento").length != 0) {
		$("#frm_tryImemento").hide();
		imemento.clickControl();		
		jQuery("#frm_tryImemento").submit(function(){return formsValidationsHome.validaTryMementoForm( jQuery(this)) })	
					
	}
	if($("#iMementoDest").length) {
		$(".jcarousel-control").show();
		jQuery(".carrusel").jcarousel({
			scroll: 1,
			initCallback: mycarousel_initCallback,
			buttonNextHTML: null,
			buttonPrevHTML: null
		});
	}
})
