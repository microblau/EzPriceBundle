<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 18/09/14
 * Time: 10:20
 */

namespace Efl\WebServiceBundle\EventListener;

use Efl\WebServiceBundle\Driver\UserCreatorService;
use eZ\Publish\API\Repository\Exceptions\NotFoundException;
use eZ\Publish\API\Repository\UserService;
use eZ\Publish\Core\MVC\Symfony\Event\InteractiveLoginEvent;
use eZ\Publish\Core\MVC\Symfony\MVCEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InteractiveLoginListener implements EventSubscriberInterface
{
    /**
     * @var \eZ\Publish\API\Repository\UserService
     */
    private $userService;

    private $userCreatorService;

    public function __construct( UserService $userService, UserCreatorService $userCreatorService )
    {
        $this->userService = $userService;
        $this->userCreatorService = $userCreatorService;
    }

    public static function getSubscribedEvents()
    {
        return array(
            MVCEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin'
        );
    }

    public function onInteractiveLogin( InteractiveLoginEvent $event )
    {
        $username = $event->getAuthenticationToken()->getUser()->getUserName();
        $colective = $event->getAuthenticationToken()->getUser()->getColective();

        try
        {
            $repositoryUser = $this->userService->loadUserByLogin( $username );
            $this->userCreatorService->placeUserInGroup( $repositoryUser, $colective );
        }
        catch ( NotFoundException $e )
        {
            $repositoryUser = $this->userCreatorService->createNewUser( $username, $colective );
        }

        $event->setApiUser( $repositoryUser );
    }
}
