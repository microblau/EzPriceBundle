<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 3/10/14
 * Time: 19:19
 */

namespace Efl\WebBundle\Pagination\PagerFanta;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\MVC\Legacy\Kernel;
use Efl\WebBundle\Pagination\PagerFanta\CatalogSearchHitAdapter;

class CatalogSearchAdapter extends CatalogSearchHitAdapter
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    protected $contentService;

    public function __construct( Kernel $legacyKernel, $searchTerm, ContentService $contentService )
    {
        parent::__construct( $legacyKernel, $searchTerm );
        $this->contentService = $contentService;
    }

    /**
     * Returns a slice of the results as Content objects.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content The slice.
     */
    public function getSlice( $offset, $length )
    {
        $list = array();
        foreach ( parent::getSlice( $offset, $length ) as $hit )
        {
            $list[] = $this->contentService->loadContent( $hit['id'] );
        }

        return $list;
    }
}
