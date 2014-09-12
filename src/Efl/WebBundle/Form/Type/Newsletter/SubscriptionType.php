<?php

namespace Efl\WebBundle\Form\Type\Newsletter;

use Efl\WebBundle\Form\Validator\Constraints\EmailAlreadySubscribed;
use Efl\WebBundle\Helper\NewsletterHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;
use eZ\Publish\API\Repository\LocationService;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class SubscriptionType extends AbstractType
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var \Efl\WebBundle\Helper\NewsletterHelper
     */
    private $newsletterHelper;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;

    /**
     * @var int
     */
    private $privacidadLocationId;

    public function __construct(
        $email = '',
        NewsletterHelper $helper,
        LocationService $locationService,
        RouterInterface $router,
        Translator $translator,
        $privacidadLocationId
    )
    {
        $this->email = $email;
        $this->newsletterHelper = $helper;
        $this->locationService = $locationService;
        $this->router = $router;
        $this->translator = $translator;
        $this->privacidadLocationId = $privacidadLocationId;
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

        $politicaPrivacidadLocation = $this->locationService->loadLocation(
            $this->privacidadLocationId
        );

        $builder->add(
            'conditions',
                'checkbox',
                array(
                    'required' => true,
                    'label' => /** @Ignore*/'Acepto las <a href="#">condiciones del servicio</a> y la <a target="_blank" href="' . $this->router->generate( $politicaPrivacidadLocation ) . '">política de privacidad</a>'
                )
        );

        $builder->add(
            'send',
            'submit',
            array(
                'label' => 'Enviar',
                'attr' => array( 'class' => 'btn type2 hasIco' )
            )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(
            array(
                'email' => array(
                    new Email(
                        array(
                            'message' => $this->translator->trans( 'Email incorrecto.', array(), 'suscripcion_newsletter' )
                        )
                    ),
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo email es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    ),
                    new EmailAlreadySubscribed(
                        array(
                            'message' => $this->translator->trans( 'El email ya estaba incluído en la lista.', array(), 'suscripcion_newsletter')
                    ))
                ),
                'Subscription_FirstName' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo nombre es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'Subscription_LastName' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo Primer Apellido es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'Subscription_LastName_2' => array(),
                'cp' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo código postal es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'phone' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo teléfono es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'job' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar su actividad profesional.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'areas' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar al menos un área de interés', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'ebooks' => array(),
                'conditions' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe aceptar las condiciones del servicio y la política de privacidad', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
            )
        );

        $resolver->setDefaults(
            array(
                'constraints' => $collectionConstraint
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
