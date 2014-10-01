<?php

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\Core\Helper\FieldHelper;
use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use Efl\ReviewsBundle\eZ\Publish\Core\Repository\ReviewsService;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\Core\MVC\Symfony\Templating\Twig\Extension\ContentExtension;

class ProductHelper
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    private $contentService;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    /**
     * @var FieldHelper
     */
    private $fieldHelper;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var ReviewsService
     */
    private $reviewsService;

    /**
     * @var ContentTypeService
     */
    private $contentTypeService;

    private $contentExtension;

    public function __construct(
        ContentService $contentService,
        LocationService $locationService,
        FieldHelper $fieldHelper,
        SearchService $searchService,
        ReviewsService $reviewsService,
        ContentTypeService $contentTypeService,
        ContentExtension $contentExtension
    )
    {
        $this->contentService = $contentService;
        $this->locationService = $locationService;
        $this->fieldHelper = $fieldHelper;
        $this->searchService = $searchService;
        $this->reviewsService = $reviewsService;
        $this->contentTypeService = $contentTypeService;
        $this->contentExtension = $contentExtension;
    }

    /**
     * @param $locationId
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content
     */
    private function getContentByLocationId( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );
        return $this->contentService->loadContent( $location->contentInfo->id );
    }

    /**
     * Obtiene la imagen asociada al producto
     *
     * @param $locationId
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content
     */
    public function getImageByProductLocationId( $locationId )
    {
        if ( !$this->fieldHelper->isFieldEmpty( $this->getContentByLocationId( $locationId ), 'image_2014' ) )
        {
            return $this->contentService->loadContent(
                $this->getContentByLocationId( $locationId )->getFieldValue( 'image_2014' )->destinationContentId
            );
        }

        $images = $this->getContentByLocationId( $locationId )->getFieldValue( 'imagen' );
        return $this->contentService->loadContent( $images->destinationContentIds[0] );
    }

    /**
     * @param $locationId
     *
     * @return mixed
     */
    public function getFechaAparicionByProductLocationId( $locationId )
    {
        return $this->getContentByLocationId( $locationId )->getFieldValue( 'fecha_aparicion' );
    }

    /**
     * Determina que tab mostraremos activa por defecto en función del contenido
     *
     * @param $locationId
     * @return array
     */
    public function getActiveTab( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );
        $content = $this->contentService->loadContent( $location->contentId );
        $activeTab = 0;
        $hasTab1 = $this->contentHasNovedades( $content );
        $sistemaMemento = $this->contentHasSistemaMemento( $location );
        $reviews = $this->contentHasReviews( $location );

        if ( $hasTab1 )
        {
            $activeTab = 1;
        }
        else if ( $sistemaMemento )
        {
            $activeTab = 2;
        }
        else if ( $reviews )
        {
            $activeTab = 3;
        }

        return array(
            'hasTab1' => $hasTab1,
            'sistemaMemento' => $sistemaMemento,
            'reviews' => $reviews,
            'activeTab' => $activeTab
        );
    }

    /**
     * @param $content
     * @return bool
     */
    private function contentHasNovedades( Content $content )
    {
        return !$this->fieldHelper->isFieldEmpty( $content, 'novedades' );
    }


    /**
     * Mira si la localización tiene hijos de tipo sistema memento
     *
     * @param Location $location
     * @return array|bool
     */
    private function contentHasSistemaMemento( Location $location )
    {
        $sistemaMemento = false;

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( 'sistema_memento' )
            )
        );

        if ( $this->searchService->findLocations( $query )->totalCount > 0 )
        {
            $content = $this->contentService->loadContent(
                $this->searchService->findLocations( $query )->searchHits[0]->valueObject->contentInfo->id
            );
            $img = $content->getFieldValue( 'image' );
            $image = $this->contentService->loadContent( $img->destinationContentId );
            $sistemaMemento = array(
                'content' => $content,
                'image' => $image
            );
        }

        return $sistemaMemento;
    }

    /**
     * Devuelve las reviews que tiene el producto y falso en caso contrario
     *
     * @param Location $location
     * @return bool|mixed
     */
    private function contentHasReviews( Location $location )
    {
        return $this->reviewsService->getReviewsCountForLocation( $location ) > 0
            ? $this->reviewsService->getReviewsForLocation( $location, 3 )
            : false;
    }

    /**
     * @param Content $content
     *
     * return array
     */
    public function buildElementForLineView( Content $content )
    {
        $location = $this->locationService->loadLocation($content->contentInfo->mainLocationId);
        $parentLocation = $this->locationService->loadLocation($location->parentLocationId);
        return array(
            'content' => $content,
            'image' => $this->getImageByProductLocationId($content->contentInfo->mainLocationId),
            'parent' => $this->contentService->loadContent($parentLocation->contentId)
        );
    }

    /**
     * Hay que mostrar resume?
     *
     * @param Content $content
     *
     * @return bool
     */
    public function contentHasResume( Content $content )
    {
        return !$this->fieldHelper->isFieldEmpty( $content, 'texto_oferta' )
            || !$this->fieldHelper->isFieldEmpty( $content, 'precio' )
            || !$this->fieldHelper->isFieldEmpty( $content, 'precio_oferta' );
    }

    public function getFormatosForLocation( Location $location )
    {
        $formatos = array();

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier(
                    array(
                        'formato_papel',
                        'formato_ipad',
                        'formato_internet'
                    )
                )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;

        foreach ( $results as $result )
        {
            $content = $this->contentService->loadContent(
                $result->valueObject->contentId
            );

            $contentTypeIdentifier = $this->contentTypeService->loadContentType(
                $content->contentInfo->contentTypeId
            )->identifier;
            $formatos[$contentTypeIdentifier] = array(
                'content' => $content,
                'data' => $this->getFormatData( $content )
            );
        }

        return $formatos;
    }

    private function getFormatData( Content $content )
    {
        $contentTypeService = $this->contentTypeService->loadContentType( $content->contentInfo->contentTypeId );

        if ( $contentTypeService->identifier == 'formato_papel' )
        {
            return array(
                'icon' => 'paper',
                'literal' => 'En Papel'
            );
        }

        if ( $contentTypeService->identifier == 'formato_ipad' )
        {
            return array(
                'icon' => 'tablet',
                'literal' => 'Para Ipad'
            );
        }

        if ( $contentTypeService->identifier == 'formato_internet' )
        {
            return array(
                'icon' => 'pc',
                'literal' => 'En Internet',
                'titleInfo' => 'qMementix'
            );
        }

    }

    public function getTabs( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );
        $productContent = $this->contentService->loadContent( $location->contentId );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier(
                    array(
                        'sistema_memento',
                        'ventajas_producto',
                        'condiciones_producto',
                        'novedades_producto',
                        'actualizaciones_producto',
                        'opiniones_clientes',
                        'noticias_relacionadas_producto',
                        'faqs_producto'
                    )
                )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;

        $contents = array();

        foreach ( $results as $result )
        {
            $content = $this->contentService->loadContent(
                $result->valueObject->contentInfo->id
            );

            $contentType = $this->contentTypeService->loadContentType( $content->contentInfo->contentTypeId )->identifier;
            $tabLiteral = $this->getLiteralForTab(
                $contentType,
                $location
            );

            $tabContent = $this->getContentForTab(
                $contentType,
                $productContent
            );

            $contents[] = array(
                'label' => $tabLiteral,
                'content' => $tabContent,
                'id' => $contentType
            );
        }

        return $contents;
    }

    private function getLiteralForTab( $class, Location $location )
    {
        switch ( $class )
        {
            case 'sistema_memento':
                return 'Sistema Memento';

            case 'ventajas_producto':
                return 'Ventajas';


            case 'condiciones_producto':
                return 'Condiciones';

            case 'novedades_producto':
                return $location->parentLocationId == 66 ? 'Últimas noticias' : 'Novedades';

            case 'actualizaciones_producto':
                return 'Actualizaciones';

            case 'faqs_producto':
                return 'Preguntas Frecuentes';

            case 'opiniones_clientes':
                return 'Opinión de los clientes';

            default:
                return 'Pestaña';
        }
    }

    private function getContentForTab( $class, Content $content )
    {
        switch ( $class )
        {
            case 'sistema_memento':
                return 'Sistema Memento';

            case 'ventajas_producto':
                return $this->contentExtension->renderField( $content, 'ventajas' );

            case 'condiciones_producto':
                return $this->contentExtension->renderField( $content, 'contenido' );

            case 'novedades_producto':
                return $this->contentExtension->renderField( $content, 'novedades' );

            case 'actualizaciones_producto':
                return $this->contentExtension->renderField( $content, 'actualizaciones' );

            default:
                return 'Pestaña';
        }
    }

    /**
     * Devuelve el formato asociado al producto pasado
     * para así obtener el precio
     *
     * @param $contentId
     *
     * @return Content|null
     * @throws \eZ\Publish\Core\Base\Exceptions\UnauthorizedException
     */
    public function getFormatForContent( $contentId )
    {
        $content =  $this->contentService->loadContent( $contentId );

        $productClass = $this->contentTypeService->loadContentType(
            $content->contentInfo->contentTypeId
        )->identifier;

        $formats = $this->getFormatosForLocation(
            $this->locationService->loadLocation(
                $content->contentInfo->mainLocationId
            )
        );

        if ( $productClass == 'producto' && isset( $formats['formato_papel'] ) )
        {
            return $formats['formato_papel']['content'];
        }

        if ( strpos( $productClass, 'formato' ) !== false )
        {
            return $content;
        }

        return null;
    }

    public function getFaqsForContent( Content $content, $fieldIdentifier )
    {
        $faqsValue = $content->getFieldValue( $fieldIdentifier );

        $faqs = array();
        foreach ( $faqsValue->destinationContentIds as $faqContentId )
        {
            $faqs[] = $this->contentService->loadContent( $faqContentId );
        }

        return $faqs;
    }

}
