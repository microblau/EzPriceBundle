<?php

namespace Efl\WebBundle\Form\Type\Newsletter;

use Efl\WebBundle\Helper\NewsletterHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;

class SubscriptionType extends AbstractType
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var \Efl\WebBundle\Helper\NewsletterHelper;
     */
    private $newsletterHelper;
    /**
     * @param string $email
     * @param NewsletterHelper $helper
     */
    public function __construct( $email = '', NewsletterHelper $helper )
    {
        $this->email = $email;
        $this->newsletterHelper = $helper;
    }
    /**
     * Formulario suscripción a newsletter
     * Recogerá el valor del post para añadirselo como value
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add(
                'email',
                'text',
                array(
                    'label' => 'Correo electrónico',
                    'data' => $this->email,
                    'required' => true,
                    'attr' => array(
                        'class' => 'text',
                        'placeholder' => 'Introduzca su email'
                    ),
                    'label_attr' => array(
                        'class' => 'field row'
                    )
                )
            );

        $builder->add(
            'Subscription_FirstName',
            'text',
            array(
                'label' => 'Nombre',
                'required' => true,
                'attr' => array(
                    'class' => 'text'
                ),
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
                'Subscription_LastName',
                'text',
                array(
                    'label' => 'Primer Apellido',
                    'required' => true,
                    'attr' => array(
                        'class' => 'text'
                    ),
                    'label_attr' => array(
                        'class' => 'field row'
                    )
                )
        );

        $builder->add(
                'Subscription_LastName_2',
                'text',
                array(
                    'label' => 'Segundo Apellido',
                    'required' => false,
                    'attr' => array(
                        'class' => 'text',
                        'placeholder' => '(este dato no es obligatorio)'
                    ),
                    'label_attr' => array(
                        'class' => 'field row'
                    )
                )
        );

        $builder->add(
            'cp',
            'text',
            array(
                'label' => 'Código Postal',
                'required' => true,
                'attr' => array(
                    'class' => 'text',
                ),
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'phone',
            'text',
                array(
                    'label' => 'Teléfono',
                    'required' => true,
                    'attr' => array(
                        'class' => 'text',
                    ),
                    'label_attr' => array(
                        'class' => 'field row'
                    )
                )
        );

        $builder->add(
            'job',
            'choice',
            array(
                'label' => 'Actividad',
                'choices' => array(
                    '' => '',
                    'Trabajo 1' => 'Trabajo 1',
                    'Trabajo 2' => 'Trabajo 2',
                    'Trabajo 3' => 'Trabajo 3',
                    'Trabajo 4' => 'Trabajo 4'
                ),
                'required' => true
            )
        );

        $builder->add(
            'areas',
            'choice',
            array(
                'expanded' => true,
                'multiple' => true,
                'label' => 'Intereses',
                'choice_list' => $this->getAreasInteres()
            )
        );

        $builder->add(
            'ebooks',
            'choice',
            array(
                'expanded' => true,
                'multiple' => false,
                'label' => 'eBook de regalo',
                'choice_list' => $this->getEbooksRegalo()
            )
        );
    }

    /**
     * Obtiene las áreas de interés definidas en el gestor
     *
     * @return \Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList
     */
    private function getAreasInteres()
    {
        return $this->newsletterHelper->getAreasInteres();
    }

    /**
     * Obtiene los Ebooks definidos como regalo
     */
    private function getEbooksRegalo()
    {
        return $this->newsletterHelper->getEbooksRegalo();
    }

    public function getName()
    {
        return 'efl_newsletter_subscription';
    }
}
