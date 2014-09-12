<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 13:07
 */

namespace Efl\WebBundle\Menu\Footer\External;

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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

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

    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router,
        ConfigResolverInterface $configResolver,
        LocationService $locationService,
        ContentService $contentService,
        SearchService $searchService
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->configResolver = $configResolver;
        $this->locationService = $locationService;
        $this->contentService = $contentService;
        $this->searchService = $searchService;
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

        foreach ( $children as $key => $child )
        {
            $menu->addChild(
                "item_{$key}",
                array(
                    'label' => /** @Ignore */$child['label'],
                    'uri' => $child['url']
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
        // hemos de buscar el contenido
        $location = $this->locationService->loadLocation( 142 );
        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 2 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( array( 'link_matrix' ) )
            )
        );

        $queryResults = $this->searchService->findLocations( $query )->searchHits;

        $items = array();

        if ( count( $queryResults) )
        {
            try
            {
                $content = $this->contentService->loadContent(
                    $queryResults[0]->valueObject->contentInfo->id
                );

                /** @var Blend/EzMatrixBundle/eZ/Publish/Core/FieldType/Matrix/Value $matrixValue */
                $matrixValue = $content->getFieldValue( 'matrix' );
                $rows = $matrixValue->rows->toArray();

                foreach ( $rows as $row )
                {
                    $items[] = array(
                        'label' => /** @Ignore */$row['text'],
                        'url' => $row['url'],
                    );
                }
            }
            catch ( Exception $e )
            {
                throw new NotFoundException( 'No se ha encontrado la matriz de enlaces', 'matrix' );
            }
        }
        return $items;
    }
}
