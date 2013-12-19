<?php

class createLead
{
   function __constuct()
   {
   }

   static function doRequest( $collection, $node_id )
   {
        

	$client = new SoapClient("http://wcfaterrizajes.local/ServiceAterrizajes.svc?wsdl", array('trace'=>1)); 

        

        switch( $node_id ){
		case 1456:
$data = $collection->dataMap();

$productAttr = eZContentObjectAttribute::fetch( $data['producto']->ContentObjectAttributeID, 1 );
        $class_content =  $productAttr->attribute('class_content');
        $content = $data['producto']->DataText ;

        $product = $class_content['options'][$content]['name'];


			$result = $client->CreateLead(
			     array( 
			      "StrLeadFirstName" => $data['nombre']->content(),
			      "StrLeadLastName1" => $data['apellidos']->content(),
			      "StrLeadLastName2" => "",
			      "StrLeadPostalCode" => "", 
			      "StrLeadPhoneHome" => $data['telefono']->content(),             
			      "StrLeadMail" => $data['email']->content(),
			      "ArrStrProductId" => array($product),
			      "ArrStrProductName" => array( eZContentObject::fetch( $data['producto']->content() )),
			      "StrBusinessAction" => 'Acción Comercial 9569',
			      "StrRequest" => 'Demo',
			      "StrSource" => 'http://www.efl.es',
			      "StrObservations" => ''
			      
			     )
			);
	          break;
	       case 15258:
$data = $collection->dataMap();
        $product = $data['prod_qmeime']->DataText ;

   

			$result = $client->CreateLead(
			     array( 
			      "StrLeadFirstName" => $data['nombre']->content(),
			      "StrLeadLastName1" => $data['apellidos']->content(),
			      "StrLeadLastName2" => "",
			      "StrLeadPostalCode" => "", 
			      "StrLeadPhoneHome" => $data['telefono']->content(),             
			      "StrLeadMail" => $data['email']->content(),
			      "ArrStrProductId" => array(),
			      "ArrStrProductName" => array($product),
			      "StrBusinessAction" => 'Acción Comercial 9582',
			      "StrRequest" => 'Información',
			      "StrSource" => 'http://www.efl.es',
			      "StrObservations" => ''
			      
			     )
			);
	          break;

                 case 14864:
$data = $collection->dataMap();
  $product = $data['prod_qmeime']->DataText ;

			$result = $client->CreateLead(
			     array( 
			      "StrLeadFirstName" => $data['nombre']->content(),
			      "StrLeadLastName1" => $data['apellidos']->content(),
			      "StrLeadLastName2" => "",
			      "StrLeadPostalCode" => "", 
			      "StrLeadPhoneHome" => $data['telefono']->content(),             
			      "StrLeadMail" => $data['email']->content($product),
			      "ArrStrProductId" => array(),
			      "ArrStrProductName" => array(),
			      "StrBusinessAction" => 'Acción Comercial 9569',
			      "StrRequest" => 'Información',
			      "StrSource" => 'http://www.efl.es',
			      "StrObservations" => ''
			      
			     )
			);
	          break;

		 case 1455:
$data = $collection->dataMap();

$productAttr = eZContentObjectAttribute::fetch( $data['about_info']->ContentObjectAttributeID, 1 );
        $class_content =  $productAttr->attribute('class_content');
        $content = $data['about_info']->DataText ;

        $product = $class_content['options'][$content]['name'];

			$result = $client->CreateLead(
			     array( 
			      "StrLeadFirstName" => $data['nombre']->content(),
			      "StrLeadLastName1" => $data['apellido1']->content(),
			      "StrLeadLastName2" => $data['apellido2']->content(),
			      "StrLeadPostalCode" => "", 
			      "StrLeadPhoneHome" => $data['telefono']->content(),             
			      "StrLeadMail" => $data['email']->content(),
			      "ArrStrProductId" => array(),
			      "ArrStrProductName" => array(),
			      "StrBusinessAction" => 'Acción Comercial 9569',
			      "StrRequest" => 'Demo',
			      "StrSource" => 'http://www.efl.es',
			      "StrObservations" => ''
			      
			     )
			);

	          break;
        }
   }
}
