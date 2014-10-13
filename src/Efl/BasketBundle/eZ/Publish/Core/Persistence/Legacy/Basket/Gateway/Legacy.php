<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:36
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Gateway;

use Efl\BasketBundle\Entity\Couponcode;
use Efl\BasketBundle\Entity\Ezbasket;
use Efl\BasketBundle\Entity\Ezproductcollection;
use Efl\BasketBundle\Entity\EzproductcollectionItem;
use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Gateway;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\Product as DiscountProduct;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentTypeService;
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
     * @var \eZ\Publish\API\Repository\LocationService
     */
    protected $locationService;

    /**
     * @var ContentTypeService
     */
    protected $contentTypeService;

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
        LocationService $locationService,
        ContentTypeService $contentTypeService,
        RelatedByOrders $relatedByOrders,
        ContentVatService $contentVatService,
        Repository $repository,
        EntityManager $em,
        Session $session
    )
    {
        $this->contentService = $contentService;
        $this->locationService = $locationService;
        $this->contentTypeService = $contentTypeService;
        $this->relatedByOrdersService = $relatedByOrders;
        $this->contentVatService = $contentVatService;
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
            $sessionId = $this->session->getId();

            $query = $this->em->createQueryBuilder();
            $query
                ->select( 'ezbasket' )
                ->from( 'EflBasketBundle:Ezbasket','ezbasket' )
                ->where(
                    $query->expr()->eq( 'ezbasket.sessionId', ':sessionId')
                )
                ->setParameter( 'sessionId',  $sessionId );

            $basket = $query->getQuery()->getResult();
        }

        if( count( $basket) )
        {
            return $this->getBasketArrayData( $basket[0] );
        }

        $this->em->beginTransaction();

        $collection = new Ezproductcollection();
        $collection->setCreated( time() );
        // @todo make this configurable per siteaccess
        $collection->setCurrencyCode( 'EUR' );
        $this->em->persist( $collection );
        $this->em->flush();

        $basket = new Ezbasket();
        $basket->setSessionId( $sessionId );
        $basket->setProductcollectionId( $collection->getId() );
        $basket->setOrderId( 0 );
        $this->em->persist( $basket );
        $this->em->flush();

        $this->em->commit();

        return $this->getBasketArrayData( $basket );
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
            $addedProducts[] = $this->getProductData( $product );
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

        $priceObject = $content->getFieldValue( 'precio' );
        $price = $priceObject->price;

        /* Check if the item with the same options is not already in the basket: */
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

                $objectNameExploded = explode( ' - ', $content->contentInfo->name );
                $location = $this->locationService->loadLocation( $content->contentInfo->mainLocationId );
                $parentLocation = $this->locationService->loadLocation( $location->parentLocationId );
                $parentContent = $this->contentService->loadContent(
                    $parentLocation->contentId
                );

                $item->setName( $parentContent->contentInfo->name . ' - ' . $objectNameExploded[1] );
                $item->setContentobjectId( $content->id );
                $item->setItemCount( $quantity );
                $item->setPrice( $price );
                $item->setIsVatInc( $priceObject->isVatIncluded ? 1 : 0 );
                $item->setProductcollectionId( $productCollectionId );

                // inicializamos vat y descuento y los seteamos mediante listeners
                $item->setVatValue( 0 );
                $item->setDiscount( 0 );

                $this->em->persist( $item );
                $this->em->flush();

            }

            return $this->getProductData( $item );
        }
    }

    /**
     * Quitar el producto de la colección de productos actual
     *
     * @param $productCollectionId
     * @param $contentId
     *
     * @return mixed|void
     */
    public function removeProductFromBasket( $productCollectionId, $contentId )
    {
        $productCollectionItems = $this->getProductCollectionItem(
            $productCollectionId, $contentId
        );

        if ( count( $productCollectionItems ) )
        {
            $this->em->remove( $productCollectionItems[0] );
            $this->em->flush();
        }

        return $this->getProductData( $productCollectionItems[0] );

    }

    /**
     * Actualizar en la base de datos el número de unidades para el producto
     *
     * @param $productCollectionItemId
     * @param $quantity
     * @return mixed|void
     */
    public function updateBasketItemQuantity( $productCollectionItemId, $quantity )
    {
        $item = $this->em->find( 'EflBasketBundle:EzproductcollectionItem', $productCollectionItemId );
        $item->setItemCount( $quantity );
        $this->em->persist( $item );
        $this->em->flush();

        return $this->getProductData( $item );
    }

    /**
     * @param $productCollectionItemId
     * @param $discountPercent
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function applyDiscountToItem( $productCollectionItemId, $discountPercent )
    {
        $item = $this->em->find( 'EflBasketBundle:EzproductcollectionItem', $productCollectionItemId );
        $item->setDiscount( $discountPercent );
        $content = $this->contentService->loadContent( $item->getContentobjectId() );
        $price = $content->getFieldValue( 'precio' );
        $item->setPrice( $price->price * ( 100 - $discountPercent ) / 100 );
        $this->em->persist( $item );
        $this->em->flush();

        return $this->getProductData( $item );
    }

    /**
     * @param $productCollectionItemId
     * @param $taxPercentage
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function applyTaxToItem( $productCollectionItemId, $taxPercentage )
    {
        $item = $this->em->find( 'EflBasketBundle:EzproductcollectionItem', $productCollectionItemId );
        $item->setVatValue( $taxPercentage );
        $this->em->persist( $item );
        $this->em->flush();

        return $this->getProductData( $item );
    }

    /**
     * Actualizar id de sesión de la cesta
     *
     * @param $oldSessionId
     * @param $newSessionId
     *
     * @return mixed|void
     */
    public function resetBasketSessionId( $oldSessionId, $newSessionId )
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->update('EflBasketBundle:Ezbasket', 'b')
                ->set('b.sessionId', $qb->expr()->literal( $newSessionId ) )
                ->where('b.sessionId = ?1')
                ->setParameter(1, $oldSessionId )
                ->getQuery();
        $q->execute();
    }
    /**
     * Crear un cupón nuevo en la base de datos.
     *
     * @param $basketId
     * @param $couponCode
     * @return array
     */
    public function setDiscountCoupon( $basketId, $couponCode )
    {
        $basket = $this->em->find( 'EflBasketBundle:Ezbasket', $basketId );
        if ( !$coupon = $this->em->find( 'EflBasketBundle:Couponcode', $basketId ) )
        {
            $coupon = new Couponcode();
        }
        $coupon->setBasketId( $basket->getId() );
        $coupon->setBasket( $basket );
        $coupon->setCoupon( $couponCode );
        $this->em->persist( $coupon );
        $this->em->flush();
    }

    /**
     * Función auxiliar para obtener el código de cupón asociado a cesta
     *
     * @param $basketId
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    private function getDiscountCoupon( $basketId )
    {
        if ( $coupon = $this->em->find( 'EflBasketBundle:Couponcode', $basketId ) )
        {
            return $coupon->getCoupon();
        }

        return '';
    }

    /**
     * Datos a añadir a la cesta
     *
     * @param EzproductcollectionItem $product
     * @return array|bool
     */
    private function getProductData( EzproductcollectionItem $product )
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

            $isVATIncluded = $product->getIsVatInc();
            $price = $product->getPrice();

            if ( $isVATIncluded )
            {
                $priceExVAT = $price / ( 100 + $vatValue ) * 100;
                $priceIncVAT = $price;
                $totalPriceExVAT = $count * $priceExVAT; // * ( 100 - $discountPercent ) / 100;
                $totalPriceIncVAT = $count * $priceIncVAT; // * ( 100 - $discountPercent ) / 100 ;
            }
            else
            {
                $priceExVAT = $price;
                $priceIncVAT = $price * ( 100 + $vatValue ) / 100;
                $totalPriceExVAT = $count * $priceExVAT; // * ( 100 - $discountPercent ) / 100;
                $totalPriceIncVAT = $count * $priceIncVAT; // * ( 100 - $discountPercent ) / 100 ;
            }

            $discount = null;

            if ( $product->getDiscount() > 0 )
            {
                $discount = new DiscountProduct(
                    array(
                        'percentage' => $product->getDiscount()
                    )
                );
            }

            $addedProduct = array(
                'id' => $product->getId(),
                'vatValue' => $realVatValue,
                'itemCount' => $product->getItemCount(),
                'locationId' => $content->contentInfo->mainLocationId,
                'objectName' => $product->getName(),
                'priceExVat' => $priceExVAT,
                'priceIncVat' => $priceIncVAT,
                'basePriceExVat' => $totalPriceExVAT,
                'totalPriceIncVat' => $totalPriceIncVAT,
                'totalPriceExVat' => $totalPriceExVAT,
                'content' => $content,
                'contentTypeIdentifier' => $this->contentTypeService->loadContentType(
                    $content->contentInfo->contentTypeId
                )->identifier,
                'discount' => $discount
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

    /**
     * Representación de la info de la entidad ezbasket para formar nuestro valor
     *
     * @param Ezbasket $basket
     * @return array
     */
    private function getBasketArrayData( Ezbasket $basket )
    {
        return array(
            'id' => $basket->getId(),
            'sessionId' => $basket->getSessionId(),
            'productCollectionId' => $basket->getProductCollectionId(),
            'orderId' => $basket->getOrderId(),
            'discountCode' => $this->getDiscountCoupon( $basket->getId() )
        );
    }
}
