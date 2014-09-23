<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/09/14
 * Time: 12:09
 */

namespace Efl\ReviewsBundle\Controller;


use Efl\ReviewsBundle\Form\Type\ValoracionType;
use Efl\ReviewsBundle\Pagination\PagerFanta\ReviewsAdapter;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Pagerfanta\Pagerfanta;

class ReviewsController extends Controller
{
    /**
     * Reviews paginados por producto
     *
     * @param $locationId
     * @param int $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pagerAction( $locationId, $page = 1 )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $pager = new Pagerfanta(
            new ReviewsAdapter(
                $this->get( 'eflweb.reviews_service' ),
                $location
            )
        );

        $pager->setMaxPerPage( $this->container->getParameter( 'eflweb.reviews_per_page' ) );
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

    public function createReviewAction( $locationId )
    {
        $currentUserId = $this->get( 'eflweb.utils_helper' )->getCurrentRepositoryUserId();
        $request = $this->container->get( 'request_stack' )->getCurrentRequest();
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $content = $this->getRepository()->getContentService()->loadContent( $location->contentId );
        $parentLocation = $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId );
        $parentContent = $this->getRepository()->getContentService()->loadContent( $parentLocation->contentId );
        $currentUserData = $this->get( 'eflweb.utils_helper' )->getCurrentUserFriendlyData();
        $form = $this->createForm(
            new ValoracionType( $this->get( 'translator' ) ), $currentUserData
        );

        if ( $request->isMethod( 'post' ) )
        {
            $form->bind( $request );

            if ( $form->isValid() )
            {
                $this->get( 'eflweb.reviews_service' )->createReviewFromPost(
                    $locationId,
                    $this->get( 'eflweb.utils_helper' )->getCurrentRepositoryUserId(),
                    $form->getData()
                );

                $this->get( 'session' )->getFlashBag()->add(
                    'notice',
                    $this->get( 'translator' )->trans( 'Gracias por su opinión. Nuestro equipo la revisará y la publicará próximamente.' )
                );

                return $this->redirect(
                    $this->generateUrl( 'create_review', array( 'locationId' => $locationId ))
                );
            }

        }

        return $this->render(
            'EflReviewsBundle::form.html.twig',
            array(
                'content' => $content,
                'parentContent' => $parentContent,
                'haVotado' => ( $currentUserId != 10 ) && $this->get( 'eflweb.reviews_service' )->userHasReviewedLocation( $currentUserId, $locationId ),
                'form' => $form->createView()
            )
        );
    }
}
