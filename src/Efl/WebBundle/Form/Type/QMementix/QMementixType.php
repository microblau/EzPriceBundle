<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 14:05
 */

namespace Efl\WebBundle\Form\Type\QMementix;

use eZ\Publish\API\Repository\LocationService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Routing\RouterInterface;

class QMementixType extends AbstractType
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
        $builder->add(
            'nombre',
            'text',
            array(
                'label' => 'Nombre',
                'attr' => array(
                    'class' => 'text'
                ),
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
                'label_attr' => array(
                    'class' => 'field row'
                )
            )
        );

        $builder->add(
            'telefono',
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
                'attr' => array(
                    'class' => 'text'
                ),
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
    }

    public function getName()
    {
        return 'efl_qmementix';
    }
}
