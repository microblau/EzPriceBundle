{set-block scope=root variable=subject}
{if and(is_set($object.data_map.asunto), $object.data_map.asunto.has_content)}
	{$object.data_map.asunto.content}
	{else}
	Formulario de Prueba de Producto - acción comercial 9569
{/if}
{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=receiver}mjizquierdo@efl.es{/append-block}
{append-block scope=root variable=receiver}msandin@efl.es{/append-block}
{append-block scope=root variable=receiver}gaguiar@elderecho.com{/append-block}
{append-block scope=root variable=email_cc_receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}iglesias@efl.es{/append-block}
{append-block scope=root variable=email_cc_receivers}hurtado@efl.es{/append-block}
CAMPOS DEL FORMULARIO:

{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}

