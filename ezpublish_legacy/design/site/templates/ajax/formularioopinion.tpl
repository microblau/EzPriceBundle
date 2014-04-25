<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Datos de Usuario - Ediciones Francis Lefebvre.</title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Metadatos para los buscadores -->
	<meta name="description" content="..." />
	<meta name="keywords" content="..." />
	<meta name="language" content="es" />
	<!-- Icono en la barra de la URL -->
	 <link rel="shortcut icon" href="favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/styles.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/design/site/stylesheets/jquery.rating.css" media="all" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" href="css/fixIE.css" /> 
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="css/fixIE6.css" />	
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/print.css" media="print" />
</head>
<body id="lightboxWrap">
	<div id="wrapper">
		<div id="bodyContent">
				<div id="videoLightbox" class="columnType1">
					<div id="modType2">
							<h1>Denos su opinión</h1>
							<div class="wrap clearFix">                    		
									<div class="description">
                                    	<div class="opinionForm">
                                            <p>Use este formulario para realizar una valoración y enviarnos su opinión acerca de la obra.</p>
                                            <p>Indique su valoración por cada uno de los siguientes criterios:</p>
                                            
{def $current_user=fetch( 'user', 'current_user' )}  
{def $node_id=$node.node_id} 
{def $user_id=$current_user.contentobject_id}
 
 
 {*if and($errors|count|ne(0), $exito|eq(0) )}
                <div class="msgError">
						<span>{'Lo sentimos, pero se han encontrado los siguientes errores'|i18n('comunes')}:</span>
						<ul>
							{foreach $errors as $error}
								<li>{$error}</label></li>
							{/foreach}
						</ul>
					</div>
   {/if*}
                                            
											 <form action="/producto/formularioopinion" method="post" id="opinionForm">
                                             <div class="opinion">
                                                <ul>
                                                    <li><span>Calidad</span>
                                                    {*<img src={"img_estrellas.gif"|ezimage()} alt="" class="frt" />
                                                    	<INPUT type="radio" name="calidad" value="1">1
													    <INPUT type="radio" name="calidad" value="2">2
                                                        <INPUT type="radio" name="calidad" value="3">3
                                                        <INPUT type="radio" name="calidad" value="4">4
                                                        <INPUT type="radio" name="calidad" value="5">5*}
														<div class="frt">
                                                                <input type="hidden" id="contentObject" name="contentObject" />
                                                                <input name="star1" type="radio" class="star1" value="1" /> 
                                                                <input name="star1" type="radio" class="star1" value="2" /> 
                                                                <input name="star1" type="radio" class="star1" value="3" /> 
                                                                <input name="star1" type="radio" class="star1" value="4" /> 
                                                                <input name="star1" type="radio" class="star1" value="5" /> 
                                                            </div> 
													</li>
                                                    <li><span>Actualizaciones</span>
                                                    {*<img src={"img_estrellas.gif"|ezimage()} alt="" class="frt" />
	                                                    <INPUT type="radio" name="actualizaciones" value="1">1
													    <INPUT type="radio" name="actualizaciones" value="2">2
                                                        <INPUT type="radio" name="actualizaciones" value="3">3
                                                        <INPUT type="radio" name="actualizaciones" value="4">4
                                                        <INPUT type="radio" name="actualizaciones" value="5">5*}
                                                    <div class="frt">
                                                                <input type="hidden" id="contentObject2" name="contentObject2" />
                                                                <input name="star2" type="radio" class="star2" value="1" /> 
                                                                <input name="star2" type="radio" class="star2" value="2" /> 
                                                                <input name="star2" type="radio" class="star2" value="3" /> 
                                                                <input name="star2" type="radio" class="star2" value="4" /> 
                                                                <input name="star2" type="radio" class="star2" value="5" /> 
                                                            </div> 
                                                    
                                                    </li>
                                                    <li><span>Facilidad de consulta</span>
                                                    {*<img src={"img_estrellas.gif"|ezimage()} alt="" class="frt" />
                                                        <INPUT type="radio" name="facilidad" value="1">1
													    <INPUT type="radio" name="facilidad" value="2">2
                                                        <INPUT type="radio" name="facilidad" value="3">3
                                                        <INPUT type="radio" name="facilidad" value="4">4
                                                        <INPUT type="radio" name="facilidad" value="5">5*}
                                                    <div class="frt">
                                                                <input type="hidden" id="contentObject3" name="contentObject3" />
                                                                <input name="star3" type="radio" class="star3" value="1" /> 
                                                                <input name="star3" type="radio" class="star3" value="2" /> 
                                                                <input name="star3" type="radio" class="star3" value="3" /> 
                                                                <input name="star3" type="radio" class="star3" value="4" /> 
                                                                <input name="star3" type="radio" class="star3" value="5" /> 
                                                            </div> 
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                           
                                            	<label for="opinion">En este formulario puede escribirnos su opinión sobre la obra:</label>
                                                <input type="hidden" name="node_id" id="node_id" value="{if $node_id|ne('')}{$node_id}{else}{$nodeid}{/if}" />
                                                <input type="hidden" name="user_id" id="user_id" value="{$user_id}" />
                                                <textarea id="opinion" name="opinion" class="text" cols="5" rows="5"></textarea>
                                               {* <span class="info">(Máximo xxx caracteres)</span> *}
                                            	<div class="clearFix">
   	                                            	<span class="submit frt">
                                                    <input type="image" src={"btn_enviar_opinion.gif"|ezimage()} alt="Enviar opinion" name="enviar"/>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>								
									</div>								                        											
							</div>
						
					</div>
		</div>		
		</div>
	</div>
 {literal}
    <script type="text/javascript" src="/design/site/javascript/jquery-1.3.1.js"></script>   	 
   <script type="text/javascript" src="/design/site/javascript/jquery.rating.js"></script>  
   <script type="text/javascript" src="/design/site/javascript/langEs.js"></script>
   <script type="text/javascript" src="/design/site/javascript/common.js"></script>

   <script type="text/javascript">
		$(function(){
		 $('.star1').rating({
		  callback: function(value, link){
		   // 'this' is the hidden form element holding the current value
		   // 'value' is the value selected
		   // 'element' points to the link element that received the click.            
			   
			   $(".star_group_star1 a").mouseout(function(){$("input[name=star1]").attr("checked", "checked");})
			  
		  }
		 });
		});	
		$(function(){ 
		 $('.star2').rating({
		  callback: function(value, link){
		   // 'this' is the hidden form element holding the current value
		   // 'value' is the value selected
		   // 'element' points to the link element that received the click.            
			  
			   $(".star_group_star2 a").mouseout(function(){$("input[name=star2]").attr("checked", "checked");})
			 
		  }
		 });
		});	
		$(function(){
		 $('.star3').rating({
		  callback: function(value, link){
		   // 'this' is the hidden form element holding the current value
		   // 'value' is the value selected
		   // 'element' points to the link element that received the click.            
			  
			   $(".star_group_star3 a").mouseout(function(){$("input[name=star3]").attr("checked", "checked");})
			   
		  }
		 });
		});													
	</script>
{/literal} 
</body>
</html> 
