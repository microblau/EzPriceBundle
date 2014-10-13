<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 16:53
 */

namespace Efl\WebServiceBundle\Ws;

interface WsManagerInterface
{

    /**
     * Valida las credenciales del usuario
     *
     * @param  string $email
     * @param  string $password
     * @return Boolean
     */
    public function validaUsuario( $email, $password );

    /**
     * Nos dirá si tenemos un usuario con ese email
     *
     * @param $email
     *
     * @return mixed
     */
    public function existeUsuario( $email );

    /**
     * Precio base de un producto
     *
     * @param $cod
     *
     * @return mixed
     */
    public function recuperarProductosPrecio( $cod );

    /**
     * setear Datos de Facturación del usuario
     *
     * @param array $data
     * @return mixed
     */
    public function setUsuarioDatosFacturacion( array $data );

    /**
     * setear Datos de Envío del usuario
     *
     * @param array $data
     * @return mixed
     */
    public function setUsuarioDatosEnvio( array $data );
    /**
     * Obtener listado de provincias
     *
     * @return mixed
     */
    public function getProvincias();
}
