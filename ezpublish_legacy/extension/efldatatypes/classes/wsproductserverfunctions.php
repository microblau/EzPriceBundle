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
            'IntPageSize' => 10,
        );

        $client = new SoapClient( eZINI::instance( 'eflsoapserver.ini')->variable( 'SoapServer', 'WSDL' ) );
        $result = $client->RecuperarProductos( $params );
        $ret = array();
        foreach ( $result->RecuperarProductosResult->data->Producto as $p )
        {
            $ret[] = array(
                'cod' => $p->_codProductoCC,
                'name' => $p->_name,
            );
        }

        return $ret;
    }

}
