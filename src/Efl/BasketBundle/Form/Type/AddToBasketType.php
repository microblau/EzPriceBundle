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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;

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

    private $basketService;

    public function __construct(
        array $formats,
        Translator $translator,
        BasketService $basketService
    )
    {
        $this->formats = $formats;
        $this->translator = $translator;
        $this->basketService = $basketService;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $formats = $data = array();
        if ( count ($this->formats ) )
        {
            foreach ( $this->formats as $format )
            {
                $id = $format['content']->id;
                $formats[$id] = $id;
                if ( $this->basketService->isProductInBasket( $id ) )
                {
                    $data[] = $id;
                }

            }

            $builder->add(
                'formats',
                'choice',
                array(
                    'choices' => $formats,
                    'expanded' => true,
                    'multiple' => true,
                    'data' => $data
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
                'formats' => array(),
                //'data' => array()
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
