<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 18/09/14
 * Time: 10:20
 */

namespace Efl\WebServiceBundle\EventListener;

use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
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

    private $basketService;

    public function __construct(
        UserService $userService,
        UserCreatorService $userCreatorService,
        BasketService $basketService
    )
    {
        $this->userService = $userService;
        $this->userCreatorService = $userCreatorService;
        $this->basketService = $basketService;
    }

    public static function getSubscribedEvents()
    {
        return array(
            MVCEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin'
        );
    }

    public function onInteractiveLogin( InteractiveLoginEvent $event )
    {
        $old_session_id = $event->getRequest()->getSession()->get( 'old_session_id' );

        $this->basketService->resetBasketSessionId(
            $old_session_id,
            $event->getRequest()->getSession()->getId()
        );

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

        $event->getRequest()->getSession()->remove( 'old_session_id' );
    }
}
