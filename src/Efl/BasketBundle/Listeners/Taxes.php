<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:29
 */

namespace Efl\BasketBundle\Listeners;

use Efl\BasketBundle\Event\BasketPreShowEvent;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
use EzSystems\EzPriceBundle\API\Price\ContentVatService;
use Symfony\Component\EventDispatcher\Event;

class Taxes extends Event
{
    /**
     * @var ContentVatService
     */
    private $contentVatService;

    /**
     * @var BasketService
     */
    private $basketService;

    public function __construct(
        ContentVatService $vatService,
        BasketService $basketService
    )
    {
        $this->contentVatService = $vatService;
        $this->basketService = $basketService;
    }

    public function applyTaxesToBasket( BasketPreShowEvent $event )
    {
        $items = $event->getBasket()->getItems();

        foreach( $items as $i => $item )
        {
            $priceField = $item->getContent()->getFields()[1];
            $vatRate = $this->contentVatService->loadVatRateForField( $priceField->id, $item->getContent()->contentInfo->currentVersionNo );
            $items[$i] = $this->basketService->applyTaxToItem( $item, $vatRate );
        }
        $event->getBasket()->setItems( $items );
    }
}
