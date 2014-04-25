{set-block scope=root variable=subject}Formulario de Contacto{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=receiver}actum@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}mjizquierdo@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}iglesias@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}crevillo@gmail.com{/append-block}
CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}

