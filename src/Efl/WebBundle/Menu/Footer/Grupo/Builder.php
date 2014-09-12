<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 13:07
 */

namespace Efl\WebBundle\Menu\Footer\Grupo;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\Core\Base\Exceptions\NotFoundException;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
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
     * @var \eZ\Publish\API\Repository\SearchService
     */
    private $searchService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router,
        ConfigResolverInterface $configResolver,
        LocationService $locationService,
        ContentService $contentService,
        SearchService $searchService,
        TranslationHelper $translationHelper
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->configResolver = $configResolver;
        $this->locationService = $locationService;
        $this->contentService = $contentService;
        $this->searchService = $searchService;
        $this->translationHelper = $translationHelper;
    }

    /**
     * Forma el menú principal
     *
     * @param Request $request
     * @return ItemInterface
     */
    public function createMenu( Request $request )
    {
        $menu = $this->factory->createItem( 'root' );

        $children = $this->getMenuItems();

        foreach ( $children as $child )
        {
            $menu->addChild(
                "item_{$child->id}",
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
     * @throws NotFoundException si la matriz de enlaces no se puede encontrar
     *
     * @return array
     */
    private function getMenuItems()
    {
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
