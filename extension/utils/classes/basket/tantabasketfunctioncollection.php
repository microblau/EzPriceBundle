<?php
//
// Definition of eZShopFunctionCollection class
//
// Created on: <19-Feb-2010 12:50:21 sp>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

/**
 * Clase que contiene una serie de funciones auxiliares para trabajar
 * con el módulo shop provisto por un eZ Publish de manera más acorde
 * a las neceisdades de EFL
 * 
 * @author carlos.revillo@tantacom.com
 * @version 0.5
 * @package efl
 *
 */

class tantaBasketFunctionCollection
{
    /**
     * Constructor. No hace nada especial
     * 
     */
    function tantaBasketFunctionCollection()
    {
    }
  	
    /**
     * Devuelve los productos más vendidos para los criterios 
     * especificados
     * 
     * @param int $topParentNodeID id del nodo raíz del arbol
     * @param int $limit limite de elementos a devolver
     * @param int $offset desplazamiento
     * @param int $start_time inicio del intervalo en formato timestamp
     * @param int $end_time fin del intervalo en formato timestamp
     * @param int $duration duración del intervalo
     * @param bool $ascending ordenación ascendente o descendente 
     * @param bool $extended
     * @param array $attribute_filter array para formar filtros de attributo
     * @param array $extended_attribute_filter array con parametros de un extended attribute filter
     * @return array 
     */
 	function fetchBestSellList( $topParentNodeID, $limit, $offset, $start_time, $end_time, $duration, $ascending, $extended, $attribute_filter, $extended_attribute_filter )
    {
        $node = eZContentObjectTreeNode::fetch( $topParentNodeID , false, false);
        if ( !is_array( $node ) )
            return array( 'result' => null );

        $nodePath = $node['path_string'];
        $currentTime = time();
        $sqlCreatedCondition = '';

        if ( is_numeric( $start_time ) and is_numeric( $end_time ) )
        {
            $sqlCreatedCondition = "AND ezorder.created BETWEEN '$start_time' AND '$end_time'";
        }
        else if ( is_numeric( $start_time ) and is_numeric( $duration ) )
        {
            $end_time = $start_time + $duration;
            $sqlCreatedCondition = "AND ezorder.created BETWEEN '$start_time' AND '$end_time'";
        }
        else if ( is_numeric( $end_time ) and is_numeric( $duration ) )
        {
            $start_time = $end_time - $duration;
            $sqlCreatedCondition = "AND ezorder.created BETWEEN '$start_time' AND '$end_time'";
        }
        else if ( is_numeric( $start_time ) )
        {
            $sqlCreatedCondition = "AND ezorder.created > '$start_time'";
        }
        else if ( is_numeric( $end_time ) )
        {
            $sqlCreatedCondition = "AND ezorder.created < '$end_time'";
        }
        else if ( is_numeric( $duration ) )
        {
            // substract passed duration from current time timestamp to get start_time stamp
            // end_timestamp is equal to current time in this case
            $start_time = $currentTime - $duration;
            $sqlCreatedCondition = "AND ezorder.created > '$start_time'";
        }
        
        if( $attribute_filter != null )
        {        	
        	$attributeFilterParam = isset( $attribute_filter ) ? $attribute_filter : false;               
        	$attributeFilter = eZContentObjectTreeNode::createAttributeFilterSQLStrings( $attributeFilterParam );
        	
        	if ( $attributeFilter === false )
        	{
            	return null;
        	}
        	if( $attributeFilter[$from] != '' )
        	{
	        	$attributeFilter[$from] = ', ezcontentobject, ezcontentobject_name ' . $attributeFilter[$from];
	        	$attributeFilter[$where] = ' ezproductcollection_item.contentobject_id = ezcontentobject.id AND ' . $attributeFilter[$where];
        	}
        }
            
    	if ( $extended_attribute_filter != null )
        	$extendedAttributeFilter = eZContentObjectTreeNode::createExtendedAttributeFilterSQLStrings( $extended_attribute_filter );
			
		
        $sqlOrderString = ( $ascending ? 'ORDER BY count asc' : 'ORDER BY count desc' );
        $query="SELECT sum(ezproductcollection_item.item_count) as count,
                       ezproductcollection_item.contentobject_id
                  FROM ezcontentobject_tree,
                       ezproductcollection_item,
                       ezorder, ezcontentobject
                       $attributeFilter[from]
                       $extendedAttributeFilter[tables]
                 WHERE $extendedAttributeFilter[joins]                      
                 	   $attributeFilter[where]
                 	   ezcontentobject_tree.contentobject_id=ezproductcollection_item.contentobject_id AND
                       ezorder.productcollection_id=ezproductcollection_item.productcollection_id AND ezcontentobject_tree.is_hidden = 0 AND
                       ezcontentobject_tree.path_string like '$nodePath%'
                       $sqlCreatedCondition
                 GROUP BY ezproductcollection_item.contentobject_id
                 $sqlOrderString";


        $db = eZDB::instance();
        $topList = $db->arrayQuery( $query, array( 'limit' => $limit, 'offset' => $offset ) );

        if ( $extended )
        {
            foreach ( array_keys ( $topList ) as $key )
            {
                $contentObject = eZContentObject::fetch( $topList[ $key ][ 'contentobject_id' ] );
                if ( $contentObject === null )
                    return array( 'error' => array( 'error_type' => 'kernel',
                                                    'error_code' => eZError::KERNEL_NOT_FOUND ) );
                $topList[$key]['object'] = $contentObject;
            }
            return array( 'result' => $topList );
        }
        else
        {
            $contentObjectList = array();
            foreach ( array_keys ( $topList ) as $key )
            {
                $objectID = $topList[$key]['contentobject_id'];
                $contentObject = eZContentObject::fetch( $objectID );
                if ( $contentObject === null )
                    return array( 'error' => array( 'error_type' => 'kernel',
                                                    'error_code' => eZError::KERNEL_NOT_FOUND ) );
                $contentObjectList[] = $contentObject;
            }
            return array( 'result' => $contentObjectList );
        }
    }
    /**
     * Devuelve los productos que se han comprado en operaciones en las que
     * también se compraron los productos incluidos en la cesta actual
     * 
     * @param array $contentObjectIDS Array con los ids de los objetos incluidos en la cesta
     * @param int $limit Limite de elementos a devolver
     * @return array 
     */
	function fetchRelatedPurchaseList( $contentObjectIDS, $limit )
    {    	
        //$contentObjectID = (int)$contentObjectID;
        $db = eZDB::instance();
        $tmpTableName = $db->generateUniqueTempTableName( 'ezproductcoll_tmp_%' );
        $db->createTempTable( "CREATE TEMPORARY TABLE $tmpTableName( productcollection_id int )" );
        $db->query( "INSERT INTO $tmpTableName SELECT ezorder.productcollection_id
                                                           FROM ezorder, ezproductcollection_item
                                                          WHERE ezorder.productcollection_id=ezproductcollection_item.productcollection_id
                                                            AND ezproductcollection_item.contentobject_id IN ( " . implode( ',' , $contentObjectIDS ) . " )",
                    eZDBInterface::SERVER_SLAVE );

        $query="SELECT sum(ezproductcollection_item.item_count) as count, contentobject_id FROM ezproductcollection_item, $tmpTableName
                 WHERE ezproductcollection_item.productcollection_id=$tmpTableName.productcollection_id
                   AND ezproductcollection_item.contentobject_id NOT IN ( " . implode( ',' , $contentObjectIDS ) . " )
              GROUP BY ezproductcollection_item.contentobject_id
              ORDER BY count desc";

        $objectList = $db->arrayQuery( $query, array( 'limit' => $limit ), eZDBInterface::SERVER_SLAVE );

        $db->dropTempTable( "DROP TABLE $tmpTableName" );
        $contentObjectList = array();
        foreach ( array_keys ( $objectList ) as $key )
        {
            $objectID = $objectList[$key]['contentobject_id'];
            $contentObject = eZContentObject::fetch( $objectID );
            if ( $contentObject === null )
                return array( 'error' => array( 'error_type' => 'kernel',
                                                'error_code' => eZError::KERNEL_NOT_FOUND ) );
            $contentObjectList[] = $contentObject;
        }
        return array( 'result' => $contentObjectList );
    }
    
