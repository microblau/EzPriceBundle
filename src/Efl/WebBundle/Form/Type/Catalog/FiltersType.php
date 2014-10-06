<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 6/10/14
 * Time: 10:19
 */

namespace Efl\WebBundle\Form\Type\Catalog;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Efl\WebBundle\Helper\CatalogHelper;
use Symfony\Component\Routing\RouterInterface;

class FiltersType extends AbstractType
{
    /**
     * @var CatalogHelper
     */
    private $catalogHelper;

    private $router;

    public function __construct(
        CatalogHelper $catalogHelper,
        RouterInterface $routerInterface
    )
    {
        $this->catalogHelper = $catalogHelper;
        $this->router = $routerInterface;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $areas = $this->getRamasDerecho();
        $types = $this->getProductTypes();

        $builder
            ->setMethod( 'get' )
            ->setAction(
                $this->router->generate( 'catalog_search' )
            )
            ->add(
                'areas',
                'choice',
                array(
                    'label' => 'Ramas del derecho',
                    'choice_list' => $areas,
                    'required' => false
                )
            );

        $builder
            ->add(
                'types',
                'choice',
                array(
                    'label' => 'Tipo',
                    'choice_list' => $types,
                )
            );

        $builder
            ->add(
                'states',
                'choice',
                array(
                    'label' => 'Estado',
                    'choice_list' => new SimpleChoiceList(
                        array(
                            '' => '',
                            '1' => 'En prepublicación',
                            '2' => 'Novedades',
                            '3' => 'Ofertas',
                            '4' => 'Packs'
                        )
                    )
                )
            );

        $builder
            ->add(
                'formats',
                'choice',
                array(
                    'label' => 'Formato',
                    'attr' => array( 'class' => 'format' ),
                    'choice_list' => new SimpleChoiceList(
                        array(
                            '' => '',
                            '1' => 'En Papel',
                            '2' => 'Para Ipad (iMemento)',
                            '3' => 'Versión online (qMementix)'
                        )
                    )
                )
            );

        $builder->add(
            'search',
            'submit',
            array(
                'label' => 'Buscar',
                'attr' => array( 'class' => 'btn type3 hasIco' )
            )
        );

    }

    public function getName()
    {
        return 'efl_catalog_filter';
    }

    /**
     * Obtiene las ramas del derecho para el combo
     *
     * @return SimpleChoiceList
     */
    private function getRamasDerecho()
    {
        $ramas = $this->catalogHelper->getRamasDelDerecho();
        return new SimpleChoiceList(
            array(
                '' => ''
            ) + $ramas
        );
    }

    /**
     * Distintos formatos de producto.
     *
     * @return SimpleChoiceList
     */
    private function getProductTypes()
    {
        $types = $this->catalogHelper->getProductTypes();
        return new SimpleChoiceList(
            array(
                '' => ''
            ) + $types
        );
    }
}
