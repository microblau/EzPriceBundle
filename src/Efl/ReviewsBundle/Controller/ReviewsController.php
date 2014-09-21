<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/09/14
 * Time: 12:09
 */

namespace Efl\ReviewsBundle\Controller;

use Efl\ReviewsBundle\Pagination\PagerFanta\ReviewsAdapter;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\Location;
use Pagerfanta\Pagerfanta;

class ReviewsController extends Controller
{
    public function reviewsAction( Location $location )
    {
        $pager = new Pagerfanta(
            new ReviewsAdapter(
                $this->get( 'eflweb.reviews_service' ),
                $location
            )
        );

        $pager->setMaxPerPage( 3 );
        $page = $this->container->get('request_stack')->getCurrentRequest()->get( 'page', 1 );
        $pager->setCurrentPage( $page );

        return $this->render(
            'EflReviewsBundle::reviews.html.twig',
            array(
                'reviews' => $pager,
                'nbResults' => $pager->getNbResults(),
                'location' => $location,
                'page' => $page
            )
        );

    }

    public function pagerAction( $locationId, $page = 1 )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $pager = new Pagerfanta(
            new ReviewsAdapter(
                $this->get( 'eflweb.reviews_service' ),
                $location
            )
        );

        $pager->setMaxPerPage( 3 );
        $pager->setCurrentPage( $page );

        return $this->render(
            'EflReviewsBundle::reviews.html.twig',
            array(
                'reviews' => $pager,
                'location' => $location,
                'nbResults' => $pager->getNbResults(),
                'page' => $page
            )
        );
    }
} 