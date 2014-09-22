<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/09/14
 * Time: 15:53
 */

namespace Efl\WebBundle\Helper;

use Efl\WebServiceBundle\Security\WebserviceUser;
use eZ\Publish\API\Repository\Repository;

class UtilsHelper
{
    private $repository;

    public function __construct(
        Repository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * Función para determinar el usuario que está logado, distinguiendo si es un usuario
     * webservice o un usuario del repository
     */
    public function getCurrentUser()
    {
        $user = $this->repository->getCurrentUser();
        return $user instanceof WebserviceUser ? $user->getAPIUser() : $user;

    }
}
