<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/09/14
 * Time: 12:26
 */

namespace Efl\ReviewsBundle\Form\Type;

use Efl\WebServiceBundle\Security\WebserviceUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class ValoracionType extends AbstractType
{

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;

    /**
     * @var
     */
    private $currentUser;

    public function __construct(
        Translator $translator,
        WebserviceUser $user
    )
    {
        $this->translator = $translator;
        $this->currentUser = $user;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        print_r( $this->currentUser );
        $radioOptions = array();
        for ( $i = 1 ; $i <= 5 ; $i++ )
        {
            $radioOptions[$i] = '';
        }

        $builder->add(
            'calidad',
            'choice',
            array(
                'label' => 'Calidad',
                'choices' => $radioOptions,
                'expanded' => true,
                'multiple' => false
            )
        );

        $builder->add(
            'actualizaciones',
            'choice',
            array(
                'label' => 'Actualizaciones',
                'choices' => $radioOptions,
                'expanded' => true,
                'multiple' => false
            )
        );

        $builder->add(
            'facilidad',
            'choice',
            array(
                'label' => 'Facilidad de consulta',
                'choices' => $radioOptions,
                'expanded' => true,
                'multiple' => false
            )
        );

        $builder->add(
            'nombre',
            'text',
            array(
                'label' => 'Nombre',
                'attr' => array(
                    'class' => 'text'
                ),
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'apellido1',
            'text',
            array(
                'label' => 'Primer apellido',
                'attr' => array(
                    'class' => 'text'
                ),
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
                    'class' => 'text'
                ),
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
                'attr' => array(
                    'class' => 'text'
                ),
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'comentario',
            'textarea',
            array(
                'label' => 'En este campo puede escribirnos su opinión sobre la obra:',
                'required' => true,
                'attr' => array(
                    'class' => 'text',
                    'rows' => 5,
                    'cols' => 5
                ),
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'captcha', 'captcha',
            array(
                'invalid_message' => $this->translator->trans( 'El código introducido en el campo Captcha no es correcto' ),
                'width' => 200,
                'height' => 50,
                'attr' => array(
                    'class' => 'box text'
                )
            )
        );

        $builder->add(
            'send',
            'submit',
            array(
                'label' => 'Enviar Opinión',
                'attr' => array( 'class' => 'btn type2 hasIco' )
            )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(
            array(
                'calidad' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar un valor para el campo Calidad.', array(), 'suscripcion_newsletter')
                        )
                    ),
                ),
                'actualizaciones' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar un valor para el campo Actualizaciones.', array(), 'suscripcion_newsletter')
                        )
                    ),
                ),
                'facilidad' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar un valor para el campo Facilidad de Uso.', array(), 'suscripcion_newsletter')
                        )
                    ),
                ),
                'nombre' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo nombre es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'apellido1' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'El campo Primer Apellido es obligatorio.', array(), 'suscripcion_newsletter')
                        )
                    )
                ),
                'apellido2' => array(),
                'comentario' => array(),
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
        return 'efl_create_review';
    }
}
