<?php
/**
 * Fichero que contiene la definición de la clase eflMementixDiscountRule
 * 
 * Se definen aquí las reglas de descuento para el mementix
 *
 * Una regla de descuento viene definida por:
 * un id interno que asigna el sistema
 * un entero que indica la cantidad mínina de accesos (qte_min)
 * un entero que indica la cantidad máxima de accesos (qte_min)
 * un entero que indica la cantidad de mementos seleccionados (qte_men)
 * el descuento asociado a esa regla
 * adems del id y la versión del atributo al que irían asociadas estas reglas. 
 * (esto nos permitiría tener varios mementix aunque no es el caso).  
 *
 * Las reglas pueden crearse desde el administrador editando el producto
 * http://www.efl.es/catalogo/mementix/mementix
 *
 * Como se puede ver en la definición, los datos se guardan, modifican o eliminan e
 * en la tabla eflmementixdiscountrule
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */

class eflImementoDiscountRule extends eZPersistentObject
{
    /**
     * Constructor
     * 
     * @param array $row
     */
    function eflImementoDiscountRule( $row )
    {
        $this->eZPersistentObject( $row );
    }
    
    /**
     * Devuelve la definición del objeto
     * 
     * @static
     * @return array
     */
    static function definition()
    {
        return array( 'fields' => array( 'id' => array( 'name' => 'ID',
                                                        'datatype' => 'integer',
                                                        'default'  => 0,
                                                        'required' => true ),                                        
                                         
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
                                        'contentobjectattribute_version' => array( 'name' =>  'ContentObjectAttributeVersion',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ) 
  ),
                      'keys' => array( 'id' ),
                      'increment_key' => 'id',
                      'class_name' => 'eflImementoDiscountRule',
                      'name' => 'eflimementodiscountrule' );
    }
    
    /**
     * Devuelve los datos asociados al atributo $id en su version $version
     *
     * @param int $id
     * @param int $version
     * @param bool $asObject
     * @return array( eflMementixDiscountRule )
     */
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

    /**
     * Elimina los datos asociados al atributo $id en su version $version
     *
     * @param int $id
     * @param int $version
     * @return void
     */
    function removeData( $id, $version )
    {
       eZPersistentObject::removeObject( eflMementixDiscountRule::definition(),    array( "contentobjectattribute_id" => $id,
                                                     "contentobjectattribute_version" => $version ) );
    }

}
?>

