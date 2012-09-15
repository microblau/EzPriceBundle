{set-block scope=root variable=subject}Formulario de Formación Nautis/Mementix{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=email_bcc_receivers}defrancisco@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}bsimon@efl.es{/append-block}
CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}
