/*
CSS Browser Selector v0.5.0 (Jul 7, 2011)
Rafael Lima (http://rafael.adm.br)
http://rafael.adm.br/css_browser_selector
Ramin Gomari (http://saarblog.wordpress.com)
License: http://creativecommons.org/licenses/by/2.5/
Contributors: http://rafael.adm.br/css_browser_selector#contributors
*/
function css_browser_selector(u) {var ua = u.toLowerCase(),is = function(t) {return ua.indexOf(t) > -1},g = 'gecko',w = 'webkit',s = 'safari',o = 'opera',m = 'mobile',h = document.documentElement, b = [ (!(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua)) ? ('ie ie' + (/trident\/4\.0/i.test(ua) ? '8' : RegExp.$1)) : /firefox\/(\d+)\.?(\d*)/i.test(ua) && parseInt(RegExp.$1) >= 2 ? g + ' ff ff' + RegExp.$1 + (parseInt(RegExp.$2) > 0 ? ' ff' + RegExp.$1 + '_' + RegExp.$2 : '') : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.$1 : (/opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.$2 : '')) : is('konqueror') ? 'konqueror' : is('blackberry') ? m + ' blackberry' : is('android') ? m + ' android' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.$1 : '') : is('mozilla/') ? g : '', is('j2me') ? m + ' j2me' : is('iphone') ? m + ' iphone' : is('ipod') ? m + ' ipod' : is('ipad') ? m + ' ipad' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' + (is('windows nt 6.0') ? ' vista' : is('windows nt 5.1') || is('windows nt 5.2') ? ' xp' : '') : is('freebsd') ? 'freebsd' : (is('x11') || is('linux')) ? 'linux' : '', 'js'];c = b.join(' ');h.className += ' ' + c;return c;}css_browser_selector(navigator.userAgent);

