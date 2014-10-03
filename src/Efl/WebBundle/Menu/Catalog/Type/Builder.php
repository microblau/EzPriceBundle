<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 3/10/14
 * Time: 19:00
 */

namespace Efl\WebBundle\Menu\Catalog\Type;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use eZ\Publish\Core\Helper\TranslationHelper;
use eZ\Publish\Core\Repository\SearchService;

class Builder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    /**
     * @var SearchService
     */
    private $searchService;

    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router,
        LocationService $locationService,
        TranslationHelper $translationHelper,
        SearchService $searchService
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->locationService = $locationService;
        $this->translationHelper = $translationHelper;
        $this->searchService = $searchService;
    }

    /**
     * Forma el menú de la sección nosotros
     *
     * @param Request $request
     * @return ItemInterface
     */
    public function createMenu( Request $request )
    {
        $menu = $this->factory->createItem( 'root', array( 'childrenAttributes' => array( 'class' => 'cols-7' ) ) );

        $children = $this->getMenuItems();

        foreach ( $children as $index => $child )
        {
            $menu->addChild(
                "item_$child->id",
                array(
                    'label' => /** @Ignore*/$this->translationHelper->getTranslatedContentNameByContentInfo( $child->contentInfo ),
                    'uri' => $this->router->generate( $child ),
                    'attributes' => array(
                        'class' => 'item-' . ( $index + 1 )
                    )
                )
            );
        }

        return $menu;
    }

    /**
     * Obtiene los elementos que han de formar parte del menú qmemento
     *
     * @return \Location[]
     */
    private function getMenuItems()
    {
        $items = array();
        $location = $this->locationService->loadLocation( 70 );

        try
        {
            $query = new LocationQuery();

            $query->query = new Criterion\LogicalAnd(
                array(
                    new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                    new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                    new Criterion\Subtree( $location->pathString ),
                    new Criterion\ContentTypeIdentifier( 'producto_nautis' )
                )
            );

            $query->sortClauses = array( new Query\SortClause\Location\Priority() );

            $queryResults = $this->searchService->findLocations( $query )->searchHits;

            foreach ( $queryResults as $queryResult )
            {
                $items[] = $this->locationService->loadLocation(
                    $queryResult->valueObject->id
                );
            }
        }
        catch ( \Exception $e )
        {
        }

        return $items;
    }
}
