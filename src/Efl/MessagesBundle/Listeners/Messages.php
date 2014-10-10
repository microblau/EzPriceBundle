<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 9/10/14
 * Time: 15:22
 */

namespace Efl\MessagesBundle\Listeners;

use Efl\BasketBundle\Event\AddItemToBasketEvent;
use Efl\BasketBundle\Event\RemoveItemFromBasketEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class Messages
{
    private $session;

    private $translator;

    public function __construct(
        Session $session,
        Translator $translator
    )
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * Añadir mensaje para indicar al usuario que ha añadido producto a la cesta
     *
     * @param AddItemToBasketEvent $event
     */
    public function onAddItemToBasket( AddItemToBasketEvent $event)
    {
        $this->session->getFlashBag()->add(
           'basketMsg',
           $this->translator->trans(
               'Acabamos de añadir el <b>%product%</b> a la compra.',
               array(
                   '%product%' => $event->getItem()->objectName
               )
           )
        );
    }

    /**
     * Añadir mensaje para indicar al usuario que ha añadido producto a la cesta
     *
     * @param AddItemToBasketEvent $event
     */
    public function onRemoveItemFromBasket( RemoveItemFromBasketEvent $event)
    {
        $this->session->getFlashBag()->add(
            'basketMsg',
            $this->translator->trans(
                'Acabamos de quitar el <b>%product%</b> de la compra.',
                array(
                    '%product%' => $event->getItem()->objectName
                )
            )
        );
    }
}
