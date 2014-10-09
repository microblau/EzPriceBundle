<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:36
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Gateway;

use Efl\BasketBundle\Entity\Ezbasket;
use Efl\BasketBundle\Entity\Ezproductcollection;
use Efl\BasketBundle\Entity\EzproductcollectionItem;
use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Gateway;
use Efl\DiscountsBundle\eZ\Publish\Core\Repository\DiscountsService;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use EzSystems\EzPriceBundle\API\Price\ContentVatService;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;

class Legacy extends Gateway
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    protected $contentService;

    /**
     * @var RelatedByOrders
     */
    protected $relatedByOrdersService;

    /**
     * @var ContentVatService
     */
    protected $contentVatService;

    /**
     * @var DiscountsService
     */
    protected $discountsService;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * EntityManager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var DatabaseHandler
     */
    protected $dbHandler;

    /**
     * @var Session
     */
    protected  $session;

    public function __construct(
        ContentService $contentService,
        RelatedByOrders $relatedByOrders,
        ContentVatService $contentVatService,
        DiscountsService $discountsService,
        Repository $repository,
        EntityManager $em,
        Session $session
    )
    {
        $this->contentService = $contentService;
        $this->relatedByOrdersService = $relatedByOrders;
        $this->contentVatService = $contentVatService;
        $this->discountsService = $discountsService;
        $this->repository = $repository;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * Set database handler
     *
     * @param mixed $dbHandler
     *
     * @return void
     * @throws \RuntimeException if $dbHandler is not an instance of
     *         {@link \eZ\Publish\Core\Persistence\Database\DatabaseHandler}
     */
    public function setConnection( $dbHandler )
    {
        // This obviously violates the Liskov substitution Principle, but with
        // the given class design there is no sane other option. Actually the
        // dbHandler *should* be passed to the constructor, and there should
        // not be the need to post-inject it.
        if ( !$dbHandler instanceof DatabaseHandler )
        {
            throw new \RuntimeException( "Invalid dbHandler passed" );
        }

        $this->dbHandler = $dbHandler;
    }

    /**
     * Returns the active connection
     *
     * @throws \RuntimeException if no connection has been set, yet.
     *
     * @return \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    protected function getConnection()
    {
        if ( $this->dbHandler === null )
        {
            throw new \RuntimeException( "Missing database connection." );
        }
        return $this->dbHandler;
    }

    /**
     * Lista de productos relacionados en compras
     *
     * @param array $contentIds
     * @param int $limit
     * @return array|\eZ\Publish\API\Repository\Values\Content\Content[]
     */
    public function relatedPurchasedListForContentIds( array $contentIds, $limit )
    {
        $this->relatedByOrdersService->setConnection( $this->getConnection() );
        $result = $this->relatedByOrdersService->relatedPurchasedListForContentIds( $contentIds, $limit );

        $products = array();

        foreach ( $result as $row )
        {
            $products[] = $this->contentService->loadContent( $row['contentobject_id'] );
        }

        return $products;
    }

    /**
     * Cesta. Si no se le pasa $byOrderId obtendrá la cesta en sesión
     *
     * @param int $byOrderId
     * @return array
     */
    public function currentBasket( $byOrderId = -1 )
    {
        if( $byOrderId != -1 )
        {
            $query = $this->em->createQueryBuilder();
            $query
                ->select( 'ezbasket' )
                ->from( 'EflBasketBundle:Ezbasket','ezbasket' )
                ->where(
                    $query->expr()->eq( 'ezbasket.orderId', ':orderId')
                )
                ->setParameter( 'orderId', $byOrderId );

            $basket = $query->getQuery()->getResult();
        }
        else
        {
            $query = $this->em->createQueryBuilder();
            $query
                ->select( 'ezbasket' )
                ->from( 'EflBasketBundle:Ezbasket','ezbasket' )
                ->where(
                    $query->expr()->eq( 'ezbasket.sessionId', ':sessionId')
                )
                ->setParameter( 'sessionId', $this->session->getId() );

            $basket = $query->getQuery()->getResult();
        }

        if( count( $basket) )
        {
            return array(
                'id' => $basket[0]->getId(),
                'sessionId' => $basket[0]->getSessionId(),
                'productCollectionId' => $basket[0]->getProductCollectionId(),
                'orderId' => $basket[0]->getOrderId()
            );
        }

        $this->em->beginTransaction();

        $collection = new Ezproductcollection();
        $collection->setCreated( time() );
        // @todo make this configurable per siteaccess
        $collection->setCurrencyCode( 'EUR' );
        $this->em->persist( $collection );
        $this->em->flush();

        $basket = new Ezbasket();
        $basket->setSessionId( $this->session->getId() );
        $basket->setProductcollectionId( $collection->getId() );
        $this->em->persist( $basket );
        $this->em->flush();

        $this->em->commit();

        return array(
            'id' => $basket->getId(),
            'sessionId' => $basket->getSessionId(),
            'productCollectionId' => $basket->getProductCollectionId(),
            'orderId' => $basket->getOrderId()
        );
    }

    /**
     * Obtiene los productos que están incluidos en la colección
     *
     * @param $productCollectionId
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem[]
     */
    public function getItemsByProductCollectionId( $productCollectionId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->from( 'EflBasketBundle:EzproductcollectionItem', 'ezproductcollection_item' )
            ->select( 'ezproductcollection_item' )
            ->where(
                $query->expr()->eq( 'ezproductcollection_item.productcollectionId', ':productCollectionId' )
            )
            ->setParameter( 'productCollectionId', $productCollectionId );

        $collection = $query->getQuery()->getResult();

        $addedProducts = array();

        foreach ( $collection as $product )
        {
            $addedProducts[] = $this->getAddedProductData( $product );
        }

        return $addedProducts;
    }

    /**
     * Añade producto a la colección de productos en la cesta
     *
     * @param $productCollectionId
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return mixed|void
     */
    public function addProductToProductCollection( $productCollectionId, $contentId, array $optionList = array(), $quantity = 1 )
    {
        $content = $this->contentService->loadContent( $contentId );
        $currentVersionNo = $content->contentInfo->currentVersionNo;
        $priceFieldId = $content->getFields()[1]->id;

        $priceObject = $content->getFieldValue( 'precio' );
        $price = $priceObject->price;

        /* Check if the item with the same options is not already in the basket: */
        $itemID = false;
        $collection = $this->getProductCollectionByProductCollectionId( $productCollectionId );

        if ( !$collection )
        {
            // @todo throw exception here

        }
        else
        {
            $collectionItems = $this->getProductCollectionItems( $collection->getId() );

            foreach ( $collectionItems as $item )
            {
                /* For all items in the basket which have the same object_id: */
                if ( $item->getContentobjectId() == $contentId )
                {
                    $itemObject = $item;
                    break;
                }
            }

            if ( isset( $itemObject ) )
            {
                /* If found in the basket, just increment number of that items: */
                $item->setItemCount( $quantity + $item->getItemCount() );
                $this->em->persist( $item );
                $this->em->flush();
            }
            else
            {
                $item = new EzproductcollectionItem();

                $item->setName( $content->contentInfo->name );
                $item->setContentobjectId( $content->id );
                $item->setItemCount( $quantity );
                $item->setPrice( $price );
                $item->setIsVatInc( $priceObject->isVatIncluded ? 1 : 0 );
                $item->setProductcollectionId( $productCollectionId );
                $item->setVatValue(
                    $this->contentVatService->loadVatRateForField( $priceFieldId, $currentVersionNo )->percentage
                );

                $discount = $this->discountsService->getDiscountPercent(
                    $this->repository->getCurrentUser(),
                    $content
                );

                $item->setDiscount( $discount ? $discount : 0 );

                $this->em->persist( $item );
                $this->em->flush();

            }

            return $this->getAddedProductData( $item );
        }
    }

    /**
     * Quitar el producto de la colección de productos actual
     *
     * @param $contentId
     *
     * @return mixed|void
     */
    public function removeProductFromBasket( $contentId )
    {
        $basket = $this->currentBasket();
        $productCollectionId = $basket->getProductcollectionId();

        $productCollectionItems = $this->getProductCollectionItem(
            $productCollectionId, $contentId
        );

        if ( count( $productCollectionItems ) )
        {
            $this->em->remove( $productCollectionItems[0] );
            $this->em->flush();
        }

    }

    /**
     * Datos a añadir a la cesta
     *
     * @param EzproductcollectionItem $product
     * @return array|bool
     */
    private function getAddedProductData( EzproductcollectionItem $product )
    {
        $content = $this->contentService->loadContent( $product->getContentobjectId() );

        if ( $content !== null )
        {
            $vatValue = $product->getVatValue();

            // If VAT is unknown yet then we use zero VAT percentage for price calculation.
            $realVatValue = $vatValue;
            if ( $vatValue == -1 )
                $vatValue = 0;

            $count = $product->getItemCount();
            $discountPercent = $product->getDiscount();
            $nodeID = $content->contentInfo->mainLocationId;
            $objectName = $content->contentInfo->name;

            $isVATIncluded = $product->getIsVatInc();
            $price = $product->getPrice();

            if ( $isVATIncluded )
            {
                $priceExVAT = $price / ( 100 + $vatValue ) * 100;
                $priceIncVAT = $price;
                $totalPriceExVAT = $count * $priceExVAT * ( 100 - $discountPercent ) / 100;
                $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
            }
            else
            {
                $priceExVAT = $price;
                $priceIncVAT = $price * ( 100 + $vatValue ) / 100;
                $totalPriceExVAT = $count * $priceExVAT  * ( 100 - $discountPercent ) / 100;
                $totalPriceIncVAT = $count * $priceIncVAT * ( 100 - $discountPercent ) / 100 ;
            }

            $addedProduct = array(
                'id' => $product->getId(),
                'vatValue' => $realVatValue,
                'itemCount' => $count,
                'locationId' => $content->contentInfo->mainLocationId,
                'objectName' => $objectName,
                'priceExVat' => $priceExVAT,
                'priceIncVat' => $priceIncVAT,
                'discountPercent' => $discountPercent,
                'totalPriceExVat' => $totalPriceExVAT,
                'totalPriceIncVat' => $totalPriceIncVAT,
                'content' => $content
            );

            return $addedProduct;
        }

        return false;
    }

    /**
     * Colección de productos par un id dado
     *
     * @param int $productCollectionId
     * @return mixed
     */
    private function getProductCollectionByProductCollectionId ( $productCollectionId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'ezproductcollection' )
            ->from( 'EflBasketBundle:Ezproductcollection','ezproductcollection' )
            ->where(
                $query->expr()->eq( 'ezproductcollection.id', ':productCollectionId')
            )
            ->setParameter( 'productCollectionId', $productCollectionId );

        return $query->getQuery()->getResult()[0];
    }

    /**
     * @param $productCollectionId
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem[]
     */
    private function getProductCollectionItems( $productCollectionId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'ezproductcollection_item' )
            ->from( 'EflBasketBundle:EzproductcollectionItem','ezproductcollection_item' )
            ->where(
                $query->expr()->eq( 'ezproductcollection_item.productcollectionId', ':productCollectionId')
            )
            ->setParameter( 'productCollectionId', $productCollectionId );

        return $query->getQuery()->getResult();
    }

    /**
     * Obtiene un item de compra en función del id de la colección
     * de productos y el objeto.
     *
     * @param $productCollectionId
     * @param $contentId
     *
     * @return array
     */
    private function getProductCollectionItem( $productCollectionId, $contentId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'ezproductcollection_item' )
            ->from( 'EflBasketBundle:EzproductcollectionItem','ezproductcollection_item' )
            ->where(
                $query->expr()->andX(
                    $query->expr()->eq( 'ezproductcollection_item.productcollectionId', ':productCollectionId' ),
                    $query->expr()->eq( 'ezproductcollection_item.contentobjectId', ':contentId')
                )
            )
            ->setParameter( 'productCollectionId', $productCollectionId )
            ->setParameter( 'contentId', $contentId );

        return $query->getQuery()->getResult();
    }
}
