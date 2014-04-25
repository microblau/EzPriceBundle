{set-block scope=root variable=subject}Formulario de Newsletter{/set-block}
{set-block scope=root variable=email_sender}newsletter@efl.es{/set-block}
{append-block scope=root variable=receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=receivers}iglesias@efl.es{/append-block}

CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}

