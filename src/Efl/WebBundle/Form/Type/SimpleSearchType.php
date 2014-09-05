<?php

namespace Efl\WebBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SimpleSearchType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->setMethod( 'GET' )
            ->add( 'searchText', 'text' )
            ->add( 'save', 'submit');
    }

    public function getName()
    {
        return 'efl_simple_search';
    }

    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults( array( 'data_class' => 'Efl\WebBundle\Entity\SimpleSearch' ) );
    }
}
