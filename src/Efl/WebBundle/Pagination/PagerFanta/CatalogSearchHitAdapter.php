<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 3/10/14
 * Time: 19:19
 */

namespace Efl\WebBundle\Pagination\PagerFanta;

use Pagerfanta\Adapter\AdapterInterface;
use eZ\Publish\Core\MVC\Legacy\Kernel;
use eZFunctionHandler;

class CatalogSearchHitAdapter implements  AdapterInterface
{
    /**
     * @var \eZ\Publish\Core\MVC\Legacy\Kernel
     */
    private $legacyKernel;

    /**
     * @var int
     */
    private $nbResults;

    /**
     * @var string
     */
    private $searchTerm;

    /**
     * @var array
     */
    private $defaultSearchParams;

    /**
     * Constructor
     *
     * @param \eZ\Publish\Core\MVC\Legacy\Kernel $legacyKernel
     * @param string $searchTerm
     */
    public function __construct( Kernel $legacyKernel, $searchTerm )
    {
        $this->legacyKernel = $legacyKernel;
        $this->searchTerm = $searchTerm;
        $this->defaultSearchParams = array(
            'query' => $this->searchTerm,
            'as_objects' => false,
            'class_id' => array( 'producto' ),
            'fields_to_return' => array( 'id' )
        );
    }

    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     */
    public function getNbResults()
    {
        if ( isset( $this->nbResults ) )
        {
            return $this->nbResults;
        }

        $searchResults = $this->doSearch( $this->defaultSearchParams + array( 'limit' => 0 ) );

        return $this->nbResults = $searchResults['SearchCount'];
    }

    /**
     * Returns as slice of the results, as SearchHit objects.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Search\SearchHit The slice.
     */
    public function getSlice( $offset, $length )
    {
        $sort = array(
            'score' => 'desc',
            'published' => 'desc',
        );

        $searchParams = $this->defaultSearchParams + array(
                'sort' => $sort,
                'offset' => $offset,
                'limit' => $length
            );

        $searchResults = $this->doSearch( $searchParams );


        if ( !isset( $this->nbResults ) )
        {
            $this->nbResults = $searchResults['SearchCount'];
        }

        return $searchResults['SearchResult'];
    }

    /**
     * Executes the eZFind query via callback function
     *
     * @param array $searchParams
     * @return array eZFindResult
     */
    private function doSearch( array $searchParams )
    {
        return $this->legacyKernel->runCallback(
            function () use ( $searchParams )
            {
                return eZFunctionHandler::execute(
                    'ezfind',
                    'search',
                    $searchParams
                );
            }
        );
    }
}
