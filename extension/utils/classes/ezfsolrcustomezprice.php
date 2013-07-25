<?php

class ezfSolrCustomEzPrice extends ezfSolrDocumentFieldBase
{
    const DEFAULT_ATTRIBUTE_TYPE = 'float';
    const DEFAULT_SUBATTRIBUTE_TYPE = 'float';

    
    public function getData()
    {   
    $contentClassAttribute = $this->ContentObjectAttribute->attribute( 'contentclass_attribute' );
  
      $returnArray = array();
 
      // Get timestamp attribute value
      $value = $this->ContentObjectAttribute->content();
	  
        
      // Generate the main filedName attr_XXX_dt 
      $fieldName = parent::generateAttributeFieldName( $contentClassAttribute,
      self::DEFAULT_ATTRIBUTE_TYPE );
      $returnArray[$fieldName] = $value->attribute( 'ex_vat_price' );
 
      // Generate the yearmonth subattribute filedName subattr_year_dt
      $fieldName = parent::generateSubattributeFieldName( $contentClassAttribute,
      'precio',
      self::DEFAULT_SUBATTRIBUTE_TYPE );
     

      $returnArray[$fieldName] = $value->attribute( 'has_discount' ) ? str_replace( ',', '.', $value->attribute( 'discount_price_ex_vat' ) ) : str_replace( ',', '.',$value->attribute( 'ex_vat_price' ) ) ;
    
      // Generate the yearmonth subattribute filedName subattr_yearmonth_dt
      $fieldName = parent::generateSubattributeFieldName( $contentClassAttribute,
      'discount',
      'int' ); 
    
      $returnArray[$fieldName] = $value->attribute( 'has_discount' ) ? 1 : 0;

      // vamos a indexar si hay descuento o no para cada grupo de usuarios
      $groups = eZContentObjectTreeNode::subTreeByNodeId( array( 'ClassFilterType' => 'include',
                                                                 'ClassFilterArray' => array( 'user_group' ),
                                                                 'Limitation' => array(),
                                                                 'ExtendedAttributeFilter' => array( 'id' => 'NodeHasChildrenFilter', 
                                                                                                      'params' => array( 0, '<' ) )
 ),

 5 );
         
      foreach( $groups as $group )
      {

         $fieldName = parent::generateSubattributeFieldName( $contentClassAttribute,
                                                            'discount_' . $group->attribute( 'node_id' ),
                                                             'int' ); 
         $group_children = eZContentObjectTreeNode::subTreeByNodeId( array( 'AsObject' => false, 'Limitation' => array(), 'Limit' => 1 ) , $group->attribute( 'node_id' ) );
;
         $user = eZUser::fetch( $group_children[0]['contentobject_id'] );
      
        $discountPercent = eZDiscount::discountPercent( $user,
                                                            array( 'contentclass_id' => $this->ContentObjectAttribute->attribute( 'object' )->attribute( 'contentclass_id'),
                                                                   'contentobject_id' => $this->ContentObjectAttribute->attribute( 'object' )->attribute( 'id' ),
                                                                   'section_id' => $this->ContentObjectAttribute->attribute( 'object' )->attribute( 'section_id') ) );
        
        if( $discountPercent > 0 )
        {
            // hay que ver si está en fechas
        }
        $returnArray[$fieldName] = ( $discountPercent > 0 ) ? 1 : 0;
         
       
         $fieldName = parent::generateSubattributeFieldName( $contentClassAttribute,
                'precio_' . $group->attribute( 'node_id' ),
                self::DEFAULT_SUBATTRIBUTE_TYPE );
           $returnArray[$fieldName] = ( $discountPercent > 0 ) ? str_replace( ',', '.', $value->attribute( 'ex_vat_price' ) - ( ( $discountPercent / 100 ) * $value->attribute( 'ex_vat_price' ) ) ) : str_replace( ',', '.', $value->attribute( 'ex_vat_price' ));
      }
      
      return $returnArray;
 
  

    }
    

    public static function getFieldName( eZContentClassAttribute $classAttribute, $subAttribute = null )
    {
        
        if ( $subAttribute and $subAttribute !== '' )
	    {
	      // A subattribute was passed
	      return parent::generateSubattributeFieldName( $classAttribute,
	       $subAttribute,
	       self::DEFAULT_SUBATTRIBUTE_TYPE );
	     }
	     else
	     {
	      // return the default field name here.
	      
	      return parent::generateAttributeFieldName( $classAttribute, self::getClassAttributeType( $classAttribute, null, $context ) );
	     }
    
    }
   
 
   

    
}
?>
