<?php

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\Newsletter\SubscriptionBoxType;
use Efl\WebBundle\Form\Type\Newsletter\SubscriptionType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    /**
     * @return Response
     */
    public function suscriptionBoxAction()
    {
        $response = new Response();

        $form = $this->createForm( new SubscriptionBoxType( $this->get( 'router' ) ) );

        return $this->render(
            'EflWebBundle:footer:newsletter_subscription.html.twig',
            array(
                'form' => $form->createView()
            ),
            $response
        );
    }

    public function subscribeAction( Request $request )
    {
        $response = new Response();

        $form = $this->createForm( new SubscriptionBoxType( $this->get( 'router') ) );
        $email = '';

        if ( $request->isMethod( 'post' ) )
        {
            $form->bind( $request );
            $email = $form->get( 'email' )->getData();
        }

        $subscriptionForm = $this->createForm( new SubscriptionType(
            $email,
            $this->get( 'eflweb.newsletter_helper' )
        ));

        return $this->render(
            'EflWebBundle:newsletter:subscription_form.html.twig',
            array(
                'form' => $subscriptionForm->createView()
            )
        );

    }
}
