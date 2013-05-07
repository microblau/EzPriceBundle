/*
CSS Browser Selector v0.4.0 (Nov 02, 2010)
Rafael Lima (http://rafael.adm.br)
http://rafael.adm.br/css_browser_selector
License: http://creativecommons.org/licenses/by/2.5/
Contributors: http://rafael.adm.br/css_browser_selector#contributors
*/
function css_browser_selector(u){var ua=u.toLowerCase(),is=function(t){return ua.indexOf(t)>-1},g='gecko',w='webkit',s='safari',o='opera',m='mobile',h=document.documentElement,b=[(!(/opera|webtv/i.test(ua))&&/msie\s(\d)/.test(ua))?('ie ie'+RegExp.$1):is('firefox/2')?g+' ff2':is('firefox/3.5')?g+' ff3 ff3_5':is('firefox/3.6')?g+' ff3 ff3_6':is('firefox/3')?g+' ff3':is('gecko/')?g:is('opera')?o+(/version\/(\d+)/.test(ua)?' '+o+RegExp.$1:(/opera(\s|\/)(\d+)/.test(ua)?' '+o+RegExp.$2:'')):is('konqueror')?'konqueror':is('blackberry')?m+' blackberry':is('android')?m+' android':is('chrome')?w+' chrome':is('iron')?w+' iron':is('applewebkit/')?w+' '+s+(/version\/(\d+)/.test(ua)?' '+s+RegExp.$1:''):is('mozilla/')?g:'',is('j2me')?m+' j2me':is('iphone')?m+' iphone':is('ipod')?m+' ipod':is('ipad')?m+' ipad':is('mac')?'mac':is('darwin')?'mac':is('webtv')?'webtv':is('win')?'win'+(is('windows nt 6.0')?' vista':''):is('freebsd')?'freebsd':(is('x11')||is('linux'))?'linux':'','js']; c = b.join(' '); h.className += ' '+c; return c;}; css_browser_selector(navigator.userAgent);

jQuery.fn.extend({
        createElem:function(tag,properties,styles,text){
                var el=document.createElement(tag)
        if(properties!=null)for (var i in properties){var v=eval("properties."+i);$(el).attr(i,v)}
                if(styles!=null)for (var x in styles){
                        var w=eval("styles."+x);
                        $(el).css(x,w)
                }
                if(text!=null){el.appendChild(document.createTextNode(text))}
       
                return el;  
        },
        exists:function(){ return $(this).size()>0},
        del:function(){if ($(this).parents().exists()){return $(this).empty().remove()}},
        appendElement:function(tag,properties,styles,text){$(this).append($(this).createElem(tag,properties,styles,text))},
        ajaxShowPreloader:function(ids,styles,funct){          
                if($("#"+ids).length>0){$("#"+ids).show()}
                else{$("#wrapperContent").appendElement("div",{id:ids},styles)}                                        
                $("#"+ids).fadeTo("slow", 0.75);                               
                if(funct)funct()
        },
        ajaxHidePreloader:function(ids){
                $("#"+ids).fadeTo("slow",0,function(){$(this).del()})
        }
});


(function ($) {
// VERTICALLY ALIGN FUNCTION
$.fn.vAlign = function() {
        return this.each(function(i){                                            
        var ah = $(this).outerHeight();
        var ph = $(this).parent().outerHeight();
        /*alert("altura caja" + ph);
        alert("altura enlace" + ah);*/
        var mh = ((ph - ah) / 2) - 10;
        $(this).css('padding-top', mh);
        });
};
})(jQuery);


var curves = { 
        wrapSectionsFooter:function(){
                $("#wrapSections").append($(curves.createElementsCurves("fix")));
        },
        home:{
                modFormacion:function(){
                        var obj = $("#modFormacion .grid");
                        obj.append($(curves.createElementsCurves("fix")));
                        obj.find(".description").append($(curves.createElementsCurves("fix")));
                        $("#modDestacado .wrap").append($(curves.createElementsCurves("fix")));
                },
                modPrPrimario:function(){
                        $("#promocionPrimaria .columnType1").append($(curves.createElementsCurves("fix")));
                },
                grid1:function(){
                var obj = $("#gridHome1 .columnType1 .wrap");
                var obj2 = $("#gridHome1 .columnType2 .wrap"); 
               // obj.append($(curves.createElementsCurves("fix")));             
               // obj2.append($(curves.createElementsCurves("fix")));            
                }
        },  
        homeMementos:{
			grid1:function(){
				var obj = $("#gridHome1 .columnType1 .wrap");
				var obj2 = $("#gridHome1 .columnType2 .wrap");	
				obj.append($(curves.createElementsCurves("fix")));		
				obj2.append($(curves.createElementsCurves("fix")));		
			}
		},   
        addCurves:function(obj){               
                if($(obj).length > 1){
                        $(obj).each(function(){
                                $(this).append($(curves.createElementsCurves("fix")));
                        })
                }else{
                        $(obj).append($(curves.createElementsCurves("fix")));
                }
        },
		addCurves2:function(obj){
			if($(obj).length > 1){
				$(obj).each(function(){
					$(this).append($(curves.createElementsCurves("cTl")));
					$(this).append($(curves.createElementsCurves("cTr")));
					$(this).append($(curves.createElementsCurves("cBl")));
					$(this).append($(curves.createElementsCurves("cBr")));
				})
			}else{
				$(obj).append($(curves.createElementsCurves("cTl")));
				$(obj).append($(curves.createElementsCurves("cTr")));
				$(obj).append($(curves.createElementsCurves("cBl")));
				$(obj).append($(curves.createElementsCurves("cBr")));
			}
		},
        cestaCompra:{
                precios:function(){
                        /*var obj = $(".precioIva");
                        var _this = null;
                        obj.each(function(){
                                _this = $(this);
                                _this.append($(curves.createElementsCurves("cTopL")));
                                _this.append($(curves.createElementsCurves("cTopR")));
                                _this.append($(curves.createElementsCurves("cBotL")));
                                _this.append($(curves.createElementsCurves("cBotR")));
                        })      */
                },
                ventasCruzadas:function(){
                        var cesta = $("#cestaCompra table");
                        var ventasCruzadas = cesta.find(".ventaCruzada");
                        var ventasCruzadasRecomendaciones = cesta.find(".ultimaRecom");
                        var _this = tds = aux = html = curve = w = h = null;                                           
                        ventasCruzadas.each(function(){
                                _this = $(this);                               
                                tds = _this.find("td");
                                aux = tds.eq(0);                                                       
                                aux.addClass("cTl");                           
                                aux = tds.eq(6);                               
                                aux.addClass("cTr");                           
                        })
                        ventasCruzadasRecomendaciones.each(function(){                         
                                _this = $(this);                                                                                                                               
                                tds = _this.find("td");
                                aux = tds.eq(0);                                                       
                                aux.addClass("cBl");
                                aux = tds.eq(4);
                                aux.addClass("cBr");                           
                               
                        })
                }
        },
        subNavBar:function(){
                var items = $("#subNavBar > ul > li");
                var _this = first = null;              
                var hLi = hElement = vAlign = 0;
                items.each(function(){
                        _this = $(this);                                               
                        hLi = _this.height();
                        first = _this.find(":first");
                        hElement = first.height();                     
                        vAlign = hLi - (hElement / 2);                                         
                        _this.append($(curves.createElementsCurves("cTop")));                  
                        if(_this.attr("class") == "sel"){
                                first.append($(curves.createElementsCurves("cBot")));
                                //_this.append($(curves.createElementsCurves("cBot")));
                        }else{                         
                                _this.append($(curves.createElementsCurves("cBot")));
                        }                      
                })
        },
        categoriesTabs:function(){
                var objs = $("#categoriesTabs .tabs li");
                var _this = null;
                var cLeft = curves.createElementsCurves("cLeft");
                var cRight = curves.createElementsCurves("cRight");
                objs.each(function(){
                        _this = $(this);
                        _this.append($(cLeft));
                        _this.append($(cRight));
                })
        },
        topsTabs:function(){           
                var obj = $("#tops .tabs li");
                var _this = null;                      
                obj.each(function(){
                        _this = $(this);
                        _this.append($(curves.createElementsCurves("cL")));
                        _this.append($(curves.createElementsCurves("cR")));                    
                })             
        },
        topsTabs2:function(){
                var obj = $(".modType4 .tabs li");
                var _this = null;                      
                obj.each(function(){
                        _this = $(this);
                        _this.append($(curves.createElementsCurves("cL")));
                        _this.append($(curves.createElementsCurves("cR")));                    
                })             
        },
        topsTabs3:function(){
                var obj = $(".modType5 .tabs li");
                var _this = null;                      
                obj.each(function(){
                        _this = $(this);
                        _this.append($(curves.createElementsCurves("cLeft")));
                        _this.append($(curves.createElementsCurves("cRight")));                
                })             
        },
        createElementsCurves:function(style){
                return "<div class='sp " + style + "'>&nbsp;</div>";
        }
       
       
}

var fixes={    
        zIndex:{
                zIndexNumber:2000,
                recalculate:function(obj){             
                        obj.css('zIndex', fixes.zIndex.zIndexNumber);
                        fixes.zIndex.zIndexNumber -= 10;                                                                       
                }
        },
        fix:function(){
                return "<div class='fix sp png'>&nbsp;</div>";
        },
       
        resizeContent:function(){
                var isIE6 = (typeof document.body.style.maxHeight === "undefined");
                var menu = $("#modFormacion #tiposFormacion").height();
               
                if (isIE6){
                        $("#modFormacion .description").css("height",menu + 20);
                }else{
                        $("#modFormacion .description").css("min-height",menu + 20);
                }
               
               
        }
       
       
}

function checkMementixPrice( accesos )
{
    var n = $("#accesoMementos input:checked").length;
        if (n == 1){
                $("#modMiMementix .listMem span").text(n + ' ' + literal["mementos"][0]);
        }else{
                $("#modMiMementix .listMem span").text(n + ' ' + literal["mementos"][1]);
        }
    $.get( '/basket/mementixcheckprice',
        { mementos: n, accesos: accesos, id : $("#object").val() },
        function(data){
        $("#partial").html( data.price);
        $("#partialfield").val( data.price );
        $("#discount").html( data.discount);
        $("#discountfield").val( parseInt( data.discount ) );
        $("#ptotal").html( data.total);
        $("#totalfield").val( data.total );
    }, 'json');
}

var sliders = {
        accesos:{
                init:function() {
                        var obj = $("#valor");
                        var sld = $(".slider-range-min");
                        obj.attr("value", 1);
                        $("#modMiMementix .listaAccesos span").text("1" + ' ' + literal["acceso"][0]);
                        $(".slider .sliderChart .chart").slider({
                                range: "min",
                                value:1,
                                min: 1,
                                max: 6,
                                slide: function(event, ui) {
                                        obj.val(ui.value);
                                },
                                /*muestra en el lugar especificado el valor del slide*/
                                change: function(event, ui) {
                                        var last = obj.val(ui.value);
                                        var texto = "";
                                        var selected = "";
                                        $(".slider-lb").removeClass("sel");
                                        switch (last.attr("value")) {
                                        case "1" :
                                                        texto = literal["acceso"][0];
                                                        selected = $("#item1");
                                                break;
                                        case "2" :
                                                        texto = literal["acceso"][1];
                                                        selected = $("#item2");
                                                break;
                                        case "3" :
                                                        texto = literal["acceso"][2];
                                                        selected = $("#item3");
                                                break;
                                        case "4" :
                                                        texto = literal["acceso"][3];
                                                        selected = $("#item4");
                                                break;
                                                case "5" :
                                                        texto = literal["acceso"][4];
                                                        selected = $("#item5");
                                                break;
                                                case "6" :
                                                        texto = literal["acceso"][5];
                                                        selected = $("#item6");
                                                break;
                                        }
                                        selected.addClass("sel");
                                        $("#modMiMementix .listaAccesos span").text(last.attr("value") + ' ' + texto);            
                    checkMementixPrice( last.attr("value") );    
               
                                }

                        });
                       
                }
        }
       
}

var cuentaChecks = {
        init:function(){
                var n = $("#accesoMementos input:checked").length;
                if (n == 1){
                        $("#modMiMementix .listMem span").text(n + ' ' + literal["mementos"][0]);
                }else{
                        $("#modMiMementix .listMem span").text(n + ' ' + literal["mementos"][1]);
                }
               

        }
}




