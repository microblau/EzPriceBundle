<?php 
/**
 * Clase con la definición del objeto eflOrders
 * En la tabla relacionada se guardarán la información sobre los pedidos,
 * complementando la información que eZ Publish guarda por defecto *
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class eflOrders extends eZPersistentObject
{
	/**
	 * constructor
	 */
	function __construct( $row = array() )
	{
		$this->eZPersistentObject( $row );
	}
	
	/**
	 * Definición del objeto eflOrders
	 * 
	 * @static
	 * @return array
	 */
 	static function definition()
    {
        return array( 'fields' => array(
                                         'productcollection_id' => array( 'name' => 'ProductCollectionId',
                                                        'datatype' => 'integer',
                                                        'default' => '',
                                                        'required' => true                                                                                                 				
                                         				),                                                       
        								 'order_serialized' => array( 'name' => 'Order',
                                                        'datatype' => 'string',
                                                        'default' => '',
                                                        'required' => false                                                                                                 				
                                         				)                                                        
        								                                        
        								                                                       
                                          ),                       
                       'keys' => array( 'productcollection_id' ),                       
                       'sort' => array( ),
                       'class_name' => 'eflOrders',
                       "name" => 'efl_orders' );    
    }
}
?>