    /**
     * Devueve los productos incluidos en la colección de productos $productcollection_id
     * 
     * @static
     * @param int $productcollection_id id de la colección de productos
     * @return array
     */
    static function getProductsInBasket( $productcollection_id )
    {
    	$productItems = eZPersistentObject::fetchObjectList( eZProductCollectionItem::definition(),
                                                             array(),
                                                             array( 'productcollection_id' => $productcollection_id ),
                                                             array( 'contentobject_id' => 'desc' ),
                                                             null,
                                                             true,
															 false,
															 array( array( 'operation' => 'ezproductcollection_item.id', 'name' => 'id' ),
																    array( 'operation' => 'productcollection_id' ),
																    array( 'operation' => 'contentobject_id' ),
																    array( 'operation' => 'item_count' ),
																    array( 'operation' => 'price' ),
																    array( 'operation' => 'is_vat_inc' ),
																    array( 'operation' => 'vat_value' ),
																    array( 'operation' => 'discount' ),
																    array( 'operation' => 'ezproductcollection_item.name', 'name' => 'name' )
																    
															 ),
															 array( 'ezcontentobject' ),
															 ' AND ezcontentobject.id = ezproductcollection_item.contentobject_id AND (  ezcontentobject.contentclass_id = 48 OR ezcontentobject.contentclass_id = 98 OR ezcontentobject.contentclass_id = 101 OR ezcontentobject.contentclass_id = 100
                                                                                                                              OR ezcontentobject.contentclass_id = ' . eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Class' ) . ' ) '
                                                             );       
        $addedProducts = array();

