<?php
//
// Definition of eZPaymentObject class
//
// Created on: <11-Jun-2004 14:18:58 dl>
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
 * Clase muy similar a la provista por eZ Publish ( eZPaymentObject), 
 * pero con cambios motivados por los distintos tipos de pago. 
 * @author carlos
 * @version 1.0
 * @package efl.
 *
 */

class eflPaymentObject extends eZPersistentObject
{
    const STATUS_NOT_APPROVED = 0;
    const STATUS_APPROVED = 1;

    /**
     * Devuelve un objeto de la clase eflPaymentObject
     * 
     * @param array $row
     * @return array
     */
    function eflPaymentObject( $row )
    {
        $this->eZPersistentObject( $row );
    }

    /**
     * Crea un nuevo objeto de tipo eflPaymentObject
     * 
     * Nota: Por si solo no lo guarda en bd. habría que llamar a eZPersistentObject->store();
     * 
     * @param int $orderID
     * @param string $paymentType
     * @return eflPaymentObject
     */
    static function createNew( $orderID, $paymentType )
    {    
        return new eflPaymentObject( array( 'order_id'            => $orderID,
                                           'payment_string'      => $paymentType ) );
    }

    /**
     * Aprueba un pago
     * 
     * @return void
     */
    function approve()
    {
    	eZDebug::writeError( 'Aquí' );
        $this->setAttribute( 'status', self::STATUS_APPROVED );
        $this->store();
    }
	
    /**
     * Devuelve si un pago está aceptado o no
     * 
     * @return bool
     */
    function approved()
    {
        return ( $this->attribute( 'status' ) == self::STATUS_APPROVED );
    }
	
    /**
     * Definición del objeto. 
     * 
     * @static
     * @return array Definición del objeto eflPaymentObject
     */
    static function definition()
    {
        return array( 'fields' => array( 'id' => array( 'name' => 'ID',
                                                        'datatype' => 'integer',
                                                        'default'  => 0,
                                                        'required' => true ),
                                        
                                         'order_id' => array( 'name' => 'OrderID',
                                                              'datatype'=> 'integer',
                                                              'default' => 0,
                                                              'required'=> false,
                                                              'foreign_class' => 'eZOrder',
                                                              'foreign_attribute' => 'id',
                                                              'multiplicity' => '1..*' ),
                                         'payment_string' => array( 'name' => 'PaymentString',
                                                                    'datatype'=> 'string',
                                                                    'default' => 'Payment',
                                                                    'required'=> false ),
                                         'status' => array( 'name' => 'Status',
                                                            'datatype'=> 'integer',
                                                            'default' => 0,
                                                            'required'=> true ) ),
                      'keys' => array( 'id' ),
                      'increment_key' => 'id',
                      'class_name' => 'eflPaymentObject',
                      'name' => 'eflpaymentobject' );
    }

    /*!
     \static
    Returns eZPaymentObject by 'id'.
    */
    static function fetchByID( $transactionID )
    {
        return eZPersistentObject::fetchObject( eflPaymentObject::definition(),
                                                null,
                                                array( 'id' => $transactionID ) );
    }

    /*!
     \static
    Returns eZPaymentObject by 'id' of eZOrder.
    */
    static function fetchByOrderID( $orderID )
    {
        return eZPersistentObject::fetchObject( eflPaymentObject::definition(),
                                                null,
                                                array( 'order_id' => $orderID ) );
    }      
}
?>