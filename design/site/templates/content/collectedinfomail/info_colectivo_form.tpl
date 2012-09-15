{set-block scope=root variable=subject}Formulario de Información de Colectivo{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=email_bcc_receivers}clientes@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}hurtado@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}dentici@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}victor.aranda.iglesias@gmail.com{/append-block}
CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}