        foreach ( $productItems as  $productItem )
        {
            $discountPercent = 0.0;
            $isVATIncluded = true;
            $id = $productItem->attribute( 'id' );

            $contentObject = $productItem->attribute( 'contentobject' );

            if ( $contentObject !== null )
            {
                if( ( $contentObject->attribute( 'contentclass_id' ) == 98 ) or ( $contentObject->attribute( 'contentclass_id' ) == 101 )
                        or ( $contentObject->attribute( 'contentclass_id' ) == eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Class' ) )
                        )
                {
                    $vatValue = $productItem->attribute( 'vat_value' );
                     // If VAT is unknown yet then we use zero VAT percentage for price calculation.
                    $realVatValue = $vatValue;

                    if ( $vatValue == -1 )
                        $vatValue = 0;

                    $count = $productItem->attribute( 'item_count' );
                    $discountPercent = 0;
                    $nodeID = $contentObject->attribute( 'main_node_id' );
                    $objectName = $productItem->attribute( 'name' );

                    $isVATIncluded = $productItem->attribute( 'is_vat_inc' );
                    $price = $productItem->attribute( 'price' );

                    if ( $isVATIncluded )
                    {
                        $priceExVAT = $price / ( 100 + $vatValue ) * 100;
                        $priceIncVAT = $price;
                        $totalPriceExVAT = $count * $priceExVAT * ( 100 - $discountPercent ) / 100;
                        $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
                    }
                    else
                    {
                        $priceExVAT = $price;
                        $priceIncVAT = $price * ( 100 + $vatValue ) / 100;
                        $totalPriceExVAT = $count * $priceExVAT  * ( 100 - $discountPercent ) / 100;
                        $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;                        
                    }
        
                    $addedProduct = array( "id" => $id,
                                           "vat_value" => $realVatValue,
                                           "item_count" => $count,
                                           "node_id" => $nodeID,
                                           "object_name" => $objectName,
                                           "price_ex_vat" => $priceExVAT,
                                           "price_inc_vat" => $priceIncVAT,
                                           "discount_percent" => $discountPercent,
                                           "total_price_ex_vat" => $totalPriceExVAT,
                                           "total_price_inc_vat" => $totalPriceIncVAT,
                                           'item_object' => $productItem );
                    $addedProducts[] = $addedProduct;
                }
                else
                {
                    $vatValue = $productItem->attribute( 'vat_value' );

                    // If VAT is unknown yet then we use zero VAT percentage for price calculation.
                    $realVatValue = $vatValue;
                    if ( $vatValue == -1 )
                        $vatValue = 0;

                    $count = $productItem->attribute( 'item_count' );
                    $discountPercent = $productItem->attribute( 'discount' );
                    $nodeID = $contentObject->attribute( 'main_node_id' );
                    $objectName = $contentObject->name( false, $contentObject->currentLanguage() );

                    $isVATIncluded = $productItem->attribute( 'is_vat_inc' );
                    $price = $productItem->attribute( 'price' );

                    if ( $isVATIncluded )
                    {
                        $priceExVAT = $price / ( 100 + $vatValue ) * 100;
                        $priceIncVAT = $price;
                        $totalPriceExVAT = $count * $priceExVAT * ( 100 - $discountPercent ) / 100;
                        $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
                    }
                    else
                    {
                        $priceExVAT = $price;
                        $priceIncVAT = $price * ( 100 + $vatValue ) / 100;
                        $totalPriceExVAT = $count * $priceExVAT  * ( 100 - $discountPercent ) / 100;
                        $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
                    }
        
                    $addedProduct = array( "id" => $id,
                                           "vat_value" => $realVatValue,
                                           "item_count" => $count,
                                           "node_id" => $nodeID,
                                           "object_name" => $objectName,
                                           "price_ex_vat" => $priceExVAT,
                                           "price_inc_vat" => $priceIncVAT,
                                           "discount_percent" => $discountPercent,
                                           "total_price_ex_vat" => $totalPriceExVAT,
                                           "total_price_inc_vat" => $totalPriceIncVAT,
                                           'item_object' => $productItem );
                    $addedProducts[] = $addedProduct;
                }
            }
        }
        return array( 'result' => $addedProducts );
    }
    
