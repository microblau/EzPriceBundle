{*?template charset=utf-8?*}{set-block variable=$subject scope=root}{ezini('NewsletterMailSettings', 'EmailSubjectPrefix', 'cjw_newsletter.ini')} {'Boletín electrónico de Ediciones Francis Lefebvre'|i18n( 'cjw_newsletter/subscription_confirmation' )}{/set-block}
{*
$newsletter_user
$hostname
*}
{def $subscriptionListString = ''}
{foreach $newsletter_user.subscription_array as $subscription}
{set $subscriptionListString = concat( $subscriptionListString, "\n- ", $subscription.newsletter_list.data_map.title.content|wash() )}
{/foreach}
{'Hola %name ,

hemos recibido correctamente su solicitud de suscripción al boletín electrónico de Ediciones Francis Lefebvre.
Por favor haga click en el siguiente enlace para activar su suscripción.

%configureLink

Gracias

'|i18n( 'cjw_newsletter/mail/subscription_confirmation',,
                                         hash( '%name', concat( $newsletter_user.first_name, ' ', $newsletter_user.last_name ),
                                               '%subscriptionList', $subscriptionListString,
                                               '%listName', $newsletter_list.name,
                                               '%configureLink', concat( 'http://', $hostname, concat( '/newsletter/configure/', cond( $newsletter_user, $newsletter_user.hash, '#' ),'?nooverride=1' )|ezurl(no) ),
                                                ) )}
{*include uri="design:newsletter/mail/footer.tpl"*}
