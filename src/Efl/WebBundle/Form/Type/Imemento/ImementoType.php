<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 14:05
 */

namespace Efl\WebBundle\Form\Type\Imemento;

use eZ\Publish\API\Repository\LocationService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ImementoType extends AbstractType
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;

    private $locationService;

    private $router;

    private $privacidadLocationId;

    public function __construct(
        Translator $translator,
        LocationService $locationService,
        RouterInterface $routerInterface,
        $privacidadLocationId
    )
    {
        $this->translator = $translator;
        $this->locationService = $locationService;
        $this->router = $routerInterface;
        $this->privacidadLocationId = $privacidadLocationId;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->setAction( $this->router->generate( 'imemento_postform' ) );
        $builder->add(
            'nombre',
            'text',
            array(
                'label' => 'Nombre',
                'label_attr' => array(
                    'class' => 'field row'
                ),
                'attr' => array(
                    'id' => 'name'
                )
            )
        );

        $builder->add(
            'apellido1',
            'text',
            array(
                'label' => 'Primer apellido',
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'apellido2',
            'text',
            array(
                'label' => 'Segundo apellido',
                'attr' => array(
                    'placeholder' => '(opcional)'
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
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'email',
            'text',
            array(
                'label' => 'Correo electrónico',
                'required' => true,
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'cp',
            'text',
            array(
                'label' => 'Código postal',
                'required' => true,
                'label_attr' => array(
                    'class' => 'field row'
                )
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
                'label' => 'Continuar',
                'attr' => array( 'class' => 'btn type2 hasIco' )
            )
        );

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                if ( !empty( $data['nombre'] ) )
                {
                    $form->add( 'nombre', 'text', array( 'attr' => array( 'readonly' => true ) ) );
                }
                if ( !empty( $data['apellido1'] ) )
                {
                    $form->add( 'apellido1', 'text', array( 'attr' => array( 'readonly' => true ) ) );
                }
                if ( !empty( $data['apellido2'] ) )
                {
                    $form->add( 'apellido2', 'text', array( 'attr' => array( 'readonly' => true ) ) );
                }
                if ( !empty( $data['email'] ) )
                {
                    $form->add( 'email', 'text', array( 'attr' => array( 'readonly' => true ) ) );
                }
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(
            array(
                'email' => array(
                    new Email(
                        array(
                            'message' => $this->translator->trans( 'Email incorrecto.', array(), 'formulario_qmementix' )
                        )
                    ),
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo email es obligatorio.', array(), 'formulario_qmementix')
                        )
                    ),
                ),
                'nombre' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo nombre es obligatorio.', array(), 'formulario_qmementix')
                        )
                    )
                ),
                'apellido1' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo Primer Apellido es obligatorio.', array(), 'formulario_qmementix')
                        )
                    )
                ),
                'apellido2' => array(),
                'cp' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo código postal es obligatorio.', array(), 'formulario_qmementix')
                        )
                    )
                ),
                'phone' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo teléfono es obligatorio.', array(), 'formulario_qmementix')
                        )
                    )
                ),

                'conditions' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe aceptar las condiciones del servicio y la política de privacidad', array(), 'formulario_qmementix')
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

    public function getName()
    {
        return 'efl_imemento';
    }
}