    /**
     * Devueve los cursos incluidos en la colección de productos $productcollection_id
     * 
     * @static
     * @param int $productcollection_id id de la colección de productos
     * @return array
     */
	static function getTrainingInBasket( $productcollection_id )
    {
    	$productItems = eZPersistentObject::fetchObjectList( eZProductCollectionItem::definition(),
                                                             array(),
                                                             array( 'productcollection_id' => $productcollection_id ),
                                                             array( 'contentobject_id' => 'desc' ),
                                                             null,
                                                             true,
															 false,
															 array( array( 'operation' => 'ezproductcollection_item.id', 'name' => 'id' ),
																    array( 'operation' => 'productcollection_id' ),
																    array( 'operation' => 'contentobject_id' ),
																    array( 'operation' => 'item_count' ),
																    array( 'operation' => 'price' ),
																    array( 'operation' => 'is_vat_inc' ),
																    array( 'operation' => 'vat_value' ),
																    array( 'operation' => 'discount' ),
																    array( 'operation' => 'ezproductcollection_item.name', 'name' => 'name' )
																    
															 ),
															 array( 'ezcontentobject' ),
															 ' AND ezcontentobject.id = ezproductcollection_item.contentobject_id AND ezcontentobject.contentclass_id IN( 49, 61, 64, 66)'
                                                             );       
        $addedProducts = array();
        foreach ( $productItems as  $productItem )
        {
            $discountPercent = 0.0;
            $isVATIncluded = true;
            $id = $productItem->attribute( 'id' );
            $contentObject = $productItem->attribute( 'contentobject' );

            if ( $contentObject !== null )
            {
                $vatValue = $productItem->attribute( 'vat_value' );

                // If VAT is unknown yet then we use zero VAT percentage for price calculation.
                $realVatValue = $vatValue;
                if ( $vatValue == -1 )
                    $vatValue = 0;

                $count = $productItem->attribute( 'item_count' );
                $discountPercent = $productItem->attribute( 'discount' );
                $nodeID = $contentObject->attribute( 'main_node_id' );
                $objectName = $contentObject->name( false, $contentObject->currentLanguage() );

                $isVATIncluded = $productItem->attribute( 'is_vat_inc' );
                $price = $productItem->attribute( 'price' );

                if ( $isVATIncluded )
                {
                    $priceExVAT = $price / ( 100 + $vatValue ) * 100;
                    $priceIncVAT = $price;
                    $totalPriceExVAT = $count * $priceExVAT * ( 100 - $discountPercent ) / 100;
                    $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
                }
                else
                {
                    $priceExVAT = $price;
                    $priceIncVAT = $price * ( 100 + $vatValue ) / 100;
                    $totalPriceExVAT = $count * $priceExVAT  * ( 100 - $discountPercent ) / 100;
                    $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
                }

                $addedProduct = array( "id" => $id,
                                       "vat_value" => $realVatValue,
                                       "item_count" => $count,
                                       "node_id" => $nodeID,
                                       "object_name" => $objectName,
                                       "price_ex_vat" => $priceExVAT,
                                       "price_inc_vat" => $priceIncVAT,
                                       "discount_percent" => $discountPercent,
                                       "total_price_ex_vat" => $totalPriceExVAT,
                                       "total_price_inc_vat" => $totalPriceIncVAT,
                                       'item_object' => $productItem );
                $addedProducts[] = $addedProduct;
            }
        }
        return array( 'result' => $addedProducts );
    }
    
