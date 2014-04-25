<?php
class eflMementixDiscountRule extends eZPersistentObject
{
    function eflMementixDiscountRule( $row )
    {
        $this->eZPersistentObject( $row );
    }

    static function definition()
    {
        return array( 'fields' => array( 'id' => array( 'name' => 'ID',
                                                        'datatype' => 'integer',
                                                        'default'  => 0,
                                                        'required' => true ),
                                        
                                         'qte_min' => array( 'name' => 'QteMin',
                                                              'datatype'=> 'integer',
                                                              'default' => 0,
                                                              'required'=> true ),
                                                             
                                         'qte_max' => array( 'name' => 'QteMax',
                                                                    'datatype'=> 'integer',
                                                                    'default' => 0,
                                                                    'required'=> true ),
                                         'qte_mem' => array( 'name' => 'QteMem',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ),
                                         'discount' => array( 'name' => 'Discount',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ),
                                         'contentobjectattribute_id' => array( 'name' => 'ContentObjectAttributeID',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ),

                                        'contentobjectattribute_version' => array( 'name' => 'ContentObjectAttributeVersion',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ) 
  ),
                      'keys' => array( 'id' ),
                      'increment_key' => 'id',
                      'class_name' => 'eflMementixDiscountRule',
                      'name' => 'eflmementixdiscountrule' );
    }

    static function fetchMatrix( $id, $version, $asObject = true )
    {
        if( $version == null )
        {
            return eZPersistentObject::fetchObjectList( eflMementixDiscountRule::definition(),
                                                        null,
                                                        array( "contentobjectattribute_id" => $id ),
                                                        null,
                                                        null,
                                                        $asObject );
        }
        else
        {    
            return eZPersistentObject::fetchObjectList( eflMementixDiscountRule::definition(),
                                                    null,
                                                    array( "contentobjectattribute_id" => $id,
                                                           "contentobjectattribute_version" => $version ),
                                                    $asObject );
        }
    }

    function removeData( $id, $version )
    {
       eZPersistentObject::removeObject( eflMementixDiscountRule::definition(),    array( "contentobjectattribute_id" => $id,
                                                     "contentobjectattribute_version" => $version ) );
    }

}
?>
