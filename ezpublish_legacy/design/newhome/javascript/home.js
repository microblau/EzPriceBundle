
	
literal["modGratis"] = [];	
	literal["modGratis"][0] = "El campo 'Su nombre' es obligatorio|";	
	literal["modGratis"][1] = "El campo 'Sus apellidos' es obligatorio|";	
	literal["modGratis"][2] = "El campo 'Su teléfono' es obligatorio|";	
	literal["modGratis"][3] = "El formato del campo 'Su teléfono' no es correcto|";	
	literal["modGratis"][4] = "El formato del campo 'Email' no es correcto|";
	literal["modGratis"][5] = "Debe aceptar la política de privacidad y el aviso legal|";
        literal["modGratis"][6] = "Debe seleccionar un producto|";
        literal["modGratis"][7] = "El campo 'E-mail' es obligatorio|";
	literal["modGratis"][8] = "El campo 'Código Postal' es obligatorio|"
	

literal["modActualidad"] = [];	
	literal["modActualidad"][0] = "El campo 'Email' es obligatorio|";	
	literal["modActualidad"][1] = "El formato del campo 'Email' no es correcto|";
	literal["modActualidad"][2] = "El campo 'Tema de la alerta' es obligatorio|";
        literal["modActualidad"][3] = "Debe aceptar la política de privacidad y el aviso legal|";
	
literal["modBoletin"] = [];	
	literal["modBoletin"][0] = "El campo 'Email' es obligatorio|";	
	literal["modBoletin"][1] = "El formato del campo 'Email' no es correcto|";
		

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
	validaModPruebaForm:function(obj){
		var errorTxt = "";
		var f = $(obj);
		
		var aux = f.find("input#sun");
		var parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modGratis"][0];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		aux = f.find("input#sua");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modGratis"][1];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		aux = f.find("input#sut");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modGratis"][2];			
			parent.addClass("error");
		}else{
			parent.removeClass("error");
			if(!regularExpressions.esTelefono(aux.val())){
				errorTxt += literal["modGratis"][3];
				parent.addClass("error");
			}else parent.removeClass("error");
			
		} 
		
		aux = f.find("input#sue");
		parent = aux.parent();		
												
		if(aux.val() != ""){		
			if(!regularExpressions.isValidEmail(aux.val())){
				errorTxt += literal["modGratis"][4];
				parent.addClass("error");
			}else parent.removeClass("error");
		}
                else{
                    errorTxt += literal["modGratis"][7];
		     parent.addClass("error");
                }
                
          
		parent = aux.parent();		
												
		if(aux.val() == ""){		
			
                    errorTxt += literal["modGratis"][6];
		     parent.addClass("error");
                }

		aux = f.find("input#cp");
		parent = aux.parent();
		
		if(!aux.val()){		
			errorTxt += literal["modGratis"][8];			
			parent.addClass("error");
		}else parent.removeClass("error");
                
		
		parent = f.find(".acepto");	
		if(!f.find(":checkbox").is(":checked")){
			errorTxt += literal["modGratis"][5];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		if(errorTxt != ""){				
			formsValidationsHome.setMsgError(errorTxt, f);			
			return false;
		}else return true;
	},
	validaModActualidadForm:function(obj){
		var errorTxt = "";
		var f = $(obj);
		
		var aux = f.find("input#em");
		var parent = aux.parent();
		if(!aux.val()){		
			errorTxt += literal["modActualidad"][0];			
			parent.addClass("error");
		}else{
			parent.removeClass("error");
			if(!regularExpressions.isValidEmail(aux.val())){
				errorTxt += literal["modActualidad"][1];
				parent.addClass("error");
			}else parent.removeClass("error");
		}
		
		aux = f.find("select#tem");
		parent = aux.parent();
		
		
		if(aux.val() == -1){		
			errorTxt += literal["modActualidad"][2];			
			parent.addClass("error");
		}else parent.removeClass("error");
                
                parent = f.find(".check");	
		if(!f.find(":checkbox").is(":checked")){
			errorTxt += literal["modActualidad"][3];			
			parent.addClass("error");
		}else parent.removeClass("error");
		
		if(errorTxt != ""){				
			formsValidationsHome.setMsgError(errorTxt, f);			
			return false;
		}else{
			var uri = $("#uri");
			if(aux.val() == 0){
				uri.val("EflBlogActJur");
				window.open('http://feedburner.google.com/fb/a/mailverify?uri=EflBlogActJur', 'popupwindow', 'scrollbars=yes,width=550,height=520');	
			}else{
				uri.val("EflBlogArtDoc");
				window.open('http://feedburner.google.com/fb/a/mailverify?uri=EflBlogArtDoc', 'popupwindow', 'scrollbars=yes,width=550,height=520')	
			}
			return true;
		
		};
	},
	validaModBoletin:function(obj){
		var errorTxt = "";
		var f = $(obj);
		

		var aux = f.find("input#sem");
		var auxVal = aux.val();
		var parent = aux.parent();	
											
		if(!auxVal){		
			errorTxt += literal["modBoletin"][0];			
			parent.addClass("error");
		}else{
			parent.removeClass("error");
			if(!regularExpressions.isValidEmail(auxVal)){
				errorTxt += literal["modBoletin"][1];
				parent.addClass("error");
			}else parent.removeClass("error");
		}
		
		if(errorTxt != ""){				
			formsValidationsHome.setMsgError(errorTxt, f);			
			return false;
		}else return true;
	}
	
}


var lightboxhome = {
	legal:function(){
		var enlace = $("#formPrueba .acepto a");
			$(enlace).fancybox({
				'width':631, 
				'height':517,
				'padding':0,
				'type':'iframe'
			});
	}
}

jQuery(document).ready(function() {	
	
	
	if($("#formPrueba").length != 0) {
        
		if($("#promocionPrimaria.type3").length != 0) $(".car").jcarousel({ scroll: 1, auto:1, wrap:'last', initCallback: initCarousel });


		jQuery("#formPrueba form").submit(function(){return formsValidationsHome.validaModPruebaForm( jQuery(this)) })	
		lightboxhome.legal();
	}
	if($("#modMemGrat").length != 0) {				
		jQuery("#modMemGrat form").submit(function(){return formsValidationsHome.validaModActualidadForm( jQuery(this)) })	
	}
	if($("#modSusc").length != 0) {				
		jQuery("#modSusc form").submit(function(){return formsValidationsHome.validaModBoletin( jQuery(this)) })	
	}

    function initCarousel( carousel )
    {

        $('.youtube-player').each( function(i,val){
            $(val).tubeplayer({
	width: 633, // the width of the player
	height: 304, // the height of the player
	allowFullScreen: "false", // true by default, allow user to go full screen
	initialVideo: $(val).attr('id'), // the video that is loaded into the player
	preferredQuality: "default",// preferred quality: default, small, medium, large, hd720
	
    onPlayerPlaying: function(){ carousel.stopAuto() },
    onPlayerPaused: function(){ carousel.startAuto() },
    onPlayerEnded: function(){ carousel.startAuto() }
    });
        });
    }

  
	

	
})
