<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\Core\FieldType\Page\PageService;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use eZ\Publish\Core\MVC\Symfony\Controller\Content\ViewController;

class NewsletterHelper
{
    /**
     * @var \eZ\Publish\API\Repository\Repository;
     */
    protected $repository;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    protected $locationService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    protected $searchService;

    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    protected $contentService;

    /**
     * @var \eZ\Publish\Core\FieldType\Page\PageService
     */
    protected $pageService;

    /**
     * @var \eZ\Publish\Core\MVC\Symfony\Controller\Content\ViewController
     */
    protected $viewController;

    public function __construct(
        Repository $repository,
        LocationService $locationService,
        SearchService $searchService,
        ContentService $contentService,
        PageService $pageService,
        ViewController $viewController
    )
    {
        $this->repository = $repository;
        $this->locationService = $locationService;
        $this->searchService = $searchService;
        $this->contentService = $contentService;
        $this->pageService = $pageService;
        $this->viewController = $viewController;
    }

    /**
     * Devuelve una lista con las áreas de interés susceptibles
     * de ser seleccionadas en el formulario de suscripción
     * a la newsletter
     *
     * @return ChoiceList
     */
    public function getAreasInteres()
    {
        $location = $this->locationService->loadLocation( 143 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->repository->getSearchService()->findLocations( $query )->searchHits;

        $values = array();

        foreach ( $results as $result )
        {
            $values[$result->valueObject->contentInfo->id] = $result->valueObject->contentInfo->name;
        }

        return new SimpleChoiceList( array( $values ) );
    }

    public function getEbooksRegalo()
    {
        $home = $this->contentService->loadContent( 11004 );
        $page = $home->getFieldValue( 'page' );
        $block = $page->page->zones[1]->blocks[3];
        $items = $this->pageService->getValidBlockItems( $block );
        $values = array();

        foreach ( $items as $item )
        {

            $content = $this->contentService->loadContentInfo( $item->contentId );
            if ( $content->contentTypeId == 138 )
            {
                $values[$item->contentId] = $this->viewController->viewContent(
                    $item->contentId,
                    'ebook_regalo',
                    false
                )->getContent();
            }
        }

        return new SimpleChoiceList( array( $values ) );
    }
}
