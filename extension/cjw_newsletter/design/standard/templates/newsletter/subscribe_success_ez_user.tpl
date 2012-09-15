{* subsribe_success_ez_user - if ez user has successfully subscribe to a newsletter

    $newsletter_user
    $mail_send_result
    $user_email_already_exists
    $subscription_result_array
    $back_url_input
*}



<div class="columnType1">
					<div id="modType2">

							
							 <h1>{'Newsletter - subscribe success'|i18n( 'cjw_newsletter/subscribe_success' )}</h1>

							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">

								<div class="contacte" >
							<p  class="newsletter-maintext">
        {'You are registered for our newsletter.'|i18n( 'cjw_newsletter/subscribe_success' )}
    </p>

    <p><a href="{$back_url_input}">{'back'|i18n( 'cjw_newsletter/subscribe_success' )}</a></p>
								</div>
							
						

                                                									
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
                
                    
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    
				</div>
                
			</div>
