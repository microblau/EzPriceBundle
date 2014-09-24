<?php

namespace Efl\WebServiceBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class WebserviceUser implements UserInterface, EquatableInterface
{
    private $username;

    private $colective;

    private $nombre;

    private $apellido1;

    private $apellido2;

    private $facturacion;

    private $idWs;

    public function __construct( $username,
        $nombre = '',
        $apellido1 = '',
        $apellido2 = '',
        $colective = '',
        $facturacion = null,
        $idWs = null
    )
    {
        $this->username = $username;
        $this->nombre = $nombre;
        $this->colective = $colective;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->facturacion = $facturacion;
        $this->idWs = $idWs;
    }

    public function getRoles()
    {
        return array( 'ROLE_USER' );
    }

    public function setColective( $colective )
    {
        $this->colective = $colective;
    }

    public function setNombre( $nombre )
    {
        $this->nombre = $nombre;
    }

    public function getPassword()
    {
        return '';
    }

    public function setApellido1( $apellido1 )
    {
        $this->apellido1 = $apellido1;
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function setApellido2( $apellido2 )
    {
        $this->apellido2 = $apellido2;
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getColective()
    {
        return $this->colective;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo( UserInterface $user )
    {
        if ( !$user instanceof WebserviceUser )
        {
            return false;
        }

        if ( $this->username !== $user->getUsername() )
        {
            return false;
        }

        return true;
    }

    public function getFacturacion()
    {
        return $this->facturacion;
    }

    public function getIdWs()
    {
        return $this->idWs;
    }

    public function setFacturacion( $facturacion )
    {
        $this->facturacion = $facturacion;
    }
}
