<?php

namespace Efl\WebServiceBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class WebserviceUser implements UserInterface, EquatableInterface
{
    private $username;

    private $colective;

    private $nombre;

    public function __construct( $username, $nombre = '', $colective = '' )
    {
        $this->username = $username;
        $this->nombre = $nombre;
        $this->colective = $colective;
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
}
