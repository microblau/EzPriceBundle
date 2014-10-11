<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/10/14
 * Time: 14:32
 */

namespace Efl\BasketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;

class CartType extends AbstractType
{
    /**
     * @var BasketService
     */
    private $basketService;

    public function __construct(
        BasketService $basketService
    )
    {
        $this->basketService = $basketService;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        foreach ( $this->basketService->getCurrentBasket()->getItems() as $item )
        {
            $builder->add(
                'delete_' . $item->id,
                'submit',
                array(
                    'label' => 'Eliminar de la cesta'
                )
            );

            if ( $item->isA( 'formato_papel' ) )
            {
                $builder->add(
                    'quantity_' . $item->id,
                    'text',
                    array(
                        'data' => $item->itemCount
                    )
                );
            }

            $builder->add(
                'voucher_code',
                'text',
                array(
                    'label' => 'Código del cupón',
                    'data' => $this->basketService->getCurrentBasket()->getDiscountCode(),
                    'attr' => array(
                        'class' => 'voucher-code'
                    ),
                    'label_attr' => array(
                        'class' => 'offscreen'
                    )
                )
            );

            $builder->add(
                'apply_coupon',
                'submit',
                array(
                    'label' => 'Aplicar',
                    'attr' => array( 'class' => 'btn type5' )
                )
            );

            $builder->add(
                'update_cart',
                'submit',
                array(
                    'label' => 'Actualizar',
                    'attr' => array( 'class' => 'btn type5' )
                )
            );
        }
    }

    public function getName()
    {
        return 'efl_cart';
    }
}
