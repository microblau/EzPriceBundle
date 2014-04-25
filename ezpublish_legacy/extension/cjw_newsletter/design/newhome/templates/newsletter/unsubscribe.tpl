<div id="modType2">
						<h1>Confirmación de baja del Boletín</h1>
                            
                         <div class="wrap clearFix curvaFondo">                    		
                            <div id="confirmacion" class="description">
                                <div class="cont">
                                    <p>                                  
                 {'Hola %name

Si quieres realmente darte de baja de nuestro Boletín de novedades confírmalo aquí.'|i18n( 'cjw_newsletter/unsubscribe','',
                                          hash( '%name', concat( $subscription.newsletter_user.first_name, ' ', $subscription.newsletter_user.last_name ),
                                                '%listName', $subscription.newsletter_list.name ) )|wash|nl2br}
                                         </p>               
           <p>                     
    <form method="post" action={concat('newsletter/unsubscribe/', $subscription.hash)|ezurl}>
        <input type="hidden" name="CancelUriInput" value="/" />
       <br /> 
        <input type="image" src="/design/site/images/btn_continuar.gif" alt="Confirmar" name="SubscribeButton" value="Enviar" id="send">
     </form>
    </p>                            
                                </div>								                        											
                            </div>																				
                        </div>
                        
                    </div>