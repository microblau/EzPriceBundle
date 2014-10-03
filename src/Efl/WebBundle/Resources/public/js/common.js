/*
 CSS Browser Selector js v0.5.3 (July 2, 2013)

 -- original --
 Rafael Lima (http://rafael.adm.br)
 http://rafael.adm.br/css_browser_selector
 License: http://creativecommons.org/licenses/by/2.5/
 Contributors: http://rafael.adm.br/css_browser_selector#contributors
 -- /original --

 Fork project: http://code.google.com/p/css-browser-selector/
 Song Hyo-Jin (shj at xenosi.de)
 */
function css_browser_selector(n){var b=n.toLowerCase(),f=function(c){return b.indexOf(c)>-1},h="gecko",k="webkit",p="safari",j="chrome",d="opera",e="mobile",l=0,a=window.devicePixelRatio?(window.devicePixelRatio+"").replace(".","_"):"1";var i=[(!(/opera|webtv/.test(b))&&/msie\s(\d+)/.test(b)&&(l=RegExp.$1*1))?("ie ie"+l+((l==6||l==7)?" ie67 ie678 ie6789":(l==8)?" ie678 ie6789":(l==9)?" ie6789 ie9m":(l>9)?" ie9m":"")):(/trident\/\d+.*?;\s*rv:(\d+)\.(\d+)\)/.test(b)&&(l=[RegExp.$1,RegExp.$2]))?"ie ie"+l[0]+" ie"+l[0]+"_"+l[1]+" ie9m":(/firefox\/(\d+)\.(\d+)/.test(b)&&(re=RegExp))?h+" ff ff"+re.$1+" ff"+re.$1+"_"+re.$2:f("gecko/")?h:f(d)?d+(/version\/(\d+)/.test(b)?" "+d+RegExp.$1:(/opera(\s|\/)(\d+)/.test(b)?" "+d+RegExp.$2:"")):f("konqueror")?"konqueror":f("blackberry")?e+" blackberry":(f(j)||f("crios"))?k+" "+j:f("iron")?k+" iron":!f("cpu os")&&f("applewebkit/")?k+" "+p:f("mozilla/")?h:"",f("android")?e+" android":"",f("tablet")?"tablet":"",f("j2me")?e+" j2me":f("ipad; u; cpu os")?e+" chrome android tablet":f("ipad;u;cpu os")?e+" chromedef android tablet":f("iphone")?e+" ios iphone":f("ipod")?e+" ios ipod":f("ipad")?e+" ios ipad tablet":f("mac")?"mac":f("darwin")?"mac":f("webtv")?"webtv":f("win")?"win"+(f("windows nt 6.0")?" vista":""):f("freebsd")?"freebsd":(f("x11")||f("linux"))?"linux":"",(a!="1")?" retina ratio"+a:"","js portrait"].join(" ");if(window.jQuery&&!window.jQuery.browser){window.jQuery.browser=l?{msie:1,version:l}:{}}return i}(function(j,b){var c=css_browser_selector(navigator.userAgent);var g=j.documentElement;g.className+=" "+c;var a=c.replace(/^\s*|\s*$/g,"").split(/ +/);b.CSSBS=1;for(var f=0;f<a.length;f++){b["CSSBS_"+a[f]]=1}var e=function(d){return j.documentElement[d]||j.body[d]};if(b.jQuery){(function(q){var h="portrait",k="landscape";var i="smartnarrow",u="smartwide",x="tabletnarrow",r="tabletwide",w=i+" "+u+" "+x+" "+r+" pc";var v=q(g);var s=0,o=0;function d(){if(s!=0){return}try{var l=e("clientWidth"),p=e("clientHeight");if(l>p){v.removeClass(h).addClass(k)}else{v.removeClass(k).addClass(h)}if(l==o){return}o=l}catch(m){}s=setTimeout(n,100)}function n(){try{v.removeClass(w);v.addClass((o<=360)?i:(o<=640)?u:(o<=768)?x:(o<=1024)?r:"pc")}catch(l){}s=0}if(b.CSSBS_ie){setInterval(d,1000)}else{q(b).on("resize orientationchange",d).trigger("resize")}})(b.jQuery)}})(document,window);

