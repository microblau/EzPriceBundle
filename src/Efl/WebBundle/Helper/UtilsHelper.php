<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/09/14
 * Time: 15:53
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\Repository;
use eZ\Publish\Core\MVC\Symfony\Security\UserWrapped;
use Symfony\Component\Security\Core\SecurityContext;

class UtilsHelper
{
    private $repository;

    private $securityContext;

    public function __construct(
        Repository $repository,
        SecurityContext $securityContext
    )
    {
        $this->repository = $repository;
        $this->securityContext = $securityContext;
    }

    /**
     * Función para determinar el usuario del repo
     * que está logado, distinguiendo si es un usuario
     * webservice o un usuario del repository
     */
    public function getCurrentRepositoryUserId()
    {
        $currentUser = $this->securityContext;
        return $currentUser->isGranted('IS_AUTHENTICATED_FULLY')
            ? $currentUser->getToken()->getUser()->getAPIUser()->content->id
            : 10;
    }

    public function getCurrentUserFriendlyData()
    {
        if ( !$this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') )
            return array();

        $data = array();
        $user = $this->securityContext->getToken()->getUser();

        if ( $user instanceof UserWrapped )
        {
            $data['nombre'] = $user->getWrappedUser()->getNombre();
            $data['apellido1'] = $user->getWrappedUser()->getApellido1();
            $data['apellido2'] = $user->getWrappedUser()->getApellido2();
            $data['email'] = $user->getUsername();
        }
        else
        {
            $userContent = $user->getAPIUser()->content;
            $data['nombre'] = $userContent->getFieldValue( 'first_name' )->text;
            $data['apellido1'] = $userContent->getFieldValue( 'last_name' )->text;
            $data['apellido2'] = '';
            $data['email'] = $userContent->getFieldValue( 'user_account' )->email;
        }

        return $data;
    }
}
