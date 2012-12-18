<?php /* #?ini charset="utf8"?

[layout_rpsmsage]
Source=pagelayout.tpl
MatchFile=pagelayout_rpsm.tpl
Subdir=templates
Match[section]=17


[embed_file]
Source=content/view/embed.tpl
MatchFile=embed/file.tpl
Subdir=templates
Match[class_identifier]=file

[notas_relacionadas_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=notas_relacionadas_producto

[bases_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=bases_producto

[valoraciones_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=valoraciones_producto

[opiniones_clientes]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=opiniones_clientes


[testimonios_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=testimonios_producto

[faqs_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=faqs_producto

[novedades_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=novedades_producto

[actualizaciones_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=actualizaciones_producto

[sumario_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=sumario_producto

[condiciones_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=condiciones_producto

[ventajas_producto]
Source=node/view/full.tpl
MatchFile=full/producto_hijo.tpl
Subdir=templates
Match[class_identifier]=ventajas_producto

[quienessomosredirect]
Source=node/view/full.tpl
MatchFile=full/quienessomosredirect.tpl
Subdir=templates
Match[node]=88

[porquelefebvreredirect]
Source=node/view/full.tpl
MatchFile=full/porquelefebvreredirect.tpl
Subdir=templates
Match[node]=63

[colectivos_redirect]
Source=node/view/full.tpl
MatchFile=full/colectivos_redirect.tpl
Subdir=templates
Match[node]=1072

[fechas]
Source=node/view/full.tpl
MatchFile=full/fechas.tpl
Subdir=templates
Match[class_identifier]=fechas

[pagina_texto]
Source=node/view/full.tpl
MatchFile=full/pagina_texto.tpl
Subdir=templates
Match[class_identifier]=pagina_texto

[producto_imemento]
Source=node/view/full.tpl
MatchFile=full/producto_imemento.tpl
Subdir=templates
Match[class_identifier]=producto_imemento

[producto_nautis_4]
Source=node/view/full.tpl
MatchFile=full/producto_nautis_4.tpl
Subdir=templates
Match[class_identifier]=producto_nautis4

[producto]
Source=node/view/full.tpl
MatchFile=full/producto.tpl
Subdir=templates
Match[class_identifier]=producto

[producto_mementix]
Source=node/view/full.tpl
MatchFile=full/producto_mementix.tpl
Subdir=templates
Match[class_identifier]=producto_mementix

[producto_qmementix]
Source=node/view/full.tpl
MatchFile=full/producto_qmementix.tpl
Subdir=templates
Match[class_identifier]=producto_qmementix

[provincia_a_medida_colect]
Source=content/datatype/collect/ezstring.tpl
MatchFile=content/datatype/collect/provincia_formulario_a_medida.tpl
Match[class_identifier]=formulario_formacion_medida
Match[attribute_identifier]=provincia

[curso_a_medida_colect]
Source=content/datatype/collect/ezstring.tpl
MatchFile=content/datatype/collect/curso_a_medida.tpl
Match[class_identifier]=formulario_formacion_medida
Match[attribute_identifier]=curso

[colectivos_colect]
Source=content/datatype/collect/ezstring.tpl
MatchFile=content/datatype/collect/asociacion_colectivo.tpl
Match[class_identifier]=info_colectivo_form
Match[attribute_identifier]=asociacion_colectivo



[colectivos_prueba_producto]
Source=content/datatype/collect/ezstring.tpl
MatchFile=content/datatype/collect/colectivo.tpl
Match[class_identifier]=prueba_producto_form
Match[attribute_identifier]=colectivo

[catalogo_index]
Source=node/view/full.tpl
MatchFile=full/catalogo.tpl
Subdir=templates
Match[node]=61


[home]
Source=node/view/full.tpl
MatchFile=full/home.tpl
Subdir=templates
Match[node]=2

[hometext]
Source=node/view/full.tpl
MatchFile=full/home.tpl
Subdir=templates
Match[node]=10825


[colectivos]
Source=node/view/catalog.tpl
MatchFile=full/colectivos.tpl
Subdir=templates
Match[node]=166

[listado_productos_qmementix]
Source=node/view/full.tpl
MatchFile=full/listadoproductosqmementix.tpl
Subdir=templates
Match[node]=69
Match[class_identifier]=folder
Match[depth]=3

[listado_productos_imemento]
Source=node/view/full.tpl
MatchFile=full/listadoproductosimemento.tpl
Subdir=templates
Match[node]=11152
Match[class_identifier]=folder
Match[depth]=3

[listado_productos]
Source=node/view/full.tpl
MatchFile=full/listadoproductos.tpl
Subdir=templates
Match[section]=7
Match[class_identifier]=folder
Match[depth]=3

[subarea_productos_otros]
Source=node/view/full.tpl
MatchFile=full/subareaproductosotros.tpl
Subdir=templates
Match[node]=2258


[subarea_productos]
Source=node/view/full.tpl
MatchFile=full/subareaproductos.tpl
Subdir=templates
Match[section]=7
Match[class_identifier]=subhome
Match[depth]=4

[subhome_productos]
Source=node/view/full.tpl
MatchFile=full/subhomeproductos.tpl
Subdir=templates
Match[section]=7
Match[class_identifier]=subhome
Match[depth]=3

[producto_line]
Source=node/view/line.tpl
MatchFile=line/producto.tpl
Subdir=templates
Match[class_identifier]=producto

[producto_mementix_line]
Source=node/view/line.tpl
MatchFile=line/producto.tpl
Subdir=templates
Match[class_identifier]=producto_mementix

[producto_nautis_line]
Source=node/view/line.tpl
MatchFile=line/producto_nautis.tpl
Subdir=templates
Match[class_identifier]=producto_nautis

[producto_qmementix_line]
Source=node/view/line.tpl
MatchFile=line/producto_qmementix.tpl
Subdir=templates
Match[class_identifier]=producto_qmementix

[producto_imemento_line]
Source=node/view/line.tpl
MatchFile=line/producto_imemento.tpl
Subdir=templates
Match[class_identifier]=producto_imemento

[producto_nautis_relacionadoonline]
Source=node/view/relacionadoonline.tpl
MatchFile=relacionado/producto_nautis.tpl
Subdir=templates
Match[class_identifier]=producto_nautis

[producto_nautis_relacionado]
Source=node/view/relacionado.tpl
MatchFile=relacionado/producto_nautis.tpl
Subdir=templates
Match[class_identifier]=producto_nautis

[producto_nautis_full]
Source=node/view/full.tpl
MatchFile=full/producto_nautis.tpl
Subdir=templates
Match[class_identifier]=producto_nautis

[producto_nautis4]
Source=node/view/line.tpl
MatchFile=line/producto.tpl
Subdir=templates
Match[class_identifier]=producto_nautis4

[producto_qmementix_line]
Source=node/view/line.tpl
MatchFile=line/producto_qmementix.tpl
Subdir=templates
Match[class_identifier]=producto_qmementix

[curso_presencial]
Source=node/view/full.tpl
MatchFile=full/detallecurso.tpl
Subdir=templates
Match[class_identifier]=curso_presencial

[curso_distancia]
Source=node/view/full.tpl
MatchFile=full/detallecurso_distancia.tpl
Subdir=templates
Match[class_identifier]=curso_distancia

[curso_master]
Source=node/view/full.tpl
MatchFile=full/detallecurso_master.tpl
Subdir=templates
Match[class_identifier]=master

[curso_econference]
Source=node/view/full.tpl
MatchFile=full/detallecurso_econference.tpl
Subdir=templates
Match[class_identifier]=econferencia

[subhome_cursopresencial]
Source=node/view/full.tpl
MatchFile=full/subhomecursospresenciales.tpl
Subdir=templates
Match[node]=72

[subhome_cursodistancia]
Source=node/view/full.tpl
MatchFile=full/subhomecursospresenciales.tpl
Subdir=templates
Match[node]=73

[subhome_cursomedida]
Source=node/view/full.tpl
MatchFile=full/subhomecursospresenciales.tpl
Subdir=templates
Match[node]=74

[subhome_masters]
Source=node/view/full.tpl
MatchFile=full/subhomecursospresenciales.tpl
Subdir=templates
Match[node]=75

[subhome_cursopresencial_area]
Source=node/view/full.tpl
MatchFile=full/subhomecursospresenciales.tpl
Subdir=templates
Match[node]=472

[embed_image]
Source=content/view/embed.tpl
MatchFile=embed_image.tpl
Subdir=templates
Match[class_identifier]=image

[listado_valores]
Source=node/view/full.tpl
MatchFile=full/valores.tpl
Subdir=templates
Match[node]=81

[valor_valores]
Source=node/view/valores.tpl
MatchFile=valores/valor.tpl
Subdir=templates
Match[class_identifier]=valor

[valor_modulo_destacado]
Source=node/view/valores.tpl
MatchFile=valores/modulo.tpl
Subdir=templates
Match[class_identifier]=modulo_destacado

[pagina_porque]
Source=node/view/full.tpl
MatchFile=full/pagina_porque.tpl
Subdir=templates
Match[class_identifier]=folder
Match[section]=9

[pagina_accesoabonados]
Source=node/view/full.tpl
MatchFile=full/pagina_accesoabonados.tpl
Subdir=templates
Match[node]=1058


[pagina_acceso]
Source=node/view/full.tpl
MatchFile=full/pagina_acceso.tpl
Subdir=templates
Match[class_identifier]=pagina_acceso

[notas_prensa]
Source=node/view/full.tpl
MatchFile=full/notas_prensa.tpl
Subdir=templates
Match[node]=92

[contacto]
Source=node/view/full.tpl
MatchFile=full/contacto.tpl
Subdir=templates
Match[node]=1073

[preguntas_frecuentes]
Source=node/view/full.tpl
MatchFile=full/preguntas_frecuentes.tpl
Subdir=templates
Match[node]=80

[preguntas_frecuentes_categoria]
Source=node/view/full.tpl
MatchFile=full/preguntas_frecuentes.tpl
Subdir=templates
Match[class_identifier]=categoria_faq

[quienes-somos]
Source=node/view/full.tpl
MatchFile=full/quienes-somos.tpl
Subdir=templates
Match[class_identifier]=folder
Match[section]=10

[formulario_informacion_colectivo]
Source=node/view/full.tpl
MatchFile=full/formulario_informacion_colectivo.tpl
Subdir=templates
Match[class_identifier]=info_colectivo_form

[formulario_informacion_colectivo_resultado]
Source=content/collectedinfo/info_colectivo_form.tpl
MatchFile=full/formulario_informacion_colectivo.tpl
Subdir=templates

[formulario_formacion_a_medida]
Source=node/view/full.tpl
MatchFile=full/formulario_formacion_a_medida.tpl
Subdir=templates
Match[class_identifier]=formulario_formacion_medida

[formulario_newsletter]
Source=node/view/full.tpl
MatchFile=full/formulario_newsletter.tpl
Subdir=templates
Match[class_identifier]=newsletter_form

[formulario_newsletter_resultado]
Source=content/collectedinfo/newsletter_form.tpl
MatchFile=full/formulario_newsletter.tpl
Subdir=templates

[formulario_contacto]
Source=node/view/full.tpl
MatchFile=full/formulario_contacto.tpl
Subdir=templates
Match[class_identifier]=contacto_form

[formulario_contacto_resultado]
Source=content/collectedinfo/form.tpl
MatchFile=full/formulario_contacto.tpl
Subdir=templates

[formulario_prueba_producto]
Source=node/view/full.tpl
MatchFile=full/formulario_prueba_producto.tpl
Subdir=templates
Match[class_identifier]=prueba_producto_form

[formulario_prueba_producto_resultado]
Source=content/collectedinfo/prueba_producto_form.tpl
MatchFile=full/formulario_prueba_producto.tpl
Subdir=templates

[formulario_prueba_producto_resultado_qmementix]
Source=content/collectedinfo/prueba_producto_qmementix_form.tpl
MatchFile=full/formulario_prueba_producto.tpl
Subdir=templates

[formulario_prueba_producto_resultado_imemento]
Source=content/collectedinfo/prueba_producto_imemento_form.tpl
MatchFile=full/formulario_prueba_producto.tpl
Subdir=templates

[formulario_formacion_nautis_mementix]
Source=node/view/full.tpl
MatchFile=full/formulario_formacion_nautis_mementix.tpl
Subdir=templates
Match[class_identifier]=formacion_nautis_mementix_form

[formulario_formacion_nautis_mementix_resultado]
Source=content/collectedinfo/formacion_nautis_mementix_form.tpl
MatchFile=full/formulario_formacion_nautis_mementix.tpl
Subdir=templates

[formulario_contacto_formacion]
Source=node/view/full.tpl
MatchFile=full/formulario_contacto.tpl
Subdir=templates
Match[class_identifier]=contacto_formacion_form

[formulario_contacto_formacion_resultado]
Source=content/collectedinfo/contacto_form.tpl
MatchFile=full/formulario_contacto.tpl
Subdir=templates

[formulario_sugerencias_colectivos]
Source=node/view/full.tpl
MatchFile=full/formulario_sugerencias_colectivos.tpl
Subdir=templates
Match[class_identifier]=sugerencias_colectivos_form

[formulario_sugerencias_colectivos_resultado]
Source=content/collectedinfo/sugerencias_colectivos_form.tpl
MatchFile=full/formulario_sugerencias_colectivos.tpl
Subdir=templates

[full_ReallySimpleSyndication]
Source=node/view/full.tpl
MatchFile=full/rsspage.tpl
Subdir=templates
Match[node]=5140

[recursospsm]
Source=node/view/full.tpl
MatchFile=full/rpsm_home.tpl
Subdir=templates
Match[node]=6468

[recursospsm_sabermas]
Source=node/view/full.tpl
MatchFile=full/rpsm_sabermas.tpl
Subdir=templates
Match[node]=6495

[formulario_inscripcion_rpsm]
Source=node/view/full.tpl
MatchFile=full/formulario_inscripcion_rpsm.tpl
Subdir=templates
Match[class_identifier]=inscripcion_rpsm_form

[formulario_inscripcion_rpsm_resultado]
Source=content/collectedinfo/inscripcion_rpsm_form.tpl
MatchFile=full/formulario_inscripcion_rpsm.tpl
Subdir=templates

[recursospsm_rss]
Source=node/view/full.tpl
MatchFile=full/rpsm_rss.tpl
Subdir=templates
Match[node]=6475

[recursospsm_casos_exito]
Source=node/view/full.tpl
MatchFile=full/rpsm_casos_exito.tpl
Subdir=templates
Match[node]=6488

[recursospsm_video_guias]
Source=node/view/full.tpl
MatchFile=full/rpsm_video_guias.tpl
Subdir=templates
Match[node]=6496

[rpsm_encuesta]
Source=node/view/full.tpl
MatchFile=full/rpsm_encuesta.tpl
Subdir=templates
Match[class_identifier]=encuesta_rpsm

[recursospsm_novedades]
Source=node/view/full.tpl
MatchFile=full/rpsm_novedades.tpl
Subdir=templates
Match[node]=6520

[formulario_upgrade_rpsm]
Source=node/view/full.tpl
MatchFile=full/formulario_upgrade_rpsm.tpl
Subdir=templates
Match[class_identifier]=upgrade_rpsm_form

[formulario_upgrade_rpsm_resultado]
Source=content/collectedinfo/inscripcion_rpsm_form.tpl
MatchFile=full/formulario_upgrade_rpsm.tpl
Subdir=templates

[sage_recursospsm]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_home.tpl
Subdir=templates
Match[node]=9577

[sage_recursospsm_sabermas]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_sabermas.tpl
Subdir=templates
Match[node]=9605

[sage_formulario_inscripcion_rpsm]
Source=node/view/full.tpl
MatchFile=full/sage_formulario_inscripcion_rpsm.tpl
Subdir=templates
Match[class_identifier]=inscripcion_rpsm_form_sage

[sage_formulario_inscripcion_rpsm_resultado]
Source=content/collectedinfo/sage_inscripcion_rpsm_form.tpl
MatchFile=full/sage_formulario_inscripcion_rpsm.tpl
Subdir=templates

[sage_recursospsm_rss]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_rss.tpl
Subdir=templates
Match[node]=9584

[sage_recursospsm_casos_exito]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_casos_exito.tpl
Subdir=templates
Match[node]=9597

[sage_recursospsm_video_guias]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_video_guias.tpl
Subdir=templates
Match[node]=9606

[sage_rpsm_encuesta]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_encuesta.tpl
Subdir=templates
Match[class_identifier]=encuesta_rpsm_sage

[sage_recursospsm_novedades]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_novedades.tpl
Subdir=templates
Match[node]=9630

[sage_formulario_upgrade_rpsm]
Source=node/view/full.tpl
MatchFile=full/sage_formulario_upgrade_rpsm.tpl
Subdir=templates
Match[class_identifier]=upgrade_rpsm_form_sage

[sage_formulario_upgrade_rpsm_resultado]
Source=content/collectedinfo/sage_inscripcion_rpsm_form.tpl
MatchFile=full/sage_formulario_upgrade_rpsm.tpl
Subdir=templates

[sage_formulario_formacion_nautis_mementix]
Source=node/view/full.tpl
MatchFile=full/sage_formulario_formacion_nautis_mementix.tpl
Subdir=templates
Match[class_identifier]=formacion_nautis_mementix_form_sage

[sage_formulario_formacion_nautis_mementix_resultado]
Source=content/collectedinfo/sage_formacion_nautis_mementix_form.tpl
MatchFile=full/sage_formulario_formacion_nautis_mementix.tpl
Subdir=templates

[sage_preguntas_frecuentes_utilizacion]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_preguntas_frecuentes.tpl
Subdir=templates
Match[node]=9639

[sage_preguntas_frecuentes_tecnicas]
Source=node/view/full.tpl
MatchFile=full/sage_rpsm_preguntas_frecuentes.tpl
Subdir=templates
Match[node]=9650

[formacion_nautis_mementix_form_sage_resultado]
Source=content/collectedinfo/formacion_nautis_mementix_form_sage.tpl
MatchFile=full/sage_formulario_formacion_nautis_mementix.tpl
Subdir=templates
*/ ?>
