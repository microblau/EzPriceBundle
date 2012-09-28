<?php
class eflHashEncuestas extends eZPersistentObject
{
    /**
     * Constructor
     * 
     * @param array $row
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
                                         'hash' => array( 'name' => 'hash',
                                                        'datatype' => 'string',
                                                        'default' => '',
                                                        'required' => true                                                                                                 				
                                         				),                                                       
        								 'order_id' => array( 'name' => 'order_id',
                                                        'datatype' => 'integer',
                                                        'default' => '',
                                                        'required' => false                                                                                                 				
                                         				),
                                        'type' => array( 'name' => 'type',
                                                         'datatype' => 'integer',
                                                         'required' => true ),
                                        'status' => array( 'name' => 'status',
                                                           'datatype' => 'integer',
                                                           'required' => true )
        								                                        
        								                                                       
                                          ),   
                                                
                       'keys' => array( 'hash' ),                       
                       'sort' => array( ),
                       'class_name' => 'eflHashEncuestas',
                       "name" => 'efl_hashencuestas' );    
    }

    static function fetch( $hash )
    {
        return eZPersistentObject::fetchObject( self::definition(),
                                                null,
                                                array( 'hash' => $hash ) );
    }

    static function fetchByOrderId( $order_id )
    {
        return eZPersistentObject::fetchObject( self::definition(),
                                                null,
                                                array( 'order_id' => $order_id ) );
    }
}
?>
