/*
 *
 * Copyright (c) 2006 Sam Collett (http://www.texotela.co.uk)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */

/*
 * Hides and adds a nice slide effect to bookmark icons
 *
 * @name     Share it!
 * @author   Joan Piedra (http://www.joanpiedra.com)
 * @example  $("a.bmarks-btn").shareitBtn();
 *
 */
jQuery.fn.shareitBtn = function()
{
	return this.click(
		function(){					
			var href = jQuery(this).attr('href');			
			var axis = jQuery(this).offset();
			var layerWidth = parseInt(jQuery(href).outerWidth());			
			if (axis.left + layerWidth > (document.body.clientWidth -20)){			
				jQuery(href).addClass("fixScreen");
			}
			jQuery(href).slideToggle(250);
			return false;
		}
	);
}


/*
 * Adds a tooltip effect to the icons
 *
 * @name     jThumbImg
 * @author   Joan Piedra (http://www.joanpiedra.com)
 * @example  $(".bmarks a").shareitHover();
 *
 */
jQuery.fn.shareitHover = function()
{
	return this.hover(
		function(){
			jQuery(this).find('img').each(function(){
				var alt = jQuery(this).attr('alt');
				var tip = jQuery(this).ancestors('.bmarks').find('.tip');
				tip.html(alt);
			});
		},
		function(){
			var tip = jQuery(this).ancestors('.bmarks').find('.tip');
			tip.html(tip.attr('title'));
		}
	);
}


/*
 * Initialization. Hides all divs and starts the tooltip effect
 *
 * @name     shareitInit
 * @author   Joan Piedra (http://www.joanpiedra.com)
 * @example  shareitInit();
 *
 */
var shareitInit = function() {
	jQuery('.bmarks').hide();
	jQuery('.tip').each(function(){
		jQuery(this).attr('title',jQuery(this).html());
	});	
}


/*
 * Start the script
 */
jQuery(document).ready(function(){
	shareitInit();
	$("a.bmarks-btn").shareitBtn();
});