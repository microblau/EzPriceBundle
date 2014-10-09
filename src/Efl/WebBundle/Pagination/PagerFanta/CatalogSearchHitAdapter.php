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
     * @var array
     */
    private $params;

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
    public function __construct( Kernel $legacyKernel, $params = array() )
    {
        $this->legacyKernel = $legacyKernel;
        $this->params = $this->addSearchParams( $params );
        $this->defaultSearchParams = array(
            'query' => '',
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

        $searchResults = $this->doSearch(
            $this->defaultSearchParams + $this->params +  array( 'limit' => 0 )
        );

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

        $searchParams = $this->defaultSearchParams + $this->params + array(
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

    public function addSearchParams( array $params = array() )
    {
        $filter = $subTree = $queryParams = array();

        // areas
        if ( isset( $params['areas'] ) )
        {
            $areas = $params['areas'];
            if ( !is_array( $params['areas'] ) )
            {
                $areas = array( $params['areas'] );
            }

            $filter['areas'] = array();
            $filter['areas'][] = 'or';
            foreach ( $areas as $area )
            {
                $filter['areas'][] = 'submeta_area___id____si:' . $area;
            }
        }

        // types
        if ( isset( $params['types'] ) )
        {
            $types = $params['types'];
            if ( !is_array( $params['types'] ) )
            {
                $types = array( $params['types'] );
            }

            foreach ( $types as $type )
            {
                $subTree[] = $type;
            }
        }

        //states
        if ( isset( $params['state'] ) )
        {
            switch( $params['state'] )
            {
                case 1:
                    $filter['prepublicaciones'] = array(
                        'attr_fecha_aparicion_dt:[NOW TO NOW/DAY+90DAY]'
                    );
                break;

                case 2:
                    $filter['prepublicaciones'] = array(
                        'attr_fecha_aparicion_dt:[NOW/DAY-90DAY TO NOW]'
                    );
                break;

                default:;
            }
        }

        if ( !empty ( $filter ) )
        {
            $queryParams['filter'] = array( 'and', $filter );
        }

        if ( !empty( $subTree ) )
        {
            $queryParams['subtree_array'] = $subTree;
        }

        return  $queryParams;
    }
}
