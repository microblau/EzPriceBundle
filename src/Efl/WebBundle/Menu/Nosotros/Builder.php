<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/09/14
 * Time: 09:50
 */

namespace Efl\WebBundle\Menu\Nosotros;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use eZ\Publish\Core\Helper\TranslationHelper;

/**
 * A simple eZ Publish menu provider.
 */
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
     * @var ConfigResolverInterface
     */
    private $configResolver;

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
        ConfigResolverInterface $configResolver,
        LocationService $locationService,
        TranslationHelper $translationHelper,
        SearchService $searchService
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->configResolver = $configResolver;
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
        $menu = $this->factory->createItem( 'root' );

        $children = $this->getMenuItems();

        $porQueLocation = $this->locationService->loadLocation( 63 );

        $menu->addChild(
             "item_{$porQueLocation->id}",
             array(
                'label' => /** @Ignore*/$this->translationHelper->getTranslatedContentNameByContentInfo( $porQueLocation->contentInfo ),
                'uri' => $this->router->generate( $porQueLocation )
             )
        );

        foreach ( $children as $child )
        {
            $menu->addChild(
                 "item_$child->id",
                 array(
                    'label' => /** @Ignore*/$this->translationHelper->getTranslatedContentNameByContentInfo( $child->contentInfo ),
                    'uri' => $this->router->generate( $child )
                 )
            );
        }

        return $menu;
    }

    /**
     * Obtiene los elementos que han de formar parte del menú principal
     *
     * @return \Location[]
     */
    private function getMenuItems()
    {
        // hemos de buscar el contenido

        $items = array();
        $location = $this->locationService->loadLocation( 63 );
        $nosotrosLocation = $this->locationService->loadLocation( $location->parentLocationId );

        try
        {
            $query = new LocationQuery();

            $query->query = new Criterion\LogicalAnd(
                array(
                    new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                    new Criterion\Location\Depth( Criterion\Operator::EQ, $nosotrosLocation->depth + 1 ),
                    new Criterion\Subtree( $nosotrosLocation->pathString ),
                    new Criterion\LogicalNot(
                        new Criterion\LocationId( 63 )
                    )
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
        catch ( Exception $e )
        {
        }

        return $items;
    }
}
