//<![CDATA[
  function setCookie(nombre, valor, tiempo){
    var dominio = window.location.hostname;
    var arr_dominio = dominio.split(".");
    while(arr_dominio.length > 2){ arr_dominio.shift(); }
    var dominio_principal = arr_dominio.join(".");
    var expiration = (new Date(2037, 12, 31)).toGMTString();
    var thecookie = nombre + " = " + escape(valor) + "; expires=" + expiration+"; path=/; domain=."+dominio_principal;
    document.cookie = thecookie;
  }

  function getCookie(nombre){
    var nombreCookie, valorCookie, cookie = null, cookies = document.cookie.split(';');
    for (i=0; i<cookies.length; i++){
      valorCookie = cookies[i].substr(cookies[i].indexOf('=') + 1);
      nombreCookie = cookies[i].substr(0,cookies[i].indexOf('=')).replace(/^\s+|\s+$/g, '');
      if (nombreCookie == nombre)
        cookie = unescape(valorCookie);
    }
    return cookie;
  }
  
  jQuery(document).ready(function(){
	  var msghtml='';
	  if( navigator.userAgent.indexOf( "AdobeAIR" ) < 0 )
	  {
		  if(!getCookie('msg')){
			  msghtml += '<div class="msg-cookie" id="msg-cookie">';
			  msghtml += '<div class="wrap">';
			  msghtml += '<p><strong>Política de cookies</strong></p>';
			  msghtml += '<p>Utilizamos cookies tanto propias como de terceros para evaluar la actividad general y el uso que se hace de nuestras Plataformas Online, mejorar su experiencia de navegación y ofrecerle información comercial personalizada.Si usted continua navegando, consideramos que acepta su uso. Puede cambiar la configuración y obtener más información haciendo clic </p>';
			  msghtml +='<a class="a2" id="hide-msg-cookie" href="/politica-de-cookies">aquí</a></p>';
			  //msghtml += '<ul>';
			  //msghtml += '<li><a class="a2 fancybox" id="hide-msg-cookie" href="'+literal['cookies'][1]+'" target="_blank">'+literal['cookies'][2]+'</a></li>';
			  //msghtml += '</ul>';
			  msghtml += '</div>';
			  msghtml += '</div>';
			jQuery("body").append(msghtml);
		  
		  var _h = $("#msg-cookie").outerHeight();
		  $("#wrapperFooter").css("margin-bottom",_h);
		  }
	  }
	  
	  jQuery("a").click(function(){
		  jQuery("#msg-cookie").hide();
		  setCookie('msg', 'hide', 'null');
	  });
  }); 
  //]]>
