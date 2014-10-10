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
       }
    }

    public function getName()
    {
        return 'efl_cart';
    }
}
