<?php

class wsProductServerFunctions extends ezjscServerFunctions
{
    /**
     * Llama al webservice con un texto para obtener productos
     *
     * @param array $args
     */
    static public function get( $args )
    {
        $params = array(
            'StrName' => $args[0],
            'IntPageSize' => 15,
        );

        $client = new SoapClient( eZINI::instance( 'eflsoapserver.ini')->variable( 'SoapServer', 'WSDL' ) );
        $result = $client->RecuperarProductos( $params );

        $ret = array();
        if ( is_array( $result->RecuperarProductosResult->data->Producto ) )
        {
            foreach ( $result->RecuperarProductosResult->data->Producto as $p )
            {
                $ret[] = array(
                    'cod' => $p->_codProductoCC,
                    'name' => $p->_name,
                );
            }
        }
        elseif ( is_object( $result->RecuperarProductosResult->data->Producto ) )
        {
            $ret[] = array(
                'cod' => $result->RecuperarProductosResult->data->Producto->_codProductoCC,
                'name' => $result->RecuperarProductosResult->data->Producto->_name
            );
        }

        return $ret;
    }

}
