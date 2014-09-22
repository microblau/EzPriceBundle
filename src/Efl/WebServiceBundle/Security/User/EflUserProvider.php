<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 16:50
 */

namespace Efl\WebServiceBundle\Security\User;

use Efl\WebServiceBundle\Ws\WsManagerInterface;
use eZ\Publish\API\Repository\Repository;
use Efl\WebServiceBundle\Security\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Psr\Log\LoggerInterface;
use eZ\Publish\Core\MVC\Symfony\Security\User;
use eZ\Publish\Core\Base\Exceptions\NotFoundException;

/**
 * Class EflUserProvider
 *
 * provides user from Efl Web Service
 *
 * @package Efl\WebServiceBundle\Security\User
 */
class EflUserProvider implements UserProviderInterface
{
    private $repository;

    private $wsManager;

    private $logger;

    public function __construct(
        Repository $repository,
        WsManagerInterface $wsManager,
        LoggerInterface $logger = null
    )
    {
        $this->repository = $repository;
        $this->wsManager = $wsManager;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($email)
    {
        try
        {
            $user = $this->wsManager->existeUsuario( $email );

            if ( !$user ) {
                $this->logger->info( "User $email not found on webservice" );
                throw new UsernameNotFoundException(sprintf('User "%s" not found', $email));
            } else {
                $this->logger->info("User $email found on webservice");
            }
            return new WebserviceUser( $email );

        }
        catch ( NotFoundException $e )
        {
             throw new UsernameNotFoundException( $e->getMessage(), 0, $e );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {

        if ( !$user instanceof UserInterface )
        {
            throw new UnsupportedUserException( sprintf( 'Instances of "%s" are not supported.', get_class( $user ) ) );
        }


        $this->repository->setCurrentUser( $user->getAPIUser() );
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Efl\\WebServiceBundle\\Security\\WebserviceUser';
    }
}