/*
 * Function viewport()
 *
 * Using this function to ask for width and height to avoid problems with different values
 * on mediaqueries and $(window).width()
 *
 * @return <Object> with two properties: 'width', and 'height'
 * 
 * http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
*/
function viewport(){
  var e = window,
      a = 'inner';
  if ( !( 'innerWidth' in window ) ) {
    a = 'client';
    e = document.documentElement || document.body;
  }
  return { width : e[ a+'Width' ] , height : e[ a+'Height' ] }
}

var EFL = function(){

	var priv = {
		
		rwd: {
			menu:function(){
        
        $( '.header' ).on( 'click', '.menu a', function(ev){
          ev.preventDefault();
          var $span = $(this).parent();

          $span.toggleClass( 'active' );
          $( '.main-menu' ).toggleClass( 'active' );

        })

      },
      filterTypes:function(){

        $( '.filter-types' ).on( 'click', '.menu a', function(ev){
          ev.preventDefault();
          var $span = $(this).parent();
          $span.toggleClass( 'active' );
          $( '.filter-types .wrap-filter' ).toggleClass( 'active' );
        })

      }
		},
    formsValidations: {
      regularExpressions: {
        isValidEmail: function (str) {
          var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
          return (filter.test(str));
        },
        esNombre: function (c) { return /^[a-zA-ZÀ-ÖØ-öø-ÿ]+?(( |-)[a-zA-ZÀ-ÖØ-öø-ÿ]+?)*$/.test(c); },
        esTelefono: function (c) { return /^[0-9\s\+\-)(]+$/.test(c) },
        esCodigoPostal: function (c) { return /^([0-4]{1}[1-9]{1}|10|20|30|40|50|51|52)([0-9]{3})+$/.test(c); },
      },
      setMsgError: function (txt, form, msgLayer) {
        var parentForm = form.parent();
            msgError = (msgLayer ===  undefined) ? parentForm.find( '.msg' ) : msgLayer.empty(),
            divElement = (msgError.length != 0) ? msgError.eq(0) : document.createElement( 'div' ),
            pElement = document.createElement( 'p' ),
            ulElement = document.createElement( 'ul' ),
            liElement = null,
            errors = txt.split( '|' ),
            msgConfirm = jQuery( '.msgConfirm' );
        
        jQuery(divElement).attr("class", "msg error");
        jQuery(divElement).attr("tabIndex", "-1");

        if ( jQuery( divElement ).find( 'ul' ).length != 0) jQuery( divElement ).empty();
        
        pElement.appendChild( document.createTextNode( literal['text-check'] ) )
        jQuery( pElement ).addClass( 'error' )
        for ( var i = 0; i < errors.length - 1; i++ ) {
            liElement = document.createElement( 'li' );
            liElement.appendChild( document.createTextNode( errors[i] ) );
            jQuery( liElement ).addClass( 'error' )
            ulElement.appendChild( liElement );
        }

        jQuery( divElement ).append( pElement ).append( ulElement );
        if ( msgError.length === 0 ) form.before( jQuery( divElement ) );
        if ( msgConfirm.length !== 0 ) msgConfirm.remove();
        jQuery( divElement ).parent().show(); // If parent() is hide
        jQuery( divElement ).show().focus();
        jQuery( divElement ).blur();
      }
    },
    promo:{
      behaviours:function(){
        var $body = $( 'body.promo' );
        if( $body.attr( 'data-url-img' ) !== '' ){

          $body.css({
            'background-image': 'url('+$body.attr( 'data-url-img' ) +')'
          })
        }
      }
    },
    formTest:{
      validate: function( obj ) {
        var f = jQuery( obj ),
            parent = '',
            errorTxt = '';

        /*
         * Set form fields into a variables for two reasons:
         * 1.- Caching fields
         * 2.- Fields ids can change
        */
        var $name = f.find( '#name' ),
            $surname = f.find( '#surname' ),
            $surname2 = f.find( '#surname2' ),
            $phone = f.find( '#phone' ),
            $email = f.find( '#email' ),
            $cp = f.find( '#cp' ),
            $legal = f.find( '#legal' );


        /*Name*/
        parent = jQuery( $name.parent() );
        if ( $name.length != 0 && !$name.val() ) {
            errorTxt += literal["name-req"];
            parent.addClass("error");
        } else parent.removeClass("error");

        /*Surname*/
        parent = jQuery( $surname.parent() );
        if ( $surname.length != 0 && !$surname.val() ) {
            errorTxt += literal["surname-req"];
            parent.addClass("error");
        } else parent.removeClass("error");

        /*Phone*/
        parent = jQuery( $phone.parent() );
        if ( $phone.length != 0 && !$phone.val() ) {
            errorTxt += literal["phone-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.esTelefono( $phone.val() ) ){
              errorTxt += literal["phone-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*Email*/
        parent = jQuery( $email.parent() );
        if ( $email.length != 0 && !$email.val() ) {
            errorTxt += literal["email-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.isValidEmail( $email.val() ) ){
              errorTxt += literal["email-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*CP*/
        parent = jQuery( $cp.parent() );
        if ( $cp.length != 0 && !$cp.val() ) {
            errorTxt += literal["cp-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.esCodigoPostal( $cp.val() ) ){
              errorTxt += literal["cp-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*Legal Conditions*/
        parent = jQuery( $legal.parent() );
        if ( $legal.length !== 0 ) {
            if ( !$legal.is(":checked") ){
                errorTxt += literal["legal"];
                parent.addClass("error");
            } else parent.removeClass("error");
        }

        if (errorTxt != "") {
            priv.formsValidations.setMsgError(errorTxt, f);
            return false;
        } else {                    
            return true;
        }

      }
    },
    formBuy:{
      behaviours: function(){
        var $billingPrivate = $( '#billing-customer-private' ),
            $billingBusiness = $( '#billing-customer-business' );

        $( '.frm-buy' ).on( 'change', '.billing-customer-private', function(){
          $( '.billing .row.private' ).show();
          $( '.billing .row.business' ).hide();
        })
        .on( 'change', '.billing-customer-business', function(){
          $( '.billing .row.private' ).hide();
          $( '.billing .row.business' ).show();
        })

        $( '.frm-buy' ).on( 'change', '.prelogin', function(){
          $( 'fieldset.signin' ).slideToggle();

        })
        .on( 'click', '.cancel-signin', function(ev){
          ev.preventDefault();
          $( 'fieldset.signin' ).slideUp(function(){
            $('.prelogin').prop( 'checked', false );
          });
        })

        $( '.frm-buy' ).on( 'click', '.shipping-is-billing', function(ev){
          ev.preventDefault();
          $( '.shipping-detail' ).slideToggle(function(){
            var $a = $( '.shipping-is-billing' );
            if( $a.text() === literal['shipping-address'] ){
              $a.text( literal['shipping-address-equal'] )
            }else{
              $a.text( literal['shipping-address'] )
            }
          });
          
        })
        .on( 'change', '.shipping-spain', function(){
          $( '.shipping .country-spain' ).show();
          $( '.shipping .country-other, .lbl-shipping-country-name' ).hide();
        })
        .on( 'change', '.shipping-other', function(){
          $( '.shipping .country-other, .lbl-shipping-country-name' ).show();
          $( '.shipping .country-spain' ).hide();
        })

        $( '.frm-buy' ).on( 'change', 'input[name="payment-method"]', function(){
          var $bank = $( 'fieldset.bank' );
          if( $(this).hasClass( 'payment-debit' ) ){
            $bank.slideDown();
          }else{
            $bank.slideUp();
          }
        })

        $( '.frm-buy').on( 'keyup', '#billing-email', function(){
          var $layer = $( '#layer-' + $(this).attr( 'id' ) );
          //Check versus regexp
          if( priv.formsValidations.regularExpressions.isValidEmail( $(this).val() ) ){
            if( $(this).val() === 'cesar.garcia@tantacom.com' ){
              //If layer is not visible, then show it
              if( !$layer.is( ':visible' )){
                $layer.show();
              }
            }else{
              $layer.hide();  
            }
          }else{
            $layer.hide();
          }
        })


      },
      validate: function( obj ) {
        var f = jQuery( obj ),
            parent = '',
            errorTxt = '';

        /*
         * Set form fields into a variables for two reasons:
         * 1.- Caching fields
         * 2.- Fields ids can change
        */
        var $name = f.find( '#name' ),
            $surname = f.find( '#surname' ),
            $surname2 = f.find( '#surname2' ),
            $phone = f.find( '#phone' ),
            $email = f.find( '#email' ),
            $cp = f.find( '#cp' ),
            $legal = f.find( '#legal' );


        /*Name*/
        parent = jQuery( $name.parent() );
        if ( $name.length != 0 && !$name.val() ) {
            errorTxt += literal["name-req"];
            parent.addClass("error");
        } else parent.removeClass("error");

        /*Surname*/
        parent = jQuery( $surname.parent() );
        if ( $surname.length != 0 && !$surname.val() ) {
            errorTxt += literal["surname-req"];
            parent.addClass("error");
        } else parent.removeClass("error");

        /*Phone*/
        parent = jQuery( $phone.parent() );
        if ( $phone.length != 0 && !$phone.val() ) {
            errorTxt += literal["phone-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.esTelefono( $phone.val() ) ){
              errorTxt += literal["phone-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*Email*/
        parent = jQuery( $email.parent() );
        if ( $email.length != 0 && !$email.val() ) {
            errorTxt += literal["email-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.isValidEmail( $email.val() ) ){
              errorTxt += literal["email-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*CP*/
        parent = jQuery( $cp.parent() );
        if ( $cp.length != 0 && !$cp.val() ) {
            errorTxt += literal["cp-req"];
            parent.addClass("error");
        } else {
          parent.removeClass("error");
          if ( !priv.formsValidations.regularExpressions.esCodigoPostal( $cp.val() ) ){
              errorTxt += literal["cp-format"];
              parent.addClass("error");
          } else parent.removeClass("error");
        }

        /*Legal Conditions*/
        parent = jQuery( $legal.parent() );
        if ( $legal.length !== 0 ) {
            if ( !$legal.is(":checked") ){
                errorTxt += literal["legal"];
                parent.addClass("error");
            } else parent.removeClass("error");
        }

        if (errorTxt != "") {
            priv.formsValidations.setMsgError(errorTxt, f);
            return false;
        } else {                    
            return true;
        }

      }
    },
		behaviours: {
      columns:function(){
        return false;
      },
      calendar:function(){
        $( '.frm-calendar' ).on( 'change', 'select#month', function(){
          $( '.listCalendar > li' ).show();
          $( '.listCalendar > li' ).not('#' + $(this).val() ).hide();
        })
      },
      sliderStatements:function(){
        if( $( '.home' ).length && $( '.statements' ).length ){
          $( '.statements' ).flexslider({
            animation: "slide",
            selector: ".slides > .statement-detail",
            directionNav: false,
            itemMargin: 100
          });
        }
      },
      filtersFrom:function(obj){
        var frm = obj;
        frm.find("select").each(function(){ 
          var $select = $(this); //Caching select
          if( !$select.hasClass( 'no-convert' ) ){
            $select.hide()
          
            var list = '<ul id="ul-'+$select.attr( 'id' )+'" class="'+$select.attr( 'class' )+'">';

            $select.find( 'option' ).each(function(){
              var $option = $(this);
              if( $option.attr('value') ){
                list += '<li';
                //If is selected element
                if( $option.is( ':selected' ) ){
                  list += ' class="selected" ';
                }
                list += '>';
                //If has icon
                if( $option.attr( 'data-ico' ) ){
                  list += '<i class="' + $option.attr( 'data-ico' ) + '"></i> ';
                }

                list += '<a href="#'+$option.attr( 'id' )+'">'+$option.text()+'</a></li>';
              }
            });

            list += '</ul>';
           
            $select.parent().append( list );

          }

        });

        //add class=selected in li filter when click on a
        $( '.frm-filter' ).on( 'click', 'li a', function(ev){
          ev.preventDefault();
          var _this = $(this),
              _li = _this.parent(),
              _ul = _li.parent(),
              _liSel = _ul.find( 'li.selected' ),
              _id = _ul.attr( 'id' ).split('-')[1],
              _href = _this.attr( 'href' ),
              _indSel = _liSel.index();

          if( !_ul.hasClass( 'dropdown' ) ){ //Is not dropdown
            _li.parent().find( '.selected' ).removeClass( 'selected' );
            frm.find( '#' + _id + " option:selected").removeAttr( 'selected' ); 
          }else{
            if( _ul.hasClass( 'unfolded' ) ){
              _li.parent().find( '.selected' ).removeClass( 'selected' );
              frm.find( '#' + _id + " option:selected").removeAttr( 'selected' ); 
            }
            _ul.toggleClass( 'unfolded' )
          }


          //Only if 'a' clicked not selected li
          if( _li.index() !== _indSel ){
            _li.addClass( 'selected' );
            frm.find( _href ).attr( 'selected' , 'selected');
          }


        })
        .on( 'submit', function(ev){ /*to check if send form data ok*/
          ev.preventDefault();
          console.log( frm.serialize() )
        })
      },
      customerServices:function(){
        if( !$( '.main .customerServices' ).length ){
          $( '.customerServices' ).appendTo( $( '#bodyContent .oneCol .main' ) )
        }
      },
      fancybox:{
        video:function(){
          if( $( '.fancybox.play' ).length ){
            $( '.fancybox.play' ).each(function(){
              $(this).fancybox({
                preload : true,
                padding : [0,0,0,0],
                maxWidth  : 580,
                maxHeight : 484,
                fitToView : false,
                width   : '70%',
                height    : '70%',
                autoSize  : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none'
              });
            })
          }
        },
        reviews:function(){
          if( $( '.fancybox.addReview' ).length ){
            $( '.fancybox.addReview' ).each(function(){
              $(this).fancybox({
                preload : true,
                padding : [0,0,0,0],
                maxWidth  : 580,
                maxHeight : 484,
                fitToView : false,
                width   : '70%',
                height    : '70%',
                autoSize  : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none'
              });
            })
          }
        }
      },
      loadVideo:function(){
        $( '.wrap-video' ).on( 'click', 'a.preview-video', function(ev){
          ev.preventDefault();
            var _url = $(this).attr( 'href' ),
                strHtml = '<iframe width="560" height="315" src="' + _url  + '" frameborder="0" allowfullscreen></iframe>';
            $( '#preview-video' ).html( strHtml );
        })
      },
      ratings:function(){
        $('.star1').rating({
          callback: function(value, link){
           // 'this' is the hidden form element holding the current value
           // 'value' is the value selected
           // 'element' points to the link element that received the click.            
            $(".star_group_star1 a").mouseout(function(){$("input[name=star1]").attr("checked", "checked");})
        
          }
        });
      },
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
      replaceWithImg:function(){
        var $fakeimg = $( '.replace-img' ),
            ln = $fakeimg.length;
        for (var i=0; i<ln; i++) {
          var src = $( $fakeimg[i] ).attr( 'data-src' ),
              css = $( $fakeimg[i] ).attr( 'class' ).replace( 'replace-img' , '' );
          
          $( $fakeimg[i] ).replaceWith( '<img src="' + src + '" class="' + css +'" />' )

        }
      },
      toggleMoreInfo:function(){
        $( '.more' ).on( 'click', 'a', function(ev){
          ev.preventDefault();
          var _this = $(this),
              $next = _this.next();
          $( _this.attr( 'href' ) ).slideToggle( 250, function(){
            var dataIcon = _this.attr( 'data-toggle-icon' ),
                open = _this.attr( 'data-open-text' ),
                close = _this.attr( 'data-close-text' ),
                icon;
            
            icon = ( dataIcon === undefined )? 'ico-arrow-top-blue': dataIcon
            _this.text( ( _this.text() === open )? close : open )
            
            $next.toggleClass( 'ico-arrow-bottom-blue ' + icon );
          });
        })
      },
      toggleFormTest:function(){
        var $callToAction = $( '.call-to-action' ),
            $claim = $( '.claim', $callToAction ),
            $btn = $( '.call-to-action > .btn' );
            $frm = $( '.wrap-frm-test', $callToAction )

        $callToAction.on( 'click', 'a.ask-test', function(ev){
          ev.preventDefault();
          $claim.hide();
          $btn.hide();
          $frm.show();
        })
      },
      showLayer:function(){
        // Search all layers and set fadeOut transition to close link
        $( document ).on( 'click', '.layer .close', function(e){
          e.preventDefault();
          $(this).parent().parent().fadeOut( 200 );
        })

        // Set fadeIn transition to layer related with their opener link
        $( document ).on( 'click', '.layer-trigger', function(e){
          e.preventDefault();
          var layer = $(this).attr( 'href' ),
              position = $(this).position(),
              _l = position.left,
              _t = position.top,
              _w = $(this).outerWidth(),
              _h = $(this).outerHeight(),
              _zI = 100;

          var $ico = $( $(this).attr( 'href' ) ).find( '.ico-arrow-top-layer' ),
              _wI = $ico.outerWidth(),
              _hI = $ico.outerHeight();

            $( '.wrap-layer' ).fadeOut( 200 );
            $( layer ).find('.layer').css({
              'top' : _t + _h + _hI
            });
            $( layer ).fadeIn( 200 );
              


          $ico.css({
            'display' : 'inline-block',
            'position' : 'absolute',
            'top' : _t + _h,
            'left' : (_l + (_w / 2)) - (_wI / 2) //Left of layer-trigger + half of width and minus half of icon width
          })
        })
      },
      tabs:{
        init:function(){
          var $tabs = $( '.mod-tabs' );

          if( !$tabs.hasClass( 'no-ajax' ) ){

            $( '.tab' ).on( 'click' , 'a' , function(ev){
              ev.preventDefault();
              var _this = $(this),
                  _href = _this.attr( 'href' );

              //Remove previous 'active' class
              $( '.tab, .tabs-content' ).removeClass( 'active' )
              
              //Set actual 'active' class
              _this.parent().addClass( 'active' );
              $( _href ).addClass( 'active' );
            })

          }
        },
        convertTabs:function(){
          /*
           * Function to convert p with 'tab' class into a tab list.
          */
          $( 'span.tabs-wrap' ).replaceWith( $( '<ul class="tabs-wrap"></ul>' ) );

          var $ul = $( '.tabs-wrap' ),
              tabLen = $( 'p.tab' ).length-1,
              i=0;

          for (i;i<=tabLen;i++) {
            var tab = $( 'p.tab' )[i]
                content = tab.innerHTML,
                css = $( tab ).attr( 'class' ),
                $tabLi = $('<li class="' + css + '">' + content + '</li>');
            
            $tabLi.appendTo( $ul );
          }
        }
      },
			equalHeights:function(obj, type){
				/* 
				 * Function to set higher height to all children
				 * @param obj <jQuery Object> Object parent to search height childrens
				 * 
				 * Put all heights into an Array and get higher height
				*/
       
        if( type === 'self' ){
          var currentTallest = 0,
              currentRowStart = 0,
              rowDivs = new Array(),
              $el,
              topPosition = 0;

          obj.each(function() {

            $el = $(this);
            topPostion = $el.position().top;
             
            if (currentRowStart != topPostion) {
              // we just came to a new row.  Set all the heights on the completed row
              for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
              }
              // set the variables for the new row
              rowDivs.length = 0; // empty the array
              currentRowStart = topPostion;
              currentTallest = $el.height();
              rowDivs.push($el);
            }else{
              // another div on the current row.  Add it to the list and check if it's taller
              rowDivs.push($el);
              currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
             
            // do the last row
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
              rowDivs[currentDiv].height(currentTallest);
            }
             
          });

        }else{
          var childs = $( obj ).children(),
              hs = [];
        
          childs.each(function(n){
            hs.push( $( this ).outerHeight() )
          })
          childs.height( Math.max.apply(Math, hs) )
        }
			}
			
		}
		
	};

	var pub = {     

		init : function(){
      var vp = viewport();
      

      if( vp.width >= 720 ) {
        priv.behaviours.customerServices();
        if( $( '.home' ).length ){
          $( '.mementos' ).insertAfter( $( '.related' ) )
        }
      }
      
      if( vp.width >= 768 ) {
        priv.behaviours.fancybox.video();
        priv.behaviours.fancybox.reviews();
        if( $( '.frm-filter' ).length ){
          priv.behaviours.filtersFrom( $( '.frm-filter' ) );
        }
      }

      
        if( $( '.listCalendar' ).length ){
          priv.behaviours.equalHeights( $( '.listCalendar > li' ), 'self' );
        }
      
      
      if( vp.width >= 980 ) {
        priv.behaviours.replaceWithImg();
        priv.behaviours.tabs.convertTabs();
        priv.behaviours.sliderStatements();
        if( $( '.home' ).length ){
          //$( '.mementos' ).appendTo( $( '#most .tabs-wrap-content > .wrapper' ) )
          $( '#most .tabs-wrap-content > .wrapper' ).append( $( '.mementos' ) )
        }
        if( $( 'body.promo' ).length ){
          priv.promo.behaviours();
        }

        if( $('html').hasClass('ie9') ){
          var ln = $( '.layout-3cols' ).length;
          for (var i=0; i<ln; i++){
            try{
              $( $( '.layout-3cols' )[i] ).columnize({ columns: 3, debug: 1 });
            }catch(e){
              console.error( 'Error on columnize: ' + e )
            }
          }
          
          ln = $( '.layout-2cols' ).length;
          for (var i=0; i<ln; i++){
            try{
              $( $( '.layout-2cols' )[i] ).columnize({ columns: 2, debug: 1 });
            }catch(e){
              console.error( 'Error on columnize: ' + e )
            }
          }
          
        }

      }


      if( vp.width < 980 ) {
        if( $( '.filter-types' ).length ){
          priv.rwd.filterTypes();
        }
      }

      /*Validation form test*/
      if( $( 'form.frm-test' ).length ){
        
        $( 'form.frm-test' ).submit(function (ev){
          ev.preventDefault();
          if( priv.formTest.validate( $(this) ) ){
            // TODO: Send form with AJAX
            // This is a fake response:
            var strResponse = '<p class="title-form">Gracias, hemos recibido su solicitud de prueba gratis correctamente.</p>';
            $(this).parent().html( strResponse );
          }
        });
      }
      
      if( $( '.frm-calendar' ).length ){
        priv.behaviours.calendar();
      }

      if( $( '.frm-test' ).length ){
        priv.behaviours.toggleFormTest();
      }

      if( $( '.frm-buy' ).length ){
        priv.formBuy.behaviours();
      }

      if( $( '.wrap-video' ).length ){
        priv.behaviours.loadVideo();
      }

      if( $( '.ratings' ).length ){
        priv.behaviours.ratings();
      }

      if( $( '.layer-trigger' ).length ){
        priv.behaviours.showLayer();
      }

      if( $( '.mod-tabs' ).length ) {
        priv.behaviours.tabs.init();
      }

      if( $( '.more' ).length ) {
        priv.behaviours.toggleMoreInfo();
      }

      $( 'a.print' ).on( 'click', function(ev){
        ev.preventDefault();
        window.print();
      })

      priv.rwd.menu();
		}
		
		
	};
	
	return { // metodos que queramos devolver como públicos
		init: pub.init,
	}

}();

jQuery(document).ready(function() {
	EFL.init();
})