    /**
     * Determina las distintas posibilidadesde plazo según el importe de la compra
     * 
     * @static
     * @param float $importe
     * @return array informacion con los plazos
     */
    static function getPlazos( $importe )
    {
    	$plazos = eZContentObjectTreeNode::subTreeByNodeID( 
    						array( 'ClassFilterType' => 'include',
								   'ClassFilterArray' => array( 74 ),
    							   'AttributeFilter' => array( array( 604, '<=', $importe * 100 ) ),
    						       'SortBy' => array( 'attribute', true, 927 )
    						), 295
    						
    	);
    	return $plazos;
    }

    static function getUsuarioAreasInteres( $id_usuario )
    {
        $eflws = new eflWS();

        $result = $eflws->getUsuarioAreasInteres( $id_usuario );
        $dom = simplexml_load_string( $result );
        $areas = $dom->xpath( '//area' );  
        $codigos = array();
        foreach( $areas as $area )
        {
            $codigos[] = (string)$area->codigo;
        }   
      
        return array( 'result' => $codigos );
    }

    static function getUsuarioDatosPaso3( $id_usuario )
    {
        $eflws = new eflWs();
        $result = $eflws->getUsuarioDatosPaso3( $id_usuario );
        $dom = simplexml_load_string( $result );
        $usuario = $dom->xpath( '//usuario' );
        $datos = array();
        $datos['perfil_profesion'] = (string)( $usuario[0]->perfil_profesion );
        $datos['perfil_cargo'] = (string)( $usuario[0]->perfil_cargo );
        $datos['perfil_dpto'] = (string)( $usuario[0]->perfil_dpto );
        $datos['perfil_dpto'] = (string)( $usuario[0]->perfil_dpto ); 
        $datos['perfil_areaesp'] = (string)( $usuario[0]->perfil_areaesp );
        $datos['num_empleados'] = (string)( $usuario[0]->num_empleados ); 
        $datos['actividad'] = (string)( $usuario[0]->actividad );    
        return array( 'result' => $datos );
    }

    static function discountByTicket( $product_id )
    {
        $products = eZPersistentObject::fetchObjectList( eZDiscountSubRuleValue::definition(), null, array( 'value' => $product_id ) );
        if( count( $products ) )
        {
            return array( 'result' => false );
        }
        return array( 'result' => true );
    }

