<?php

namespace Efl\WebBundle\Form\Type\Faqs;

use Symfony\Component\Form\AbstractType;
use Efl\WebBundle\Helper\FaqsHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;

class GroupsType extends AbstractType
{
    /**
     * @var \Efl\WebBundle\Helper\FaqsHelper
     */
    private $faqsHelper;

    /**
     * @var int
     */
    private $locationId;

    public function __construct( FaqsHelper $faqsHelper, $locationId )
    {
        $this->faqsHelper = $faqsHelper;
        $this->locationId = $locationId;
    }

    /**
     * Construye la caja de suscripción a newsletter que se ve en el pie de página
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $choices = $this->faqsHelper->getFaqGroups();

        $builder
            ->add(
                'group',
                'choice',
                array(
                    'label' => 'Seleccione el tipo de preguntas que desea consultar',
                    'choice_list' => $choices,
                    'data' => $this->locationId
                )
            );
    }

    public function getName()
    {
        return 'efl_faqs_groups';
    }
}
