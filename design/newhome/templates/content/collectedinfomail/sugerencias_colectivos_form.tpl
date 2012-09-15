{def $user = fetch( 'user', 'current_user')}
{def $colectivo = $user.contentobject.main_node.parent.object.name}

{set-block scope=root variable=subject}Formulario Sugerencias Colectivos{/set-block}
{set-block scope=root variable=email_sender}contacto@efl.es{/set-block}
{append-block scope=root variable=receivers}mourelle@efl.es{/append-block}
{append-block scope=root variable=receivers}iglesias@efl.es{/append-block}
{append-block scope=root variable=receivers}hurtado@efl.es{/append-block}
{append-block scope=root variable=receivers}dentici@efl.es{/append-block}
{append-block scope=root variable=receivers}breton@efl.es{/append-block}


FORMULARIO SUGERENCIAS COLECTIVOS:

Colectivo: {$colectivo}

{def $datos = fetch( 'basket', 'get_datos_usuario', hash( 'email', $user.contentobject.data_map.first_name.content ))}



Nombre y apellidos: {$datos.nombre} {$datos.apellido1} {$datos.apellido2}
Email: {$user.contentobject.data_map.first_name.content}


{foreach $collection.attributes as $attribute}
{$attribute.contentclass_attribute_name|wash()}:{attribute_result_gui view=info attribute=$attribute}
{/foreach}