var ohl = function(){

	var priv = {
		
		rwd: {
			logo:function(){
				var _src = "images/logo_desktop.png";
				$(".header .logo img").attr("src", _src);
			}
		},
		behaviours: {
			placeholder: function (obj) {
				var _this = obj;
				
				var $input = $("[placeholder]");
                $input.each(function (i) {
					var _this = $(this);
					_this.attr("value", $(this).attr("placeholder"));
					_this.addClass("placeholder");
					
					$(this).focus(function(e) {
                       var input = $(this);
                        if (input.val() == input.attr("placeholder")) {
                            input.val("");
                            input.removeClass("placeholder");
                        }
                    }).blur(function () {
                        var input = $(this);
                        if (input.val() == "" || input.val() == input.attr("placeholder")) {
                            input.addClass("placeholder");
                            input.val(input.attr("placeholder"));
                        }
                    })

                });
            },
			supports_input_placeholder:function() {
			 	var i = document.createElement('input');
			  	return 'placeholder' in i;
			},
			equalHeights:function(obj){
				/* 
				 * Function to set higher height to all children
				 * @param obj <jQuery Object> Object parent to search height childrens
				 * 
				 * Put all heights into an Array and get higher height
				*/
				var childs = $( obj ).children(),
						hs = [];
				childs.each(function(n){
					hs.push( $( this ).outerHeight() )
				})
				childs.height( Math.max.apply(Math, hs) )
			}
			
		},
		formsValidations: {
            regularExpressions: {

                isValidEmail: function (str) {
                    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                    return (filter.test(str));
                },
                esCadena: function (c) { return /^[0-9A-Za-z-\/Ññ?É?ÓÚáéíóúÜüÄäËë?ïÖö´,'/\\t\n\r\s]+$/.test(c); },
                esAlfabetico: function (c) { return /^([a-zA-Z])+$/.test(c); },
                esNumero: function (c) { return /^[0-9]+$/.test(c); },
                esTelefono: function (c) { return /^[0-9\s\+\-)(]+$/.test(c) },
				esMobile: function (c) { return /^[67]{1}[0-9]{8}$/.test(c) },
                esCodigoPostal: function (c) { return /^([0-4]{1}[1-9]{1}|10|20|30|40|50|51|52)([0-9]{3})+$/.test(c); },
                esCuenta: function (c) { return /^[0-9]{10}$/.test(c); },
				esCuentaCompleta: function (c) { return /^[0-9]{20}$/.test(c); },
                esDC: function (c) { return /^[0-9]{2}$/.test(c); },
                esEntidadOficina: function (c) { return /^[0-9]{4}$/.test(c); },
                esNif: function (c) {
                    if (!/^[0-9]{7,8}([A-Za-z]{1})$/.test(c)) return false
                    var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
                    return (c.substr(8, 9).toUpperCase() == letras.charAt(c.substr(0, 8) % 23) || c.substr(7, 8).toUpperCase() == letras.charAt(c.substr(0, 7) % 23));
                },esNie: function (c) {
					var temp = c.toUpperCase();
					if ((temp.length == 9)) {
						var cadenadni = "TRWAGMYFPDXBNJZSQVHLCKE";
						if( /^[T]{1}[A-Z0-9]{8}$/.test(temp)){
							if( c.charAt( 8 ) == /^[T]{1}[A-Z0-9]{8}$/.test(temp)){
								return true;
							}
							else{
								return false;
							}
						}
						//XYZ
						if( /^[XYZ]{1}/.test( temp )){
							temp = temp.replace( 'X','0')
							temp = temp.replace( 'Y','1' )
							temp = temp.replace( 'Z','2' )
							pos = temp.substring(0, 8) % 23;
	 
							if( c.toUpperCase().charAt( 8 ) == cadenadni.substring( pos, pos + 1 )){
								return true;
							}
							else{
								return false;
							}
						}
					}else return false;
				},
                esFecha: function (c) {
                    if (!/^([0-2]?[1-9]{1}|10|20|30|31)\/(0?[1-9]{1}|10|11|12)\/([0-9]{4})+$/.test(c)) return false;
                    var fch = c.split("/")
                    var bisiesto = ((fch[2] % 4 == 0 && fch[2] % 100 != 0) || (fch[2] % 400 == 0)) ? 29 : 28;
                    var diasMes = [31, bisiesto, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                    if (fch[0] > diasMes[fch[1] - 1]) return false;
                    return true;
                },
                esCif: function (c) {
                    if (!/^[A-Za-z0-9]{9}$/.test(c) || !/^[ABCDEFGHKLMNPQS]/.test(c)) return false;
                    var v1 = new Array(0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
                    var digCrtl = c.charAt(c.length - 1);
                    var temp = 0;
                    for (i = 2; i <= 6; i += 2) {
                        temp = temp + v1[parseInt(c.substr(i - 1, 1))];
                        temp = temp + parseInt(c.substr(i, 1));
                    };
                    temp = temp + v1[parseInt(c.substr(7, 1))];
                    temp = (10 - (temp % 10));
                    if (temp == 10) {
                        if (!(digCrtl == "J" || digCrtl == "0")) return false;
                    } else { if (digCrtl != temp) return false; }
                    return true;
                },
				esMayorEdad:function(c){
					var partes = c.split("/");
					var day = parseInt(partes[0], 10);
					var month = parseInt(partes[1], 10);
					var year = parseInt(partes[2], 10);
					var dateMin = new Date(new Number(year) + 18, month -1, day);
					var dateMax = new Date(new Number(year) + 65, month -1, day);

					var now = new Date();
					if (dateMin > now || dateMax < now) {
						return false;
					}else return true;
					
				},
				dcF:function(entidad, office, account){
					var part1 = "00" + entidad + office;
					var part2 = account;
					var num1 = priv.formsValidations.regularExpressions.calculaDC(part1);
					var num2 = priv.formsValidations.regularExpressions.calculaDC(part2);
					var _dc = num1.toString() + num2.toString();
					return _dc;
				},
				calculaDC:function (c) {
					 pesos = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
					 d = 0;
					 for (i=0; i<=9; i++) {
					   d += parseInt(c.charAt(i)) * pesos[i];
					 }
					 d = 11 - (d % 11);
					 if (d==11) d=0;
					 if (d==10) d=1;
					 return d;
				}
            },
            setMsgError: function (txt, form) {

                var parentForm = form.parent();
                var msgError = parentForm.find(".msgError");
                var divElement = (msgError.length != 0) ? msgError.eq(0) : document.createElement("div");
                var ulElement = document.createElement("ul");
                var liElement = null;
                var errors = txt.split("|");
                var msgConfirm = $(".msgConfirm");
                jQuery(divElement).attr("class", "msgError");
                jQuery(divElement).attr("tabIndex", "-1");

                if (jQuery(divElement).find("ul").length != 0) jQuery(divElement).empty();

                for (var i = 0; i < errors.length - 1; i++) {
                    liElement = document.createElement("li");
                    liElement.appendChild(document.createTextNode(errors[i]));
                    ulElement.appendChild(liElement);
                }

                jQuery(divElement).append(ulElement);
                //if (msgError.length == 0) form.before(jQuery(divElement));
                if (msgError.length == 0) form.before(jQuery(divElement));
                if (msgConfirm.length != 0) msgConfirm.remove();
                jQuery(divElement).focus();
				jQuery(divElement).blur();
            },
			validaContactForm: function (obj) {
                var f = $(obj),
					field = "",
					parent = "",
					errorTxt = "";
				field = $(f.find("input[id=name]"));
                parent = field.parent();
				
                if (field.length && field.val() == "") {
                    errorTxt += literal["name"];
                    parent.addClass("error");
                } else {
                    parent.removeClass("error");
                    if (!priv.formsValidations.regularExpressions.esCadena(field.val()) ) {
                        errorTxt += literal["name-format"];
                        parent.addClass("error");
                    } else parent.removeClass("error");
				}
				
				field = $(f.find("input[id=surname]"));
                parent = field.parent();
				
                if (field.length && field.val() == "") {
                    errorTxt += literal["surname"];
                    parent.addClass("error");
                } else {
                    parent.removeClass("error");
                    if (!priv.formsValidations.regularExpressions.esCadena(field.val()) ) {
                        errorTxt += literal["surname-format"];
                        parent.addClass("error");
                    } else parent.removeClass("error");
				}
				
				field = $(f.find("input[id=email]"));
                parent = field.parent();
				
                if (field.length && field.val() == "") {
                    errorTxt += literal["email"];
                    parent.addClass("error");
                } else {
                    parent.removeClass("error");
                    if (!priv.formsValidations.regularExpressions.isValidEmail(field.val())) {
                        errorTxt += literal["email-format"];
                        parent.addClass("error");
                    } else parent.removeClass("error");
                }
				
				field = $(f.find("textarea[id=message]"));
                parent = field.parent();
				if (field.length && field.val() == "") {
                    errorTxt += literal["message"];
                    parent.addClass("error");
                }else parent.removeClass("error");

          		
                if (errorTxt != "") {
                    priv.formsValidations.setMsgError(errorTxt, f);
                    return false;
                } else {                    
                    return true;}
            }
		
		}
		
	};

	var pub = {     

		init : function(){
			
			$("body").addClass("js");
			
			/*forms validations*/
			$("#contactForm").submit(function () { return priv.formsValidations.validaContactForm($(this)) });

			if($(window).width() >= 980){
				priv.rwd.logo();
			}
			
		}
		
		
	};
	
	return { // metodos que queramos devolver como públicos
		init: pub.init,
	}

}();

jQuery(document).ready(function() {
	ohl.init();
})