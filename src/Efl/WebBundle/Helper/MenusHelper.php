<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 29/09/14
 * Time: 8:47
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\URLAliasService;
use eZ\Publish\Core\Repository\ContentService;
use Symfony\Component\HttpFoundation\RequestStack;

class MenusHelper
{
    /**
     * @var RequestStack
     */
    private $request;

    private $URLAliasService;

    private $locationService;

    private $contentService;

    public function __construct(
        URLAliasService $URLAliasService,
        LocationService $locationService,
        ContentService $contentService
    )
    {
        $this->URLAliasService = $URLAliasService;
        $this->locationService = $locationService;
        $this->contentService = $contentService;
    }

    public function setRequest(
        RequestStack $request_stack
    )
    {
        $this->request = $request_stack->getCurrentRequest();

    }

    public function getSelectedMainMenuItem( $route = '', $locationId = null )
    {
        if ( strpos( $route, 'qmementix' ) !== false )
        {
            return 69;
        }

        if ( strpos( $route, 'imemento' ) !== false )
        {
            return 11152;
        }

        if ( strpos( $route, 'qmemento' ) !== false )
        {
            return 70;
        }

        if ( $route == 'ez_urlalias' )
        {
            $contentTypeId = $this->contentService->loadContent(
                $this->locationService->loadLocation( $locationId )->contentId
            )->contentInfo->contentTypeId;

            if ( $contentTypeId == 99 )
            {
                return 70;
            }

            if ( $locationId ==  61 )
            {
                return 61;
            }
        }

        return 2;
    }
} 