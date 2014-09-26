<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 24/09/14
 * Time: 16:15
 */

namespace Efl\BasketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class AddToBasketType extends AbstractType
{
    /**
     * @var \eZ\Publish\API\Repository\Values\Content\Content[]
     */
    private $formats;

    /**
     * @var Translator
     */
    private $translator;

    public function __construct(
        array $formats,
        Translator $translator
    )
    {
        $this->formats = $formats;
        $this->translator = $translator;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $formats = array();
        if ( count ($this->formats ) )
        {
            foreach ( $this->formats as $format )
            {
                $formats[$format['content']->id] = $format['content']->id;
            }

            $builder->add(
                'formats',
                'choice',
                array(
                    'choices' => $formats,
                    'expanded' => true,
                    'multiple' => true
                )
            );

            $builder->add(
                'buy',
                'submit',
                array(
                    'label' => 'Comprar ahora',
                    'attr' => array( 'class' => 'btn type2 hasIco' )
                )
            );
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(
            array(
                'formats' => array(
                    new NotBlank(
                        array(
                            'message' => $this->translator->trans( 'Debe seleccionar al menos un formato')
                        )
                    )
                )
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
        return 'efl_add_to_basket';
    }

}