/* validaciones de formularios */
var formsValidations = {
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
                window.scrollTo(0,0);  
        },             
        validaBusquedaAvanzadaForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                
                var parent = $(f.find("input#buscar").parent());               
                if(!f.find("input#buscar").val() && f.find(":checked").length == 0){           
                        errorTxt += literal["busquedaAvanzada"][0];                    
                        parent.addClass("error");
                }
                else parent.removeClass("error");
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaNewsletterForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                
                var parent = $(f.find("input#publicaciones").parent().parent());
                if(f.find(":checked").length == 0){
                        errorTxt += literal["newsletter"][0];                  
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#nombre").parent());           
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["newsletter"][1];                  
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#apellidos").parent());
                if(!f.find("input#apellidos").val()){
                        errorTxt += literal["newsletter"][2];                  
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("select#actividad").parent());       
                if(!f.find("select#actividad").val()){
                        errorTxt += literal["newsletter"][3];                  
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("select#materia").parent()); 
                if(!f.find("select#materia").val()){
                        errorTxt += literal["newsletter"][4];                  
                        parent.addClass("error");
                }else parent.removeClass("error");                             
                parent = $(f.find("input#email").parent());    
                if(!f.find("input#email").val()){
                        errorTxt += literal["newsletter"][5];                  
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");

                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["newsletter"][6];                  
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }                      
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaInfoColectivos:function(obj){
                var errorTxt = "";
                var f = $(obj);                
                parent = $(f.find("input#nombre").parent());           
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["infoColectivos"][0];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#apellidos").parent());
                if(!f.find("input#apellidos").val()){
                        errorTxt += literal["infoColectivos"][1];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#email").parent());    
                if(!f.find("input#email").val()){
                        errorTxt += literal["infoColectivos"][2];                      
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["infoColectivos"][3];                      
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
                parent = $(f.find("input#phone").parent());
                if(!f.find("input#phone").val()){
                        errorTxt += literal["infoColectivos"][4];                      
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#email").val())){
                                errorTxt += literal["infoColectivos"][5];                      
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
                parent = $(f.find("textarea#comments").parent());
                if(!f.find("input#comments").val()){
                        errorTxt += literal["infoColectivos"][6];              
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaDatosUsuarioForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                        
                var pass = $(f.find("input#pass"));            
                var repPass = $(f.find("input#repPass"));              
                var parent = $(f.find("input#nombre").parent());               
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["datosUsuario"][0];                
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#apellido1").parent());
                if(!f.find("input#apellido1").val()){
                        errorTxt += literal["datosUsuario"][12];                       
                        parent.addClass("error");
                }else parent.removeClass("error");     
                parent = $(f.find("input#apellido2").parent());
               
                parent = $(f.find("input#email").parent());    
                if(!f.find("input#email").val()){
                        errorTxt += literal["datosUsuario"][2];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["datosUsuario"][3];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
                /*parent = $(f.find("input#usuario").parent());
                if(!f.find("input#usuario").val()){
                        errorTxt += literal["datosUsuario"][4];
                        parent.addClass("error");
                }else parent.removeClass("error");
                */             
                parent = pass.parent();
                if(!pass.val()){
                        errorTxt += literal["datosUsuario"][5];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");           
                        if(pass.val().length > 8){
                                errorTxt += literal["datosUsuario"][6];
                                parent.addClass("error");
                        }else parent.removeClass("error");             
                }
                parent = repPass.parent();     
                if(!repPass.val()){
                        errorTxt += literal["datosUsuario"][7];
                        parent.addClass("error");                      
                }else{
                        parent.removeClass("error");           
                        if(repPass.val().length > 8){
                                errorTxt += literal["datosUsuario"][8];
                                parent.addClass("error");
                        }else parent.removeClass("error");             
                }
                if((pass.val() != repPass.val()) && (pass.val() != "" && repPass.val() != "")){        
                        errorTxt += literal["datosUsuario"][9];
                        parent.addClass("error");
                }
                parent = $(f.find("select#pais").parent());    
                if(!f.find("select#pais").val()){
                        errorTxt += literal["datosUsuario"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");             
               
                parent = $(f.find("legend span"));     
                if(f.find(":checked").length == 0){
                        errorTxt += literal["datosUsuario"][11];
                        parent.addClass("error");
                }else parent.removeClass("error");             
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosFacturacion"][31];                   
                        parent.addClass("error");
                }else parent.removeClass("error");             
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);                     
                        return false;
                }else return true;     
        },
		validaDatosUsuarioColectivo:function(obj){
                var errorTxt = "";
                var f = $(obj);                        
                var pass = $(f.find("input#pass"));            
                var repPass = $(f.find("input#repPass"));              
                var parent = $(f.find("input#nombre").parent());               
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["datosUsuarioColectivo"][0];                
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#apellido1").parent());
                if(!f.find("input#apellido1").val()){
                        errorTxt += literal["datosUsuarioColectivo"][1];                       
                        parent.addClass("error");
                }else parent.removeClass("error");     
				
                parent = $(f.find("input#apellido2").parent());
                if(!f.find("input#apellido2").val()){
                        errorTxt += literal["datosUsuarioColectivo"][2];                       
                        parent.addClass("error");
                }else parent.removeClass("error");
				
                parent = $(f.find("input#email").parent());    
                if(!f.find("input#email").val()){
                        errorTxt += literal["datosUsuarioColectivo"][3];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["datosUsuarioColectivo"][4];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }        
                parent = pass.parent();
                if(!pass.val()){
                        errorTxt += literal["datosUsuarioColectivo"][5];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");           
                        if(pass.val().length > 8){
                                errorTxt += literal["datosUsuarioColectivo"][6];
                                parent.addClass("error");
                        }else parent.removeClass("error");             
                }
                parent = repPass.parent();     
                if(!repPass.val()){
                        errorTxt += literal["datosUsuarioColectivo"][7];
                        parent.addClass("error");                      
                }else{
                        parent.removeClass("error");           
                        if(repPass.val().length > 8){
                                errorTxt += literal["datosUsuarioColectivo"][8];
                                parent.addClass("error");
                        }else parent.removeClass("error");             
                }
                if((pass.val() != repPass.val()) && (pass.val() != "" && repPass.val() != "")){        
                        errorTxt += literal["datosUsuarioColectivo"][9];
                        parent.addClass("error");
                }          
               
                parent = $(f.find("legend span"));     
                if(f.find(":checked").length == 0){
                        errorTxt += literal["datosUsuarioColectivo"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");             
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosUsuarioColectivo"][11];                   
                        parent.addClass("error");
                }else parent.removeClass("error");             
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);                     
                        return false;
                }else return true;     
        },
        validaDatosFacturacionForm:function(obj){
                
                var errorTxt = nombreCurso = "";
                var f = $(obj);           
                   
                var radios = obj.find(":radio");                               
                var parent = $(f.find("input#nif").parent());
                var cursos = nombresCursos = null;                     
                var cont = 0;  
                if(!f.find("input#nif").val()){
                        errorTxt += literal["datosFacturacion"][3];                    
                        parent.addClass("error");
                }else{

                        parent.removeClass("error");
                        if(!regularExpressions.esNif(f.find("input#nif").val())){
                                errorTxt += literal["datosFacturacion"][4];                    
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                }

                parent = $(f.find("input#telefono").parent());         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["datosFacturacion"][6];                    
                        parent.addClass("error");
                }else if ( $(f.find( "input#telefono" ) ).val().length > 16 )
                    {
                        errorTxt += literal["datosFacturacion"][60];                    
                        parent.addClass("error"); 
                    }
                    else parent.removeClass("error");
               

                parent = $(f.find("input#movil").parent());
                if ( ( $(f.find( "input#movil" ) ).val() != '' ) && ( $(f.find( "input#movil" ) ).val().length > 16 ) )
                    {
                        errorTxt += literal["datosFacturacion"][61];                    
                        parent.addClass("error"); 
                    }
               else parent.removeClass("error");
                
                parent = $(f.find(".direccion legend").eq(0).parent());
                if(!f.find("select#tipoV").val() || !f.find("input#dir1").val() || !f.find("input#num").val()){
                        errorTxt += literal["datosFacturacion"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("select#provincia").parent());               
                if(!f.find("select#provincia").val()){
                        errorTxt += literal["datosFacturacion"][12];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#localidad").parent());        
                if(!f.find("input#localidad").val()){
                        errorTxt += literal["datosFacturacion"][13];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cp").parent());               
                if(!f.find("input#cp").val()){
                        errorTxt += literal["datosFacturacion"][14];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCodigoPostal(f.find("input#cp").val())){              
                                errorTxt += literal["datosFacturacion"][15];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
                // datos de facturación
                if($("input#no").is(":checked")){              
                        parent = $(f.find("input#nombre2").parent());
                        if(!f.find("input#nombre2").val()){
                                errorTxt += literal["datosFacturacion"][16];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#apellido12").parent());               
                        if(!f.find("input#apellido12").val()){
                                errorTxt += literal["datosFacturacion"][47];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");             
                        /*
                        parent = $(f.find("input#nif2").parent());             
                        if(!f.find("input#nif2").val()){
                        errorTxt += literal["datosFacturacion"][18];                   
                        parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esNif(f.find("input#nif2").val())){
                                        errorTxt += literal["datosFacturacion"][19];                   
                                        parent.addClass("error");
                                }else parent.removeClass("error");                             
                        }*/
                        parent = $(f.find("input#telefono2").parent());        
                        if(!f.find("input#telefono2").val()){
                                errorTxt += literal["datosFacturacion"][21];                   
                                parent.addClass("error");
                        } else if ( $(f.find( "input#telefono2" ) ).val().length > 16 )
                            {
                            errorTxt += literal["datosFacturacion"][210];                    
                            parent.addClass("error"); 
                            }                                                     
                            else parent.removeClass("error");

                        parent = $(f.find("input#movil2").parent());
                        if ( ( $(f.find( "input#movil2" ) ).val() != '' ) && ( $(f.find( "input#movil2" ) ).val().length > 16 ) )
                            {
                                errorTxt += literal["datosFacturacion"][211];                    
                                parent.addClass("error"); 
                            }
                       else parent.removeClass("error");
                       
                        parent = $(f.find("input#email2").parent());   
                        /*if(!f.find("input#email2").val()){
                                errorTxt += literal["datosFacturacion"][22];
                                parent.addClass("error");
                        }else{*/
                        if( f.find("input#email2").val() != ''){
                                parent.removeClass("error");
                                if(!regularExpressions.isValidEmail(f.find("input#email2").val())){
                                        errorTxt += literal["datosFacturacion"][23];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                         }
                        parent = $(f.find(".direccion legend").eq(1).parent());
                        if(!f.find("select#tipoV2").val() || !f.find("input#dir12").val() || !f.find("input#num2").val()){
                                errorTxt += literal["datosFacturacion"][25];
                                parent.addClass("error");
                        }else parent.removeClass("error");                     
                        parent = $(f.find("select#provincia2").parent());      
                       
                        if(!f.find("select#provincia2").val()){
                                errorTxt += literal["datosFacturacion"][27];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#localidad2").parent());               
                        if(!f.find("input#localidad2").val()){
                                errorTxt += literal["datosFacturacion"][28];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#cp2").parent());              
                        if(!f.find("input#cp2").val()){
                                errorTxt += literal["datosFacturacion"][29];
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCodigoPostal(f.find("input#cp2").val())){
                                        errorTxt += literal["datosFacturacion"][30];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }
                }
               
                // datos de cursos
                nombresCursos = $(f.find(".nombreCurso"));
                idsCursos = $(f.find(".curso_id"));
                cursos = $(f.find(".cursos"));
                cursos.each(function(i){               
                        cont = idsCursos.eq(i).val();
                       
                        if(f.find("input#noc" + cont).is(":checked")){                 
                                nombreCurso = nombresCursos.eq(i).val();
                                parent = $(f.find("input#nombrec" + cont)).parent();           
                                if(!f.find("input#nombrec" + cont).val()){             
                                        errorTxt += literal["datosFacturacion"][32] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                                parent = $(f.find("input#apellido1c" + cont)).parent();        
                                if(!f.find("input#apellido1c" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][48] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#profesionc" + cont)).parent();        
                                if(!f.find("input#profesionc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][34] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#telefonoc" + cont)).parent();         
                                if(!f.find("input#telefonoc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][35] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#emailc" + cont)).parent();    
                                if(!f.find("input#emailc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][36] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else{
                                        parent.removeClass("error");
                                        if(!regularExpressions.isValidEmail(f.find("input#emailc" + cont).val())){
                                                errorTxt += literal["datosFacturacion"][37] + " '" + nombreCurso + "' " + literal["obligatorio"];;
                                                parent.addClass("error");
                                        }else parent.removeClass("error");
                                }
                        }
                })
               
               
                                               
                if(errorTxt != ""){                            
                        f.find("fieldset legend").css("position","static");
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                        f.find("fieldset legend").css("position","absolute");
                }else return true;     
        },
       
        validaDatosFacturacionFormEmpresa:function(obj){
                var errorTxt = nombreCurso = "";
                var f = $(obj);                        
                var radios = obj.find(":radio");                                               
                var cursos = nombresCursos = null;                     
                var cont = 0;  
                var parent = $(f.find("input#empresa").parent());              
                if(!f.find("input#empresa").val()){
                        errorTxt += literal["datosFacturacion"][2];                    
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cif").parent());
                if(!f.find("input#cif").val()){
                        errorTxt += literal["datosFacturacion"][38];                   
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCif(f.find("input#cif").val())){
                                errorTxt += literal["datosFacturacion"][5];                    
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                }

                parent = $(f.find("input#telefono").parent());         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["datosFacturacion"][42];                   
                        parent.addClass("error");
                }
                else if ( $(f.find( "input#telefono" ) ).val().length > 16 )
                    {
                        errorTxt += literal["datosFacturacion"][420];                    
                        parent.addClass("error"); 
                    }
                    else parent.removeClass("error");

                 parent = $(f.find("input#telefonoEmp").parent());
                if ( ( $(f.find( "input#telefonoEmp" ) ).val() != '' ) && ( $(f.find( "input#telefonoEmp" ) ).val().length > 16 ) )
                    {
                        errorTxt += literal["datosFacturacion"][421];                    
                        parent.addClass("error"); 
                    }
               else parent.removeClass("error");

                 parent = $(f.find("input#movil").parent());
                if ( ( $(f.find( "input#movil" ) ).val() != '' ) && ( $(f.find( "input#movil" ) ).val().length > 16 ) )
                    {
                        errorTxt += literal["datosFacturacion"][422];                    
                        parent.addClass("error"); 
                    }
               else parent.removeClass("error");
               
                parent = $(f.find(".direccion legend").eq(0).parent());
                if(!f.find("select#tipoV").val() || !f.find("input#dir1").val() || !f.find("input#num").val()){
                        errorTxt += literal["datosFacturacion"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("select#provincia").parent());               
                if(!f.find("select#provincia").val()){
                        errorTxt += literal["datosFacturacion"][12];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#localidad").parent());        
                if(!f.find("input#localidad").val()){
                        errorTxt += literal["datosFacturacion"][13];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cp").parent());               
                if(!f.find("input#cp").val()){
                        errorTxt += literal["datosFacturacion"][14];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCodigoPostal(f.find("input#cp").val())){              
                                errorTxt += literal["datosFacturacion"][15];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
                /*parent = $(f.find(".contacto:eq(0)"));
                if(parent.find("input:checked").length == 0){
                        errorTxt += literal["datosFacturacion"][44];                   
                        parent.addClass("error");
                }else parent.removeClass("error");             
                */
                // datos de facturación
                if($("input#no").is(":checked")){              
            /*
                        parent = $(f.find("input#empresa2").parent());         
                        if(!f.find("input#empresa2").val()){
                                errorTxt += literal["datosFacturacion"][41];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");*/
                        /*parent = $(f.find("input#cif2").parent());
                        if(!f.find("input#cif2").val()){
                                errorTxt += literal["datosFacturacion"][39];                   
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCif(f.find("input#cif2").val())){
                                        errorTxt += literal["datosFacturacion"][20];                   
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                       
                        }*/
            parent = $(f.find("input#nombre2").parent());              
                        if(!f.find("input#nombre2").val()){
                                errorTxt += literal["datosFacturacion"][49];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");

            parent = $(f.find("input#apellido12").parent());   
         
                        if(!f.find("input#apellido12").val()){
                                errorTxt += literal["datosFacturacion"][47];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");


                 parent = $(f.find("input#telefono2").parent());         
                if(!f.find("input#telefono2").val()){
                        errorTxt += literal["datosFacturacion"][4200];                   
                        parent.addClass("error");
                }
                else if ( $(f.find( "input#telefono2" ) ).val().length > 16 )
                    {
                        errorTxt += literal["datosFacturacion"][4201];                    
                        parent.addClass("error"); 
                    }
                    else parent.removeClass("error");

                      parent = $(f.find("input#movil2").parent());
                if ( ( $(f.find( "input#movil2" ) ).val() != '' ) && ( $(f.find( "input#movil2" ) ).val().length > 16 ) )
                    {
                        errorTxt += literal["datosFacturacion"][4220];                    
                        parent.addClass("error"); 
                    }
               else parent.removeClass("error");
                        
                       
                        parent = $(f.find(".direccion legend").eq(1).parent());
                        if(!f.find("select#tipoV2").val() || !f.find("input#dir12").val() || !f.find("input#num2").val()){
                                errorTxt += literal["datosFacturacion"][25];
                                parent.addClass("error");
                        }else parent.removeClass("error");                     
                        parent = $(f.find("select#provincia2").parent());              
                        if(!f.find("select#provincia2").val()){
                                errorTxt += literal["datosFacturacion"][27];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#localidad2").parent());               
                        if(!f.find("input#localidad2").val()){
                                errorTxt += literal["datosFacturacion"][28];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#cp2").parent());              
                        if(!f.find("input#cp2").val()){
                                errorTxt += literal["datosFacturacion"][29];
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCodigoPostal(f.find("input#cp2").val())){
                                        errorTxt += literal["datosFacturacion"][30];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }

                        
                        /*parent = $(f.find(".contacto:eq(1)"));                       
                        if(parent.find("input:checked").length == 0){
                                errorTxt += literal["datosFacturacion"][46];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");*/
                }
               
                // datos de cursos
                nombresCursos = $(f.find(".nombreCurso"));
                cursos = $(f.find(".cursos"));
                cursos.each(function(i){               
                        cont = i + 1;                  
                        if(f.find("input#noc" + cont).is(":checked")){                 
                                nombreCurso = nombresCursos.eq(i).val();
                                parent = $(f.find("input#nombrec" + cont)).parent();           
                                if(!f.find("input#nombrec" + cont).val()){             
                                        errorTxt += literal["datosFacturacion"][32] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                                parent = $(f.find("input#apellidosc" + cont)).parent();        
                                if(!f.find("input#apellidosc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][33] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#profesionc" + cont)).parent();        
                                if(!f.find("input#profesionc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][34] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#telefonoc" + cont)).parent();         
                                if(!f.find("input#telefonoc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][35] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#emailc" + cont)).parent();    
                                if(!f.find("input#emailc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][36] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else{
                                        parent.removeClass("error");
                                        if(!regularExpressions.isValidEmail(f.find("input#emailc" + cont).val())){
                                                errorTxt += literal["datosFacturacion"][37] + " '" + nombreCurso + "' " + literal["obligatorio"];;
                                                parent.addClass("error");
                                        }else parent.removeClass("error");
                                }
                        }
                })
                /*
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosFacturacion"][31];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                                                */
                if(errorTxt != ""){                            
                        f.find("fieldset legend").css("position","static");
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                        f.find("fieldset legend").css("position","absolute");
                }else return true;     
        },
        validaDatosFacturacionFormPartEmp:function(obj){       
                var errorTxt = nombreCurso = "";
                var f = $(obj);                        
                var radios = obj.find(":radio");                                               
                var cursos = nombresCursos = null;                     
                var cont = 0;  
                var parent = $(f.find("input#empresa").parent());              
                if(!f.find("input#empresa").val()){
                        errorTxt += literal["datosFacturacion"][2];                    
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cif").parent());
                if(!f.find("input#cif").val()){
                        errorTxt += literal["datosFacturacion"][38];                   
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCif(f.find("input#cif").val())){
                                errorTxt += literal["datosFacturacion"][5];                    
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                }

                parent = $(f.find("input#telefono").parent());         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["datosFacturacion"][42];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find(".direccion legend").eq(0).parent());
                if(!f.find("select#tipoV").val() || !f.find("input#dir1").val() || !f.find("input#num").val()){
                        errorTxt += literal["datosFacturacion"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("select#provincia").parent());               
                if(!f.find("select#provincia").val()){
                        errorTxt += literal["datosFacturacion"][12];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#localidad").parent());        
                if(!f.find("input#localidad").val()){
                        errorTxt += literal["datosFacturacion"][13];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cp").parent());               
                if(!f.find("input#cp").val()){
                        errorTxt += literal["datosFacturacion"][14];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCodigoPostal(f.find("input#cp").val())){              
                                errorTxt += literal["datosFacturacion"][15];
                                parent.addClass("error");
                        }else parent.removeClass("error");

                }
               
               
                // datos de facturación
                if($("input#no").is(":checked")){              
                        parent = $(f.find("input#empresa2").parent());         
                        if(!f.find("input#empresa2").val()){
                                errorTxt += literal["datosFacturacion"][41];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#cif2").parent());
                        if(!f.find("input#cif2").val()){
                                errorTxt += literal["datosFacturacion"][39];                   
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCif(f.find("input#cif2").val())){
                                        errorTxt += literal["datosFacturacion"][20];                   
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                       
                        }
                        parent = $(f.find("input#telefono2").parent());        
                        if(!f.find("input#telefono2").val()){
                                errorTxt += literal["datosFacturacion"][43];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                        parent = $(f.find(".direccion legend").eq(1).parent());
                        if(!f.find("select#tipoV2").val() || !f.find("input#dir12").val() || !f.find("input#num2").val()){
                                errorTxt += literal["datosFacturacion"][25];
                                parent.addClass("error");
                        }else parent.removeClass("error");                     
                        parent = $(f.find("select#provincia2").parent());              
                        if(!f.find("select#provincia2").val()){
                                errorTxt += literal["datosFacturacion"][27];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#localidad2").parent());               
                        if(!f.find("input#localidad2").val()){
                                errorTxt += literal["datosFacturacion"][28];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#cp2").parent());              
                        if(!f.find("input#cp2").val()){
                                errorTxt += literal["datosFacturacion"][29];
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCodigoPostal(f.find("input#cp2").val())){
                                        errorTxt += literal["datosFacturacion"][30];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }
               
                }
               
                // datos de cursos
                nombresCursos = $(f.find(".nombreCurso"));
                cursos = $(f.find(".cursos"));
                cursos.each(function(i){               
                        cont = i + 1;                  
                        if(f.find("input#noc" + cont).is(":checked")){                 
                                nombreCurso = nombresCursos.eq(i).val();
                                parent = $(f.find("input#nombrec" + cont)).parent();           
                                if(!f.find("input#nombrec" + cont).val()){             
                                        errorTxt += literal["datosFacturacion"][32] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                                parent = $(f.find("input#apellidosc" + cont)).parent();        
                                if(!f.find("input#apellidosc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][33] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#profesionc" + cont)).parent();        
                                if(!f.find("input#profesionc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][34] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#telefonoc" + cont)).parent();         
                                if(!f.find("input#telefonoc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][35] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#emailc" + cont)).parent();    
                                if(!f.find("input#emailc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][36] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else{
                                        parent.removeClass("error");
                                        if(!regularExpressions.isValidEmail(f.find("input#emailc" + cont).val())){
                                                errorTxt += literal["datosFacturacion"][37] + " '" + nombreCurso + "' " + literal["obligatorio"];;
                                                parent.addClass("error");
                                        }else parent.removeClass("error");
                                }
                        }
                })
               
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosFacturacion"][31];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                                               
                if(errorTxt != ""){                            
                        f.find("fieldset legend").css("position","static");
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                        f.find("fieldset legend").css("position","absolute");
                }else return true;             
        },
        validaDatosFacturacionFormPart:function(obj){
                
                var errorTxt = nombreCurso = "";
                var f = $(obj);                        
                var radios = obj.find(":radio");                                               
                var cursos = nombresCursos = null;                     
                var cont = 0;  
                var parent = $(f.find("input#nombre").parent());               
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["datosFacturacion"][0];                    
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#apellido1").parent());        
                if(!f.find("input#apellido1").val()){
                        errorTxt += literal["datosFacturacion"][1];                    
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#nif").parent());
                if(!f.find("input#nif").val()){
                        errorTxt += literal["datosFacturacion"][3];                    
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNif(f.find("input#nif").val())){
                                errorTxt += literal["datosFacturacion"][4];                    
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                }

                parent = $(f.find("input#telefono").parent());         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["datosFacturacion"][6];                    
                        parent.addClass("error");
                }else if ( $(f.find( "input#telefono" ) ).val().length > 16 )
                    {
                        errorTxt += literal["datosFacturacion"][60];                    
                        parent.addClass("error"); 
                    }
                    else parent.removeClass("error");

                 parent = $(f.find("input#movil").parent());
                if ( ( $(f.find( "input#movil" ) ).val() != '' ) && ( $(f.find( "input#movil" ) ).val().length > 16 ) )
                    {
                        errorTxt += literal["datosFacturacion"][61];                    
                        parent.addClass("error"); 
                    }
               else parent.removeClass("error");
                
               
                parent = $(f.find(".direccion legend").eq(0).parent());
                if(!f.find("select#tipoV").val() || !f.find("input#dir1").val() || !f.find("input#num").val()){
                        errorTxt += literal["datosFacturacion"][10];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("select#provincia").parent());               
                if(!f.find("select#provincia").val()){
                        errorTxt += literal["datosFacturacion"][12];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#localidad").parent());        
                if(!f.find("input#localidad").val()){
                        errorTxt += literal["datosFacturacion"][13];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#cp").parent());               
                if(!f.find("input#cp").val()){
                        errorTxt += literal["datosFacturacion"][14];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esCodigoPostal(f.find("input#cp").val())){              
                                errorTxt += literal["datosFacturacion"][15];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               

                // datos de facturación
                if($("input#no").is(":checked")){              
                        parent = $(f.find("input#nombre2").parent());          
                        if(!f.find("input#nombre2").val()){
                                errorTxt += literal["datosFacturacion"][16];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#apellido12").parent());               
                        if(!f.find("input#apellido12").val()){
                                errorTxt += literal["datosFacturacion"][17];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        /*
                        parent = $(f.find("input#nif2").parent());
                        if(!f.find("input#nif2").val()){
                                errorTxt += literal["datosFacturacion"][18];                   
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esNif(f.find("input#nif2").val())){
                                        errorTxt += literal["datosFacturacion"][19];                   
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                       
                        }*/
                       parent = $(f.find("input#telefono2").parent());        
                        if(!f.find("input#telefono2").val()){
                                errorTxt += literal["datosFacturacion"][21];                   
                                parent.addClass("error");
                        } else if ( $(f.find( "input#telefono2" ) ).val().length > 16 )
                            {
                            errorTxt += literal["datosFacturacion"][210];                    
                            parent.addClass("error"); 
                            }                                                     
                            else parent.removeClass("error");

                        parent = $(f.find("input#movil2").parent());
                        if ( ( $(f.find( "input#movil2" ) ).val() != '' ) && ( $(f.find( "input#movil2" ) ).val().length > 16 ) )
                            {
                                errorTxt += literal["datosFacturacion"][211];                    
                                parent.addClass("error"); 
                            }
                       else parent.removeClass("error");
                       
                        parent = $(f.find(".direccion legend").eq(1).parent());
                        if(!f.find("select#tipoV2").val() || !f.find("input#dir12").val() || !f.find("input#num2").val()){
                                errorTxt += literal["datosFacturacion"][25];
                                parent.addClass("error");
                        }else parent.removeClass("error");                     
                        parent = $(f.find("select#provincia2").parent());              
                        if(!f.find("select#provincia2").val()){
                                errorTxt += literal["datosFacturacion"][27];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#localidad2").parent());               
                        if(!f.find("input#localidad2").val()){
                                errorTxt += literal["datosFacturacion"][28];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                        parent = $(f.find("input#cp2").parent());              
                        if(!f.find("input#cp2").val()){
                                errorTxt += literal["datosFacturacion"][29];
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCodigoPostal(f.find("input#cp2").val())){
                                        errorTxt += literal["datosFacturacion"][30];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }
               
                }
               
                // datos de cursos
                nombresCursos = $(f.find(".nombreCurso"));
                cursos = $(f.find(".cursos"));
                cursos.each(function(i){               
                        cont = i + 1;                  
                        if(f.find("input#noc" + cont).is(":checked")){                 
                                nombreCurso = nombresCursos.eq(i).val();
                                parent = $(f.find("input#nombrec" + cont)).parent();           
                                if(!f.find("input#nombrec" + cont).val()){             
                                        errorTxt += literal["datosFacturacion"][32] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                                parent = $(f.find("input#apellidosc" + cont)).parent();        
                                if(!f.find("input#apellidosc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][33] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#profesionc" + cont)).parent();        
                                if(!f.find("input#profesionc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][34] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#telefonoc" + cont)).parent();         
                                if(!f.find("input#telefonoc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][35] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else parent.removeClass("error");     
                                parent = $(f.find("input#emailc" + cont)).parent();    
                                if(!f.find("input#emailc" + cont).val()){
                                        errorTxt += literal["datosFacturacion"][36] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                        parent.addClass("error");
                                }else{
                                        parent.removeClass("error");
                                        if(!regularExpressions.isValidEmail(f.find("input#emailc" + cont).val())){
                                                errorTxt += literal["datosFacturacion"][37] + " '" + nombreCurso + "' " + literal["obligatorio"];
                                                parent.addClass("error");
                                        }else parent.removeClass("error");
                                }
                        }
                })
               
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosFacturacion"][31];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                                               
                if(errorTxt != ""){                            
                        f.find("fieldset legend").css("position","static");
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                        f.find("fieldset legend").css("position","absolute");
                }else return true;
        },
        validaDatosLoginForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                                        
                var parent = $(f.find("input#usuario").parent());              
                if(!f.find("input#usuario").val()){
                        errorTxt += literal["datosLogin"][0];                  
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#pass").parent());     
                if(!f.find("input#pass").val()){
                        errorTxt += literal["datosLogin"][1];                  
                        parent.addClass("error");
                }else parent.removeClass("error");             
               
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;     
       
        },
        validaDatosPagoForm:function(obj){     
                var errorTxt = "";
                var f = $(obj);                                        
                var radiosFormaPago = f.find("fieldset").eq(0).find(":checked");
   
                var radiosModalidadPago = f.find("fieldset").eq(1).find(":checked");
                var parent = $(f.find("legend").eq(0));
                var titular = banco = sucursal = control = cuenta = "";
                if(radiosFormaPago.length == 0){
                        errorTxt += literal["datosPago"][0];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                                               
                if($("input#domiciliacion:checked").length == 1){
                        titular = $(f.find("input#titular"));
                        sucursal = $(f.find("input#sucursal"));
                        banco = $(f.find("input#banco"));
                        control = $(f.find("input#control"));
                        cuenta = $(f.find("input#cuenta"));
                        parent = titular.parent();             
                        if(!titular.val()){
                                errorTxt += literal["datosPago"][1];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                       
                        parent = f.find("legend").eq(1).parent();                                      
                        if(!sucursal.val() || !banco.val() || !control.val() || !cuenta.val()){
                                errorTxt += literal["datosPago"][2];                   
                                parent.addClass("error");
                        }else if ( !validaLibreta( banco.val(), sucursal.val(), control.val(), cuenta.val() ) ){
                                errorTxt += literal["datosPago"][4];                           
                                parent.addClass("error");
                        }
                        else
                                parent.removeClass("error");
                }      
                /*
                parent = $(f.find("legend").eq(1));
                if(radiosModalidadPago.length == 0){           
                        errorTxt += literal["datosPago"][3];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                                */
               
                if(errorTxt != ""){                            
                        f.find("fieldset legend").css("position","static");
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                        f.find("fieldset legend").css("position","absolute");
                }else{
                	if($("input#transferencia:checked").length == 1){
                		_gaq.push(['_trackEvent', 'Forma de pago', 'Click', 'Transferencia']);
                	}
                	if($("input#credito:checked").length == 1){
                		_gaq.push(['_trackEvent', 'Forma de pago', 'Click', 'Tarjeta de crédito']);
                	}
                	if($("input#paypal:checked").length == 1){
                		_gaq.push(['_trackEvent', 'Forma de pago', 'Click', ' Paypal']);
                		
                	}
                	if($("input#domiciliacion:checked").length == 1){
                		_gaq.push(['_trackEvent', 'Forma de pago', 'Click', 'Domiciliación']);
                	}
                	return true;     
                }
                return true;
       
        },
        validaFormacionNauMemForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                                
                var mail1 = f.find("input#email");
                var mail2 = f.find("input#ConfEmail");
                var nif = f.find("input#nif");
                var cif = f.find("input#cif");
                var parent = $(f.find("select#ciudad").parent());                                              
                if(f.find("select#ciudad option:selected").val() == "0"){
                        errorTxt += literal["formacionNauMem"][0];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#numCliente").parent());                                               
                if(!f.find("input#numCliente").val()){
                        errorTxt += literal["formacionNauMem"][1];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#nomEmpresa").parent());                                               
                if(!f.find("input#nomEmpresa").val()){
                        errorTxt += literal["formacionNauMem"][2];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#nomAsistente").parent());                                             
                if(!f.find("input#nomAsistente").val()){
                        errorTxt += literal["formacionNauMem"][3];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(f.find("input#apeAsistente").parent());                                             
                if(!f.find("input#apeAsistente").val()){
                        errorTxt += literal["formacionNauMem"][4];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                if(nif.length != 0){
                        parent = $(nif.parent());                                              
                        if(!nif.val()){
                                errorTxt += literal["formacionNauMem"][13];                    
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esNif(nif.val())){
                                        errorTxt += literal["formacionNauMem"][14];                    
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }                                      
                }else{
                        parent = $(cif.parent());                                              
                        if(!cif.val()){
                                errorTxt += literal["formacionNauMem"][11];                    
                                parent.addClass("error");
                        }else{
                                parent.removeClass("error");
                                if(!regularExpressions.esCif(cif.val())){
                                        errorTxt += literal["formacionNauMem"][12];                    
                                        parent.addClass("error");
                                }else parent.removeClass("error");
                        }                                      
                }              
               
                parent = $(f.find("input#telefono").parent());                                         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["formacionNauMem"][5];                     
                        parent.addClass("error");
                }else parent.removeClass("error");
                parent = $(mail1.parent());            
                if(!mail1.val()){
                        errorTxt += literal["formacionNauMem"][6];                     
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(mail1.val())){
                                errorTxt += literal["formacionNauMem"][7];                     
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }                      
                parent = $(mail2.parent());                    
                if(!mail2.val()){              
                        errorTxt += literal["formacionNauMem"][8];                     
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(mail2.val())){
                                errorTxt += literal["formacionNauMem"][9];                     
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }                                      
                parent = $(mail2.parent());            
                if((mail1.val() != "" && mail2.val() != "") && (mail1.val() != mail2.val())){
                        errorTxt += literal["formacionNauMem"][10];                    
                        parent.addClass("error");
                }
               
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaDatosContactoInteForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                                                
                /*var parent = $(f.find("input#empresa").parent());                                            
                if(!f.find("input#empresa").val()){
                        errorTxt += literal["datosContactoInte"][0];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                */
                parent = $(f.find("input#nombre").parent());                                           
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["datosContactoInte"][1];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#apellido1").parent());                                        
                if(!f.find("input#apellido1").val()){
                        errorTxt += literal["datosContactoInte"][2];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#telefono").parent());                                         
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["datosContactoInte"][3];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#email").parent());                                                                            
                if(!f.find("input#email").val()){              
                        errorTxt += literal["datosContactoInte"][4];                   
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["datosContactoInte"][5];                   
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }                      
               
                parent = $(f.find("select#pais").parent());                                            
                if(f.find("select option:selected").val() == "0"){
                        errorTxt += literal["datosContactoInte"][6];                   
                        parent.addClass("error");
                }else parent.removeClass("error");             
                /*
                parent = $(f.find("input#condiciones").parent());                      
                if(f.find("input#condiciones:checked").length == 0){
                        errorTxt += literal["datosContactoInte"][7];                   
                        parent.addClass("error");
                }else parent.removeClass("error");
                */
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaRePassForm:function(obj){
                var errorTxt = "";
                var f = $(obj);                        
                var parent = $(f.find("input#email").parent());                                                                
                if(!f.find("input#email").val()){              
                        errorTxt += literal["rePass"][0];                      
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["rePass"][1];                      
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }                                                                      
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaFinCompraForm:function(obj){
               
                var errorTxt = "";
                var f = $(obj);                                                
                var parent = $(f.find("input#profesion").parent());                                            
                if(!f.find("input#profesion").val()){
                        errorTxt += literal["datosFinCompra"][0];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#cargo").parent());                                            
                if(!f.find("input#cargo").val()){
                        errorTxt += literal["datosFinCompra"][1];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#departamento").parent());                                             
                if(!f.find("input#departamento").val()){
                        errorTxt += literal["datosFinCompra"][2];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#numEmple").parent());                                                                         
                if(!f.find("input#numEmple").val()){           
                        errorTxt += literal["datosFinCompra"][3];                      
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#numEmple").val())){
                                errorTxt += literal["datosFinCompra"][4];                      
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                parent = $(f.find("select#especialidad").parent());                                            
                if(f.find("select#especialidad option:selected").val() == "0"){
                        errorTxt += literal["datosFinCompra"][5];                      
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("legend span"));     
                if(f.find(":checked").length == 0){
                        errorTxt += literal["datosFinCompra"][6];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
               
                if(errorTxt != ""){                            
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
               
        },
        validaCursoContabilidad:function(obj){
                var errorTxt = "";
                var f = $(obj);
                var parent = $(f.find("input#name").parent());
                if(!f.find("input#name").val()){
                        errorTxt += literal["cursosContabilidad"][0];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#surname").parent());
                if(!f.find("input#surname").val()){
                        errorTxt += literal["cursosContabilidad"][1];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#empresa").parent());
                if(!f.find("input#empresa").val()){
                        errorTxt += literal["cursosContabilidad"][2];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#telefono").parent());
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["cursosContabilidad"][3];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#telefono").val())){
                                errorTxt += literal["cursosContabilidad"][4];                  
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                parent = $(f.find("input#email").parent());                                                                            
                if(!f.find("input#email").val()){              
                        errorTxt += literal["datosContactoInte"][5];                   
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["cursosContabilidad"][6];                  
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                var parent = $(f.find("select#provincia").parent());
                if(f.find("select#provincia option:selected").val() == "0"){
                        errorTxt += literal["cursosContabilidad"][7];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("select#localidad").parent());
                if(f.find("select#localidad option:selected").val() == "0"){
                        errorTxt += literal["cursosContabilidad"][8];
                        parent.addClass("error");
                }else parent.removeClass("error");
                var parent = $(f.find("textarea#comentarios").parent());
                if(!f.find("textarea#comentarios").val()){
                        errorTxt += literal["cursosContabilidad"][9];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
               
                if(errorTxt != ""){
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaMasterContabilidad:function(obj){
                var errorTxt = "";
                var f = $(obj);
                var parent = $(f.find("input#name").parent());
                if(!f.find("input#name").val()){
                        errorTxt += literal["masterContabilidad"][0];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#surname").parent());
                if(!f.find("input#surname").val()){
                        errorTxt += literal["masterContabilidad"][1];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#telefono").parent());
                if(!f.find("input#telefono").val()){
                        errorTxt += literal["masterContabilidad"][2];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#telefono").val())){
                                errorTxt += literal["masterContabilidad"][3];                  
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                parent = $(f.find("input#email").parent());                                                                            
                if(!f.find("input#email").val()){              
                        errorTxt += literal["masterContabilidad"][4];                  
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["masterContabilidad"][5];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                var parent = $(f.find("select#nacionalidad").parent());
                if(f.find("select#nacionalidad option:selected").val() == "0"){
                        errorTxt += literal["masterContabilidad"][6];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("select#titulacion").parent());
                if(f.find("select#titulacion option:selected").val() == "0"){
                        errorTxt += literal["masterContabilidad"][7];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
               
                if(errorTxt != ""){
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaPeticionContacto:function(obj){
                var errorTxt = "";
                var f = $(obj);
                var parent = $(f.find("select#tematica").parent());
                if(f.find("select#tematica option:selected").val() == "0"){
                        errorTxt += literal["peticionContacto"][0];
                        parent.addClass("error");
                }else parent.removeClass("error");
                var parent = $(f.find("input#nombre").parent());
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["peticionContacto"][1];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#apellidos").parent());
                if(!f.find("input#apellidos").val()){
                        errorTxt += literal["peticionContacto"][2];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#email").parent());                                                                            
                if(!f.find("input#email").val()){              
                        errorTxt += literal["peticionContacto"][3];                    
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["peticionContacto"][4];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                var parent = $(f.find("input#phone").parent());
                if(!f.find("input#phone").val()){
                        errorTxt += literal["peticionContacto"][5];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#phone").val())){
                                errorTxt += literal["peticionContacto"][6];                    
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
               
                if(errorTxt != ""){
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
        validaPeticionPruebaProducto:function(obj){
                var errorTxt = "";
                var f = $(obj);
                var parent = $(f.find("select#tematica").parent());
                if(f.find("select#tematica option:selected").val() == "0"){
                        errorTxt += literal["peticionPruebaProducto"][0];
                        parent.addClass("error");
                }else parent.removeClass("error");
                var parent = $(f.find("input#nombre").parent());
                if(!f.find("input#nombre").val()){
                        errorTxt += literal["peticionPruebaProducto"][1];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                var parent = $(f.find("input#apellidos").parent());
                if(!f.find("input#apellidos").val()){
                        errorTxt += literal["peticionPruebaProducto"][2];
                        parent.addClass("error");
                }else parent.removeClass("error");
               
                parent = $(f.find("input#email").parent());                                                                            
                if(!f.find("input#email").val()){              
                        errorTxt += literal["peticionPruebaProducto"][3];                      
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.isValidEmail(f.find("input#email").val())){
                                errorTxt += literal["peticionPruebaProducto"][4];
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
                var parent = $(f.find("input#phone").parent());
                if(!f.find("input#phone").val()){
                        errorTxt += literal["peticionPruebaProducto"][5];
                        parent.addClass("error");
                }else{
                        parent.removeClass("error");
                        if(!regularExpressions.esNumero(f.find("input#phone").val())){
                                errorTxt += literal["peticionPruebaProducto"][6];                      
                                parent.addClass("error");
                        }else parent.removeClass("error");
                }
               
               
                if(errorTxt != ""){
                        formsValidations.setMsgError(errorTxt, f);
                        return false;
                }else return true;
        },
		validaOpinionForm:function(obj){
			var errorTxt = "";
			var f = $(obj);				
			
			if(!f.find("input[name=star1]:checked").val()){
				errorTxt += literal["opinionForm"][0];
			}
				
			if(!f.find("input[name=star2]:checked").val()){
				errorTxt += literal["opinionForm"][1];
			}
				
			if(!f.find("input[name=star3]:checked").val()){
				errorTxt += literal["opinionForm"][2];
			}
			
			var parent = $(f.find("textarea#opinion"));		
			if(!f.find("textarea#opinion").val()){
				errorTxt += literal["opinionForm"][3];			
				parent.addClass("error");
			}else parent.removeClass("error");
					
			if(errorTxt != ""){				
				formsValidations.setMsgError(errorTxt, f);			
				return false;
			}else return true;	
		},
		validaOlvideForm:function(obj){
			var errorTxt = "";
			var f = $(obj);
			
			var parent = $(f.find("input#email").parent());										
			if(!f.find("input#email").val()){		
				errorTxt += literal["peticionPruebaProducto"][3];			
				parent.addClass("error");
			}else{
				parent.removeClass("error");
				if(!regularExpressions.isValidEmail(f.find("input#email").val())){
					errorTxt += literal["peticionPruebaProducto"][4];
					parent.addClass("error");
				}else parent.removeClass("error");
			}
			
			if(errorTxt != ""){				
				formsValidations.setMsgError(errorTxt, f);			
				return false;
			}else return true;
		}
}

/* expresiones regulares para validar formularios */
var regularExpressions = {     
        isValidEmail:function (str){
                var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                return (filter.test(str));
        },
        esCadena:function(c) { return /^[0-9A-Za-z-\/Ññ?É?ÓÚáéíóúÜüÄäËë?ïÖö´,'/\\t\n\r\s]+$/.test(c); },
        esAlfabetico:function(c){return /^([a-zA-Z])+$/.test(c);},
        esNumero:function(c){return /^[0-9]+$/.test(c);},
        esTelefono:function(c){return /^[0-9\s\+\-)(]+$/.test(c)},
        esCodigoPostal:function(c){return /^([0-4]{1}[1-9]{1}|10|20|30|40|50|51|52)([0-9]{3})+$/.test(c);},
        esNif:function(c){
                if(!/^[0-9]{8}([A-Za-z]{1})$/.test(c)) return false
                var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';        
                return (c.substr(8,9).toUpperCase()==letras.charAt(c.substr(0,8)%23)) ;
        },
        esCif:function(c){
                /*if (!/^[A-Za-z0-9]{9}$/.test(c) || !/^[ABCDEFGHKLMNPQS]/.test(c)) return false;
                var v1 = new Array(0,2,4,6,8,1,3,5,7,9);
                var digCrtl=c.charAt(c.length-1);
                var temp = 0;
                for(i=2;i<=6;i+=2 ) {
                      temp = temp + v1[ parseInt(c.substr(i-1,1)) ];
                      temp = temp + parseInt(c.substr(i,1));
                };
                temp = temp + v1[ parseInt(c.substr(7,1)) ];                  
                temp = (10 - ( temp % 10));
                if( temp == 10 ){if(!(digCrtl=="J" || digCrtl=="0")) return false;
                }else{if(digCrtl!=temp) return false; }*/
                return true;
        }              
}


var navBar = {
        zIndexNumber:2000,
        history:null,
        fixZIndex:function(){
                var isIE = !jQuery.support.cssFloat;
                var obj = $("#navBar");
                var lis = obj.find("li");
                var _this = null;              
                lis.each(function(){                                           
                        _this = $(this);
                        _this.css('zIndex', navBar.zIndexNumber);
                        navBar.zIndexNumber -= 10;                                             
                })                             
                var wraps = obj.find("ul li ul");                              
                wraps.each(function(){ 
                        _this = $(this);                       
                        _this.bgiframe();              
                })                             
        },
        init:function(){
                var lis = $("#navBar > ul > li");
                var _this = null;              
                lis.each(function(){                                           
                        _this = $(this);
                        if(_this.find("ul").length != 0){                              
                                _this.find("a:first").click(function(){
                                        navBar.action(this);
                                        return false;
                                })
                        }
                })                             
        },
        action:function(obj){
                var parent = $(obj).parent();
                var ul = parent.find("ul");
                if(navBar.history != null){
                        navBar.history.toggleClass("sel");
                        navBar.history.find("ul").toggle("normal");
                }
                if(!parent.hasClass("sel")) parent.toggleClass("sel");
                ul.toggle("normal");           
                /*ul.hover(
                        function(){},
                        function(){ul.hide("normal")}  
                )*/
                navBar.history = parent;               
                /*$(function(){
                        ul.stop().animate({top:'26px'},{queue:false,duration:2000});
                });*/
        }

}

var behaviours = {

        datosPago:function(){
                var obj = $("input#domiciliacion");            
                var datos = null;
                var radios = $("#datosPagoForm fieldset").eq(0).find(":radio");        
                var radios2 = $("#datosPagoForm fieldset").eq(2).find(":radio");               
                var legends = $("#datosPagoForm legend span");
                datos = obj.parent().find(".datos");           
                tabla = $("#datosPagoForm table");
                radios.click(function(){
                        legends.css("position","static");
                        if($(this).attr("id") == "domiciliacion"){
                                 datos.removeClass("hide");
                        }else{
                                 datos.addClass("hide");
                        }
                        legends.css("position","absolute");
                })
                radios2.click(function(){
                        if($(this).attr("id") == "fraccionado") tabla.removeClass("disabled");
                        else tabla.addClass("disabled");
                })                             
                if($("input#domiciliacion").is(":checked")){
                        legends.css("position","static");
                        datos.toggleClass("hide");
                        legends.css("position","absolute");
                }                              
                if($("input#fraccionado").is(":checked")){             
                        $("input#fraccionado").parent().find("table").toggleClass("disabled");
                }
                       
        },
        datosFacturacion:function(){
                var obj = $("#datosFacturacionForm")
                var radios = obj.find(":radio");               
                var datosEnvio = obj.find("ul.datos").eq(1);
                var _this = datos = null;              


                var legends = obj.find("legend span");
                radios.click(function(){               
                        _this = $(this);
                        datos = _this.parent().parent().parent().next();
                       
                        if(_this.attr("name") != "personaContacto" && _this.attr("name") != "personaContacto2" && _this.attr("name") != "comoCompra"){                 
                                legends.css("position","static");                      
                                if(_this.val() == "no"){
                                        datos.removeClass("hide");
                                }else{
                                        datos.addClass("hide");
                                }
                                legends.css("position","absolute");
                        }
                })             
                radios.each(function(){
                        _this = $(this);
                        datos = _this.parent().parent().parent().next();                       
                        if(_this.is(":checked") && _this.val() == "no"){                               
                                legends.css("position","static");
                                datos.removeClass("hide");
                                legends.css("position","absolute");
                        }
                })     
        },
        olvidoPass:function(){
                var obj = $("span.olvido a");
                var f = $(".forgotPass");
                var cerrar = f.find(".volver a");
                obj.click(function(event){
                        f.toggle();
                        event.preventDefault();
                })                     
                cerrar.click(function(event){
                        f.toggle();
                        event.preventDefault();
                })                     
        },
        controlHeight:function(obj){
                var maxHeight = 0;
                $(obj).each(function(i){
                        $(this).css ({"height" : "auto"});
                        if ( $(this).outerHeight() > maxHeight)
                                maxHeight = $(this).outerHeight();
                });
                $(obj).each(function(i){ $(this).css ({"height" : maxHeight +"px"}); });
        },
        controlHeight2:function(obj, obj2){

			var maxHeight = 0;
			var hObj = obj.outerHeight();
			var hObj2 = obj2.outerHeight();
			var pObj = parseInt(obj.css("padding-top")) + parseInt(obj.css("padding-bottom"));
			var pObj2 = parseInt(obj2.css("padding-top")) + parseInt(obj2.css("padding-bottom"));
		
			if( hObj > hObj2){
				obj2.css ({"height" : (hObj-pObj2) + "px" });
			}else{
				obj.css ({"height" : (hObj2-pObj) + "px" });
			}
		},
		controlHeight3:function(obj, obj2){

			var maxHeight = 0;
			var hObj = obj.height();
			var hObj2 = obj2.height();
			var pObj = parseInt(obj.css("padding-top")) + parseInt(obj.css("padding-bottom"));
			var pObj2 = parseInt(obj2.css("padding-top")) + parseInt(obj2.css("padding-bottom"));
			
			if( hObj > hObj2){
				
				obj2.css ({"min-height" : (hObj) + "px" });
				
			}else{
				
				obj.css ({"min-height" : (hObj2) + "px" });
			}
				
			
		},
		valoraciones:function(){
			var mod = $("#modFichasPrecio .opinion .modValoraciones");
			var mod1 = $("#modFichasPrecio .opinion #mod.modValoraciones");
			var mod2 = $("#modFichasPrecio .opinion #mod2.modValoraciones");
			var mod3 = $("#modFichasPrecio .opinion #mod3.modValoraciones");
			var mas = $("#modFichasPrecio .opinion .modValoraciones .mas");
			var mas1 = $("#modFichasPrecio .opinion #mas.mas");
			var mas2 = $("#modFichasPrecio .opinion #mas2.mas");
			var mas3 = $("#modFichasPrecio .opinion #mas3.mas");
			
			mod.hide();
			mod.css("position", "absolute");
			
			mas1.bind('click',function(){
				mod.hide();
				mod1.show();
				return false;
			});
			mas2.bind('click',function(){
				mod.hide();
				mod2.show();
				return false;
			});
			mas3.bind('click',function(){
				mod.hide();
				mod3.show();
				return false;
			});
			mas.bind('click',function(){
				mod.hide();
				return false;
			});
			
			$(document).click(function(){
				mod.hide();				
			})
			
			
			
		}
}

var AjaxRequest = {
        load:function(obj,_url,cb,styles){
               
                var axis = obj.offset();
                var styles = styles || {position:"absolute",width:obj.width(),height:obj.height(),left:axis.left,top:axis.top,background:"#fff url(../images/ico_loading.gif) no-repeat center center"};                                               
                $.getJSON(_url, function(data) {
           
                        $(this).ajaxHidePreloader("load");                                             
                        obj.html(data.content[0].contenido.cont);
                        obj.show();
                        obj.css("visibility","visible");       
                        if(typeof(cb) != "undefined") eval(cb);                                                
            cestaCompra.init();
                });

        },
        load2:function(obj,_url,cb,styles){    
                var axis = obj.offset();
                var styles = styles || {position:"absolute",width:obj.width(),height:obj.height(),left:axis.left,top:axis.top,background:"#fff url(../images/ico_loading.gif) no-repeat center center"};                               
                $.ajax({
                        'url': _url,                   
                        'dataType': 'json',
                        'beforeSend': function(){{$(this).ajaxShowPreloader("load",styles)}},
                        'type': 'GET',
                        'success': function(data){
                                $(this).ajaxHidePreloader("load");                     
                                obj.html(data.content.results);
               /* $('.button').corner({
                    tl: { radius: 6 }, tr: { radius: 6 }, bl: { radius: 6 }, br: { radius: 6 }, antiAlias: true
                });*/
                                if( data.content.pos )
                                {
                                        $("#links_" + data.content.block_id + '_' + data.content.pos ).html( data.content.links );
                                        $("#actualpage_" + data.content.block_id + '_' + data.content.pos ).html( data.content.pag );
                                }
                                else
                                {
                                        $("#links_" + data.content.block_id ).html( data.content.links );
                                        $("#actualpage_" + data.content.block_id ).html( data.content.pag );
                                }
                                obj.show();
                                obj.css("visibility","visible");       
                                if(typeof(cb) != "undefined") eval(cb);        
                cestaCompra.init();                                    
                        }
                });
        },
        load3:function(obj,_url,cb,styles){
                var axis = obj.offset();
                var styles = styles || {position:"absolute",width:obj.width(),height:obj.height(),left:axis.left,top:axis.top,background:"#fff url(../images/ico_loading.gif) no-repeat center center"};                                               
                $.getJSON(_url, function(data) {
                        $(this).ajaxHidePreloader("load");                     
                        obj.html(data.content[0].contenido.cont);                      
                        obj.parent().parent().parent().find("h2").html(data.content[0].contenido.title);
                        obj.show();
                        obj.css("visibility","visible");       
                        if(typeof(cb) != "undefined") eval(cb);
             cestaCompra.init();                                                       
                });

        },
       
        carruselesLaterales:{
                content:'',
                url:'',        
                botones:null,
                enlaces:null,
                enlaces1 : null,
                enlaces2 :null,
                enlaces3 :null,
                actual:null,
                total:null,
               
                init:function(links){                                  
                        this.enlaces1 = '<span class="prev reset">anterior</span><a class="next" href="contenido-carruseles2.html">siguiente</a>';
                        this.enlaces2 = '<a class="prev" href="contenido-carruseles.html">siguiente</a><a class="next" href="contenido-carruseles2.html">siguiente</a>';
                        this.enlaces3 = '<a class="prev" href="contenido-carruseles.html">anterior</a><span class="next reset">siguiente</span>';                                              
                        AjaxRequest.carruselesLaterales.setEvents(links);      
                },
               
                setEvents:function(links){                                     
                        var _this = this;
                        var content = null;                    
                        this.botones = $(links);                                                                       
                        this.enlaces = $(this.botones.find(".pagination a"));
                        this.actual = parseInt(this.botones.find(".items .actual").html());
                        this.total = parseInt(this.botones.find(".items .total").html());
                        this.content = this.botones.parent().find(".wrapAjaxContent");                         
                        this.enlaces.unbind("click");
                        this.enlaces.bind("click", {content:_this.content, total:_this.total, botones:_this.botones, enlaces:_this.enlaces, actual:_this.actual}, function(event){
                               
                                AjaxRequest.carruselesLaterales.action($(this), event.data.content, links);
                                if($(this).hasClass("prev")){
                                        if(event.data.actual > 1){
                                                event.data.actual--;
                                                if(event.data.actual != 1){
                                                        event.data.botones.find(".pagination .items .actual").text(event.data.actual);
                                                        event.data.botones.find(".botones").empty();
                                                        event.data.botones.find(".botones").append(_this.enlaces2);
                                                }else{
                                                        event.data.botones.find(".pagination .items .actual").text(event.data.actual);
                                                        event.data.botones.find(".botones").empty();
                                                        event.data.botones.find(".botones").append(_this.enlaces1);
                                                }
                                        }
                                }else{
                                        if($(this).hasClass("next")){
                                                if(event.data.actual < event.data.total){
                                                        event.data.actual++;
                                                        if(event.data.actual != event.data.total){
                                                                event.data.botones.find(".pagination .items .actual").text(event.data.actual);
                                                                event.data.botones.find(".pagination .botones").empty();
                                                                event.data.botones.find(".botones").append(_this.enlaces2);
                                                        }
                                                        else{
                                                                event.data.botones.find(".pagination .items .actual").text(event.data.actual);
                                                                event.data.botones.find(".pagination .botones").empty();
                                                                event.data.botones.find(".botones").append(_this.enlaces3);
                                                        }
                                                       
                                                }
                                        }
                                }
                                return false;
                        })
                },
                success:function(){                                            
                        AjaxRequest.carruselesLaterales.setEvents(this.links);
                        var capaH = this.links;
                        capaH = $(capaH).parent().parent().parent().parent().find(".cont");
                        cestaCompra.init();
                        behaviours.controlHeight(capaH);                       
                },
                action:function(obj, content,links){                   
                        this.links = links;
                        //AjaxRequest.load (content,obj.attr("href"),"AjaxRequest.carruselesLaterales.setEvents('"+links+"')");
                        AjaxRequest.load2 (content,obj.attr("href"),"AjaxRequest.carruselesLaterales.success()");                      
                }
               
               
        },
        destacadoHome:{
                content:null,
                url:'',
                init:function(obj){
                        var contMenu = $(obj);
                        AjaxRequest.destacadoHome.content = contMenu.parent().find(".wrapAjaxContent");
                        contMenu.find("a").each(function(){
                                $(this).bind("click",function(){
                                        AjaxRequest.destacadoHome.action($(this));
                                        $(this).parent().parent().find(".sel").removeClass("sel");
                                        $(this).parent().addClass("sel");
                                        return false;
                                })
                        })
                },
                action:function(obj){
                        AjaxRequest.load3 (AjaxRequest.destacadoHome.content,obj.attr("href"), 'behaviours.controlHeight3($("#home #promocionPrimaria"), $("#home #formPrueba"));');
                }
        },
        modsGenericHome:{
                content:null,
                url:'',
                init:function(obj){
                        var contMenu = $(obj);
                        contMenu.find("a").each(function(){
                                $(this).bind("click",function(){
                                        AjaxRequest.modsGenericHome.content = contMenu.parent().find(".wrapAjaxContent");
                                        //alert(AjaxRequest.actualidadHome.content.html());
                                        AjaxRequest.modsGenericHome.action($(this));
                                        $(this).parent().parent().find(".sel").removeClass("sel");
                                        $(this).parent().addClass("sel");
                                        return false;
                                })
                        })
                },
                action:function(obj){
                        AjaxRequest.load (AjaxRequest.modsGenericHome.content,obj.attr("href"));
                }
        },
        novedadesHome:{
                content:null,
                url:'',
                init:function(obj){
                        var contMenu = $(obj);
                        contMenu.find("button").each(function(){
                                $(this).bind("click",function(){
                                        AjaxRequest.novedadesHome.content = contMenu.parent().find(".wrapAjaxContent");
                                        AjaxRequest.novedadesHome.action($(this));
                                        return false;
                                })
                        })
                },
                action:function(obj){
                        AjaxRequest.load (AjaxRequest.novedadesHome.content,obj.attr("href"));
                }
        }
       
}



var cestaCompra = {
        velocidad:20,
        divCarrito:false,
        volador:false,
        actualProductDiv:false,
        carrito_x:false,
        carrito_y:false,
        diffX:false,
        diffY:false,
        actualXPos:false,
        actualYPos:false,
        init:function(){
                var botones = $(".loQuiero");
                var _this = null;
                botones.each(function(){
                        _this = $(this);
                        _this.bind("click",function(){
                                cestaCompra.addToCesta($(this));
                $.get($(this).attr( 'href' ), function(data) {
                 
                      $("#infocesta").html( data.output );
                }, 'json');

                                return false;                  
                        })
                })     
        },
        addToCesta:function(obj){
        	
        		if(!this.divCarrito) this.divCarrito = $('.cesta');
            if(!this.volador){
           		this.volador = $("<div style='position:absolute'></div>");                     
               $("body").append(this.volador);
            }
            this.carrito_x = this.divCarrito.offset().left;
            this.carrito_y = this.divCarrito.offset().top;
            if(obj.parent().parent().hasClass("action")){
            	this.actualProductDiv = obj.parent().parent().parent().find(".producto");
            	
            }
            else if(obj.parent().hasClass("action")){
					this.actualProductDiv = obj.parent().parent().find(".producto");
				}else if( obj.parent().hasClass( 'clear' ) || $('#todasLasObras').length == 1 )
                    {
                        this.actualProductDiv = obj.parent().find(".producto");
                    }
                    else this.actualProductDiv = obj.parent().parent().find(".producto");
                
				
          		if( this.actualProductDiv.length != 0 )
        		{
                this.actualXPos = this.actualProductDiv.offset().left;
                this.actualYPos = this.actualProductDiv.offset().top;
                this.diffX = this.carrito_x - this.actualXPos;
                this.diffY = this.carrito_y - this.actualYPos;
                var shoppingContentCopy = this.actualProductDiv.clone(true);
                shoppingContentCopy.attr("id",'');
                this.volador.empty();
                this.volador.css("left",this.actualXPos + 'px');
                this.volador.css("top",this.actualYPos + 'px');
                this.volador.append(shoppingContentCopy);
                this.volador.css("display",'block');
                this.volador.width(this.actualProductDiv.outerWidth() + 'px');
                            cestaCompra.animar(obj);       
        		}

       
        },
        animar:function(obj){
                var maxDiff = Math.max(Math.abs(this.diffX),Math.abs(this.diffY));
                var moveX = (this.diffX / maxDiff) * this.velocidad;
                var moveY = (this.diffY / maxDiff) * this.velocidad;   
                this.actualXPos = this.actualXPos + moveX;
                this.actualYPos = this.actualYPos + moveY;
                this.volador.css("left", Math.round(this.actualXPos) + 'px');
                this.volador.css("top",  Math.round(this.actualYPos) + 'px');  
                if(moveX>0 && this.actualXPos > this.carrito_x){
                        this.volador.css("display",'none');            
                }              
                if(moveX<0 && this.actualXPos < this.carrito_x){                       
                        this.volador.css("display",'none');
                }
                
                if(this.volador.css("display") == 'block') setTimeout('cestaCompra.animar("' + obj + '")',10); 
        }
}

var tweets = {
		balloon:null,
		init:function(){
		this.balloon = $("#twitterpost div.balloon");
			display_tweet = 0;
			if($("li#tweet1")){
				setTimeout(function(){tweets.swap_tweets(display_tweet);}, 12000);
				var firstli = $("li#tweet0");
				setTimeout(function(){tweets.scroll_tweet(firstli);}, 7500);
			}
	},
	scroll_tweet:function(li){
		//alert('scroll_tweet');
        var post = li.children("div.post"),
        pWidth = post.width();

        if (pWidth > parseInt(this.balloon.css('width'))){
		
            var leftEnd = li.find('div.end');
            if(leftEnd.length === 0){
                leftEnd = $('<div class="end left" />').appendTo(li);
            } 
            var offsX = parseInt(leftEnd.width());
            post.animate({left: offsX - pWidth - 55}, 23000, 'linear', function(){post.css('left', offsX);});
        }
    },
    swap_tweets:function(current_tweet){
		//alert('swap_tweets');
        var next_tweet = (current_tweet + 1) % 5;
        var li = $("li#tweet" + next_tweet);

        $("#tweet" + current_tweet).fadeOut(300);
        setTimeout(function(){
            li.fadeIn(400);
         }, 400);

        setTimeout(function(){tweets.scroll_tweet(li);}, 3800);                

        display_tweet = next_tweet;
        setTimeout(function(){tweets.swap_tweets(display_tweet);}, 11300);
    }
        
    
	}


var lightbox = {
	inscribirme:function(){
	var enlace = $("#home_recursos #gridHome1 .listadoProfundidad #inscribirme");
		$(enlace).fancybox({
			'width':568, 
			'height':512,
			'padding':0,
			'type':'iframe'
		});
	
	},
    vervideo:function(){
        var enlace = $("#video");
        $(enlace).fancybox({
			'width':624, 
			'height':453,
			'padding':0,
			'type':'iframe'
        });        
    },
	vercondiciones:function(){
        var enlace = $("#condicionesligthBox");
        $(enlace).fancybox({
			'width':568, 
			'height':500,
			'padding':0,
			'type':'iframe'
        });        
    },
	opinar:function(){
        var enlace = $("#formOpinion");
        $(enlace).fancybox({
			'width':624, 
			'height':438,
			'padding':0,
			'type':'iframe'
        });        
    }
    

}
	
	


jQuery(document).ready(function() { 

   
        var aux = null;
        var isIE = !jQuery.support.cssFloat;
        if($("#categoriesTabs").length != 0) curves.categoriesTabs();
        if($("#navBar").length != 0){
                navBar.init(); 
        }
        curves.wrapSectionsFooter();
        if($("#home").length != 0) {
                curves.home.grid1();
                curves.home.modFormacion();
				tweets.init();
                //curves.home.modPrPrimario();
                //behaviours.controlHeight2($("#home #promocionPrimaria"), $("#home #formPrueba"));
                
        }
        
        if($(".homeMementos").length != 0) {
                curves.homeMementos.grid1();
                curves.home.modFormacion();
				tweets.init();
        }
       
        if($("#modAbonados").length != 0) {
                curves.addCurves("#modAbonados");                              
                curves.addCurves("#modAbonados .description");                                                                         
        }
       
        if($("#modFormacion2").length != 0) {
                curves.addCurves("#modFormacion2");                            
                curves.addCurves("#modFormacion2 .description");       
                curves.addCurves("#modFormacion2 .columnType1");
                curves.addCurves("#modFormacion2 .columnType2");
        }
       
        if($("#modFormacion").length != 0) {
                curves.addCurves("#modFormacion");                             
                curves.addCurves("#modFormacion .description");
                curves.addCurves("#modFormacion .columnType2");
        }
       
        if($("#gridWide").length != 0) {
                if($("#gridWide").attr("class") != "compraPaso2") curves.addCurves("#gridWide");               
                curves.addCurves("#gridWide .inner");          
        }
       
        if($("#listadoValores").length != 0) {
                curves.addCurves("#listadoValores > li");                                      
        }
       
        if($("#moduloDestacadoContenido").length != 0) {
                curves.addCurves("#moduloDestacadoContenido")          
        }
       
        if($("#subNavBar").length != 0) {
                curves.subNavBar();
        }
       
        if($("#listadoNotas").length != 0) {
                curves.addCurves("#listadoNotas > li");                                
        }
       
        if($("#listadoAreas").length != 0) {
                curves.addCurves("#listadoAreas > ul > li");
                curves.addCurves("#listadoAreas .otros");
        }
       
        if($("#todasLasObras").length != 0) {
                curves.addCurves("#gridType1");        
                curves.addCurves("#gridType1 .wrapColumn");            
                curves.addCurves("#gridType2");        
                curves.addCurves("#gridType2 .wrapColumn");                                            
                curves.addCurves("#gridType3 .columnType1");                           
                curves.addCurves("#gridType3 .columnType2");
                curves.addCurves(".divcarousel .columnType1");                         
                curves.addCurves(".divcarousel .columnType2");
                curves.addCurves(".divcarousel .wrapColumn");  
                curves.addCurves(".divcarousel2");                             
                curves.addCurves(".divcarousel2 .wrapColumn");
                curves.addCurves("#gridType4 .columnType1");                           
                curves.addCurves("#gridType4 .columnType2");                                           
                curves.addCurves("#gridType4 .wrapColumn");
                curves.addCurves("#gridType5");        
                curves.addCurves("#gridType5 .wrapColumn");            
        }
       
        if($("#modType2").length != 0) {
                curves.addCurves("#modType2");         
                curves.addCurves("#modType2 .description");                                            
        }
       
        if($("#modType3").length != 0) {
                curves.addCurves("#modType3");
                curves.addCurves("#modType3 .description");                                            
        }
       
        if($("#definirResultados").length != 0) {
                curves.addCurves("#definirResultados");                        
        }
       
        if($("#cestaPaso1").length != 0) {
                curves.addCurves("#gridType3 .columnType1");                           
                curves.addCurves("#gridType3 .columnType2");                                           
                curves.addCurves("#gridType3 .wrapColumn");            
        }
       
        if($("#busquedaAvanzadaForm").length != 0) {                           
                jQuery("#busquedaAvanzadaForm").submit(function(){return formsValidations.validaBusquedaAvanzadaForm( jQuery(this)) }) 
        }
       
        if($("#newsletterForm").length != 0) {                         
                jQuery("#newsletterForm").submit(function(){return formsValidations.validaNewsletterForm( jQuery(this)) })     
        }
       
        if($("#infoColectivos").length != 0) {                         
                jQuery("#infoColectivos").submit(function(){return formsValidations.validaInfoColectivos( jQuery(this)) })     
        }
       
        if($("#cursoContabilidad").length != 0) {                              
                jQuery("#cursoContabilidad").submit(function(){return formsValidations.validaCursoContabilidad( jQuery(this)) })       
        }
       
        if($("#masterContabilidad").length != 0) {                             
                jQuery("#masterContabilidad").submit(function(){return formsValidations.validaMasterContabilidad( jQuery(this)) })     
        }
       
        if($("#peticionContactoForm").length != 0) {                           
                jQuery("#peticionContactoForm").submit(function(){return formsValidations.validaPeticionContacto( jQuery(this)) })     
        }
       
        if($("#peticionPruebaProductoForm").length != 0) {                             
                jQuery("#peticionPruebaProductoForm").submit(function(){return formsValidations.validaPeticionPruebaProducto( jQuery(this)) }) 
        }
       
        if($("#datosUsuarioForm").length != 0) {                               
                jQuery("#datosUsuarioForm").submit(function(){return formsValidations.validaDatosUsuarioForm( jQuery(this)) }) 
        }
		
		if($("#datosUsuarioColectivo").length != 0) {                               
                jQuery("#datosUsuarioColectivo").submit(function(){return formsValidations.validaDatosUsuarioColectivo( jQuery(this)) }) 
        }
       
        if($("#datosLoginForm").length != 0) {                         
                jQuery("#datosLoginForm").submit(function(){return formsValidations.validaDatosLoginForm( jQuery(this)) })     
                jQuery("#rePassForm").submit(function(){return formsValidations.validaRePassForm( jQuery(this)) })     
                behaviours.olvidoPass();
        }
       
        if($("#datosFacturacionForm").length != 0) {   
                aux = $("#datosFacturacionForm");                      
                behaviours.datosFacturacion();
                if(aux.hasClass("empresa")){
                        aux.submit(function(){return formsValidations.validaDatosFacturacionFormEmpresa( jQuery(this)) })      
                }else if(aux.hasClass("contactoEmpresa")){             
                        if(aux.hasClass("particular")){        
                                aux.submit(function(){return formsValidations.validaDatosFacturacionFormPart( jQuery(this)) }) 
                        } else{
                                aux.submit(function(){return formsValidations.validaDatosFacturacionFormPartEmp( jQuery(this)) })      
                        }                                              
                }else{ 
                        aux.submit(function(){return formsValidations.validaDatosFacturacionForm( jQuery(this)) })     
                }
        }
       
        if($("#datosPago").length != 0) {                              
                behaviours.datosPago();
                jQuery("#datosPagoForm").submit(function(){return formsValidations.validaDatosPagoForm( jQuery(this)) })       
        }
       
        if($("#formacionNauMemForm").length != 0) {                                    
                jQuery("#formacionNauMemForm").submit(function(){return formsValidations.validaFormacionNauMemForm( jQuery(this)) })   
        }
       
        if($("#datosContactoInteForm").length != 0) {                                  
                jQuery("#datosContactoInteForm").submit(function(){return formsValidations.validaDatosContactoInteForm( jQuery(this)) })       
        }
       
        /*if($("#finCompraForm").length != 0) {                                
                jQuery("#finCompraForm").submit(function(){return formsValidations.validaFinCompraForm( jQuery(this)) })       
        }*/
       
       
                       
        if($("#cestaCompra").length != 0) {    
                curves.cestaCompra.precios();
                curves.cestaCompra.ventasCruzadas();
        }
       
        if($("#gridType6").length != 0) {      
                curves.addCurves("#gridType6 .columnType1");                           
                curves.addCurves("#gridType6 .columnType2");                                           
                curves.addCurves("#gridType6 .wrapColumn");                                    
        }
       
        if($("#gridType7").length != 0) {      
                curves.addCurves("#gridType7 .columnType1");                           
                curves.addCurves("#gridType7 .columnType2");                                           
                curves.addCurves("#gridType7 .wrapColumn");                                    
        }
               
        if($("#modColectivos").length != 0 && $("#home").length == 0) {                
                curves.addCurves("#modColectivos");                            
                curves.addCurves("#modColectivos .description");                                                               
        }
       
        if($(".fichas").length != 0) {                         
                curves.addCurves(".fichas #modFichasPrecio");
                curves.addCurves(".fichas #modFichasPrecio .info");
                curves.addCurves(".fichas #modFichasPrecio2 .info");
                curves.addCurves(".fichas #gridType3 .columnType1");
                curves.addCurves(".fichas #gridType3 .columnType2");
                curves.addCurves(".fichas #gridType3 .wrapColumn");
                curves.addCurves(".fichas .sideBar .columnType2");
                curves.addCurves(".fichas .sideBar .wrapColumn");
                curves.addCurves(".fichas .sideBar .info");
                curves.addCurves(".fichas .cursosRel");                        
                curves.addCurves(".fichas .cursosRel .description");
                curves.cestaCompra.precios();
        }
       
        if($("#novedades").length != 0) {                      
                curves.addCurves("#novedades");                        
                curves.addCurves("#novedades .description");                                                           
                curves.cestaCompra.precios();
        }
       
       
        if($("#tops .tabs").length != 0) curves.topsTabs();
       
        if($(".consultenosMod").length != 0) {                 
                curves.addCurves(".consultenosMod");                                                           
        }
       
        if($(".modType4 .tabs li").length != 0) curves.topsTabs2();
       
        if($(".modType4").length != 0) {
                curves.addCurves(".modType4");
                curves.addCurves(".modType4 .descripcion");                                                            
        }
       
        if($(".modType5 .tabs li").length != 0) curves.topsTabs3();
       
        if($(".modType5").length != 0) {
                curves.addCurves(".modType5");
                curves.addCurves(".modType5 .cursosRel .description");
        }
       
        if($("#moduloDestacadoContenido").length != 0) {
                curves.addCurves("#moduloDestacadoContenido .buscaCurso");                                             
        }
       
        if($(".columnType1 .flotante").length != 0){
                $(".columnType1 .flotante a").fancybox({
                        'width':500,
                        'height':300,
                        'type':'iframe'
                });
       
        }
       
        if ($(".carrousel ul.carrousel").length != 0){
                $(".carrousel ul.carrousel").jcarousel({ scroll: 3 });
        }
       
        if ($(".testimonio ul").length != 0){
                        $(".testimonio ul").jcarousel({ scroll: 1 });
        }
       
        if($("#modFormacion #tiposFormacion").length != 0){
                fixes.resizeContent();
        }
    /*
        if($(".slider").length != 0){
                sliders.accesos.init();
        }
       
        if($("#accesoMementos input").length != 0){                                    
                $("#accesoMementos input").click(function(){
                        cuentaChecks.init();
                });
        }*/
        if($("#home #promocionPrimaria .wrapAjaxContent").length != 0){
                AjaxRequest.destacadoHome.init("#promocionPrimaria .columnType2");
        }
        if($("#home #modActum .wrapAjaxContent").length != 0){
                AjaxRequest.modsGenericHome.init("#modActum #categoriesTabs .tabs");
        }
        if($("#home #modFormacion .wrapAjaxContent").length != 0){
                AjaxRequest.modsGenericHome.init("#modFormacion #tiposFormacion");
        }
        if($("#home .modNovedades .wrapAjaxContent").length != 0){
                AjaxRequest.novedadesHome.init(".modNovedades #modResultados");
        }
        if($("#todasLasObras #gridType1 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType1 .columnType1 .inner .options");
        }
        if($("#todasLasObras #gridType1 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType1 .columnType2 .inner .options");
        }
        if($("#todasLasObras #gridType2 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType2 .columnType1 .inner .options");
        }
        if($("#todasLasObras #gridType3 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona1 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona1 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona1 .columnType2 .inner .options").length != 0){     
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona1 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona2 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona2 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona2 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona2 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona3 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona3 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona3 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona3 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona4 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona4 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona4 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona4 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona5 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona5 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona5 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona5 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona6 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona6 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType3_zona6 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType3_zona6 .columnType2 .inner .options");
        }
       
        if($("#todasLasObras #gridType2_zona2 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType2_zona2 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType2_zona3 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType2_zona3 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType2_zona4 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType2_zona4 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType2_zona5 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType2_zona5 .columnType1 .inner .options");
        }
       
        if($("#todasLasObras #gridType4 .columnType2 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType4 .columnType2 .inner .options");
        }
        if($("#todasLasObras #gridType5 .columnType1 .inner .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#todasLasObras #gridType5 .columnType1 .inner .options");
        }
        if($("#novedades .busquedaCursos .options").length != 0){
                AjaxRequest.carruselesLaterales.init("#novedades .busquedaCursos .options");
        }
        if($("#modFormacion .formacionList2 li.curso").length != 0) {
                curves.addCurves("#modFormacion .formacionList2 li.curso");
        }
        if($("#modFormacion .formacionList2 li .modInt").length != 0) {
                curves.addCurves("#modFormacion .formacionList2 li .modInt");
        }
        /*if($("#todasLasObras #gridType3 .columnType1 .wrapAjaxContent").length != 0) {
                behaviours.controlHeight("#todasLasObras #gridType3 .columnType1 .wrapAjaxContent", "#todasLasObras #gridType3 .columnType2 .wrapAjaxContent" );
        }*/
        if($("#todasLasObras #gridType1 .cont").length != 0) {
                behaviours.controlHeight("#todasLasObras #gridType1 .cont");
               
        }
        if($("#todasLasObras #gridType3 .cont").length != 0) {
                behaviours.controlHeight("#todasLasObras #gridType3 .cont");
               
        }
        if($("#todasLasObras #gridType4 .cont").length != 0) {
                behaviours.controlHeight("#todasLasObras #gridType4 .cont");
               
        }
       /*
        if($("#home #gridHome1 .wrap").length != 0) {
                behaviours.controlHeight("#home #gridHome1 .wrap");    
        }*/
        
        if($(".homeMementos #gridHome1 .wrap").length != 0) {
			behaviours.controlHeight("#gridHome1 .wrap");
		}
       
        if($("#home #modNovedades .carrousel .multim").length != 0) {
                behaviours.controlHeight("#home #modNovedades .carrousel .multim");    
        }
        
        if($("#modFormacion .formacionList").length != 0){
				if($("#modFormacion .formacionList .file01").length != 0) {
					behaviours.controlHeight("#modFormacion .formacionList .file01 > .cont");
				}
				if($("#modFormacion .formacionList .file02").length != 0) {
					behaviours.controlHeight("#modFormacion .formacionList .file02 > .cont");
				}
			}
       
        /*if($("#home #gridHome2 #modDestacado").length != 0 && $("#home #gridHome2 #modActum").length != 0) {
                behaviours.controlHeight2($("#home #gridHome2 #modDestacados"), $("#home #gridHome2 #modActum"));       
        }*/
       
        if($("#form_inf_colectivo").length != 0) {
                $("#form_inf_colectivo .box").addClass("text");
                $("#form_inf_colectivo textarea").addClass("text");
                $("#form_inf_colectivo textarea").width("50%");
               
        }

    /* $('.button').corner({
             tl: { radius: 6 }, tr: { radius: 6 }, bl: { radius: 6 }, br: { radius: 6 }, antiAlias: true
     });
      */
	 
    /*$('.precioIva').corner({
       
        tl: { radius: 16 }, tr: { radius: 16 }, bl: { radius: 16 }, br: { radius: 16 }, antiAlias: false

    });
	*/
       
        if($(".loQuiero").length != 0) cestaCompra.init();
		
		
		
	if($("#casos").length != 0) {
		curves.addCurves("#gridType2");		
		curves.addCurves("#gridType2 .wrapColumn");						
	}	
		
		
	if($("#home_recursos #gridHome1 .listadoRecursos").length != 0) {	
		curves.addCurves("#home_recursos #gridHome1 .listadoRecursos .wrap");		
		curves.addCurves("#home_recursos #gridHome1 .listadoRecursos");			
	}	
		
	if($("#home_recursos #gridHome1 .columnType2 #modDestacado").length != 0) {	
		curves.addCurves("#home_recursos #gridHome1 .columnType2 #modDestacado .wrap");		
			
	
	}	
		
    if($("#home #gridHome2 #modDestacado").length != 0 && $("#home #gridHome2 #modActum").length != 0) {
		behaviours.controlHeight2($("#home #gridHome2 #modDestacados"), $("#home #gridHome2 #modActum"));
	}	
		
	if($("#home_recursos #gridHome1 .columnType2 #modEnlaces").length != 0) {	
		curves.addCurves("#home_recursos #gridHome1 .columnType2 #modEnlaces .wrap");		
	
	}
	
	if($("#home_recursos #gridHome1 .columnType2 #modExperiencia").length != 0) {	
		curves.addCurves("#home_recursos #gridHome1 .columnType2 #modExperiencia .wrap");		
	
	}
	
	if($("#home_recursos #gridHome1 .listadoProfundidad").length != 0) {	
		curves.addCurves("#home_recursos #gridHome1 .listadoProfundidad");			
	}
	
	if($("#home_recursos #gridHome1 .listadoProfundidad #inscribirme").length != 0) {	
		lightbox.inscribirme();
	}
	
    if( $("#video").length != 0 ) {
        lightbox.vervideo();
    }
     
	if( $("#condicionesligthBox").length != 0 ) {
        lightbox.vercondiciones();
    } 
	 
	if( $("#formOpinion").length != 0 ) {
        lightbox.opinar();
    }  
	 
	
	if($("#opinionForm").length != 0) {				
		jQuery("#opinionForm").submit(function(){return formsValidations.validaOpinionForm( jQuery(this)) })	
	}
	
	if($(".nuevaFicha .ofertaSus").length != 0) curves.addCurves2(".ofertaSus");
	if($(".fichas #modFichasPrecio2").length != 0) curves.addCurves(".fichas #modFichasPrecio2");
	if($(".opiniones .columnFrt").length != 0) curves.addCurves(".opiniones .columnFrt");
	
	if($("#modFichasPrecio .opinion .modValoraciones").length != 0) {
		behaviours.valoraciones("#modFichasPrecio .opinion .modValoraciones");
		curves.addCurves("#modFichasPrecio .opinion .modValoraciones");
	}
	
	if($("#datosOlvideForm").length != 0) {				
		jQuery("#datosOlvideForm").submit(function(){return formsValidations.validaOlvideForm( jQuery(this)) })	
	} 

    if($(".mediosPago").length != 0 && $(".modTwitter").length != 0) {	
	
		behaviours.controlHeight2($(".mediosPago"), $(".modTwitter"));
	} 
})


/**
* Outbound link tracking
*
* This code largely based on examples from
* [Google Analytics Help](http://www.google.com/support/googleanalytics/bin/answer.py?answer=55527).
*/
//para enlaces externos a efl.es

jQuery(function($){

    //Recorre todos los enlaces
    $("a").each(function(){
        var $a = $(this),
            hostname = $(this).prop('hostname'),
            arrHostname = ["www.efl.es", "formacion.efl.es", "espacioclientes.efl.es"],
            result = $.inArray(hostname,arrHostname);

        //Si el hostname del enlace es igual que alguno de los del array.
        //if (result != -1){ //<-- Descomentar para Produccion

 		if(hostname !== document.domain){ //Si el hostname (dominio) del enlace no es igual que el dominio, es externo
           $a.addClass("externo")
       }
 
        
        
    })

});

//para los pdfs
jQuery(function(){
    jQuery('a[href$=".pdf"]').click(function(){ 
            _gaq.push(['_trackEvent', 'Descargas', 'Pdf', this.href]);
    }) 
});

//para añadir a la cesta de la compra



jQuery(function(){
    jQuery('a[href*="'+ "basket/add" +'"]').click(function(){ 
        var precio =$('.ofertaSus span.precioNuevo').text().split("€")[0].replace(/,/g, ".");
		var productPrice = Math.round(precio.replace(/(?!\.)[\D\s]/g,"")); // 
        var nombreproducto = $(".subTit").parent().html().split("<")[0];    
        _gaq.push(['_trackEvent', 'AddtoBasket', 'Click', nombreproducto,productPrice]);
        
    }) 
});



$('a.externo').click(function(event){ //Trackea los externos
		// Just in case, be safe and don't do anything
		if (typeof _gat == 'undefined') {
			return;
		}
	
		// Stop our browser-based redirect, we'll do that in a minute
		event.preventDefault();
		var link = $(this);
		var href = link.attr('href');
		var noProtocol = href.replace(/http[s]?:\/\//, '');
		// Track the event
		_gat._getTrackerByName()._trackEvent('Enlace saliente', noProtocol);
 
		// Opening in a new window?
		if (link.attr('target') == '_blank') {
		/* If we are opening a new window, go ahead and open it now
		instead of in a setTimeout callback, so that popup blockers
		don't block it. */
			window.open(href);
		}
		else {
		/* If we're opening in the same window, we need to delay
		for a brief moment to ensure the _trackEvent has had time
		to fire */
		setTimeout('document.location = "' + href + '";', 100);
	}
});
