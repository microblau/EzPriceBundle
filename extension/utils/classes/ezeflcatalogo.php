<?php
class ezEflCatalogo
{
    function ezEflCatalogo()
    {
    }
    
    static function getFilter( $param1, $param2 )
    {
        $catalogini = eZINI::instance( 'catalog.ini' );
        $filter = array();
        if( $catalogini->hasVariable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Filter' ) )
				{
					$value = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Filter' );
					$days = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Days' );
					$items = array();
					if ( is_array( $value ) )
					{
						foreach( $value as $el )
						{
							$el = explode( ';', $el );
											
							if( count($el) > 1 )
							{
								$el[2] = str_replace( '<currentdate>', time(), $el[2] );
								if( strpos( $el[2], ',' ) != false )
								{
									$el[2] = explode( ',', $el[2] );	
									if( $days < 0 )
										$el[2][0] = (int)$el[2][0] + $days * 86400;
									else
										$el[2][1] = (int)$el[2][1] + $days * 86400;
								}								
								$items[] = $el;
							}
							else
							{
								$items[] = $el[0];
							}								
						}
						
						$filter = $items ;					
					}
					else
					{
						$aux = explode( ';', $value );
						$aux[2] = str_replace( '<currentdate>', time(), $aux[2] );					
						if( strpos( $aux[2], ',' ) != false )
						{
							$aux[2] = explode( ',', $aux[2] );	
							if( $days < 0 )
								$aux[2][0] = (int)$aux[2][0] + $days * 86400;
							else
								$aux[2][1] = (int)$aux[2][1] + $days * 86400;					
						}
						$filter[] = $aux;
					}
	        }
        return array( 'result' => $filter ) ;
    }

     static function getExtendedFilter( $param1, $param2 )
     {
        $extendedfilter = array();
        if( $catalogini->hasVariable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'ExtendedFilter' ) )
				{
					$value = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'ExtendedFilter' );
					
					foreach( $value as $index => $el )
					{						
						if( strpos( $el, ';' ) != false )
						{
							$el = explode( ';', $el );
							
							if( $index != 'params')
								$extendedfilter['params'][$index] = $el;
							else							
							{
								if( strpos( $el[1], '%' ) != false )
								{
									
									$el[1] = explode( '%', $el[1] );
								}
								$extendedfilter['params'] = $el;
							}
						}
						else
						{
							$extendedfilter[$index] = $el;		
						}						
					}					
				}
        return array( 'result' => $extendedfilter ) ;
     }

     function customReverseRelatedObjects( $fromObjectVersion = false,
                             $objectID = false,
                             $attributeID = 0,
                             $groupByAttribute = false,
                             $params = false,
                             $reverseRelatedObjects = false )
    {

        if ( $fromObjectVersion == false )
            $fromObjectVersion = isset( $this->CurrentVersion ) ? $this->CurrentVersion : false;
        $fromObjectVersion =(int) $fromObjectVersion;
        if( !$objectID )
            $objectID = $this->ID;
        $objectID =(int) $objectID;

        $limit            = ( isset( $params['Limit']  ) && is_numeric( $params['Limit']  ) ) ? $params['Limit']              : false;
        $offset           = ( isset( $params['Offset'] ) && is_numeric( $params['Offset'] ) ) ? $params['Offset']             : false;
        $asObject         = ( isset( $params['AsObject']          ) )                         ? $params['AsObject']           : true;
        $loadDataMap      = ( isset( $params['LoadDataMap'] ) )                               ? $params['LoadDataMap']        : false;


        $db = eZDB::instance();
        $sortingString = '';
        $sortingInfo = array( 'attributeFromSQL' => '',
                              'attributeWhereSQL' => '' );

        $showInvisibleNodesCond = '';
        // process params (only SortBy and IgnoreVisibility currently supported):
        // Supported sort_by modes:
        //   class_identifier, class_name, modified, name, published, section
        if ( is_array( $params ) )
        {
            if ( isset( $params['SortBy'] ) )
            {
                $sortingInfo = eZContentObjectTreeNode::createSortingSQLStrings( $params['SortBy'] );
                $sortingString = ' ORDER BY ' . $sortingInfo['sortingFields'];
            }
            if ( isset( $params['IgnoreVisibility'] ) )
            {
                $showInvisibleNodesCond = self::createFilterByVisibilitySQLString( $params['IgnoreVisibility'] );
            }
        }

        $relationTypeMasking = '';
        $relationTypeMask = isset( $params['AllRelations'] ) ? $params['AllRelations'] : ( $attributeID === false );
 
        if ( $attributeID && ( $relationTypeMask === false || $relationTypeMask === eZContentObject::RELATION_ATTRIBUTE ) )
        {
            //$attributeID =(int) $attributeID;
            if( is_numeric( $attributeID ) )
                $attributeID = array( $attributeID );
       
           
            $relationTypeMasking .= " AND contentclassattribute_id IN ( " . implode( ",", $attributeID ) . " )";
            $relationTypeMask = eZContentObject::RELATION_ATTRIBUTE;
        }
        elseif ( is_bool( $relationTypeMask ) )
        {
            $relationTypeMask = eZContentObject::relationTypeMask( $relationTypeMask );
        }

        if ( $db->databaseName() == 'oracle' )
        {
            $relationTypeMasking .= " AND bitand( relation_type, $relationTypeMask ) <> 0 ";
        }
        else
        {
            $relationTypeMasking .= " AND ( relation_type & $relationTypeMask ) <> 0 ";
        }

        // Create SQL
        $versionNameTables = ', ezcontentobject_name ';
        $versionNameTargets = ', ezcontentobject_name.name as name,  ezcontentobject_name.real_translation ';

        $versionNameJoins = " AND ezcontentobject.id = ezcontentobject_name.contentobject_id AND
                                 ezcontentobject.current_version = ezcontentobject_name.content_version AND ";
        $versionNameJoins .= eZContentLanguage::sqlFilter( 'ezcontentobject_name', 'ezcontentobject' );

        $fromOrToContentObjectID = $reverseRelatedObjects == false ? " AND ezcontentobject.id=ezcontentobject_link.to_contentobject_id AND
                                                                      ezcontentobject_link.from_contentobject_id='$objectID' AND
                                                                      ezcontentobject_link.from_contentobject_version='$fromObjectVersion' "
                                                                   : " AND ezcontentobject.id=ezcontentobject_link.from_contentobject_id AND
                                                                      ezcontentobject_link.to_contentobject_id=$objectID AND
                                                                      ezcontentobject_link.from_contentobject_version=ezcontentobject.current_version ";
            $query = "SELECT ";

            if ( $groupByAttribute )
            {
                $query .= "ezcontentobject_link.contentclassattribute_id, ";
            }
            $query .= "
                        ezcontentclass.serialized_name_list AS class_serialized_name_list,
                        ezcontentclass.identifier as contentclass_identifier,
                        ezcontentclass.is_container as is_container,
                        ezcontentobject.* $versionNameTargets
                     FROM
                        ezcontentclass,
                        ezcontentobject,
                        ezcontentobject_link
                        $versionNameTables
                        $sortingInfo[attributeFromSQL]
                     WHERE
                        ezcontentclass.id=ezcontentobject.contentclass_id AND
                        ezcontentclass.version=0 AND
                        ezcontentobject.status=" . eZContentObject::STATUS_PUBLISHED . " AND
                        $sortingInfo[attributeWhereSQL]
                        ezcontentobject_link.op_code='0'
                        $relationTypeMasking
                        $fromOrToContentObjectID
                        $showInvisibleNodesCond
                        $versionNameJoins
                        $sortingString";
        if ( !$offset && !$limit )
        {
            $relatedObjects = $db->arrayQuery( $query );
        }
        else
        {
            $relatedObjects = $db->arrayQuery( $query, array( 'offset' => $offset,
                                                             'limit'  => $limit ) );
        }

        $ret = array();
        $tmp = array();
        foreach ( $relatedObjects as $object )
        {
            
            if ( $asObject )
            {
                $obj = new eZContentObject( $object );
                $obj->ClassName = eZContentClass::nameFromSerializedString( $object['class_serialized_name_list'] );
            }
            else
            {
                $obj = $object;
            }
            $data = $obj->dataMap();
            if( ( $data['fecha_inicio'] ) and ( $data['fecha_inicio']->content()->timestamp() > time() ) )
            $tmp[] = $obj;

            if ( !$groupByAttribute )
            {
                if( ( $data['fecha_inicio'] ) and ( $data['fecha_inicio']->content()->timestamp() > time() ) )
                $ret[] = $obj;
            }
            else
            {
                $classAttrID = $object['contentclassattribute_id'];

                if ( !isset( $ret[$classAttrID] ) )
                    $ret[$classAttrID] = array();

                $ret[$classAttrID][] = $obj;
            }
        }

        if ( $loadDataMap && $asObject )
            eZContentObject::fillNodeListAttributes( $tmp );
        return array( 'result' => $ret );
    }
}
?>
