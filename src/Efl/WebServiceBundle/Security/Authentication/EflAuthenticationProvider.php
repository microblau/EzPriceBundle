<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 16:43
 */

namespace Efl\WebServiceBundle\Security\Authentication;

use Efl\WebServiceBundle\Security\WebserviceUser;
use Efl\WebServiceBundle\Ws\WsManagerInterface;
use Symfony\Component\Security\Core\Authentication\Provider\UserAuthenticationProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class EflAuthenticationProvider extends UserAuthenticationProvider
{
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var WsManagerInterface
     */
    private $wsManager;

    /**
     * Constructor.
     *
     * @param UserCheckerInterface  $userChecker                An UserCheckerInterface interface
     * @param string                $providerKey                A provider key
     * @param UserProviderInterface $userProvider               An UserProviderInterface interface
     * @param WsManagerInterface  $ldapManager                An WsManagerInterface interface
     * @param Boolean               $hideUserNotFoundExceptions Whether to hide user not found exception or not
     */
    public function __construct(
        UserCheckerInterface $userChecker,
        $providerKey,
        UserProviderInterface $userProvider,
        WsManagerInterface $wsManagerInterface,
        $hideUserNotFoundExceptions = true
    )
    {
        parent::__construct($userChecker, $providerKey, $hideUserNotFoundExceptions);

        $this->userProvider = $userProvider;
        $this->wsManager = $wsManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    protected function retrieveUser( $username, UsernamePasswordToken $token )
    {
        try {

            if( $validate = $this->wsManager->validaUsuario( $username, $token->getCredentials() ) )
            {
                return new WebserviceUser(
                    $username,
                    $validate->_nombre,
                    $validate->_apellido1,
                    $validate->_apellido2,
                    $validate->_cod_colectivo
                );
            }

        } catch (UsernameNotFoundException $notFound) {
            $notFound->setUsername($username);
            throw $notFound;
        } catch (\Exception $repositoryProblem) {
            $ex = new AuthenticationServiceException($repositoryProblem->getMessage(), 0, $repositoryProblem);
            $ex->setToken($token);
            throw $ex;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function checkAuthentication( UserInterface $user, UsernamePasswordToken $token )
    {
        $currentUser = $token->getUser();
        if ( $currentUser instanceof WebserviceUser )
        {
            if ( !$this->wsManager->validaUsuario( $currentUser, $currentUser->getPassword() ) )
            {
                throw new BadCredentialsException( 'Las credenciales han sido cambiadas en otra sesión.' );
            }
        }
        else
        {
            $userWs = $this->wsManager->existeUsuario( $user->getUsername() );
            if (!$userWs) {
                throw new BadCredentialsException(sprintf('User "%s" not found', $user->getUsername()));
            }

            if (!$presentedPassword = $token->getCredentials()) {
                throw new BadCredentialsException('The presented password cannot be empty.');
            }

            $validation = $this->wsManager->validaUsuario( $user->getUsername(), $presentedPassword );
            if ( !$validation ) {
                throw new BadCredentialsException('The presented password is invalid.');
            }
            else
            {
                return new WebserviceUser(
                    $user->getUsername(),
                    $validation->_nombre,
                    $validation->_apellido1,
                    $validation->_apellido2,
                    $validation->_cod_colectivo
                );
            }
        }
    }
}
