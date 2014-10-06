<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 17:11
 */

namespace Efl\WebServiceBundle\Ws;

use Efl\WebServiceBundle\Driver\EflWsConnectionInterface;

class WsManager implements WsManagerInterface
{
    private $connection;
    private $params = array();

    public function __construct( EflWsConnectionInterface $connection, array $params )
    {
        $this->connection = $connection;
        $this->params = $params;
    }

    public function validaUsuario($email, $password)
    {
        return $this->connection->validaUsuario( $email, $password );
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function existeUsuario( $email )
    {
        return $this->connection->existeUsuario( $email );
    }

    /**
     * @param $cod
     *
     * @return mixed
     */
    public function recuperarProductosPrecio( $cod )
    {
        return $this->connection->recuperarPreciosProducto( $cod );
    }
} 