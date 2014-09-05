<?php

namespace Efl\WebBundle\Form\Type\Newsletter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;

class SubscriptionBoxType extends AbstractType
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    protected $router;

    public function __construct( RouterInterface $router )
    {
        $this->router = $router;
    }

    /**
     * Construye la caja de suscripción a newsletter que se ve en el pie de página
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->setAction( $this->router->generate( 'newsletter_subscribe' ) )
            ->add(
                'email',
                'text',
                array(
                    'label' => null,
                    'attr' => array(
                        'class' => 'text',
                        'placeholder' => 'Introduzca su email'
                    )
                )
            )
            ->add(
                'save',
                'submit',
                array(
                    'label' => 'Enviar',
                    'attr' => array(
                        'class' => 'submit btn hasIco type3'
                    )
                )
            );
    }

    public function getName()
    {
        return 'efl_newsletter_subscription_box';
    }
}
