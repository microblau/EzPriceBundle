{set-block scope=root variable=subject}Formulario Cursos RPSM SAGE{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=email_bcc_receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}iglesias@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}bsimon@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}defrancisco@efl.es{/append-block}
{append-block scope=root variable=email_bcc_receivers}marketingdespachos@sage.es{/append-block}
CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}


