<?php /*

[General]
AllowedTypes[]=Destacado
AllowedTypes[]=BannerHomeFormacion
AllowedTypes[]=Completo2Modalidades
AllowedTypes[]=Completo
AllowedTypes[]=Simple
AllowedTypes[]=SimpleOnline1
AllowedTypes[]=SimpleOnline2
AllowedTypes[]=DestacadoHome
AllowedTypes[]=SabeLoQueQuiere
AllowedTypes[]=DiganosQueBusca
AllowedTypes[]=TambienPuede
AllowedTypes[]=UltimasNovedadesAutomatico
AllowedTypes[]=UltimasNovedadesManual
AllowedTypes[]=ActumMementos
AllowedTypes[]=Formacion
AllowedTypes[]=PromocionPrimaria
AllowedTypes[]=PromocionPrimariaUnica
AllowedTypes[]=PromocionPrimariaRelatedObjects
AllowedTypes[]=NewsletterSuscription

AllowedTypes[]=DestacadoHomeFormacion
AllowedTypes[]=Contacto
AllowedTypes[]=CursosListadoHome
AllowedTypes[]=ModuloSimpleFormacion
AllowedTypes[]=BloqueAreas
AllowedTypes[]=CursoDestacado
AllowedTypes[]=DestacadoBuscador
AllowedTypes[]=CursosBloquesHomeFormacion
AllowedTypes[]=ListadoFecha
AllowedTypes[]=TwitterBlock
AllowedTypes[]=BuscaObrasPortalMementos
AllowedTypes[]=PruebaGratis
AllowedTypes[]=MementosSage

[Destacado]
Name=Destacado
NumberOfValidItems=1
NumberOfArchivedItems=0
ManualAddingOfItems=enabled

[BannerHomeFormacion]
Name=Banner Home Formacion
NumberOfValidItems=1
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=url
CustomAttributes_title[url]=Url destino

[Completo2Modalidades]
Name=Módulo completo con dos modalidades de producto
NumberOfValidItems=100
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=titulo_1
CustomAttributes_title[titulo_1]=Título primer bloque
CustomAttributes[]=texto_enlace_1
CustomAttributes_title[texto_enlace_1]=Texto primer enlace
CustomAttributes[]=enlace_1
CustomAttributes_title[enlace_1]=Primer enlace
CustomAttributes[]=titulo_2
CustomAttributes_title[titulo_2]=Título segundo bloque
CustomAttributes[]=texto_enlace_2
CustomAttributes_title[texto_enlace_2]=Texto segundo enlace
CustomAttributes[]=enlace_2
CustomAttributes_title[enlace_2]=Segundo enlace
ItemsPerBlock=2

[Completo]
Name=Módulo completo
NumberOfValidItems=100
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título 
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace
ItemsPerBlock=4
ViewList[]=a
ViewList[]=b
ViewName[a]=A
ViewName[b]=B

[Simple]
Name=Módulo simple
NumberOfValidItems=100
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título 
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace
ItemsPerBlock=2

[SimpleOnline1]
Name=Módulo simple online 1
NumberOfValidItems=1
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título 
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace

[SimpleOnline2]
Name=Módulo simple online 2
NumberOfValidItems=100
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título 
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace
ItemsPerBlock=2

[DestacadoHome]
Name=Destacado en home
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título
CustomAttributes[]=texto
CustomAttributes_title[texto]=Texto
CustomAttributeTypes[texto]=text
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto enlace
CustomAttributes[]=objeto
UseBrowseMode[objeto]=true

[SabeLoQueQuiere]
Name=Sabe lo que quiere
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
CustomAttributes[]=texto_1
CustomAttributes_title[texto_1]=Texto Enlace 1
CustomAttributes[]=enlace_1
CustomAttributes_title[Enlace_1]=Enlace 1
CustomAttributes[]=texto_2
CustomAttributes_title[texto_2]=Texto Enlace 2
CustomAttributes[]=enlace_2
CustomAttributes_title[enlace_2]=Enlace 2
CustomAttributes[]=texto_3
CustomAttributes_title[texto_3]=Texto Enlace 3
CustomAttributes[]=enlace_3
CustomAttributes_title[enlace_3]=Enlace 3
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título 


[DiganosQueBusca]
Name=Díganos qué está buscando
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título
CustomAttributes[]=combo1
CustomAttributes_title[combo1]=Combo 1
CustomAttributes[]=combo2
CustomAttributes_title[combo2]=Combo 2 
CustomAttributes[]=combo3
CustomAttributes_title[combo3]=Combo 3
ViewList[]=Default
ViewList[]=New
ViewList[New]=New
ViewName[Default]=Por defecto
ViewName[New]=Home Versión 2
ViewName[New]=Home Versión 2
 


[TambienPuede]
Name=También puede
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
CustomAttributes[]=texto_enlace_1
CustomAttributes_title[texto_enlace_1]=Texto Enlace 1
CustomAttributes[]=enlace_1
CustomAttributes_title[enlace_1]=Enlace 1
CustomAttributes[]=texto_enlace_2
CustomAttributes_title[texto_enlace_2]=Texto Enlace 2
CustomAttributes[]=enlace_2
CustomAttributes_title[enlace_2]=Enlace 2

[UltimasNovedadesAutomatico]
Name=Últimas novedades (Automático)
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
ViewList[]=Default
ViewList[]=New
ViewName[Default]=Por defecto
ViewName[New]=Home Versión 2

[UltimasNovedadesManual]
Name=Últimas novedades (Manual)
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=10
ViewList[]=Default
ViewList[]=New
ViewName[Default]=Por defecto
ViewName[New]=Home Versión 2

[ActumMementos]
Name=Actum Mementos
NumberOfArchivedItems=0
ManualAddingOfItems=disabled
CustomAttributes[]=titulo
CustomAttributes_title[titulo]=Título
ViewList[]=Default
ViewList[]=New
ViewName[Default]=Por defecto
ViewName[New]=Home Versión 2

[Formacion]
Name=Formación
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=4
CustomAttributes[]=titulo_pestana
CustomAttributes_title[titulo_pestana]=Título Pestaña
CustomAttributes[]=titulo_bloque
CustomAttributes_title[titulo_bloque]=Título del bloque
CustomAttributes[]=texto_enlace
CustomAttributes_title[texto_enlace]=Texto Enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace

[PromocionPrimaria]
Name=Promoción Primaria
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=7
ViewList[]=Default
ViewList[]=New
ViewName[Default]=Por defecto
ViewName[New]=Home Versión 2

[PromocionPrimariaUnica]
Name=Promoción Primaria Única
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1
ViewList[]=Default
ViewName[Default]=Por defecto



[DestacadoHomeFormacion]
Name=Destacado Home Formación
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1
ViewList[]=Destacadoprincipal
ViewList[]=Modulosimple_img_bottom
ViewList[]=Modulosimple_img_left
ViewName[Destacadoprincipal]=Destacado principal
ViewName[Modulosimple_img_bottom]=Módulo simple imágen abajo
ViewName[Modulosimple_img_left]=Módulo simple imágen izquierda


[Contacto]
Name=Contacto
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1


[CursoNovedad]
Name=Curso Novedad
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1


[CursoOfertaDestacada]
Name=Curso Oferta Destacada
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1


[CursosListadoHome]
Name=Curso Listado Home
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=100
CustomAttributes[]=novedad
CustomAttributes_title[novedad]=Novedad
UseBrowseMode[novedad]=true
CustomAttributes[]=ofertaDestacada
CustomAttributes_title[ofertaDestacada]=Oferta destacada
UseBrowseMode[ofertaDestacada]=true
CustomAttributes[]=areaRelacionada
CustomAttributes_title[areaRelacionada]=Area relacionada
UseBrowseMode[areaRelacionada]=true

[ModuloSimpleFormacion]
Name=Módulo simple formación
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1

[BloqueAreas]
Name=Bloque Area
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=2
CustomAttributes[]=oferta
CustomAttributes_title[oferta]=Oferta
UseBrowseMode[oferta]=true
CustomAttributes[]=areaRelacionada
CustomAttributes_title[areaRelacionada]=Área relacionada
UseBrowseMode[areaRelacionada]=true

[CursoDestacado]
Name=Curso destacado
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1
CustomAttributes[]=imagen
CustomAttributes_title[imagen]=Imágen
UseBrowseMode[imagen]=true

[DestacadoBuscador]
Name=Destacado Buscador
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=1

[CursosBloquesHomeFormacion]
Name=Curso Bloque Home Formación
NumberOfArchivedItems=0
ManualAddingOfItems=enabled
NumberOfValidItems=100
CustomAttributes[]=testimonio
CustomAttributes_title[testimonio]=Testimonio
UseBrowseMode[testimonio]=true
CustomAttributes[]=textoenlace
CustomAttributes_title[textoenlace]=Texto del enlace
CustomAttributes[]=enlace
CustomAttributes_title[enlace]=Enlace a
UseBrowseMode[enlace]=true
CustomAttributes[]=estilo
CustomAttributes_title[estilo]=Estilo cabecera

[ListadoFecha]
Name=Listado formacion filtrado
NumberOfArchivedItems=0
ManualAddingOfItems=disabled


[TwitterBlock]
Name=Twitter
ManualAddingOfItems=disabled
ViewList[]=twitterblock
ViewName[twitterblock]=Twitter

[BuscaObrasPortalMementos]
Name=Novedades Portal Mementos
ManualAddingOfItems=enabled
NumberOfValidItems=6

[PruebaGratis]
Name=Formulario de prueba gratis
ManualAddingOfItems=disabled

[NewsletterSuscription]
Name=Inscripción newsletter
ManualAddingOfItems=enabled
NumberOfValidItems=10

[PromocionPrimariaRelatedObjects]
Name=Promociones primarias con objetos relacionados
ManualAddingOfItems=enabled
NumberOfValidItems=100

[MementosSage]
Name=Mementos Sage
ManualAddingOfItems=disabled



*/?>
