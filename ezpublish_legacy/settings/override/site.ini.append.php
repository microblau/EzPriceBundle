<?php /* #?ini charset="utf-8"?
[DatabaseSettings]
DatabaseImplementation=ezmysqli
Server=localhost
User=lefebvre
Password=lyXyv3Jq
Database=lefebvre
SQLOutput=enabled

[DesignSettings]
AdditionalSiteDesignList[]=googlesitemapgenerator

[ExtensionSettings]
ActiveExtensions[]=ezdemo
ActiveExtensions[]=envdata
ActiveExtensions[]=ezvideoflv
ActiveExtensions[]=objectrelationbrowse
ActiveExtensions[]=utils
ActiveExtensions[]=ezjscore
ActiveExtensions[]=ezfind
ActiveExtensions[]=ezflow
ActiveExtensions[]=ezoe
ActiveExtensions[]=ezwt
ActiveExtensions[]=ezstarrating
ActiveExtensions[]=shareit
ActiveExtensions[]=objectrelationfilter
ActiveExtensions[]=ezgmaplocation
ActiveExtensions[]=ezsurvey
ActiveExtensions[]=ezmultiupload
ActiveExtensions[]=fezmetadata
ActiveExtensions[]=ezhumancaptcha
ActiveExtensions[]=ezodf
ActiveExtensions[]=collectexport
ActiveExtensions[]=novenutils
ActiveExtensions[]=ngsuggest
ActiveExtensions[]=twitterblock
#ActiveExtensions[]=efltwitter
ActiveExtensions[]=eflyoutube
ActiveExtensions[]=cjw_newsletter
ActiveExtensions[]=eflvaloraciones
ActiveExtensions[]=googlesitemapgenerator
ActiveExtensions[]=ggwebservices
ActiveExtensions[]=efldatatypes
ActiveExtensions[]=bump
#ActiveExtensions[]=ezpaypal

[Session]
SessionNameHandler=default
#SessionNamePerSiteAccess=enabled

[SiteSettings]
SiteURL=www.efl.es
DefaultAccess=newhome
SiteList[]=site
SiteList[]=administracion
SiteList[]=adminfrance
RootNodeDepth=1
GMapsKey[efl]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BQ7l8yMWzVY_S3O9hRXx8IwQjk7HBQXfqHPcbHeDprEx9aa-8bsJ6-7Yw
GMapsKey[efl.tantacom.com]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BS1XPktXesD48JdgMk8eS7i1KP1XRTEsJpyC1MravpfUIYEGQJr02C44g
GMapsKey[formacionefl.tantacom.com]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BSB6BYCYUL3DimnEcrHO0lbacCX9hSG9YtNsviVs_QGoY5EKHOp9SVCbA
GMapsKey[www.eflweb.com]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BQNq018Bn66yh6AhNJOO5tUv8WuBxROZf5H2JQYQ6mZeKpniABg6vvyEg
GMapsKey[formacion.eflweb.com]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BT3f54W7biddis8AYuK9VoUnB3V2xQR_NKfs0Qi3d1aSyIxcllaZy-JqA
GMapsKey[formacion.efl.es]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BTuiy-xq3xFT48oAwGYvjVv1lvljBQNAZId8HRhlPs1RKj1t3QDWCRzYw
GMapsKey[www.efl.es]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BSrvJ6PxiUWV4V-r6Xi8aHVQH0O0BRsugUVVWnr9Mf-NtrQHvoMJqtfHQ
GMapsKey[www2.efl.es]=ABQIAAAAeaK5x8cQV9oDRdtcgO2o-BQHo4Kdl9MFwsRN163XoBvFAY_yAxSOG2LkqjiZdabq4wauIEZ9hX9-Ww

[SiteAccessSettings]
CheckValidity=false
AvailableSiteAccessList[]=site
AvailableSiteAccessList[]=newhome
AvailableSiteAccessList[]=administracion
AvailableSiteAccessList[]=test
AvailableSiteAccessList[]=forma
AvailableSiteAccessList[]=adminfrance
MatchOrder=uri;host
ForceVirtualHost=true
RemoveSiteAccessIfDefaultAccess=enabled

HostMatchMapItems[]=eflweb;site;
HostMatchMapItems[]=www.efl.es;newhome;
HostMatchMapItems[]=formacion.efl.es;forma
HostMatchMapItems[]=formacion.eflweb.local;forma
HostMatchMapItems[]=eflweb.local;site

[TemplateSettings]
ShowUsedTemplates=enabled

[DebugSettings]
DebugOutput=enabled
DebugByIP=enabled
DebugRedirection=disabled
DebugIPList[]
DebugIPList[]=212.0.126.46
DebugIPList[]=212.4.112.90
DebugIPList[]=88.12.15.142
#DebugIPList[]=192.168.1.56
#DebugIPList[]=192.168.1.80
DebugIPList[]=127.0.0.1
DebugIPList[]=212.4.112.90


[ShopSettings]
RedirectAfterAddToBasket=reload

[UserSettings]
LogoutRedirect=/

[SSLZoneSettings]
SSLZones=disabled
ModuleViewAccessMode[basket/ajaxadd]=keep
ModuleViewAccessMode[basket/csv-encuestas]=keep
ModuleViewAccessMode[basket/mementixcheckprice]=keep
ModuleViewAccessMode[basket/addnautis4]=keep
ModuleViewAccessMode[basket/*]=ssl
ModuleViewAccessMode[paypal/*]=ssl
#ModuleViewAccessMode[colectivos/*]=ssl
ModuleViewAccessMode[colectivos/login]=keep
ModuleViewAccessMode[transferencia/*]=ssl
ModuleViewAccessMode[domiciliacion/*]=ssl

[MailSettings]
Transport=file
#Transport=SMTP
#AdminEmail=clientes@efl.es
#EmailSender=clientes@efl.es
#TransportServer=localhost
#TransportPort=25
#TransportUser=xxxx
#TransportPassword=xxxx

[MailSettings]
Transport=sendmail
TransportServer=smtp.desorden.net
TransportPort=25
TransportUser=smtp@desorden.net
TransportPassword=smtp2011
AdminEmail=lidia.valle@tantacom.com
EmailSender=

[EmbedViewModeSettings]
AvailableViewModes[]
AvailableViewModes[]=embed
AvailableViewModes[]=embed-inline
InlineViewModes[]
InlineViewModes[]=embed-inline
EmailReceiver=asistenciaclientes@efl.es

[SiteAccessRules]
Rules[]=Access;disable
#Rules[]=Module;content/browse
Rules[]=Module;content/tipafriend
#Rules[]=Module;user/login
#Rules[]=Module;user/logout
Rules[]=Module;user/register
Rules[]=Module;user/forgotpassword
#Rules[]=Module;ezinfo/about

[TemplateSettings]
ShowUsedTemplates=enabled
*/ ?>