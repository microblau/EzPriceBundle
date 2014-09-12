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
    protected $faqsHelper;

    public function __construct( FaqsHelper $faqsHelper )
    {
        $this->faqsHelper = $faqsHelper;
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
                    'choice_list' => $choices
                )
            );
    }

    public function getName()
    {
        return 'efl_faqs_groups';
    }
}
