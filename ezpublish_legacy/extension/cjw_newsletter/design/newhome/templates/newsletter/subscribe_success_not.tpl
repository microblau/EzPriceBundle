{* subsribe_success_no.tpl is shown after subscribtion to a newsletter list is failed

    $newsletter_user
    $mail_send_result
    $user_email_already_exists
    $subscription_result_array
    $back_url_input
*}
<div id="gridTwoColumnsTypeB" class="clearFix">


<div class="columnType1">
					<div id="modType2">

							
							<h1>{'Newsletter - subscribe unsuccessfull'|i18n( 'cjw_newsletter/subscribe_success_not' )}</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">

								<div class="contacte" >
								 <p>{'Please contact the system administrator'|i18n( 'cjw_newsletter/subscribe_success_not' )}</p>
                                 <p><a href="{$back_url_input}">{'back'|i18n( 'cjw_newsletter/subscribe_success_not' )}</a></p>
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
