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
use Efl\BasketBundle\Event\UpdateQuantityItemInBasket;
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
    public function onAddItemToBasket( AddItemToBasketEvent $event )
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
     * Añadir mensaje para indicar al usuario que ha quitado el producto de la cesta
     *
     * @param RemoveItemFromBasketEvent $event
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

    /**
     * Añadir mensaje para indicar al usuario que ha actualizado el número de unidades de l
     * un item en la cesta
     *
     * @param UpdateQuantityItemInBasket $event
     */
    public function onUpdateItemInBasket( UpdateQuantityItemInBasket $event)
    {
        $this->session->getFlashBag()->add(
            'basketMsg',
            $this->translator->trans(
                'Acabamos de actualizar el número de unidades del producto <b>%product%</b> a <b>%quantity%</b>',
                array(
                    '%product%' => $event->getItem()->objectName,
                    '%quantity%' => $event->getQuantity()
                )
            )
        );
    }
}