    static function nautis4Price( $product_id, $mementos )
    {
        $object = eZContentObject::fetch( $product_id );
        $data = $object->dataMap();
        $preciomonopuesto = $data['precio']->content()->exVATPrice();
        $tabla = eZContentObject::fetch( 332 );
        $datatabla = $tabla->dataMap();
        $discount = eZPersistentObject::fetchObject( eflMementixDiscountRule::definition(), null, 
                                                     array( 'qte_min' => array( '<=', 1 ),
                                                            'qte_max' => array( '>=', 1 ),
                                                            'qte_mem' => $mementos,
                                                            'contentobjectattribute_id' => $datatabla['tabla_precios']->attribute( 'id' ),
                                                            'contentobjectattribute_version' => $datatabla['tabla_precios']->attribute( 'version' ) ) );
  

        $precio = $preciomonopuesto * $mementos * 1;
        $discountpercent = $discount->Discount;
        $total = $precio - ( $discount->Discount / 100 * $precio );
        return array( 'result' => array( 'discount' => $discountpercent, 'total' => $total ) );
    }
    
    static function getDiscountType( $product_id, $params )
    {
        
        $bestMatch = 0.0;
        $user = eZUser::currentUser();
        if ( is_object( $user ) )
        {
            $groups = $user->groups();
            $idArray = array_merge( $groups, array( $user->attribute( 'contentobject_id' ) ) );

            // Fetch discount rules for the current user
            $rules = eZUserDiscountRule::fetchByUserIDArray( $idArray );
           
            if ( count( $rules ) > 0 )
            {
                $db = eZDB::instance();

                $i = 1;
                $subRuleStr = '';
                foreach ( $rules as $rule )
                {
                    $subRuleStr .= $rule->attribute( 'id' );
                    if ( $i < count( $rules ) )
                        $subRuleStr .= ', ';
                    $i++;
                }

                // Fetch the discount sub rules
                $subRules = $db->arrayQuery( "SELECT * FROM
                                       ezdiscountsubrule
                                       WHERE discountrule_id IN ( $subRuleStr )
                                       ORDER BY discount_percent DESC" );
                        
                // Find the best matching discount rule
              
                foreach ( $subRules as $subRule )
                {
                    if ( $subRule['discount_percent'] > $bestMatch )
                    {
                        // Rule has better discount, see if it matches
                        if ( $subRule['limitation'] == '*' )
                        {
                            $bestMatch = $subRule['discount_percent'];
                            $bestMatchRuleid = $subRule['discountrule_id'];
                            $bestMatchRuleName = $subRule['name'];
                        }
                        else
                        {
                            // Do limitation check
                            $limitationArray = $db->arrayQuery( "SELECT * FROM
                                       ezdiscountsubrule_value
                                       WHERE discountsubrule_id='" . $subRule['id']. "'" );

                            $hasSectionLimitation = false;
                            $hasClassLimitation = false;
                            $hasObjectLimitation = false;
                            $objectMatch = false;
                            $sectionMatch = false;
                            $classMatch = false;
                            foreach ( $limitationArray as $limitation )
                            {
                                if ( $limitation['issection'] == '1' )
                                {
                                    $hasSectionLimitation = true;

                                    if ( isset( $params['section_id'] ) && $params['section_id'] == $limitation['value'] )
                                        $sectionMatch = true;
                                }
                                elseif ( $limitation['issection'] == '2' )
                                {
                                    $hasObjectLimitation = true;

                                    if ( isset( $params['contentobject_id'] ) && $params['contentobject_id'] == $limitation['value'] )
                                        $objectMatch = true;
                                }
                                else
                                {
                                    $hasClassLimitation = true;
                                    if ( isset( $params['contentclass_id'] ) && $params['contentclass_id'] == $limitation['value'] )
                                        $classMatch = true;
                                }
                            }

                            $match = true;
                            if ( ( $hasClassLimitation == true ) and ( $classMatch == false ) )
                                $match = false;

                            if ( ( $hasSectionLimitation == true ) and ( $sectionMatch == false ) )
                                $match = false;

                            if ( ( $hasObjectLimitation == true ) and ( $objectMatch == false ) )
                                $match = false;

                            if ( $match == true  )
                            {
                                $bestMatch = $subRule['discount_percent'];
                                $bestMatchRuleid = $subRule['discountrule_id'];
                                $bestMatchRuleName = $subRule['name'];
                            }
                        }
                    }
                }
            }
        }
        return array( 'result' => array( 'id' => $bestMatchRuleid, 'name' => $bestMatchRuleName ) );
    }
    
}
