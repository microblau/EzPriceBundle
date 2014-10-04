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
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;

class Legacy extends Gateway
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    protected $contentService;

    protected $relatedByOrdersService;

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
        EntityManager $em,
        Session $session
    )
    {
        $this->contentService = $contentService;
        $this->relatedByOrdersService = $relatedByOrders;
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
     * @return mixed
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
            return $basket[0];
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

        return $basket;
    }

    /**
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

    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $content = $this->contentService->loadContent( $contentId );
        $locationId = $content->contentInfo->mainLocationId;
        $price = 0.0;
        $isVATIncluded = true;

        $price = $content->getFieldValue( 'precio' )->price;

        $basket = $this->currentBasket();

        /* Check if the item with the same options is not already in the basket: */
        $itemID = false;
        $collection = $this->getItemsByProductCollectionId( $basket->getProductcollectionId() );

        if ( !$collection )
        {
            // @todo throw exception here

        }
        else
        {

            $count = 0;
            /* Calculate number of options passed via the HTTP variable: */
            foreach ( array_keys( $optionList ) as $key )
            {
                if ( is_array( $optionList[$key] ) )
                    $count += count( $optionList[$key] );
                else
                    $count++;
            }
            $collectionItems = $collection->itemList( false );
            foreach ( $collectionItems as $item )
            {
                /* For all items in the basket which have the same object_id: */
                if ( $item['contentobject_id'] == $objectID )
                {
                    $options = eZProductCollectionItemOption::fetchList( $item['id'], false );
                    /* If the number of option for this item is not the same as in the HTTP variable: */
                    if ( count( $options ) != $count )
                    {
                        break;
                    }
                    $theSame = true;
                    foreach ( $options as $option )
                    {
                        /* If any option differs, go away: */
                        if ( ( is_array( $optionList[$option['object_attribute_id']] ) &&
                                !in_array( $option['option_item_id'], $optionList[$option['object_attribute_id']] ) )
                            || ( !is_array( $optionList[$option['object_attribute_id']] ) &&
                                $option['option_item_id'] != $optionList[$option['object_attribute_id']] ) )
                        {
                            $theSame = false;
                            break;
                        }
                    }
                    if ( $theSame )
                    {
                        $itemID = $item['id'];
                        break;
                    }
                }
            }

            if ( $itemID )
            {
                /* If found in the basket, just increment number of that items: */
                $item = eZProductCollectionItem::fetch( $itemID );
                $item->setAttribute( 'item_count', $quantity + $item->attribute( 'item_count' ) );
                $item->store();
            }
            else
            {
                $item = eZProductCollectionItem::create( $basket->attribute( "productcollection_id" ) );

                $item->setAttribute( 'name', $object->attribute( 'name' ) );
                $item->setAttribute( "contentobject_id", $objectID );
                $item->setAttribute( "item_count", $quantity );
                $item->setAttribute( "price", $price );
                if ( $priceObj->attribute( 'is_vat_included' ) )
                {
                    $item->setAttribute( "is_vat_inc", '1' );
                }
                else
                {
                    $item->setAttribute( "is_vat_inc", '0' );
                }
                $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
                $item->setAttribute( "discount", $priceObj->attribute( 'discount_percent' ) );
                $item->store();
                $priceWithoutOptions = $price;

                $optionIDList = array();
                foreach ( array_keys( $optionList ) as $key )
                {
                    $attributeID = $key;
                    $optionString = $optionList[$key];
                    if ( is_array( $optionString ) )
                    {
                        foreach ( $optionString as $optionID )
                        {
                            $optionIDList[] = array( 'attribute_id' => $attributeID,
                                'option_string' => $optionID );
                        }
                    }
                    else
                    {
                        $optionIDList[] = array( 'attribute_id' => $attributeID,
                            'option_string' => $optionString );
                    }
                }

                $db = eZDB::instance();
                $db->begin();
                foreach ( $optionIDList as $optionIDItem )
                {
                    $attributeID = $optionIDItem['attribute_id'];
                    $optionString = $optionIDItem['option_string'];

                    $attribute = eZContentObjectAttribute::fetch( $attributeID, $object->attribute( 'current_version' ) );
                    $dataType = $attribute->dataType();
                    $optionData = $dataType->productOptionInformation( $attribute, $optionString, $item );
                    if ( $optionData )
                    {
                        $optionData['additional_price'] = eZShopFunctions::convertAdditionalPrice( $currency, $optionData['additional_price'] );
                        $optionItem = eZProductCollectionItemOption::create( $item->attribute( 'id' ), $optionData['id'], $optionData['name'],
                            $optionData['value'], $optionData['additional_price'], $attributeID );
                        $optionItem->store();
                        $price += $optionData['additional_price'];
                    }
                }

                if ( $price != $priceWithoutOptions )
                {
                    $item->setAttribute( "price", $price );
                    $item->store();
                }
                $db->commit();
            }
        }

    }

    private function getAddedProductData( EzproductcollectionItem $product )
    {
        $content = $this->contentService->loadContent( $product->getContentobjectId() );

        $discountPercent = 0.0;
        $isVATIncluded = true;

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
                "id" => $product->getId(),
                "vatValue" => $realVatValue,
                "itemCount" => $count,
                "locationId" => $nodeID,
                "objectName" => $objectName,
                "priceExVat" => $priceExVAT,
                "priceIncVat" => $priceIncVAT,
                "discountPercent" => $discountPercent,
                "totalPriceExVat" => $totalPriceExVAT,
                "totalPriceIncVat" => $totalPriceIncVAT,
                'content' => $content );

            return $addedProduct;
        }

        return false;
    }
}
