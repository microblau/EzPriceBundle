<?php

namespace Efl\WebServiceBundle\Driver;

/**
 * Connection interface.
 * Driver connections must implement this interface.
 *
 */
interface EflWsConnectionInterface
{
    /**
     * Indica si podemos validar el login de un usuario que introduce
     * su email y su password
     */
    public function validaUsuario($email, $password);

    /**
     * Determina si el usuario está en el webservice
     */
    public function existeUsuario( $email );

    /**
     * crea un nuevo Usuario en el Ws
     */
    public function nuevoUsuario( array $data );

    /**
     * obtiene datos usuario
     */
    public function getUsuario( $idUsuario );
}
